<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_invoice_no()
{
	$ci = &get_instance();
	$query = $ci->db->select('*')->from(DB_INVOICE)->like('invoice_no', 'INV', 'after')->order_by('id', 'DESC')->limit(1)->get();
	$result = $query->row();
	if ($result) {
		return 'INV00' . (substr($result->invoice_no, 3) + 1);
	} else {
		return 'INV001';
	}
}


// CRON INVOICE *************************************************************************************/
function send_cron_invoice()
{
	$ci = &get_instance();

	$invoice_billing_date = date('Y-m-d H:i');


	// ACTIVE STUDENT DATA
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
	$query1 = $ci->db->get()->result();
	// var_dump($query1);
	// die();
	if ($query1) {
		foreach ($query1 as $result1) {
			$student_id = $result1->student_id;
			$class_id = $result1->class_id;

			// ENROLLMENT DATA
			$ci->db->select('*');
			$ci->db->from('student_enrollment');
			$ci->db->where(['student_id'	=>	$student_id, 'class_id'	=>	$class_id]);
			$query2 = $ci->db->get()->row();
			$result2 = $query2;

			// BILLING DATA
			$query3 = $ci->db->query("select * from billing where DATE_FORMAT(invoice_generation_date, '%d-%m-%Y %H:%i')  =  DATE_FORMAT('$invoice_billing_date', '%d-%m-%Y %H:%i')");
			$result3 = $query3->row();
			// var_dump($query2);
			// die();

			// STATUS AS BOOLEAN
			$status = 0;

			// DEFINE VARIABLES

			$invoice_generation_date = $result1->invoice_generation_date;

			$invoice_id = uniqid();
			$invoice_no = get_invoice_no();
			$date = date('Y-m-d H:i:s');
			$invoice_file = $invoice_id . '__invoice_pdf-' . $date . '.pdf';
			$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);

			$frequency = $result1->frequency;
			$class_code = $result1->class_code;
			$emailto = [$result1->email, $result1->parent_email];
			$fees = $result1->monthly_fees;
			$extra_charges = isset($result2->extra_charges) ? $result2->extra_charges : 0;
			$deposit = $result1->deposit_fees;
			$previous_month_balance = isset($result2->previous_month_balance) ? $result2->previous_month_balance : 0;
			$previous_month_payment = isset($result2->previous_month_payment) ? $result2->previous_month_payment : 0;
			$counter = 0;
			$invoice_amount = $amount_excluding_material = $lesson_fees = 0;
			$book_price_amount = get_invoice_result2($student_id, $invoice_generation_date, $class_code);
			$book_charges = $book_price_amount;
			$billing_data = json_decode($result3->billing);

			// INVOICE EMAIL DATA
			$subject = 'Invoice #' . $invoice_no;
			$message = '<a href="' . $file_path . '">Click here </a> to view invoice.';
			$invoice_content = ['subject' => $subject, 'message' => $message];

			// CHECK FIRST MONTH INVOICE EXIST
			$ci->db->select('*');
			$ci->db->from(DB_INVOICE);
			$ci->db->where('student_id', $student_id);
			$ci->db->where('class_id', $class_id);
			$ci->db->where('type', 'first_month_invoice');
			$query4 = $ci->db->get()->result();
			//var_dump($query4);
			if ($query4) {
				// GENERATE REST MONTH INVOICE ***************************/
				$status = 1;
				$type = 'rest_month_invoice';
				$invoice_amount = ($fees + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment);
				$amount_excluding_material = ($invoice_amount - $book_charges);
				$lesson_fees = $fees;
				$returned_deposit = 0;
			} else {
				// GENERATE FIRST MONTH INVOICE ***************************/
				$type = 'first_month_invoice';
				$first_month_attendance_data = getFirstMonthAttendanceDate($student_id, $class_code);
				//var_dump($first_month_attendance_data);
				if ($first_month_attendance_data) {
					foreach ($billing_data as $billing) {
						$no_week_count = [$billing->working_week, $billing->rest_week];
						if (in_array(1, $no_week_count) == false) {
							$dates = explode("-", $billing->date_range);
							if (strtotime(str_replace("-", "/", $first_month_attendance_data->attendance_date)) <= strtotime($dates[1])) {
								$attendance_status = json_decode($first_month_attendance_data->status);
								$counter += array_sum($attendance_status);
							}
							//echo $counter . "<br/>";
						}
					}
					//die();

					$invoice_amount = ((($counter * $fees) / $frequency) + $book_charges + $extra_charges);
					
					$amount_excluding_material = ($invoice_amount - $book_charges);
					$lesson_fees =(($counter * $fees) / $frequency);
					$returned_deposit = 0;
					$status = 1;
				}
			}
			if ($status === 1) {

				$invoice_data = ['class_code' => $class_code, 'lesson_fee' => number_format($lesson_fees, 2), 'material_fees' => number_format($book_charges, 2), 'extra_charges' => number_format($extra_charges, 2), 'previous_month_payment' => number_format($previous_month_payment, 2), 'previous_month_balance' => number_format($previous_month_balance, 2), 'returned_deposit'	=>	number_format($returned_deposit, 2)];

				$invoice = ['invoice_id' => $invoice_id, 'invoice_no' => $invoice_no, 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data), 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];
				

				// INSERT INVOICE DATA
				$query5 = $ci->db->insert(DB_INVOICE, $invoice);


				// UPDATE EXTRA CHARGE AND PREVIOUS MONTH PAYMENT TO ZERO
				$ci->db->where('student_id', $student_id);
				$ci->db->where('class_id', $class_id);
				$ci->db->update('student_enrollment', ['extra_charges' => 0, 'previous_month_payment' => 0]);

				// SEND MAIL AND GENERATE PDF
				if ($query5) {
					$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
					$ci->load->library('M_pdf');
					$ci->m_pdf->download_my_mPDF($invoice_file);
					echo "<br> Invoice has been generated.";
					if ($mail == true) {
						echo "<br> Email Sent.";
					}
				}
			}
		}
	}
}

