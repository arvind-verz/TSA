<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_currency($currency_code = false)
	{
	$currency_array = ['INR' => '<i class="fa fa-inr" aria-hidden="true"></i>', 'SGD' => '$', ];
	foreach($currency_array as $key => $value)
		{
		if ($currency_code == $key)
			{
			echo $value;
			}
		}
	}

function get_footer()
	{
	$ci = & get_instance();
	$query = $ci->db->get('footer');
	$result = $query->row();
	if ($result)
		{
		return $result;
		}
	}

function get_salary_scheme($scheme_code)
	{
	$salary_scheme = ['Fixed', 'Variable'];
	if ($scheme_code)
		{
		return $salary_scheme[($scheme_code - 1) ];
		}

	return '-';
	}

function get_all_modules()
	{
	return ['SUBJECT', 'TUTOR', 'CLASSES', 'ATTENDANCE', 'MATERIAL', 'ORDER', 'BILLING', 'INVOICE', 'STUDENT', 'MENU', 'CMS', 'USERS', 'REPORTING', 'SMS_TEMPLATE', 'SMS_HISTORY', 'SMS_REMINDER'];
	}

function get_all_months()
	{
	return ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	}

function get_tutor_of_class($class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result = $query->row();

	if ($result)
		{
		$query = $ci->db->get_where(DB_TUTOR, ['tutor_id' => $result->tutor_id]);
		$result = $query->row();
		if ($result)
			{
			return $result->firstname.' '.$result->lastname;
			}
		}

	return "-";
	}

function get_user_type($user_type)
	{
	$user_type_arr = ['Super Admin', 'Admin', 'Tutor'];
	return $user_type_arr[($user_type - 1) ];
	}

function get_enrollment_status($status)
	{
	$enrollment_type_arr = ['Reserved', 'Waitlist', 'Enrolled', 'Final Settlement', 'Transfer'];
	if ($status)
		{
		return $enrollment_type_arr[($status - 1)];
		}
	}

function get_enrollment_type()
	{
	$enrollment_type_arr = ['Reserved', 'Waitlist', 'Enroll'];
	return $enrollment_type_arr;
	}

function get_enrolled_classes($student_id)
	{
	$ci = & get_instance();
	$class_code = [];
	if ($student_id)
		{
		$ci->db->select('*');
		$ci->db->from(DB_CLASSES);
		$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
		$ci->db->where(['student_to_class.student_id' => $student_id]);
		$query = $ci->db->get();
		$result = $query->result();
		foreach($result as $value)
			{
			$class_code[] = $value->class_code;
			}

		return implode(', ', $class_code);
		}
	  else
		{
		return "-";
		}
	}

function get_class_size($class_id, $enrollment_type)
	{
	$ci = & get_instance();
	if ($class_id)
		{
		$class = get_classes($class_id);
		$class_size = get_students_enrolled($class_id, $enrollment_type);
		return $class_size . '/' . $class->class_size;
		}
	}

function enrollment_decision($class_id, $student_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('student_enrollment', ['class_id' => $class_id, 'student_id' => $student_id, 'status' => 3]);
	if ($query->num_rows() > 0)
		{
		return true;
		}
	}

function get_student_name_by_student_id($student_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_STUDENT, ['student_id' => $student_id]);
	$result = $query->row();
	if ($result)
		{
		return $result->firstname . ' ' . $result->lastname;
		}
	}

function get_deposit_value_of_class($class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		return get_currency('SGD') . $result->deposit_fees;
		}
	}
	
	function get_deposit_value_of_class_without_currency($class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		return number_format($result->deposit_fees, 2);
		}
	}

