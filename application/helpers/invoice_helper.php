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
	$query1 = $ci->db->get();
	// var_dump($query1);
	// die();
	if ($query1->num_rows()>0) {
		$query1 = $query1->result();
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
			$invoice_file = $invoice_id . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
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
			$message = getInvoiceTemplate($result1->firstname, $file_path);
			$invoice_content = ['subject' => $subject, 'message' => $message];

			// CHECK FIRST MONTH INVOICE EXIST
			$ci->db->select('*');
			$ci->db->from(DB_INVOICE);
			$ci->db->where('student_id', $student_id);
			$ci->db->where('class_id', $class_id);
			$ci->db->where('type', 'first_month_invoice');
			$query4 = $ci->db->get();
			//var_dump($query4);
			if ($query4->num_rows()<1) {
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
					$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message, $file_path);
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
		$invoice_file = $invoice_id . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
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
		$message = getInvoiceTemplate($result1->firstname, $file_path);
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
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message, $file_path);
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
		$invoice_file = $invoice_id . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
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
		$message = getInvoiceTemplate($result1->firstname, $file_path);
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
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message, $file_path);
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
		$invoice_file = $invoice_id . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
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
		$message = getInvoiceTemplate($result1->firstname, $file_path);
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
			$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message, $file_path);
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