function send_archived_invoice($student_id)
{

	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_STUDENT . '.student_id' => $student_id]);
	$query = $ci->db->get();
	$result = $query->result();
	foreach ($result as $row) {
		send_archive_invoice_extend($student_id, $row->class_id);
	}

	$ci->db->where('student_id', $row->student_id);
	$ci->db->where('class_id', $row->class_id);
	$ci->db->update('student_enrollment', ['extra_charges' => 0, 'previous_month_payment' => 0]);
}

function send_archive_invoice_extend($student_id, $class_id)
{

	$ci = &get_instance();

	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	if($result1)
	{
		$type = 'archive_invoice';

		// ENROLLMENT DATA
		$ci->db->select('*');
		$ci->db->from('student_enrollment');
		$ci->db->where(['student_id'	=>	$student_id, 'class_id'	=>	$class_id]);
		$query2 = $ci->db->get()->row();
		$result2 = $query2;
	
		// DEFINE VARIABLES
	
		$invoice_id = uniqid();
		$invoice_no = get_invoice_no();
		$date = date('Y-m-d H:i:s');
		$invoice_file = $invoice_id . '__invoice_pdf-' . $date . '.pdf';
		$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	
		$frequency = $result1->frequency;
		$class_code = $result1->class_code;
		$emailto = [$result1->email, $result1->parent_email];
		$fees = $result1->monthly_fees;
		$extra_charges = isset($result2->extra_charges) ? $result2->extra_charges : 0;
		$deposit = $result1->deposit_fees;
		$previous_month_balance = isset($result2->previous_month_balance) ? $result2->previous_month_balance : 0;
		$previous_month_payment = isset($result2->previous_month_payment) ? $result2->previous_month_payment : 0;
		$invoice_amount = $amount_excluding_material = $lesson_fees = 0;

		// INVOICE GENERATION DATE
		$result3 = get_invoice_result5();
		$query4 = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result3]);
		$result4 = $query4->row();
		$billing_data = json_decode($result4->billing);

		$book_price_amount = get_invoice_result2($student_id, $result3, $class_code);
		$book_charges = $book_price_amount;
		
	
		// INVOICE EMAIL DATA
		$subject = 'Invoice #' . $invoice_no;
		$message = '<a href="' . $file_path . '">Click here </a> to view invoice.';
		$invoice_content = ['subject' => $subject, 'message' => $message];

		$L = $M = $E = $X = $G = $H = [];
		$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
		$X1 = $G1 = [];
		if ($value_since_enrollment) {
			$X1 = $value_since_enrollment['X'];
			$G1 = $value_since_enrollment['G'];
		}
	

	
		$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $class_code]);
		if ($query->num_rows() > 0) {
			foreach ($billing_data as $billing) {
				$no_week_count = [$billing->working_week, $billing->rest_week];
				if (in_array(1, $no_week_count) == false) {
					$dates = explode("-", $billing->date_range);
					foreach ($query->result() as $row) {
						$status = json_decode($row->status);
						if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1]))) {
							if ($status[0] == 1) {
								$L[] = $status[0];
							}

							if ($status[1] == 1) {
								$M[] = $status[1];
							}

							if ($status[2] == 1) {
								$E[] = $status[2];
							}

							if ($status[3] == 1) {
								$X[] = $status[3];
							}

							if ($status[4] == 1) {
								$G[] = $status[4];
							}

							if ($status[5] == 1) {
								$H[] = $status[5];
							}
						}
					}
				}
			}
		}
		$L = array_sum($L);
		$M = array_sum($M);
		$X = array_sum($X);
		$H = array_sum($H);
		$returned_deposit = 0;

		$invoice_amount = (((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit);

		$amount_excluding_material = ($invoice_amount - $book_charges);
		$lesson_fees = ((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees);

		$invoice_data = ['class_code' => $class_code, 'lesson_fee' => number_format($lesson_fees, 2), 'material_fees' => number_format($book_charges, 2), 'extra_charges' => number_format($extra_charges, 2), 'previous_month_payment' => number_format($previous_month_payment, 2), 'previous_month_balance' => number_format($previous_month_balance, 2), 'returned_deposit'	=>	number_format($returned_deposit, 2)];

		$invoice = ['invoice_id' => $invoice_id, 'invoice_no' => $invoice_no, 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data), 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];

		$query = $ci->db->insert(DB_INVOICE, $invoice);
		if ($query) {
			$ci->load->library('M_pdf');
			$ci->m_pdf->download_my_mPDF($invoice_file);
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
			echo "<br> Invoice has been generated.";
			if ($mail == true) {
				echo "<br> Email Sent.";
			}
		}
	}
}