function get_enrollment_type_popup_content_update($student_id, $class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('student_enrollment', ['student_id' => $student_id, 'class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		$enrollment_date = date('Y-m-d', strtotime($result->enrollment_date));
		$deposit_collected = $result->deposit_collected;
		$remarks_deposit = $result->remarks_deposit;
		$previous_month_balance = get_previous_month_balance($student_id, $class_id);
		$extra_charges = isset($result->extra_charges) ? $result->extra_charges : 0;
		$previous_month_payment = eval('return '.$result->previous_month_payment.';');
		$remarks = $result->remarks;
?>
        <div class="form-group">
            <label for="">Select Enrollment Date</label>
            <input type="text" name="enrollment_date" class="form-control datepicker" value="<?php
		echo $enrollment_date; ?>" required="required" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="">Deposit: </label>
            <?php
		echo get_deposit_value_of_class($class_id); ?>
        </div>
        <div class="form-group">
          <div class="row">
              <div class="col-sm-1">
                  <label for="">Deposit Collected</label>
              </div>
              <div class="col-sm-2">
                  <label class="radio-inline">
                      <input name="deposit_collected" value="1" type="radio" <?php
		if ($deposit_collected == 1)
			{
			echo 'checked';
			} ?> />Yes</label>
              </div>
              <div class="col-sm-2">
                  <label class="radio-inline">
                      <input name="deposit_collected" value="0" type="radio" <?php
		if ($deposit_collected == 0)
			{
			echo 'checked';
			} ?> />No</label>
            </div>
        </div>
        <div class="form-group">
            <label for="">Remarks Deposit</label>
            <input type="text" name="remarks_deposit" class="form-control" value="<?php
		echo $remarks_deposit; ?>">
        </div>
        <div class="form-group">
            <label for="">Previous Month's Balance (PMB)</label>
            <input type="text" name="previous_month_balance" class="form-control" value="<?php
		echo $previous_month_balance; ?>" readonly> </div>
        <div class="form-group">
            <label for="">Extra Charges (EC)</label>
            <input type="text" name="extra_charges" class="form-control" value="<?php
		echo $extra_charges; ?>"> </div>
        <div class="form-group">
            <label for="">Previous Month Payment (PMP)</label>
            <input type="text" name="previous_month_payment" class="form-control" value="<?php
		echo $previous_month_payment; ?>" > </div>
        <div class="form-group">
            <label for="">Remarks</label>
            <input type="text" name="remarks" class="form-control" value="<?php
		echo $remarks; ?>">
          </div>
        <?php
		}
	}

function get_enrollment_type_popup_content($type)
	{
	$ci = & get_instance();
	$classes = get_classes();
	if ($classes)
		{
?>
        <div class="form-group">
            <label>Class Code</label>
            <select name="class_code" class="form-control select2" required="required">
                <option value="">-- Select --</option>
                <?php
		foreach($classes as $class)
			{
?>
                    <option value="<?php
			echo $class->class_id; ?>"><?php
			echo $class->class_code; ?></option>
                    <?php
			} ?>
            </select>
            <p class="text-danger pull-right class_size"></p>
        </div>
        <?php
		if ($type == 'reservation')
			{
?>
            <div class="form-group"><label for="">Select Reservation Date</label><input type="text" name="reservation_date" class="form-control datepicker" value="" autocomplete="off"></div>
            <?php
			}
		elseif ($type == 'enroll')
			{
?>
            <div class="form-group">
                <label for="">Select Enrollment Date</label>
                <input type="text" name="enrollment_date" class="form-control datepicker" value="" required="required" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="">Deposit: </label> <span class="deposit"></span></div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <label for="">Deposit Collected</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio-inline">
                            <input name="deposit_collected" value="1" type="radio" />Yes</label>
                    </div>
                    <div class="col-sm-2">
                        <label class="radio-inline">
                            <input name="deposit_collected" value="0" type="radio" checked />No</label</div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Remarks Deposit</label>
                    <input type="text" name="remarks_deposit" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="">Previous Month's Balance (PMB)</label>
                    <input type="text" name="previous_month_balance" class="form-control" value="0" readonly>
                </div>
                <div class="form-group">
                    <label for="">Extra Charges (EC)</label>
                    <input type="text" name="extra_charges" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="">Previous Month Payment (PMP)</label>
                    <input type="text" name="previous_month_payment" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="">Remarks</label>
                    <input type="text" name="remarks" class="form-control" value="">
                </div>
            <?php
			}
		}
	}

/*function get_p_content()
{
?>
<div class="col-md-12 mt-2">
<div class="col-md-2">
<input type="text" name="p_amount[]" class="form-control" value="" placeholder="Amount">
</div>
<div class="col-md-2">
<select class="form-control" name="p_payment_terms[]">
<option value="">-- Select --</option>
<option value="Cheque">Cheque</option>
<option value="Cash">Cash</option>
<option value="Paynow">Paynow</option>
</select>
</div>
<div class="col-md-2">
<input type="text" name="p_reference_number[]" class="form-control" value="" placeholder="Reference Number">
</div>
<div class="col-md-2">
<input type="text" name="p_date[]" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
</div>
<div class="col-md-2">
<input type="text" name="p_remark[]" class="form-control" value="" placeholder="Remark">
</div>
<div class="col-md-2">
<select class="form-control" name="p_billing_cycle[]">
<option value="">-- Select --</option>
<?php print_r(get_billing_cycle()); ?>
</select>
</div>
</div>
<?php
}*/

function get_billing_cycle($billing_id = false)
	{
	$ci = & get_instance();
	$query = $ci->db->get(DB_BILLING);
	$result = $query->result();
	if ($result)
		{
		foreach($result as $row)
			{
?>
      <option value="<?php
			echo $row->id; ?>"><?php
			echo $row->billing_title; ?></option>
    <?php
			}
		}
	}

function get_student_names_with_nric($student_id = false)
	{
	$ci = & get_instance();
	if ($student_id)
		{
		$query = $ci->db->get_where(DB_STUDENT, ['student_id !=' => $student_id]);
		}
	  else
		{
		$query = $ci->db->get_where(DB_STUDENT);
		}

	$result = $query->result();
	if ($result)
		{
		return $result;
		}
	}

function get_books_by_subject($subjects /*Array*/)
	{
	$ci = & get_instance();
	$material_array = [];
	if ($subjects)
		{
		$query = $ci->db->get(DB_MATERIAL);
		$result = $query->result();
		if ($result)
			{
			foreach($result as $row)
				{
				$subject_id = json_decode($row->subject);
				foreach($subject_id as $value)
					{
					if (in_array($value, $subjects))
						{
						$material_array[] = $row->id;
						}
					}
				}
			}
		}

	if ($material_array)
		{
		$query = $ci->db->where('is_archive', 0)->where_in('id', $material_array)->get(DB_MATERIAL);
		$result = $query->result();
		if ($result)
			{
?>
            <option value="">-- Select One --</option>
            <?php
			foreach($result as $row)
				{
?>
                <option value="<?php
				echo $row->id ?>" <?php
				echo set_select('book_id', $row->id); ?>><?php
				echo $row->material_id . ' - ' . $row->book_name ?></option>
                <?php
				}
			}
		}
	}

function get_book_price_range($price_from, $price_to)
	{
	$ci = & get_instance();
	$query = $ci->db->get(DB_MATERIAL);
	if (!empty($price_from) || !empty($price_to))
		{
		$query = $ci->db->get_where(DB_MATERIAL, ['book_price >=' => $price_from, 'book_price <=' => $price_to, 'is_archive'	=>	0]);
		}

	$result = $query->result();
	if ($result)
		{
		foreach($result as $book)
			{
?>
            <tr>
                <th width="15px">
                    <input type="checkbox" class="checkbox" name="material_id[]" value="<?php
			echo $book->id; ?>"/>
                </th>
                <td>
                    <a href="<?php
			echo site_url('admin/material/edit/' . $book->material_id) ?>" title="Edit"><i class="fa fa-pencil-square-o btn btn-warning" aria-hidden="true"></i></a>
                    <!-- <a href="<?php
			echo site_url('admin/material/delete/' . $book->material_id) ?>" onclick="return confirm('Are you sure you want to archive this book?')" title="Archive"><i class="fa fa-archive btn btn-danger" aria-hidden="true"></i></a> -->
                </td>
                <td>
                    <?php
			echo isset($book->material_id) ? $book->material_id : '-' ?>
                </td>
                <td>
                    <?php
			echo isset($book->book_name) ? $book->book_name : '-' ?>
                </td>
                <td>
                    <?php
			echo isset($book->subject) ? get_subject_classes($book->subject) : '-' ?>
                </td>
                <td>
                    <?php
			echo isset($book->book_price) ? get_currency('SGD') . $book->book_price : '-' ?>
                </td>
            </tr>
            <?php
			}
		}
	}

function get_logo()
	{
	$ci = & get_instance();
	$query = $ci->db->get('logo');
	$result = $query->row();
	return $result;
	}

function get_student_remark($student_id, $class_id)
	{
	$ci = & get_instance();
	if ($student_id && $class_id)
		{
		$query = $ci->db->get_where('student_enrollment', ['student_id' => $student_id, 'class_id' => $class_id]);
		$result = $query->row();
		if ($result)
			{
			return $result->remarks;
			}
		}

	return "-";
	}

function miss_class_request($class_id, $reason, $date_of_absence)
	{
	$ci = & get_instance();
	$student = $ci->session->userdata('student_credentials');
	$query = $ci->db->get_where(DB_STUDENT, ['id' => $student['id']]);
	$result = $query->row();
	$query1 = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result1 = $query1->row();
	if ($result && $result1)
		{
		$class_code = $result1->class_code;
		$student_id = $result->student_id;
		$date_of_absence = $date_of_absence;
		$reason = $reason;
		$current_date = date('Y-m-d');
		$query2 = $ci->db->get_where(DB_ATTENDANCE, ['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence]);
		$result2 = $query2->row();
		$recipients = ['phone' => $result->phone, 'parents_phone' => $result->parents_phone, ];
		$message = get_sms_template_content(4);
		$z = 0;
		$sms_pre_content = 'Hi ' . $result->firstname . ' ' . $result->lastname . '\r\n';
		foreach($recipients as $recipient)
			{
			if ($z == 1)
				{
				$sms_pre_content = 'Hi ' . $result->salutation . ' ' . $result->parent_first_name . ' ' . $result->parent_last_name . '\r\n';
				}

			send_sms($recipient, $sms_pre_content . $message, 4, $result1->class_code);
			$z++;
			}

		if ($result2)
			{
			$data = ['reason_for_absent' => $reason, 'status' => json_encode(["0", "1", "0", "0", "0", "0"]) , 'missed_update' => date('Y-m-d H:i:s') , ];
			$ci->db->where(['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence]);
			$ci->db->update(DB_ATTENDANCE, $data);
			return "success";
			}
		  else
			{
			$data = ['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence, 'reason_for_absent' => $reason, 'status' => json_encode(["0", "1", "0", "0", "0", "0"]) , 'missed_update' => date('Y-m-d H:i:s') , ];

			// $ci->db->where(['class_code' => $class_code, 'student_id' => $student_id, 'attendance_date' => $date_of_absence]);

			$ci->db->insert(DB_ATTENDANCE, $data);
			return "success";
			}
		}

	return "failed";
	}

function get_student_classes_search_data($searchby, $sortby, $searchfield)
	{
	$ci = & get_instance();
	$login_id = $ci->session->userdata('student_credentials') ['id'];
	$searchby_array = ['classname', 'classcode', 'day', 'time', 'level', 'fees'];
	$searchby_array_value = ['class_name', 'class_code', 'class_day', 'class_time', 'level', 'monthly_fees'];

	// echo $searchby;

	if ($searchfield)
		{
		if (in_array($searchby, $searchby_array))
			{
			$attr = array_search($searchby, $searchby_array);
			$attr = $searchby_array_value[$attr];
			$ci->db->select('*');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
			$ci->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
			$ci->db->where(['student_to_class.status' => 3, 'student.id' => $login_id]);
			$ci->db->like($attr, $searchfield, 'both');
			}

		if ($searchby == 'tutor')
			{
			$ci->db->select('*, class.subject as subject');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
			$ci->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
			$ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
			$ci->db->where(['student_to_class.status' => 3, 'student.id' => $login_id]);
			$ci->db->like('tutor.tutor_name', $searchfield, 'both');
			}

		if ($searchby == 'subject')
			{
			$subject_code_name = '';
			$ci->db->select('*');
			$ci->db->from('subject');
			$ci->db->like('subject_name', $searchfield, 'both');
			$query1 = $ci->db->get();
			$result1 = $query1->result();
			foreach($result1 as $row)
				{
				$subject_code_name = $row->subject_code;
				}

			$query = "SELECT *, class.subject as subject FROM class JOIN student_to_class ON class.class_id = student_to_class.class_id JOIN student ON student.student_id = student_to_class.student_id JOIN tutor ON class.tutor_id = tutor.tutor_id INNER JOIN subject WHERE student_to_class.status = ? AND subject.subject_name like ? AND student.id = ? AND tutor.subject like ? GROUP BY class.class_code";
			$query = $ci->db->query($query, [3, '%' . $searchfield . '%', $login_id, '%' . $subject_code_name . '%']);
			}
		}

	if ($sortby)
		{
		if (in_array($sortby, $searchby_array))
			{
			$attr = array_search($sortby, $searchby_array);
			$attr = $searchby_array_value[$attr];
			$ci->db->select('*, class.subject as subject');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
			$ci->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
			$ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
			$ci->db->where(['student_to_class.status' => 3, 'student.id' => $login_id]);
			$ci->db->order_by($attr, 'ASC');
			}

		if ($sortby == 'tutor')
			{
			$ci->db->select('*, class.subject as subject');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
			$ci->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
			$ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
			$ci->db->where(['student_to_class.status' => 3, 'student.id' => $login_id]);
			$ci->db->order_by('tutor.tutor_name', 'asc');
			}

		if ($sortby == 'subject')
			{
			$subject_code_array = [];
			$ci->db->select('*, tutor.subject as subject');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_to_class', 'class.class_id = student_to_class.class_id');
			$ci->db->join(DB_STUDENT, 'student.student_id = student_to_class.student_id');
			$ci->db->join(DB_TUTOR, 'class.tutor_id = tutor.tutor_id');
			$ci->db->where(['student_to_class.status' => 3, 'student.id' => $login_id]);
			$query1 = $ci->db->get();
			$result1 = $query1->result();
			foreach($result1 as $row)
				{
				$subject_code_array1 = json_decode($row->subject);
				foreach($subject_code_array1 as $value)
					{
					$subject_code_array[] = $value;
					}
				}

			// $query = $ci->db->query('SELECT * FROM class');
			// print_r($query->result());

			$query = "SELECT *, class.subject as subject FROM class JOIN student_to_class ON class.class_id = student_to_class.class_id JOIN student ON student.student_id = student_to_class.student_id JOIN tutor ON class.tutor_id = tutor.tutor_id INNER JOIN subject WHERE student_to_class.status = ? AND subject.subject_code in ? AND student.id = ? GROUP BY class.class_code ORDER BY class.subject ASC";
			$query = $ci->db->query($query, [3, $subject_code_array, $login_id]);
			}
		}

	if ($searchby != 'subject' && $sortby != 'subject')
		{
		$query = $ci->db->get();
		}

	$result = $query->result();

	// echo $ci->db->last_query();

	if (count($result))
		{
		foreach($result as $class)
			{
?>
            <div class="col-md-6">
                <div class="row-inner-md">
                    <div class="class-box">
                        <div class="class-hd">
                            <?php
			echo isset($class->class_name) ? $class->class_name : '-'; ?>
                        </div>
                        <div class="class-info">
                            <ul>
                                <li><strong>Class Name</strong><span class="cinfo"><?php
			echo isset($class->class_name) ? $class->class_name : '-'; ?></span></li>
                                <li><strong>Class Code</strong><span class="cinfo"><?php
			echo isset($class->class_code) ? $class->class_code : '-'; ?></span></li>
                                <li><strong>Subject</strong><span class="cinfo"><?php
			echo get_subject_classes($class->subject); ?></span></li>
                                <li><strong>Day</strong><span class="cinfo"><?php
			echo isset($class->class_day) ? $class->class_day : '-'; ?></span></li>
                                <li><strong>Time</strong><span class="cinfo"><?php
			echo isset($class->class_time) ? $class->class_time : '-'; ?></span></li>
                                <li><strong>Level</strong><span class="cinfo"><?php
			echo isset($class->level) ? $class->level : '-'; ?></span></li>
                                <li><strong>Monthly Fees</strong><span class="cinfo"><?php
			echo isset($class->monthly_fees) ? $class->monthly_fees : '-'; ?></span></li>
                                <li><strong>Tutor Assigned</strong><span class="cinfo"><?php
			echo get_tutor_of_class($class->tutor_id); ?></span></li>
                                <li><strong>Materials</strong><span class="cinfo"><?php
			echo get_material_of_student($class->class_code, $ci->session->userdata('student_credentials') ['id']); ?></span></li>
                            </ul>
                            <a href="javascript:void(0);" name="<?php
			echo isset($class->class_id) ? $class->class_id : ''; ?>" class="button btn-light miss_class_request">Miss Class Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
			}
		}
	}

function get_class_code_by_tutor($tutor_id)
	{
	$ci = & get_instance();
	$class_codes = [];
	$query = $ci->db->get_where(DB_CLASSES, ['tutor_id' => $tutor_id]);
	$result = $query->result();
	if ($result)
		{
		foreach($result as $row)
			{
			$class_codes[] = $row->class_code;
			}

		return implode(', ', $class_codes);
		}

	return "-";
	}

function get_student_status($class_id, $student_id)
	{
	$ci = & get_instance();
	if ($class_id && $student_id)
		{
		$ci->db->select('*');
		$ci->db->from(DB_STUDENT);
		$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
		$ci->db->where(['student_to_class.class_id' => $class_id, 'student.student_id' => $student_id]);
		$ci->db->order_by('student.id', 'DESC');
		$ci->db->limit(1);
		$query = $ci->db->get();
		$result = $query->row();
		if ($result)
			{
			return $result->status;
			}
		}
	}

function get_student_details($student_id = false)
	{
	$ci = & get_instance();
	if ($student_id)
		{
		$query = $ci->db->get_where(DB_STUDENT, ['student_id' => $student_id]);
		$result = $query->row();
		return ['name' => $result->firstname . ' ' . $result->lastname, 'email' => $result->email, 'phone' => $result->phone, 'nric'	=>	$result->nric];
		}
	}

function get_student_profile()
	{
	$ci = & get_instance();
	if ($ci->session->has_userdata('student_credentials'))
		{
		$student_id = $ci->session->userdata('student_credentials');
		$query = $ci->db->get_where(DB_STUDENT, ['id' => $student_id['id'], 'email' => $student_id['email']]);
		$result = $query->row();
		return $result;
		}

	return false;
	}

function get_previous_month_balance($student_id, $class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->order_by('id', 'DESC')->get_where('invoice', ['student_id' => $student_id, 'class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		return number_format($result->invoice_amount, 2);
		}

	return '0.00';
	}

function get_student_invoices()
	{
	$ci = & get_instance();
	if ($ci->session->has_userdata('student_credentials'))
		{
		$student_id = $ci->session->userdata('student_credentials');
		$ci->db->select('*');
		$ci->db->from(DB_INVOICE);
		$ci->db->join(DB_STUDENT, DB_INVOICE . '.student_id = ' . DB_STUDENT . '.student_id');
		$ci->db->where([DB_STUDENT . '.id' => $student_id['id'], DB_STUDENT . '.email' => $student_id['email']]);
		$query = $ci->db->get();
		$result = $query->result();
		return $result;
		}

	return false;
	}

function get_invoice_by_filename($filename)
	{
	$ci = & get_instance();
	if ($filename)
		{
		$query = $ci->db->get_where(DB_INVOICE, ['invoice_file' => $filename]);
		$result = $query->row();
		return $result;
		}
	}

function get_invoice_no()
	{
	$ci = & get_instance();
	$query = $ci->db->select('*')->from(DB_INVOICE)->like('invoice_no', 'INV', 'after')->order_by('id', 'DESC')->limit(1)->get();
	$result = $query->row();
	if ($result)
		{
		return 'INV00' . (substr($result->invoice_no, 3) + 1);
		}
	  else
		{
		return 'INV001';
		}
	}

function get_module_access_data($type, $module, $value, $perm_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('aauth_permission_access', ['perm_id' => $perm_id, $type => $value, 'module' => $module]);
	$result = $query->row();
	if ($result)
		{
		return "checked";
		}
	elseif ($value == 1)
		{
		return "checked";
		}
	}

function get_permission_data($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where('aauth_perms', ['id' => $id]);
		$result = $query->row();
		}
	  else
		{
		$query = $ci->db->get('aauth_perms');
		$result = $query->result();
		}

	return $result;
	}

function get_permission_access_module($perm_id = false)
	{
	$ci = & get_instance();
	$modules = [];
	$query = $ci->db->get_where('aauth_permission_access', ['perm_id' => $perm_id]);
	$result = $query->result();
	foreach($result as $row)
		{
		$modules[] = $row->module;
		}

	return implode(', ', $modules);
	}

function get_users_data_by_id($id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('aauth_users', ['id' => $id]);
	$result = $query->row();
	if ($result)
		{
		return $result;
		}
	}

function get_users_data($id = false)
	{
	$ci = & get_instance();
	$ci->db->select('*, aauth_users.id as aauth_users_id');
	$ci->db->from('aauth_users');
	$ci->db->join('aauth_perm_to_user', 'aauth_users.id = aauth_perm_to_user.user_id');
	$ci->db->join('aauth_perms', 'aauth_perms.id = aauth_perm_to_user.perm_id');
	if ($id)
		{
		$ci->db->where(['aauth_users.id' => $id]);
		$query = $ci->db->get();
		$result = $query->row();
		}
	  else
		{
		$ci->db->where(['aauth_users.deleted_at' => null]);
		$query = $ci->db->get();
		$result = $query->result();
		}

	// die(print_r($ci->db->last_query()));

	return $result;
	}

function get_class_code_by_class($class_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		return $result->class_code;
		}
	}

function get_class_id_by_class_code($class_code)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
	$result = $query->row();
	if ($result)
		{
		return $result->class_id;
		}
	}

function get_student_by_class_code($class_code = false)
	{
	$ci = & get_instance();
	$ci->db->select('*, student.id as student_id');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	$ci->db->where(DB_CLASSES . '.class_code', $class_code);
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
		{
?>
            <option value="all">All Students</option>
            <?php
		foreach($result as $row)
			{
?>
                <option value="<?php
			echo $row->student_id; ?>" <?php
			echo set_select('student[]', $row->student_id); ?>><?php
			echo $row->firstname . ' ' . $row->lastname; ?></option>
                <?php
			}
		}
	}

function get_sms_condition($id = false)
	{
	$sms_condition = ['Student absent without leave', 'Fee reminder', 'Late Fee reminder', 'Student filled a miss class request', 'Reminder one day before reservation', 'Enrollment Confirmation', 'Centre wide announcements'];
	if ($id)
		{
		return $sms_condition[($id - 1) ];
		}

	return $sms_condition;
	}

function get_fee_reminder()
	{
	$ci = & get_instance();
	$query = $ci->db->get(DB_SMS_REMINDER);
	$result = $query->row();
	if ($result)
		{
		return $result;
		}
	}

function level($value = false)
	{
	if ($value == 1)
		{
		return "S1";
		}
	elseif ($value == 2)
		{
		return "S2";
		}
	elseif ($value == 3)
		{
		return "S3";
		}
	elseif ($value == 4)
		{
		return "S4";
		}
	elseif ($value == 5)
		{
		return "J1";
		}
	elseif ($value == 6)
		{
		return "J2";
		}
	  else
		{
		return "-";
		}
	}

function get_tutor_by_class_code($class_code)
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	$ci->db->where(['class.class_id' => $class_id]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
		{
		foreach($result as $row)
			{
			return ['class_code' => $result->class_code, 'tutor_id' => $result->tutor_id, ];
			}
		}
	}

function get_subject_by_subject_code($subject_code)
	{
	$ci = & get_instance();
	$subject_list = [];
	$ci->db->select('*');
	$ci->db->from('subject');
	$ci->db->where_in('subject_code', $subject_code);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
		{
		foreach($result as $row)
			{
			$subject_list[] = $row->subject_name;
			}

		return implode(", ", $subject_list);
		}
	}

function get_subject_code($student_id = false)
	{
	$ci = & get_instance();
	$subject_list = [];
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	$query = $ci->db->get();
	$result = $query->row();
	if ($result->subject)
		{
		$subject = json_decode($result->subject);
		foreach($subject as $value)
			{
			$query = $ci->db->get_where(DB_SUBJECT, ['id' => $value]);
			$result = $query->row();
			$subject_list[] = isset($result->subject_name) ? $result->subject_name : '';
			}

		return implode(", ", $subject_list);
		}

	return "-";
	}

function get_students_enrolled($class_id = false, $enrollment_type = false)
	{
	$ci = & get_instance();
	if (!$enrollment_type)
		{
		$enrollment_type = 3;
		}
	  else
		{
		$enrollment_type = [1, 3];
		}

	$ci->db->select('*, count(student.id) as total_students_enrolled');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	if (!$enrollment_type)
		{
		$ci->db->where(['student_to_class.status' => $enrollment_type, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_id' => $class_id]);
		}
	  else
		{
		$ci->db->where([DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_id' => $class_id]);
		$ci->db->where_in('student_to_class.status', $enrollment_type);
		}

	$query = $ci->db->get();
	$result = $query->row();
	return $result->total_students_enrolled;
	}

function get_attendance_status($value = false)
	{
	$value = json_decode($value);
	$array_status = ['L', 'M', 'E', 'X', 'G', 'H'];
	if (in_array('1', $value))
		{
		return $array_status[array_search(1, $value) ];
		}
	  else
		{
		return '-';
		}
	}

function order_status($value = false)
	{
	if ($value == 0)
		{
		return "Print";
		}
	elseif ($value == 1)
		{
		return "Given";
		}
	elseif ($value == 2)
		{
		return "Cancel";
		}
	  else
		{
		return "-";
		}
	}

function get_archived($module = false)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where($module, ['is_archive' => 1]);
	if ($query)
		{
		return $query->result();
		}
	}

function get_tutors()
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_TUTOR, ['is_archive' => 0]);
	if ($query)
		{
		return $query->result();
		}
	}

function get_classes($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0, 'class_id' => $id]);
		$result = $query->row();
		}
	  else
		{
		$query = $ci->db->get_where(DB_CLASSES, ['is_archive' => 0]);
		$result = $query->result();
		}

	if ($query)
		{
		return $result;
		}
	}

function check_image_valid($image)
	{
	$mime = array(
		'image/gif',
		'image/jpeg',
		'image/png',
	);
	$file_info = getimagesize($image);
	if (empty($file_info))
		{

		// No Image?

		return false;
		}
	  else
		{

		// An Image?

		$file_mime = $file_info['mime'];
		if (in_array($file_mime, $mime))
			{
			return true;
			}
		  else
			{
			return false;
			}
		}
	}

function get_attendance_sheet($class_code = false, $attendance_date)
	{
	$i = 1;
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_ATTENDANCE, ['class_code' => $class_code, 'attendance_date' => $attendance_date]);
	if ($query->num_rows() > 0)
		{
		return get_attendance_edit_sheet($class_code, $attendance_date);
		}

	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_code' => $class_code]);
	$query = $ci->db->get();
	$query = $query->result(); ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L" readonly>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M" readonly>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E" readonly>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X" readonly>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G" readonly>
                <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="H" readonly>
            </td>
            <td></td>
        </tr>
        <?php
	foreach($query as $result)
		{
?>
            <tr>
                <td><input type="checkbox" name="student_id_transfer" value="<?php
		echo $result->student_id; ?>"></td>
                <td><?php
		echo $result->nric; ?></td>
                <td><?php
		echo $result->firstname . ' ' . $result->lastname; ?></td>
                <td>
                    <input type="hidden" name="student_id[]" class="form-control" value="<?php
		echo $result->student_id; ?>">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="L">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="M">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="E">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="X">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="G">
                    <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="0" placeholder="H">
                </td>
                <td><input type="text" name="attendance_remark[]" class="form-control" value="" placeholder="Remark"></td>
            </tr>
            <?php
		$i++;
		}
	}

function get_attendance_edit_sheet($class_code, $attendance_date)
	{
	$i = 1;
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = ' . DB_CLASSES . '.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_CLASSES . '.class_code' => $class_code]);
	$query = $ci->db->get();

	$query = $query->result(); ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="L" readonly>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="M" readonly>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="E" readonly>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="X" readonly>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="G" readonly>
                    <input type="text" class="form-control text-center w-50 d-inline border-0" value="" placeholder="H" readonly>
                </td>
                <td></td>
            </tr>
            <?php
	foreach($query as $result)
		{
			$query1 = $ci->db->get_where(DB_ATTENDANCE, ['DATE(attendance.attendance_date)' => $attendance_date, 'student_id'	=>	$result->student_id, 'class_code'	=>	$result->class_code]);
			$result1 = $query1->row();
?>
                <tr>
                    <td><input type="checkbox" name="student_id_transfer" value="<?php
		echo $result->student_id; ?>"></td>
                    <td><?php
		echo $result->nric; ?></td>
                    <td><?php
		echo $result->firstname . ' ' . $result->lastname; ?></td>
                    <td>
                        <input type="hidden" name="student_id[]" class="form-control" value="<?php
		echo $result->student_id; ?>">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'L') ? 1 : 0;}else {echo "0";} ?>" placeholder="L">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'M') ? 1 : 0;}else {echo "0";} ?>" placeholder="M">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'E' && $result1->attendance_date==$attendance_date) ? 1 : 0;}else {echo "0";} ?>" placeholder="E">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'X' && $result1->attendance_date==$attendance_date) ? 1 : 0;}else {echo "0";} ?>" placeholder="X">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'G' && $result1->attendance_date==$attendance_date) ? 1 : 0;}else {echo "0";} ?>" placeholder="G">
                        <input type="text" name="attendance_value<?php
		echo $i; ?>[]" class="form-control text-center w-50 d-inline attendance" value="<?php
		if($result1) {echo (get_attendance_status($result1->status) == 'H' && $attendance_date==$result1->attendance_date) ? 1 : 0;}else {echo "0";} ?>" placeholder="H">
                    </td>
                    <td><input type="text" name="attendance_remark[]" class="form-control" value="<?php
		echo isset($result->remark) ? $result->remark : ''; ?>" placeholder="Remark">
                        <p class="text-muted">Student Reason: <strong><?php
		echo isset($result->reason_for_absent) ? $result->reason_for_absent : '-'; ?></strong></p></td>
                    </tr>
                    <?php
		$i++;
		}
	}

