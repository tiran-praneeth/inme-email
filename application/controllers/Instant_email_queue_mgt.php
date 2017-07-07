<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instant_email_queue_mgt extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('utilities');
		$this->load->library('common_lib');
		$this->load->model('email_management_model');
	}

	/**
	 * This function use to send instant emails using cron job
	 * 
	 * @return void
	 */
	public function send_instant_email_queue()
	{
		$email_queue_list = $this->email_management_model->get_instant_email_queue();
		
		if ($email_queue_list != 0) {

			foreach ($email_queue_list as $input_array) {

				$email_template      = $input_array['email_template'];
				$email_template      = $input_array['email_template'];
				$email_template_list = $this->email_management_model->get_email_fun_list($input_array)[0];
				$email_body_library  = json_decode($email_template_list['email_body'], true);

				$library_path     = 'templates/'.$email_body_library['lib_name'];
				$library_name     = $email_body_library['lib_name'];
				$library_function = $email_body_library['lib_function'];

				/* Load template library */
				$this->load->library($library_path, NULL, $library_name);
				$email_body = $this->$library_name->$library_function(json_decode($input_array['email_data'], true));
				
				$data['message_header'] = $email_template_list['email_header'];
				$data['message_body'] 	= $email_body;
				$data['message_footer'] = $email_template_list['email_footer'];

				$html_template_path = 'email_templates/'.$email_body_library['template_name'];
				$html_view 	= $this->load->view($html_template_path, $data, true);

				$primary_email = json_decode($input_array['primary_email'], true);
				$cc_email      = json_decode($input_array['cc_email'], true);
				$bcc_email     = json_decode($input_array['bcc_email'], true);
				$attached_url  = json_decode($input_array['attached_url'], true);

				$send_email = $this->common_lib->send_email($primary_email, $cc_email, $bcc_email, $email_template_list['email_subject'], $html_view, $attached_url);

				if ($send_email == 1) {
					echo $this->email_management_model->set_delivered_instant_email($input_array);
				} else {
					$this->email_management_model->set_failed_instant_email($input_array);
					echo $send_email;
				}
			}
		} else {
			print_r(array('error' => 'database transaction error'));
		}
		

	}

}

/* End of file Instant_email_queue_mgt.php */
/* Location: ./application/controllers/Instant_email_queue_mgt.php */