function getInvoiceTemplate($name, $invoice_file)
{
	return '<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <style type="text/css" rel="stylesheet" media="all">
    /* Base ------------------------------ */
    
    @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&amp;display=swap");
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      -webkit-text-size-adjust: none;
    }
    
    a {
      color: #3869D4;
    }
    
    a img {
      border: none;
    }
    
    td {
      word-break: break-word;
    }
    
    .preheader {
      display: none !important;
      visibility: hidden;
      mso-hide: all;
      font-size: 1px;
      line-height: 1px;
      max-height: 0;
      max-width: 0;
      opacity: 0;
      overflow: hidden;
    }
    /* Type ------------------------------ */
    
    body,
    td,
    th {
      font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
    }
    
    h1 {
      margin-top: 0;
      color: #333333;
      font-size: 22px;
      font-weight: bold;
      text-align: left;
    }
    
    h2 {
      margin-top: 0;
      color: #333333;
      font-size: 16px;
      font-weight: bold;
      text-align: left;
    }
    
    h3 {
      margin-top: 0;
      color: #333333;
      font-size: 14px;
      font-weight: bold;
      text-align: left;
    }
    
    td,
    th {
      font-size: 16px;
    }
    
    p,
    ul,
    ol,
    blockquote {
      margin: .4em 0 1.1875em;
      font-size: 16px;
      line-height: 1.625;
    }
    
    p.sub {
      font-size: 13px;
    }
    /* Utilities ------------------------------ */
    
    .align-right {
      text-align: right;
    }
    
    .align-left {
      text-align: left;
    }
    
    .align-center {
      text-align: center;
    }
    /* Buttons ------------------------------ */
    
    .button {
      background-color: #3869D4;
      border-top: 10px solid #3869D4;
      border-right: 18px solid #3869D4;
      border-bottom: 10px solid #3869D4;
      border-left: 18px solid #3869D4;
      display: inline-block;
      color: #FFF;
      text-decoration: none;
      border-radius: 3px;
      box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
      -webkit-text-size-adjust: none;
      box-sizing: border-box;
    }
    
    .button--green {
      background-color: #22BC66;
      border-top: 10px solid #22BC66;
      border-right: 18px solid #22BC66;
      border-bottom: 10px solid #22BC66;
      border-left: 18px solid #22BC66;
    }
    
    .button--red {
      background-color: #FF6136;
      border-top: 10px solid #FF6136;
      border-right: 18px solid #FF6136;
      border-bottom: 10px solid #FF6136;
      border-left: 18px solid #FF6136;
    }
    
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
        text-align: center !important;
      }
    }
    /* Attribute list ------------------------------ */
    
    .attributes {
      margin: 0 0 21px;
    }
    
    .attributes_content {
      background-color: #F4F4F7;
      padding: 16px;
    }
    
    .attributes_item {
      padding: 0;
    }
    /* Related Items ------------------------------ */
    
    .related {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .related_item {
      padding: 10px 0;
      color: #CBCCCF;
      font-size: 15px;
      line-height: 18px;
    }
    
    .related_item-title {
      display: block;
      margin: .5em 0 0;
    }
    
    .related_item-thumb {
      display: block;
      padding-bottom: 10px;
    }
    
    .related_heading {
      border-top: 1px solid #CBCCCF;
      text-align: center;
      padding: 25px 0 10px;
    }
    /* Discount Code ------------------------------ */
    
    .discount {
      width: 100%;
      margin: 0;
      padding: 24px;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      background-color: #F4F4F7;
      border: 2px dashed #CBCCCF;
    }
    
    .discount_heading {
      text-align: center;
    }
    
    .discount_body {
      text-align: center;
      font-size: 15px;
    }
    /* Social Icons ------------------------------ */
    
    .social {
      width: auto;
    }
    
    .social td {
      padding: 0;
      width: auto;
    }
    
    .social_icon {
      height: 20px;
      margin: 0 8px 10px 8px;
      padding: 0;
    }
    /* Data table ------------------------------ */
    
    .purchase {
      width: 100%;
      margin: 0;
      padding: 35px 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_content {
      width: 100%;
      margin: 0;
      padding: 25px 0 0 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .purchase_item {
      padding: 10px 0;
      color: #51545E;
      font-size: 15px;
      line-height: 18px;
    }
    
    .purchase_heading {
      padding-bottom: 8px;
      border-bottom: 1px solid #EAEAEC;
    }
    
    .purchase_heading p {
      margin: 0;
      color: #85878E;
      font-size: 12px;
    }
    
    .purchase_footer {
      padding-top: 15px;
      border-top: 1px solid #EAEAEC;
    }
    
    .purchase_total {
      margin: 0;
      text-align: right;
      font-weight: bold;
      color: #333333;
    }
    
    .purchase_total--label {
      padding: 0 15px 0 0;
    }
    
    body {
      background-color: #FFF;
      color: #333;
    }
    
    p {
      color: #333;
    }
    
    .email-wrapper {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .email-content {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    /* Masthead ----------------------- */
    
    .email-masthead {
      padding: 25px 0;
      text-align: center;
    }
    
    .email-masthead_logo {
      width: 94px;
    }
    
    .email-masthead_name {
      font-size: 16px;
      font-weight: bold;
      color: #A8AAAF;
      text-decoration: none;
      text-shadow: 0 1px 0 white;
    }
    /* Body ------------------------------ */
    
    .email-body {
      width: 100%;
      margin: 0;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .email-body_inner {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
    }
    
    .email-footer {
      width: 570px;
      margin: 0 auto;
      padding: 0;
      -premailer-width: 570px;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .email-footer p {
      color: #A8AAAF;
    }
    
    .body-action {
      width: 100%;
      margin: 30px auto;
      padding: 0;
      -premailer-width: 100%;
      -premailer-cellpadding: 0;
      -premailer-cellspacing: 0;
      text-align: center;
    }
    
    .body-sub {
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #EAEAEC;
    }
    
    .content-cell {
      padding: 35px;
    }
    /*Media Queries ------------------------------ */
    
    @media only screen and (max-width: 600px) {
      .email-body_inner,
      .email-footer {
        width: 100% !important;
      }
    }
    
    @media (prefers-color-scheme: dark) {
      body {
        background-color: #333333 !important;
        color: #FFF !important;
      }
      p,
      ul,
      ol,
      blockquote,
      h1,
      h2,
      h3 {
        color: #FFF !important;
      }
      .attributes_content,
      .discount {
        background-color: #222 !important;
      }
      .email-masthead_name {
        text-shadow: none !important;
      }
    }
    </style>
    <!--[if mso]>
    <style type="text/css">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
    <style type="text/css" rel="stylesheet" media="all">
    body {
      width: 100% !important;
      height: 100%;
      margin: 0;
      -webkit-text-size-adjust: none;
    }
    
    body {
      font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
    }
    
    body {
      background-color: #FFF;
      color: #333;
    }
    </style>
  </head>
  <body style="width: 100% !important; height: 100%; -webkit-text-size-adjust: none; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; background-color: #FFF; color: #333; margin: 0;" bgcolor="#FFF">
    
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;">
      <tbody><tr>
        <td align="center" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0; padding: 0;">
            <tbody><tr>
              <td class="email-masthead" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; text-align: center; padding: 25px 0;" align="center">
                <a href="https://www.thescienceacademy.sg/" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">TSA - Invoice</a>
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="word-break: break-word; margin: 0; padding: 0; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; margin: 0 auto; padding: 0;">
                  <!-- Body content -->
                  <tbody><tr>
                    <td class="content-cell" style="word-break: break-word; font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 35px;">
                      <div class="f-fallback">
                        <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: left;" align="left">Hi '.$name.',</h1>
                        <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">Click <a href='.$invoice_file.'>here</a> to view invoice.</p>
                        
                        
                        
                        
                        <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">If you have any questions about this invoice, simply reply to this email or reach out to our us.</p>
                        <p style="font-size: 16px; line-height: 1.625; color: #333; margin: .4em 0 1.1875em;">Regards,<br>The Science Academy</p>
                        <!-- Sub copy -->
                        
                      </div>
                    </td>
                  </tr>
                </tbody></table>
              </td>
            </tr>
            
          </tbody></table>
        </td>
      </tr>
    </tbody></table>
  
</body></html>';
}