function get_invoice_sheet($class_code = false)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
	$result = $query->row();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join(DB_INVOICE, 'invoice.student_id = student.student_id');
	$ci->db->where('invoice.class_id', $result->class_id);
	$query = $ci->db->get();
	$result = $query->result();
	foreach($result as $row)
		{
?>
                        <tr>
                            <td ><input type="checkbox" name="payment_status" value="<?php
		echo $row->invoice_id; ?>"></td>
                            <td><?php
		echo isset($row->nric) ? $row->nric .', '. $row->firstname . ' ' . $row->lastname : '-'; ?></td>
                            <td data-order="<?php echo $row->id ?>"><?php
		echo isset($row->invoice_no) ? $row->invoice_no : '-'; ?></td>
                            <td><?php
		echo isset($row->invoice_date) ? date("Y-m-d", strtotime($row->invoice_date)) : '-'; ?></td>
                            <td><a href="<?php
		echo base_url('assets/files/pdf/invoice/' . $row->invoice_file) ?>" target="_blank">View</a><br/><a href="<?php
		echo base_url('assets/files/pdf/invoice/' . $row->invoice_file) ?>" target="_blank" download>Download Invoice</a></td>
                            <td><?php
		echo isset($row->status) ? get_invoice_status($row->invoice_id, 'status') : '-'; ?></td>
                            <td><?php
		echo isset($row->payment_method) ? get_invoice_status($row->invoice_id, 'payment_method') : '-'; ?></td>
		<td><textarea class="form-control" name="remark"><?php echo $row->remark; ?></textarea><button type="button" class="btn btn-success save_remark hide">Save</button><input type="hidden" name="id" value="<?php echo $row->id; ?>"></td>
                        </tr>
                        <?php
		}
	}