function send_final_settlement_invoice($student_id, $class_id)
{
	$ci = &get_instance();

	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	if($result1)
	{
		$type = 'final_settlement_invoice';

		// ENROLLMENT DATA
		$ci->db->select('*');
		$ci->db->from('student_enrollment');
		$ci->db->where(['student_id'	=>	$student_id, 'class_id'	=>	$class_id]);
		$query2 = $ci->db->get()->row();
		$result2 = $query2;
	
		// DEFINE VARIABLES
	
		$invoice_id = uniqid();
		$invoice_no = get_invoice_no();
		$date = date('Y-m-d H:i:s');
		$invoice_file = $invoice_id . '__invoice_pdf-' . $date . '.pdf';
		$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	
		$frequency = $result1->frequency;
		$class_code = $result1->class_code;
		$emailto = [$result1->email, $result1->parent_email];
		$fees = $result1->monthly_fees;
		$extra_charges = isset($result2->extra_charges) ? $result2->extra_charges : 0;
		$deposit = $result1->deposit_fees;
		$previous_month_balance = isset($result2->previous_month_balance) ? $result2->previous_month_balance : 0;
		$previous_month_payment = isset($result2->previous_month_payment) ? $result2->previous_month_payment : 0;
		$invoice_amount = $amount_excluding_material = $lesson_fees = 0;

		// INVOICE GENERATION DATE
		$result3 = get_invoice_result5();
		$query4 = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result3]);
		$result4 = $query4->row();
		$billing_data = json_decode($result4->billing);

		$book_price_amount = get_invoice_result2($student_id, $result3, $class_code);
		$book_charges = $book_price_amount;
		
	
		// INVOICE EMAIL DATA
		$subject = 'Invoice #' . $invoice_no;
		$message = '<a href="' . $file_path . '">Click here </a> to view invoice.';
		$invoice_content = ['subject' => $subject, 'message' => $message];

		$L = $M = $E = $X = $G = $H = [];
		$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
		$X1 = $G1 = [];
		if ($value_since_enrollment) {
			$X1 = $value_since_enrollment['X'];
			$G1 = $value_since_enrollment['G'];
		}
	

	
		$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $class_code]);
		if ($query->num_rows() > 0) {
			foreach ($billing_data as $billing) {
				$no_week_count = [$billing->working_week, $billing->rest_week];
				if (in_array(1, $no_week_count) == false) {
					$dates = explode("-", $billing->date_range);
					foreach ($query->result() as $row) {
						$status = json_decode($row->status);
						if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1]))) {
							if ($status[0] == 1) {
								$L[] = $status[0];
							}

							if ($status[1] == 1) {
								$M[] = $status[1];
							}

							if ($status[2] == 1) {
								$E[] = $status[2];
							}

							if ($status[3] == 1) {
								$X[] = $status[3];
							}

							if ($status[4] == 1) {
								$G[] = $status[4];
							}

							if ($status[5] == 1) {
								$H[] = $status[5];
							}
						}
					}
				}
			}
		}
		$L = array_sum($L);
		$M = array_sum($M);
		$X = array_sum($X);
		$H = array_sum($H);
		$returned_deposit = 0;

		$invoice_amount = (((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit);

		$amount_excluding_material = ($invoice_amount - $book_charges);

		$lesson_fees = ((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees);

		$invoice_data = ['class_code' => $class_code, 'lesson_fee' => number_format($lesson_fees, 2), 'material_fees' => number_format($book_charges, 2), 'extra_charges' => number_format($extra_charges, 2), 'previous_month_payment' => number_format($previous_month_payment, 2), 'previous_month_balance' => number_format($previous_month_balance, 2), 'returned_deposit'	=>	number_format($returned_deposit, 2)];

		$invoice = ['invoice_id' => $invoice_id, 'invoice_no' => $invoice_no, 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data), 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];

		$query = $ci->db->insert(DB_INVOICE, $invoice);
		if ($query) {
			$ci->load->library('M_pdf');
			$ci->m_pdf->download_my_mPDF($invoice_file);
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
			echo "<br> Invoice has been generated.";
			if ($mail == true) {
				echo "<br> Email Sent.";
			}
		}
	}
}

