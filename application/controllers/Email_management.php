<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_management extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('utilities');
		$this->load->library('common_lib');
		$this->load->library('Nusoap_library');
		$this->load->model('email_management_model');
	}

	/* EMAILS MANAGEMENT WEB SERVICE */
	public function server()
	{
        $GLOBALS['this'] = $this;

		$ns = base_url('inme_emails/index.php/email_management/server');

		$server = new nusoap_server;
		$server->configureWSDL('Email Management', $ns);
		
		$server->wsdl->schemaTargetNamespace = $ns;

		/* Operation 1 : insert instant email queue */
		$input_params = array
		(
			'app_code'        => 'xsd:string',
			'email_template'  => 'xsd:string',
			'primary_email'	  => 'xsd:array',
			'cc_email'        => 'xsd:array',
			'bcc_email'       => 'xsd:array',
			'email_data'      => 'xsd:array',
			'attached_url'    => 'xsd:array',
		);
		$response = array
		(
			'email_status' => 'xsd:array'
		);

		$server->register
		(
			'instant_email_queue',
			$input_params,
			$response,
			'urn:SOAPServerWSDL',
			'urn:' . $ns . '/instant_email_queue',
			'rpc',
			'encoded',
			'insert instant email queue'
		);

		/* insert into instant email queue */
		public function instant_email_queue($input_array)
		{
			global $server;
        	$api_key = $server->requestHeader['authCredentials']['api_key'];
        	$input_validation = $this->common_lib->instant_email_validation($input_array);

        	if (!empty($api_key) && $input_validation) {
    			$auth_status = $this->common_lib->authentication($api_key, $input_array);

    			if ($auth_status) {
    				$insert_email = $this->email_management_model->insert_instant_email_queue($input_array);

    				if ($insert_email) {
    					return array('success' => '');
    				} else {
    					return array('error' => '');
    				}
    			} else {
    				return array('error' => 'authentication fail');
    			}
        	} else {
        		return array('error' => 'authentication fail');
        	}
		}

		$server->service(file_get_contents("php://input"));
	}


	public function insert_email_queues()
	{
		$input_array = array(
			'email_template' => 'CVN_SUCCESS_INSURANCE',
			'primary_email'  => array('tiranpraneeth@gmail.com'),
			'cc_email'       => array('lahiru@insureme.lk'),
			'bcc_email'      => array(),
			'email_data'     => array(
				'covernote' => array(
						'cn_id'=>'','type_of_cover'=>'Comprehensive','title'=>'Mr.','name_initials'=>'W.W. Pererea','veh_registration_no'=>'WP-CAA-1256','mobile_no'=>'0789966321'
						),
						'documents' => array(
							'Vehicle Registration Book','Proforma Invoice','No Claim Bonus (NCB) Letter'
						),
				),
			'attached_url'      => array('http://inme.lk/TEST_SERVER/mas/assets/covernotes/20170524002010002_20170524.pdf', 'http://test.insureme.lk/mas/assets/covernotes/20170531002010001_20170531.pdf'),
			);

		$email_template      = $input_array['email_template'];
		$email_template_list = $this->email_management_model->get_email_fun_list($email_template)[0];

		$this->load->library('covernote_insurance');
		$email_body = $this->covernote_insurance->generate_covernote_success_html($input_array['email_data']);

		$data['message_header'] = $email_template_list['email_header'];
		$data['message_body'] 	= $email_body;
		$data['message_footer'] = $email_template_list['email_footer'];
		$html_view 	= $this->load->view('email_templates/covernote_template',$data, true);

		echo $this->common_lib->send_email($input_array['primary_email'], $input_array['cc_email'], $input_array['bcc_email'], $email_template_list['email_subject'], $html_view, $input_array['attached_url']);

	}

}

/* End of file Email_management.php */
/* Location: ./application/controllers/Email_management.php */