function get_attendance_date_by_class_code($class_code)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_CLASSES, ['class_code' => $class_code]);
	$result = $query->row();
	$result = get_weekdays_of_month($result->class_month, $result->class_day);
	if (in_array(date('Y-m-d') , $result))
		{
		return date('Y-m-d');
		}
	}

function get_invoice_status($invoice_id, $type)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_INVOICE, ['invoice_id' => $invoice_id]);
	$result = $query->row();
	if ($type == 'status')
		{
		return get_invoice_status_db($result->status);
		}
	elseif ($type == 'payment_method')
		{
		return get_invoice_payment_method_db($result->payment_method);
		}
	  else
		{
		return '-';
		}
	}

function get_invoice_status_db($status)
	{
	if ($status == 1)
		{
		return "Paid";
		}
	elseif ($status == 2)
		{
		return "Partial";
		}
	elseif ($status == 3)
		{
		return "Overdue";
		}
	  else
		{
		return '-';
		}
	}

function get_invoice_payment_method_db($payment_method)
	{
	if ($payment_method == 1)
		{
		return "Cash";
		}
	elseif ($payment_method == 2)
		{
		return "Cheque";
		}
		elseif ($payment_method == 3)
		{
		return "PayNow";
		}
	  else
		{
		return "-";
		}
	}

function get_weekdays_of_month($month = false, $day = false)
	{
	$counter_list = ['first', 'second', 'third', 'fourth', 'fifth', 'sixth', 'seventh', 'eighth'];
	$storage = [];
	$match1 = date('m', strtotime($month));
	for ($i = 0; $i < count($counter_list); $i++)
		{
		$dates = date('Y-m-d', strtotime($counter_list[$i] . ' ' . $day . ' of ' . $month));
		$match2 = date('m', strtotime($dates));
		if ($match1 == $match2)
			{
			$storage[] = $dates;
			}
		}

	return $storage;
	}

function get_subject($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->order_by('created_at', 'desc')->get_where(DB_SUBJECT, ['is_archive' => 0, 'subject_id' => $id]);
		}
	  else
		{
		$query = $ci->db->order_by('created_at', 'desc')->get_where(DB_SUBJECT, ['is_archive' => 0]);
		}

	if ($query)
		{
		return $query->result();
		}
	}

function get_subject_classes($id = false)
	{
	$ids = json_decode($id);
	$storage = [];
	$ci = & get_instance();
	if (isset($ids))
		{
		foreach($ids as $id)
			{
			$query = $ci->db->get_where(DB_SUBJECT, ['id' => $id]);
			$result = $query->row();
			if ($result)
				{
				$storage[] = $result->subject_name;
				}
			}

		$storage = implode(", ", $storage);
		return $storage;
		}
	}

function get_material_of_student($class_code, $student_id)
	{
	$ci = & get_instance();
	$ci->db->select('count(*) as count_total_order');
	$ci->db->from('orders');
	$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
	$ci->db->where(['orders.class_code' => $class_code, 'order_details.student_id' => $student_id]);
	$query = $ci->db->get();
	$result = $query->row();
	$ci->db->select('count(*) as books_given');
	$ci->db->from('orders');
	$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
	$ci->db->where(['orders.class_code' => $class_code, 'order_details.student_id' => $student_id, 'order_details.status' => 1]);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	if ($result)
		{
		return $result1->books_given . '/' . $result->count_total_order;
		}
	}

function get_order_student($id = false)
	{
	$storage = [];
	$ci = & get_instance();
	$query = $ci->db->get_where('order_details', ['order_id' => $id]);
	$result = $query->result();
	if ($result)
		{
		foreach($result as $value)
			{
			$query = $ci->db->get_where(DB_STUDENT, ['id' => $value->student_id]);
			$result = $query->row();
			$storage[] = $result->firstname . ' ' . $result->lastname;
			}

		$storage = implode(", ", $storage);
		return $storage;
		}
	}

function get_order_student_content($order_id, $class_code, $status)
	{
	$ci = & get_instance();
	$ci->db->select('*, student.id as stud_id');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->join('order_details', 'student.id = order_details.student_id');
	$ci->db->where(['order_details.order_id' => $order_id, 'student.is_archive' => 0, 'student.is_active' => 1, 'class.class_code' => $class_code]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
		{
		foreach($result as $value)
			{
?>
                            <option value="<?php
			echo $value->stud_id; ?>" <?php
			if ($status == 1)
				{
				if ($value->status != 0)
					{
					echo "disabled";
					}
				}
			elseif ($status == 2)
				{
				if ($value->status != 1)
					{
					echo "disabled";
					}
				}
			elseif ($status == 3)
				{
				if ($value->status == 2)
					{
					echo "disabled";
					}
				} ?>><?php
			echo $value->firstname . ' ' . $value->lastname . ' - ' . get_class_code_by_class($value->class_id); ?></option>
                            <?php
			}
		}
	}

function get_student($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'is_active' => 1, 'student_id' => $id]);
		$result = $query->row();
		}
	  else
		{
		$ci->db->select('*, student.id as sid, student.student_id');
		$ci->db->from(DB_STUDENT);
		$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id', 'left');
		$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id', 'left');
		$ci->db->where([DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
		$query = $ci->db->get();
		$result = $query->result();

		// return $ci->db->last_query();

		}

	if ($result)
		{
		return $result;
		}
	}

function get_student_archived()
	{
	$ci = & get_instance();
	$ci->db->select('*, student.id as sid, student.student_id');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id', 'left');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 1, DB_STUDENT . '.is_active' => 1]);
	$query = $ci->db->get();
	if ($query)
		{
		return $query->result();
		}
	}

function get_student_archive_at($student_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_STUDENT, ['student_id' => $student_id]);
	$result = $query->row();
	if ($result)
		{
		return date('d M, Y H:i A', strtotime($result->updated_at));
		}

	return '-';
	}