function send_class_transfer_invoice($student_id, $class_id, $class_id_id)
{
	$ci = &get_instance();

	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	if($result1)
	{
		$type = 'class_transfer_invoice';

		// ENROLLMENT DATA
		$ci->db->select('*');
		$ci->db->from('student_enrollment');
		$ci->db->where(['student_id'	=>	$student_id, 'class_id'	=>	$class_id]);
		$query2 = $ci->db->get()->row();
		$result2 = $query2;
	
		// DEFINE VARIABLES
	
		$invoice_id = uniqid();
		$invoice_no = get_invoice_no();
		$date = date('Y-m-d H:i:s');
		$invoice_file = $invoice_id . '__invoice_pdf-' . $date . '.pdf';
		$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	
		$frequency = $result1->frequency;
		$class_code = $result1->class_code;
		$emailto = [$result1->email, $result1->parent_email];
		$fees = $result1->monthly_fees;
		$extra_charges = isset($result2->extra_charges) ? $result2->extra_charges : 0;
		$deposit = $result1->deposit_fees;
		$previous_month_balance = isset($result2->previous_month_balance) ? $result2->previous_month_balance : 0;
		$previous_month_payment = isset($result2->previous_month_payment) ? $result2->previous_month_payment : 0;
		$invoice_amount = $amount_excluding_material = $lesson_fees = 0;

		// INVOICE GENERATION DATE
		$result3 = get_invoice_result5();
		$query4 = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result3]);
		$result4 = $query4->row();
		$billing_data = json_decode($result4->billing);

		$book_price_amount = get_invoice_result2($student_id, $result3, $class_code);
		$book_charges = $book_price_amount;
		
	
		// INVOICE EMAIL DATA
		$subject = 'Invoice #' . $invoice_no;
		$message = '<a href="' . $file_path . '">Click here </a> to view invoice.';
		$invoice_content = ['subject' => $subject, 'message' => $message];

		$L = $M = $E = $X = $G = $H = [];
		$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
		$X1 = $G1 = [];
		if ($value_since_enrollment) {
			$X1 = $value_since_enrollment['X'];
			$G1 = $value_since_enrollment['G'];
		}
	

	
		$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $class_code]);
		if ($query->num_rows() > 0) {
			foreach ($billing_data as $billing) {
				$no_week_count = [$billing->working_week, $billing->rest_week];
				if (in_array(1, $no_week_count) == false) {
					$dates = explode("-", $billing->date_range);
					foreach ($query->result() as $row) {
						$status = json_decode($row->status);
						if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1]))) {
							if ($status[0] == 1) {
								$L[] = $status[0];
							}

							if ($status[1] == 1) {
								$M[] = $status[1];
							}

							if ($status[2] == 1) {
								$E[] = $status[2];
							}

							if ($status[3] == 1) {
								$X[] = $status[3];
							}

							if ($status[4] == 1) {
								$G[] = $status[4];
							}

							if ($status[5] == 1) {
								$H[] = $status[5];
							}
						}
					}
				}
			}
		}
		$L = array_sum($L);
		$M = array_sum($M);
		$X = array_sum($X);
		$H = array_sum($H);
		$returned_deposit = 0;

		$invoice_amount = (((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment);

		$amount_excluding_material = ($invoice_amount - $book_charges);

		$lesson_fees = ((($L + $M + abs(-$X) + (-$X1) + $G1 + $H) / $frequency) * $fees);

		$invoice_data = ['class_code' => $class_code, 'lesson_fee' => number_format($lesson_fees, 2), 'material_fees' => number_format($book_charges, 2), 'extra_charges' => number_format($extra_charges, 2), 'previous_month_payment' => number_format($previous_month_payment, 2), 'previous_month_balance' => number_format($previous_month_balance, 2), 'returned_deposit'	=>	number_format($returned_deposit, 2)];

		$invoice = ['invoice_id' => $invoice_id, 'invoice_no' => $invoice_no, 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data), 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];

		$query = $ci->db->insert(DB_INVOICE, $invoice);

		/* TRANSFER STUDENT */
		$data = [
			'student_id'    =>  $student_id,
			'class_id' =>   $class_id_id,
			'status'    =>  3,
			'created_at'    =>  $date,
			'updated_at'    =>  $date,
		];
		$data1 = [
			'student_id'    =>  $student_id,
			'class_id' =>   $class_id_id,
			'updated_at'    =>  $date,
		];
		$ci->db->where('student_id', $student_id);
		$ci->db->where('class_id', $class_id);
		$ci->db->update('student_to_class', ['status' =>  5]);

		$query = $ci->db->get_where('student_to_class', ['class_id' => $class_id_id, 'student_id'    =>  $student_id, 'status'   =>  3]);
		if ($query->num_rows() > 0) {
			//return print_r($this->db->last_query());
			$ci->db->where('student_id', $student_id);
			$ci->db->where('class_id', $class_id_id);
			$ci->db->update('student_to_class', ['status' =>  3]);
		} else {
			$ci->db->insert('student_to_class', $data);
		}

		$ci->db->where('student_id', $student_id);
		$ci->db->where('class_id', $class_id);
		$ci->db->update('student_enrollment', $data1);
		/* END TRANSFER STUDENT */

		if ($query) {
			$ci->load->library('M_pdf');
			$ci->m_pdf->download_my_mPDF($invoice_file);
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
			echo "<br> Invoice has been generated.";
			if ($mail == true) {
				echo "<br> Email Sent.";
			}
		}
	}
}

