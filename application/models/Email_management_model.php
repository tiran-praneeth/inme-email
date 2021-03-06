<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_management_model extends CI_Model {

	function get_email_fun_list($email_queue_list)
	{
		$this->db->select('function_name, receiver_code, email_subject, email_header, email_body, email_footer');
		$this->db->from('email_function_template');
		$this->db->where('function_name',$email_queue_list['email_template']);
		$this->db->where('app_code',$email_queue_list['app_code']);
		$this->db->where('status',1);

		$result = $this->db->get()->result_array();
		return $result;
	}

	function get_instant_email_queue()
	{
		$this->db->select('id, app_code, email_template, primary_email, cc_email, bcc_email, email_data, attached_url');
		$this->db->from('instant_email_queue');
		$this->db->where('status',0);
		$this->db->limit(5, 0);

		$result = $this->db->get()->result_array();
		return $result;
	}

	function app_authentication($api_key, $app_code)
	{
		$this->db->from('application');
		$this->db->where('app_code',$app_code);
		$this->db->where('auth_code',$api_key);
		$this->db->where('status',1);

		$result = $this->db->get();
		if ($result->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}

	function insert_instant_email_queue($data)
	{
		$this->db->insert('instant_email_queue', $data); 
        $queue_id = $this->db->insert_id();

        if ($queue_id > 0){
            return 1;
        } else {
            return 0;
        }
	}

	function set_delivered_instant_email($input_array)
	{
		$data = array(
               'status' => 1,
            );

		$this->db->where('id', $input_array['id']);
		return $this->db->update('instant_email_queue', $data); 
	}

	function set_failed_instant_email($input_array)
	{
		$data = array(
               'status' => 3,
            );

		$this->db->where('id', $input_array['id']);
		return $this->db->update('instant_email_queue', $data); 
	}

}

/* End of file Email_management_model.php */
/* Location: ./application/models/Email_management_model.php */