function get_material_associated($sid, $class_code)
	{
	$ci = & get_instance();
	$ci->db->select('*, SUM(book_price) as book_price_amount, count(*) as books_count');
	$ci->db->from(DB_ORDER . 's');
	$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
	$ci->db->join(DB_MATERIAL, 'orders.book_id = material.id');
	$ci->db->where('order_details.student_id', $sid);
	$ci->db->where('orders.class_code', $class_code);
	$ci->db->where('order_details.status', 2);
	$ci->db->group_by('material.id');
	$query = $ci->db->get();
	$result = $query->result();
	//return $ci->db->last_query();

	foreach($result as $row) {
		$query1 = $ci->db->get_where(DB_ORDER.'s', ['book_id'	=> $row->book_id]);
		$result1 = $query1->num_rows();
		 ?>
                    <option value=""><?php
	echo $row->book_name . '  ' . $row->books_count . '/' . $result1 . ' $' . $row->book_price; ?></option>
                    <?php
									}
	}

function has_enrollment_content($student_id, $class_id, $type)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('student_enrollment', ['student_id' => $student_id, 'class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		if ($type == 'extra_charges')
			{
			return !empty($result->extra_charges) ? 'Yes' : 'No';
			}
		  else
			{
			return !empty($result->deposit_collected) ? 'Yes' : 'No';
			}
		}

	return '-';
	}

function get_view_all_contents($student_id, $class_id)
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from('student_to_class');
	$ci->db->join('student_enrollment', 'student_to_class.student_id = student_enrollment.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$query = $ci->db->get();
	$result = $query->row();
	if ($result)
		{
?>
                        <div class="form-group">
                            <label>Reservation Date : <?php
		if ($result->reservation_date && strtotime($result->reservation_date) > 1)
			{
			echo date('d M, Y', strtotime($result->reservation_date));
			}
		  else
			{
			echo '-';
			} ?></label>
                        </div>
                        <div class="form-group">
                            <label>Enrollment Date : <?php
		if ($result->enrollment_date && strtotime($result->enrollment_date) > 1)
			{
			echo date('d M, Y', strtotime($result->enrollment_date));
			}
		  else
			{
			echo '-';
			} ?></label>
                        </div>
                        <div class="form-group">
                            <label>Deposit : <?php
		echo get_deposit_value_of_class($class_id); ?></label>
                        </div>
                        <div class="form-group">
                            <label>Deposit Remark : <?php
		echo isset($result->remarks_deposit) ? $result->remarks_deposit : '-'; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Previous Month Balance : <?php
		echo get_currency('SGD').get_previous_month_balance($student_id, $class_id); ?></label>
                        </div>
                        <div class="form-group">
                            <label>Extra Charges : <?php
		echo get_currency('SGD').$result->extra_charges; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Previous Month Payment : <?php
		echo get_currency('SGD').$result->previous_month_payment; ?></label>
                        </div>
                        <div class="form-group">
                            <label>Remark : <?php
		echo isset($result->remarks) ? $result->remarks : '-'; ?></label>
                        </div>
                        <?php
		}
	}

function get_student_by_student_id($id = false)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where(DB_STUDENT, ['is_archive' => 0, 'is_active' => 1, 'student_id' => $id]);
	$result = $query->row();
	if ($result)
		{
		return $result->firstname . ' ' . $result->lastname;
		}
	  else
		{
		return '-';
		}
	}

function get_class_code_and_tutor($class_id)
	{
	$ci = & get_instance();
	$storage = [];
	$query = $ci->db->get_where(DB_CLASSES, ['class_id' => $class_id]);
	$result = $query->row();
	if ($result)
		{
		$storage = ['class_code' => $result->class_code, 'tutor_id' => $result->tutor_id, ];
		return $storage;
		}
	}

function get_reporting_sheet($date_from = false, $date_to = false)
	{
	$ci = & get_instance();
	$ci->db->select('*, sum(invoice_amount) as total_invoice_amount, sum(amount_excluding_material) as total_amount_excluding_material, sum(material_amount) as total_material_amount');
	$ci->db->from(DB_INVOICE);
	if ($date_from || $date_to)
		{
		$ci->db->where('DATE(invoice_date) >=', $date_from);
		$ci->db->where('DATE(invoice_date) <=', $date_to);
		}

	$ci->db->group_by('class_id');
	$query = $ci->db->get();
	$result = $query->result();

	// die(print_r($ci->db->last_query()));

	if ($date_from || $date_to)
		{
		if ($result)
			{
			foreach($result as $value)
				{
				$class_code = get_class_code_and_tutor($value->class_id); ?>
                                <tr>
                                    <td><?php
				echo $class_code['class_code']; ?></td>
                                    <td><?php
				echo get_subject_code($value->student_id); ?></td>
                                    <td><?php
				echo get_tutor_of_class($value->class_id); ?></td>
                                    <td><?php
				echo get_students_enrolled($value->class_id); ?></td>
                                    <td><?php
				get_currency('SGD');
				echo isset($value->total_amount_excluding_material) ? $value->total_amount_excluding_material : '-'; ?></td>
                                    <td><?php
				get_currency('SGD');
				echo isset($value->total_material_amount) ? $value->total_material_amount : '-'; ?></td>
                                </tr>
                                <?php
				}
			}
		}
	  else
		{
		return $result;
		}
	}

function get_book($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0, 'id' => $id]);
		$result = $query->row();
		}
	  else
		{
		$query = $ci->db->get_where(DB_MATERIAL, ['is_archive' => 0]);
		$result = $query->result();
		}

	if ($query)
		{
		return $result;
		}
	}

function get_order($id = false)
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_ORDER . 's');
	$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
	$ci->db->where('orders.is_archive', 0);
	$ci->db->group_by('orders.order_id');
	$query = $ci->db->get();
	if ($query)
		{
		return $query->result();
		}
	}

	function get_archived_order()
	{
		$ci = & get_instance();
		$ci->db->select('*');
		$ci->db->from(DB_ORDER . 's');
		$ci->db->join('order_details', 'orders.order_id = order_details.order_id');
		$ci->db->where('orders.is_archive', 1);
		$ci->db->group_by('orders.order_id');
		$query = $ci->db->get();
		if ($query)
			{
			return $query->result();
			}
		}

function get_class_code_transfer($class_code = false)
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_CLASSES);
	$ci->db->where(['is_archive' => 0, 'class_code !=' => $class_code]);
	$query = $ci->db->get();
	if ($query)
		{
		$result = $query->result(); ?>
                            <option value="">-- Select One --</option>
                            <?php
		foreach($result as $row)
			{
?>
                                <option value="<?php
			echo $row->class_code ?>"><?php
			echo $row->class_code ?></option>
                                <?php
			}
		}
	}

function get_sms_template($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where('sms_template', ['id' => $id]);
		$result = $query->row();
		}
	  else
		{
		$query = $ci->db->get('sms_template');
		$result = $query->result();
		}

	if ($query)
		{
		return $result;
		}
	}

function get_sms_history($id = false)
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from('sent_sms');
	if ($id)
		{
		$ci->db->where(['id' => $id]);
		$query = $ci->db->get();
		$result = $query->row();
		}
	  else
		{
		$ci->db->where(['deleted_at' => null]);
		$ci->db->order_by('created_at', 'ASC');
		$query = $ci->db->get();
		$result = $query->result();
		}

	if ($result)
		{
		return $result;
		}
	}

function get_student_details_by_sms_history($recipient)
	{
	$ci = & get_instance();
	if ($recipient)
		{
		$ci->db->select('*');
		$ci->db->from(DB_STUDENT);
		$ci->db->where(['phone' => $recipient]);
		$ci->db->limit(1);
		$query = $ci->db->get();
		$result = $query->row();
		if ($result)
			{
			return ['student_name' => $result->firstname . ' ' . $result->lastname, 'student_id' => $result->student_id, ];
			}
		}

	return false;
	}

function get_pre_condition_template($reason)
	{
	$ci = & get_instance();
	$condition_array = ['Student absent without leave', 'Fee reminder', 'Late Fee reminder', 'Student filled a miss class request', 'Reminder one day before reservation', 'Enrollment Confirmation', 'Centre wide announcements'];
	$query = $ci->db->get_where('sms_template', ['reason' => $reason]);
	$result = $query->row();
	if ($result)
		{
		return ['pre_condition' => $condition_array[($reason - 1) ], 'template_name' => $result->template_name, ];
		}
	}

function get_billing($id = false)
	{
	$ci = & get_instance();
	if ($id)
		{
		$query = $ci->db->get_where(DB_BILLING, ['id' => $id, 'is_archive' => 0]);
		$result = $query->row();
		}
	  else
		{
		$query = $ci->db->get_where(DB_BILLING, ['is_archive' => 0]);
		$result = $query->result();
		}

	if ($query)
		{
		return $result;
		}
	}