/* RESULT FOR INVOICE */

function get_invoice_result3($student_id)
{
	$ci = &get_instance();
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result) {
		return $result;
	}
}

function get_invoice_result2($sid, $invoice_generation_date, $class_code)
{
	$ci = &get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_ORDER . 's');
	$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
	$ci->db->join(DB_MATERIAL, 'orders.book_id = material.id');
	$ci->db->where('order_details.student_id', $sid);
	$ci->db->where('order_details.status', 2);
	$ci->db->where('orders.class_code', $class_code);
	$query = $ci->db->get();
	//return print_r($ci->db->last_query());
	$result = $query->result();
	$book_charges = [];
	foreach ($result as $row) {
		$query1 = $ci->db->query("select * from billing where DATE_FORMAT(invoice_generation_date, '%Y-%m-%d %H:%i')  =  DATE_FORMAT('$invoice_generation_date', '%Y-%m-%d %H:%i')");
		$result1 = $query1->row();
		$billing_data = json_decode($result1->billing);
		if ($query1->num_rows() > 0) {
			foreach ($billing_data as $billing) {
				if ($billing->working_week != 1) {
					if ($billing->rest_week != 1) {
						$dates = explode("-", $billing->date_range);
						//echo date('Y/m/d', strtotime($row->order_date)) .' | '. $dates[0]. ' | ' .$dates[1].'<br/>';
						if (strtotime(date('Y/m/d', strtotime($row->order_date))) >= strtotime($dates[0]) && strtotime(date('Y/m/d', strtotime($row->order_date))) <= strtotime($dates[1])) {
							$book_charges[] = $row->book_price;
						}
					}
				}
			}
		}
	}
	//return print_r($book_charges);
	return array_sum($book_charges);
}