function send_cron_invoice()
{
    
    $ci = & get_instance();
    
	$ci->session->set_userdata(['invoice_generation_date' => date('Y-m-d H:i')]);
	$invoice_generation_date = $ci->session->invoice_generation_date;

	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
    {
		foreach($result as $row)
        {
			$ci->db->select('*, student.id as sid');
			$ci->db->from(DB_CLASSES);
			$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
			$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
			$ci->db->where(['student_enrollment.student_id' => $row->student_id, 'student_enrollment.class_id' => $row->class_id]);
			$ci->db->limit(1);
			$query1 = $ci->db->get();

			$result1 = $query1->row();

            $invoice_id = uniqid();
            $date = date('Y-m-d H:i:s');
            $invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
            $file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
            $frequency = $result1->frequency;
            $class_code = $result1->class_code;
            $emailto = [$result1->email, $result1->parent_email];
            $fees = $result1->monthly_fees;
            $extra_charges = isset($result1->extra_charges) ? number_format($result1->extra_charges, 2) : '0.00';
            $deposit = get_deposit_value_of_class_without_currency($result1->class_id);
            $previous_month_balance = get_previous_month_balance($result1->student_id, $result1->class_id);
			$previous_month_payment = isset($result1->previous_month_payment) ? number_format($result1->previous_month_payment, 2) : '0.00';
			//die(var_dump($previous_month_balance));
            $counter = 0;
           
            $subject = 'Invoice #' . get_invoice_no();
            $message = '<a href="' . $file_path . '">Click here </a> to view invoice.';
            $invoice_content = ['subject' => $subject, 'message' => $message, ];

            $invoice_amount = $amount_excluding_material = $lesson_fees = 0;

            $query = $ci->db->query("select * from billing where DATE_FORMAT(invoice_generation_date, '%d-%m-%Y  %H:%i')  =  DATE_FORMAT('$invoice_generation_date', '%d-%m-%Y  %H:%i')");
            
            $result = $query->row();
            
            if (!$result)
            {
                echo "<br> Invoice cannot be generated, set invoice date and try again!";
                return false;
            }

            $book_price_amount = get_invoice_result2($result1->sid, $result->invoice_generation_date, $class_code);
            $book_charges = number_format($book_price_amount, 2);
            $billing_data = json_decode($result->billing);

            $ci->db->select('*');
            $ci->db->from(DB_INVOICE);
            $ci->db->where('student_id', $result1->student_id);
            $ci->db->where('class_id', $result1->class_id);
            $ci->db->where('type', 'first_month_invoice');
            $query11 = $ci->db->get();
           //print_r($ci->db->last_query());echo '<br/>';
            //echo $query11->num_rows();echo '<br/>';
            if($query11->num_rows()>0)
            {
                //echo "restmonth".$row->student_id;echo "</br>";
                $type = 'rest_month_invoice';
                $invoice_amount = number_format(($fees + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment), 2);
                $amount_excluding_material = number_format(($fees + $extra_charges + $previous_month_balance - $previous_month_payment), 2);
                $lesson_fees = number_format($fees, 2);

                $invoice_data = ['class_code' => $class_code, 'lesson_fee' => $lesson_fees, 'material_fees' => $book_charges, 'extra_charges' => $extra_charges, 'previous_month_payment' => $previous_month_payment, 'previous_month_balance' => $previous_month_balance, 'returned_deposit'	=>	'0.00'];
                $data = ['invoice_id' => $invoice_id, 'invoice_no' => get_invoice_no() , 'student_id' => $result1->student_id, 'class_id' => $result1->class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data) , 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];
                //echo $lesson_fees;echo '<br/>';
                $query = $ci->db->insert(DB_INVOICE, $data);
            
                if ($query)
                {
                    $mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
                    $ci->load->library('M_pdf');
                    $ci->m_pdf->download_my_mPDF($invoice_file);
                    echo "<br> Invoice has been generated.";
                    if ($mail == true)
                    {
                        echo "<br> Invoice has been generated.";
                    }
                }
            }
            else
            {
                //echo "firstmonth".$row->student_id;echo "</br>";
                $type = 'first_month_invoice';
                
                $first_month_attendance_date = getFirstMonthAttendanceDate($result1->student_id, $class_code, $billing_data);
                //echo $first_month_attendance_date;echo '<br/>';
                //print_r($first_month_attendance_date);echo '<br/>';
                if($first_month_attendance_date)
                {
                    foreach($billing_data as $billing)
                    {
                        if ($billing->working_week != 1)
                        {
                            if ($billing->rest_week != 1)
                            {
                                $dates = explode("-", $billing->date_range);
                                //echo $first_month_attendance_date.'-'.$dates[1].'<br/>';
                                if (strtotime(str_replace("-", "/", $first_month_attendance_date)) <= strtotime($dates[1]))
                                {
                                    $counter+=1;
                                }
                            }
                        }
                    }
                    //echo $counter;echo '<br/>';
                    $invoice_amount = number_format(((($counter * $fees) / $frequency) + $book_charges + $extra_charges), 2);
                    $amount_excluding_material = number_format(((($counter * $fees) / $frequency) + $extra_charges), 2);
					$lesson_fees = number_format((($counter * $fees) / $frequency), 2);
					
                    $invoice_data = ['class_code' => $class_code, 'lesson_fee' => $lesson_fees, 'material_fees' => $book_charges, 'extra_charges' => $extra_charges, 'previous_month_payment' => $previous_month_payment, 'previous_month_balance' => $previous_month_balance, 'returned_deposit'	=>	'0.00'];
                    $data = ['invoice_id' => $invoice_id, 'invoice_no' => get_invoice_no() , 'student_id' => $result1->student_id, 'class_id' => $result1->class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data) , 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date];
                    //echo $invoice_amount;echo '<br/>';
                    $query = $ci->db->insert(DB_INVOICE, $data);
					//die(print_r($invoice_amount));
                    if ($query)
                    {
                        $mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
                        $ci->load->library('M_pdf');
                        $ci->m_pdf->download_my_mPDF($invoice_file);
                        echo "<br> Invoice has been generated.";
                        if ($mail == true)
                        {
                            echo "<br> Invoice has been generated.";
                        }
                    }
                }
            }
            $ci->db->where('student_id', $result1->student_id);
            $ci->db->where('class_id', $result1->class_id);
            $ci->db->update('student_enrollment', ['extra_charges' => 0, 'previous_month_payment' => 0]);
    
        }
    }
}

function send_archived_invoice($student_id)
	{

	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, DB_STUDENT . '.is_archive' => 0, DB_STUDENT . '.is_active' => 1, DB_STUDENT . '.student_id' => $student_id]);
	$query = $ci->db->get();
	$result = $query->result();
	foreach($result as $row)
		{

		send_archive_invoice_extend($student_id, $row->class_id);
		}

	$ci->db->where('student_id', $row->student_id);
	$ci->db->where('class_id', $row->class_id);
	$ci->db->update('student_enrollment', ['extra_charges' => 0, 'previous_month_payment' => 0]);
	}

function send_archive_invoice_extend($student_id, $class_id)
	{

	$ci = & get_instance();
	$type = 'archive_invoice';
	$invoice_id = uniqid();
	$date = date('Y-m-d H:i:s');
	$invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
	$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	if (!$result1)
		{
		return false;
		}

	$frequency = $result1->frequency;
	$class_code = $result1->class_code;
	$emailto = [$result1->email, $result1->parent_email];
	$fees = $result1->monthly_fees;
	$extra_charges = isset($result1->extra_charges) ? number_format($result1->extra_charges, 2) : '0.00';
	$previous_month_balance = get_previous_month_balance($student_id, $class_id);
	$previous_month_payment = isset($result1->previous_month_payment) ? number_format($result1->previous_month_payment, 2) : '0.00';
	$deposit = get_deposit_value_of_class_without_currency($class_id);
	$invoice_amount = $amount_excluding_material = $lesson_fees = 0;
	$result5 = get_invoice_result5();
	//die(print_r($result5));
	if (!$result5)
		{
		return false;
		}

	$query = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result5]);
	$result = $query->row();
	$billing_data = json_decode($result->billing);
	$book_price_amount = get_invoice_result2($result1->sid, $result5, $class_code);
	$book_charges = number_format($book_price_amount, 2);
	$L = $M = $E = $X = $G = $H = [];
	$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
	$X1 = $G1 = [];
	if($value_since_enrollment)
	{
		$X1 = $value_since_enrollment['X'];
		$G1 = $value_since_enrollment['G'];
	}
	$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $result1->class_code]);
	if ($query->num_rows() > 0)
		{
		foreach($billing_data as $billing)
			{
				if ($billing->working_week != 1)
				{
				if ($billing->rest_week != 1)
					{
						$dates = explode("-", $billing->date_range);
						foreach($query->result() as $row)
						{
							$status = json_decode($row->status);
							if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1])))
							{
								if ($status[0] == 1)
									{
									$L[] = $status[0];
									}

								if ($status[1] == 1)
									{
									$M[] = $status[1];
									}

								if ($status[2] == 1)
									{
									$E[] = $status[2];
									}

								if ($status[3] == 1)
									{
									$X[] = $status[3];
									}

								if ($status[4] == 1)
									{
									$G[] = $status[4];
									}

								if ($status[5] == 1)
									{
									$H[] = $status[5];
									}
							}
						}
					}
				}
			}
		}
    //echo 'Invoice have been generated.';
	$subject = 'TSA - Invoice #' . get_invoice_no();
	$message = '<a href="' . base_url($file_path) . '">Click here </a> to view invoice.';
	$invoice_content = ['subject' => $subject, 'message' => $message, ];
	$invoice_amount = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit), 2);

	$amount_excluding_material = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit), 2);
	$lesson_fees = number_format((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees), 2);

	$invoice_data = ['class_code' => $class_code, 'lesson_fee' => $lesson_fees, 'material_fees' => $book_charges, 'extra_charges' => $extra_charges, 'previous_month_payment' => $previous_month_payment, 'previous_month_balance' => $previous_month_balance, 'returned_deposit'	=>	'0.00'];
		$data = ['invoice_id' => $invoice_id, 'invoice_no' => get_invoice_no() , 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data) , 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date, ];

	$query = $ci->db->insert(DB_INVOICE, $data);
	if ($query)
		{
		$ci->load->library('M_pdf');
		$ci->m_pdf->download_my_mPDF($invoice_file);
		$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
		if ($mail == true)
			{

			// die(print_r($query));
			// return true;

			}
		}
	}

function send_final_settlement_invoice($student_id, $class_id)
	{
	$ci = & get_instance();
	$type = 'final_settlement_invoice';
	$invoice_id = uniqid();
	$date = date('Y-m-d H:i:s');

	$invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
	$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
//die(print_r($ci->db->last_query()));
	if (!$result1)
		{
		return false;
		}

	$frequency = $result1->frequency;
	$class_code = $result1->class_code;
	$emailto = [$result1->email, $result1->parent_email];
	$fees = $result1->monthly_fees;
	$extra_charges = isset($result1->extra_charges) ? number_format($result1->extra_charges, 2) : '0.00';
	$previous_month_balance = get_previous_month_balance($student_id, $class_id);
	$previous_month_payment = isset($result1->previous_month_payment) ? number_format($result1->previous_month_payment, 2) : '0.00';
	$deposit = get_deposit_value_of_class_without_currency($class_id);
	$invoice_amount = $amount_excluding_material = $lesson_fees = 0;
	$result5 = get_invoice_result5();
	//die(print_r(gettype($previous_month_payment)));
	if (!$result5)
		{
		return false;
		}

	$query = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result5]);
	$result = $query->row();
	$billing_data = json_decode($result->billing);
	$book_price_amount = get_invoice_result2($result1->sid, $result5, $class_code);
	$book_charges = number_format($book_price_amount, 2);
	$L = $M = $E = $X = $G = $H = [];
	$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
	$X1 = $G1 = [];
	//die(print_r($value_since_enrollment));
	if($value_since_enrollment)
	{
		$X1 = $value_since_enrollment['X'];
		$G1 = $value_since_enrollment['G'];
	}
	$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $result1->class_code]);
	//echo $ci->db->last_query();
	if ($query->num_rows() > 0)
		{
		foreach($billing_data as $billing)
			{
				if ($billing->working_week != 1)
				{
				if ($billing->rest_week != 1)
					{
						$dates = explode("-", $billing->date_range);
						foreach($query->result() as $row)
							{
							$status = json_decode($row->status);
							//echo str_replace('/', '-', $dates[0]) .' | '. $row->attendance_date .' | '. str_replace('/', '-', $dates[1]).'<br/><br/>';
							if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1])))
								{
									//echo "=======================";
									//echo str_replace('/', '-', $dates[0]) .' | '. $row->attendance_date .' | '. str_replace('/', '-', $dates[1]).'<br/><br/>';
								if ($status[0] == 1)
									{
									$L[] = $status[0];
									}

								if ($status[1] == 1)
									{
									$M[] = $status[1];
									}

								if ($status[2] == 1)
									{
									$E[] = $status[2];
									}

								if ($status[3] == 1)
									{
									$X[] = $status[3];
									}

								if ($status[4] == 1)
									{
									$G[] = $status[4];
									}

								if ($status[5] == 1)
									{
									$H[] = $status[5];
									}
								}
							}
						}
					}
			}
		}
	//echo 'Invoice have been generated.';
	//die(print_r($X1));
	$subject = 'TSA - Invoice #' . get_invoice_no();
	$message = '<a href="' . base_url($file_path) . '">Click here </a> to view invoice.';
	$invoice_content = ['subject' => $subject, 'message' => $message, ];
	$invoice_amount = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit), 2);
	$amount_excluding_material = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $extra_charges + $previous_month_balance - $previous_month_payment - $deposit), 2);
	$lesson_fees = number_format((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees), 2);
	//die(print_r($invoice_amount));
	$invoice_data = ['class_code' => $class_code, 'lesson_fee' => $lesson_fees, 'material_fees' => $book_charges, 'extra_charges' => $extra_charges, 'previous_month_payment' => $previous_month_payment, 'previous_month_balance' => $previous_month_balance, 'returned_deposit'	=>	$deposit];
		$data = ['invoice_id' => $invoice_id, 'invoice_no' => get_invoice_no() , 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data) , 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date, ];

	$query = $ci->db->insert(DB_INVOICE, $data);
	if ($query)
		{
		$ci->load->library('M_pdf');
		$ci->m_pdf->download_my_mPDF($invoice_file);
		$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
		if ($mail == true)
			{

			// die(print_r($query));
			// return true;

			}
		}
	}

function send_class_transfer_invoice($student_id, $class_id, $class_id_id)
	{
		
	$ci = & get_instance();
	$type = 'class_transfer_invoice';
	$invoice_id = uniqid();
	$date = date('Y-m-d H:i:s');
	$invoice_file = uniqid() . '__invoice_pdf-' . date('Y-m-d') . '.pdf';
	$file_path = base_url('assets/files/pdf/invoice/' . $invoice_file);
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id, 'student_enrollment.class_id' => $class_id]);
	$ci->db->limit(1);
	$query1 = $ci->db->get();
	$result1 = $query1->row();
	//return $result1;
	if (!$result1)
		{
		return false;
		}

	$frequency = $result1->frequency;
	$class_code = $result1->class_code;
	$emailto = [$result1->email, $result1->parent_email];
	$fees = $result1->monthly_fees;
	$extra_charges = isset($result1->extra_charges) ? number_format($result1->extra_charges, 2) : '0.00';
	$previous_month_balance = get_previous_month_balance($student_id, $class_id);
	$previous_month_payment = isset($result1->previous_month_payment) ? number_format($result1->previous_month_payment, 2) : '0.00';
	
	$invoice_amount = $amount_excluding_material = $lesson_fees = 0;
	$result5 = get_invoice_result5();
	if (!$result5)
		{
		return false;
		}
		
	$query = $ci->db->get_where(DB_BILLING, ['invoice_generation_date' => $result5]);
	$result = $query->row();
	$billing_data = json_decode($result->billing);
	$book_price_amount = get_invoice_result2($result1->sid, $result5, $class_code);
	$book_charges = number_format($book_price_amount, 2);
	$L = $M = $E = $X = $G = $H = [];
	$value_since_enrollment = get_value_since_enrollment($student_id, $class_code);
	$X1 = $G1 = [];
	if($value_since_enrollment)
	{
		$X1 = $value_since_enrollment['X'];
		$G1 = $value_since_enrollment['G'];
	}
	$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code' => $result1->class_code]);
	if ($query->num_rows() > 0)
		{
		foreach($billing_data as $billing)
			{
				if ($billing->working_week != 1)
				{
				if ($billing->rest_week != 1)
					{
					$dates = explode("-", $billing->date_range);
					foreach($query->result() as $row)
						{
						$status = json_decode($row->status);
						if (strtotime($row->attendance_date) >= strtotime(str_replace('/', '-', $dates[0])) && strtotime($row->attendance_date) <= strtotime(str_replace('/', '-', $dates[1])))
							{
								
						
							if ($status[0] == 1)
								{
								$L[] = $status[0];
								}

							if ($status[1] == 1)
								{
								$M[] = $status[1];
								}

							if ($status[2] == 1)
								{
								$E[] = $status[2];
								}

							if ($status[3] == 1)
								{
								$X[] = $status[3];
								}

							if ($status[4] == 1)
								{
								$G[] = $status[4];
								}

							if ($status[5] == 1)
								{
								$H[] = $status[5];
								}
							}
						}
					}
				}
			}
		}
    //echo 'Invoice have been generated.';
	$subject = 'TSA - Invoice #' . get_invoice_no();
	$message = '<a href="' . base_url($file_path) . '">Click here </a> to view invoice.';
	$invoice_content = ['subject' => $subject, 'message' => $message, ];
	$invoice_amount = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $book_charges + $extra_charges + $previous_month_balance - $previous_month_payment), 2);
	$amount_excluding_material = number_format(((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees) + $extra_charges + $previous_month_balance - $previous_month_payment), 2);
	$lesson_fees = number_format((((count($L) + count($M) + abs(-count($X)) + (-$X1) + ($G1) + count($H)) / $frequency) * $fees), 2);

	$invoice_data = ['class_code' => $class_code, 'lesson_fee' => $lesson_fees, 'material_fees' => $book_charges, 'extra_charges' => $extra_charges, 'previous_month_payment' => $previous_month_payment, 'previous_month_balance' => $previous_month_balance, 'returned_deposit'	=>	'0.00'];
		$data = ['invoice_id' => $invoice_id, 'invoice_no' => get_invoice_no() , 'student_id' => $student_id, 'class_id' => $class_id, 'invoice_date' => $date, 'invoice_amount' => $invoice_amount, 'amount_excluding_material' => $amount_excluding_material, 'material_amount' => $book_charges, 'invoice_data' => json_encode($invoice_data) , 'invoice_file' => $invoice_file, 'type' => $type, 'created_at' => $date, 'updated_at' => $date, ];

	$query = $ci->db->insert(DB_INVOICE, $data);

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
	if($query->num_rows()>0) {
		//return print_r($this->db->last_query());
		$ci->db->where('student_id', $student_id);
		$ci->db->where('class_id', $class_id_id);
		$ci->db->update('student_to_class', ['status' =>  3]);
	}
	else {
		$ci->db->insert('student_to_class', $data);
	}

	$ci->db->where('student_id', $student_id);
	$ci->db->where('class_id', $class_id);
	$ci->db->update('student_enrollment', $data1);
	/* END TRANSFER STUDENT */ 

	if ($query)
		{
		$ci->load->library('M_pdf');
		$ci->m_pdf->download_my_mPDF($invoice_file);
		$mail = send_mail($emailto, $invoice_id, $date, $invoice_amount, $type, $subject, $message);
		if ($mail == true)
			{

			// die(print_r($query));
			// return true;

			}
		}
	}

/* RESULT FOR INVOICE */

function get_invoice_result3($student_id)
	{
	$ci = & get_instance();
	$ci->db->select('*, student.id as sid');
	$ci->db->from(DB_CLASSES);
	$ci->db->join('student_enrollment', 'class.class_id = student_enrollment.class_id');
	$ci->db->join(DB_STUDENT, 'student_enrollment.student_id = student.student_id');
	$ci->db->where(['student_enrollment.student_id' => $student_id]);
	$query = $ci->db->get();
	$result = $query->result();
	if ($result)
		{
		return $result;
		}
	}