function get_invoice_result5()
{
	$ci = &get_instance();
	$invoice_generation_date = [];
	$date = date('Y-m');
	$query = $ci->db->query("select * from billing where is_archive = 0 and DATE_FORMAT(invoice_generation_date, '%Y-%m') = '$date' order by updated_at desc");
	$result = $query->row();
	//print_r($ci->db->last_query());
	return $result->invoice_generation_date;
}

function getFirstMonthAttendanceDate($student_id, $class_code)
{
	//return $student_id;
	$ci = &get_instance();

	$ci->db->select('*');
	$ci->db->from(DB_ATTENDANCE);
	$ci->db->where(['student_id' => $student_id, 'class_code' => $class_code]);
	$ci->db->order_by('id', 'desc');
	$ci->db->limit(1);
	$query = $ci->db->get();
	$result = $query->row();
	if ($result) {
		return $result;
	}
}

function get_value_since_enrollment($student_id, $class_code)
{
	$ci = &get_instance();
	$X = $G = [];
	$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code'	=>	$class_code]);
	if ($query->num_rows() > 0) {
		foreach ($query->result() as $row) {
			$status = json_decode($row->status); {
				if ($status[3] == 1) {
					$X[] = $status[3];
				}

				if ($status[4] == 1) {
					$G[] = $status[4];
				}
			}
		}
	}
	return [
		'X'	=>	array_sum($X),
		'G'	=>	array_sum($G),
	];
}