function get_invoice_result2($sid, $invoice_generation_date, $class_code)
	{
	$ci = & get_instance();
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
	foreach($result as $row)
		{
		$query1 = $ci->db->query("select * from billing where DATE_FORMAT(invoice_generation_date, '%Y-%m-%d %H:%i')  =  DATE_FORMAT('$invoice_generation_date', '%Y-%m-%d %H:%i')");
		$result1 = $query1->row();
		$billing_data = json_decode($result1->billing);
		if ($query1->num_rows() > 0)
			{
			foreach($billing_data as $billing)
				{
					if ($billing->working_week != 1)
					{
					if ($billing->rest_week != 1)
					{
							$dates = explode("-", $billing->date_range);
							//echo date('Y/m/d', strtotime($row->order_date)) .' | '. $dates[0]. ' | ' .$dates[1].'<br/>';
							if (strtotime(date('Y/m/d', strtotime($row->order_date))) >= strtotime($dates[0]) && strtotime(date('Y/m/d', strtotime($row->order_date))) <= strtotime($dates[1]))
								{
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
	$ci = & get_instance();
	$invoice_generation_date = [];
	$date = date('Y-m');
	$query = $ci->db->query("select * from billing where is_archive = 0 and DATE_FORMAT(invoice_generation_date, '%Y-%m') = '$date' order by updated_at desc");
	$result = $query->row();
	//print_r($ci->db->last_query());
	return $result->invoice_generation_date;
    }
    
    function getFirstMonthAttendanceDate($student_id, $class_code, $billing_data)
    {
        //return $student_id;
        $ci = & get_instance();

        $ci->db->select('*');
        $ci->db->from(DB_ATTENDANCE);
        $ci->db->where(['student_id' => $student_id, 'class_code' => $class_code]);
        $query = $ci->db->get();
        foreach($billing_data as $billing)
			{
                
				if ($billing->working_week != 1)
				{
				if ($billing->rest_week != 1)
					{
                        
						$dates = str_replace("/", "-", (explode("-", $billing->date_range)));
						foreach($query->result() as $row)
						{
                            //return $row->attendance_date;
                            $status = json_decode($row->status);
                            //echo $row->attendance_date .'-'.$dates[0] .' = '. $row->attendance_date .'-'.$dates[1].'<br/>';
							if (strtotime($row->attendance_date) >= strtotime($dates[0]) && strtotime($row->attendance_date) <= strtotime($dates[1]))
							{
                                //echo $row->attendance_date .'-'.$dates[0] .' = '. $row->attendance_date .'-'.$dates[1].'<br/>';
								if ($status[0] == 1)
									{
									    return $row->attendance_date;
									}

								if ($status[1] == 1)
									{
                                        return $row->attendance_date;
									}

								if ($status[3] == 1)
									{
                                        return $row->attendance_date;
									}
							}
						}
					}
				}
			}
	}
	
	function get_value_since_enrollment($student_id, $class_code)
	{
		$ci = & get_instance();
		$X = $G = [];
		$query = $ci->db->get_where(DB_ATTENDANCE, ['student_id' => $student_id, 'class_code'	=>	$class_code]);
		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $row)
			{
				$status = json_decode($row->status);
				{
					if ($status[3] == 1)
						{
						$X[] = $status[3];
						}

					if ($status[4] == 1)
						{
						$G[] = $status[4];
						}
				}
			}
		}
		return [
			'X'	=>	count($X),
			'G'	=>	count($G),
		];
	}

/* END RESULT FOR INVOICE */

function fee_reminder()
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('sms_reminder', ['fee_reminder' => date('Y-m-d H:i') ]);
	$result = $query->row();
	$message = get_sms_template_content(2);
	if ($result && $message)
		{
		$ci->db->select('*');
		$ci->db->from(DB_STUDENT);
		$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
		$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
		$ci->db->where(['student_to_class.status' => 3, 'student.is_active' => 1, 'student.is_archive' => 0]);
		$ci->db->group_by('student.phone');
		$query1 = $ci->db->get();
		$result1 = $query1->result();
		
		if ($result1)
			{
			foreach($result1 as $row)
				{
				/*if ($row->status == 2)
					{*/
					$student_details = get_student($row->student_id);
					$recipients = ['phone' => $student_details->phone, 'parents_phone' => $student_details->parents_phone, ];
					$class_code = get_class_code_by_class($row->class_id);
					$z = 0;
					$sms_pre_content = 'Hi ' . $student_details->firstname . ' ' . $student_details->lastname . '\r\n';
					foreach($recipients as $recipient)
						{
						if ($z == 1)
							{
							$sms_pre_content = 'Hi ' . $student_details->salutation . ' ' . $student_details->parent_first_name . ' ' . $student_details->parent_last_name . '\r\n';
							}

						send_sms($recipient, $sms_pre_content . $message, 2, $class_code);
						$z++;
						}
					}
				//}
			}
		}
	}

function late_fee_reminder()
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('sms_reminder', ['late_fee_reminder' => date('Y-m-d H:i') ]);
	$result = $query->row();
	$message = get_sms_template_content(3);
	if ($result && $message)
		{
		$ci->db->select('*');
		$ci->db->from(DB_STUDENT);
		$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
		$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
		$ci->db->where(['student_to_class.status' => 3, 'student.is_active' => 1, 'student.is_archive' => 0]);
		$ci->db->group_by('student.phone');
		$query1 = $ci->db->get();
		$result1 = $query1->result();
		if ($result1)
			{
			foreach($result1 as $row)
				{
				//if ($row->status == 5)
					//{
					$student_details = get_student($row->student_id);
					$recipients = ['phone' => $student_details->phone, 'parents_phone' => $student_details->parents_phone, ];
					$class_code = get_class_code_by_class($row->class_id);
					$z = 0;
					$sms_pre_content = 'Hi ' . $student_details->firstname . ' ' . $student_details->lastname . '\r\n';
					foreach($recipients as $recipient)
						{
						if ($z == 1)
							{
							$sms_pre_content = 'Hi ' . $student_details->salutation . ' ' . $student_details->parent_first_name . ' ' . $student_details->parent_last_name . '\r\n';
							}

						send_sms($recipient, $sms_pre_content . $message, 3, $class_code);
						$z++;
						}
					}
				//}
			}
		}
	}

function send_mail($emailto, $invoice_id = false, $invoice_date = false, $invoice_amount = false, $type = false, $subject, $message)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('aauth_users', ['id' => 1]);
	$result = $query->row();
	$ci->load->library('email');
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'smtp.gmail.com';
	$config['smtp_port'] = '587';
	$config['smtp_user'] = 'arvind.verz@gmail.com';
	$config['smtp_pass'] = '@rvVerz$123';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['smtp_crypto'] = "tls";
	$config['smtp_timeout'] = "5";
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = true;
	$config['mailtype'] = 'html';
	$config['crlf'] = "\r\n";
	$config['newline'] = "\r\n";
	$ci->email->initialize($config);
	$ci->email->from($result->email, 'The Science Academy');
	$ci->email->to($emailto);
	$ci->email->subject($subject);
	$ci->email->message($message);
	if ($ci->email->send())
		{
		return true;
		}

	return false;
	}

function send_mail_contact($email_from, $emailto, $subject, $message)
	{
	$ci = & get_instance();
	$ci->load->library('email');
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'smtp.gmail.com';
	$config['smtp_port'] = '587';
	$config['smtp_user'] = 'arvind.verz@gmail.com';
	$config['smtp_pass'] = '@rvVerz$123';
	$config['mailpath'] = '/usr/sbin/sendmail';
	$config['smtp_crypto'] = "tls";
	$config['smtp_timeout'] = "5";
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = true;
	$config['mailtype'] = 'html';
	$config['crlf'] = "\r\n";
	$config['newline'] = "\r\n";
	$ci->email->initialize($config);
	$ci->email->from($email_from, 'The Science Academy - Contact Us Form');
	$ci->email->to($emailto);
	$ci->email->subject($subject);
	$ci->email->message($message);
	/*if ($ci->email->send())
		{
		return true;
		}

	return false;*/
	return true;
	}

function send_sms($recipient, $message, $template_id = false, $class_code = false)
	{

	$ci = & get_instance();
	if (empty($recipient))
		{
		return false;
		}
	$recipient = '65' . $recipient;
	if(strlen($recipient)!=10)
	{
		$status = 0;
	}
	else
	{
		$status = 0;
		$app_id = '2927';
		$app_secret = '0f42dc3b-29c2-4824-b51f-4fa3cca4ca5f';
		$url = "http://www.smsdome.com/api/http/sendsms.aspx?appid=" . urlencode($app_id) . "&appsecret=" . urlencode($app_secret) . "&receivers=" . urlencode($recipient) . "&content=" . urlencode($message) . "&responseformat=JSON";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		$response = json_decode($result);
		curl_close($ch);
		if ($response->result->status == 'OK')
			{
			$status = 1;
			}
		}
	$data = ['template_id' => $template_id, 'class_code' => $class_code, 'recipient' => $recipient, 'message' => $message, 'status' => $status, 'created_at' => date('Y-m-d H:i:s') , ];
	$ci->db->insert('sent_sms', $data);
	}

function get_sms_template_content($reason_id)
	{
	$ci = & get_instance();
	$query = $ci->db->get_where('sms_template', ['reason' => $reason_id]);
	$result = $query->row();
	if ($result)
		{
		return $result->message;
		}
	}

function send_student_reservation_sms()
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, 'student.is_active' => 1, 'student.is_archive' => 0]);
	$query = $ci->db->get();
	//echo $ci->db->last_query();
	$result = $query->result();
	$message = get_sms_template_content(5);

	if ($result && $message)
		{

		foreach($result as $row)
			{
				//echo $row->student_id.'<br/>';
			if (date('Y-m-d', strtotime('-1 day', strtotime($row->reservation_date))) == date('Y-m-d'))
				{

				$class_code = get_class_code_by_class($row->class_id);
				$recipients = [$row->phone, $row->parents_phone];
				$z = 0;
				$sms_pre_content = 'Hi ' . $row->firstname . ' ' . $row->lastname . '\r\n';
				foreach($recipients as $recipient)
					{
						//return print_r("Hello");

					if ($z == 1)
						{
						$sms_pre_content = 'Hi ' . $row->salutation . ' ' . $row->parent_first_name . ' ' . $row->parent_last_name . '\r\n';
						}

					if ($recipient)
						{
						send_sms($recipient, $sms_pre_content . $message, 5, $class_code);
						}

					$z++;
					}
				}
			}
		}
	}

function send_student_confirmation_sms()
	{
	$ci = & get_instance();
	$ci->db->select('*');
	$ci->db->from(DB_STUDENT);
	$ci->db->join('student_to_class', 'student.student_id = student_to_class.student_id');
	$ci->db->join(DB_CLASSES, 'student_to_class.class_id = class.class_id');
	$ci->db->join('student_enrollment', 'student_enrollment.class_id = class.class_id');
	$ci->db->where(['student_to_class.status' => 3, 'student.is_active' => 1, 'student.is_archive' => 0]);
	$query = $ci->db->get();
	$result = $query->result();
	$message = get_sms_template_content(6);
	if ($result && $message)
		{
		foreach($result as $row)
			{
			if (date('Y-m-d', strtotime('-1 day', strtotime($row->enrollment_date))) == date('Y-m-d'))
				{
				$class_code = get_class_code_by_class($row->class_id);
				$result = $query->row();
				$recipients = [$row->phone, $row->parents_phone];
				$z = 0;
				$sms_pre_content = 'Hi ' . $row->firstname . ' ' . $row->lastname . '\r\n';
				foreach($recipients as $recipient)
					{
					if ($z == 1)
						{
						$sms_pre_content = 'Hi ' . $row->salutation . ' ' . $row->parent_first_name . ' ' . $row->parent_last_name . '\r\n';
						}

					if ($recipient)
						{
						send_sms($recipient, $sms_pre_content . $message, 6, $class_code);
						}

					$z++;
					}
				}
			}
		}
	}
