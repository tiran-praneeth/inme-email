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
		global $server;
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
			'primary_email'	  => 'xsd:Array',
			'cc_email'        => 'xsd:Array',
			'bcc_email'       => 'xsd:Array',
			'email_data'      => 'xsd:Array',
			'attached_url'    => 'xsd:Array',
		);
		$response = array
		(
			'email_status' => 'xsd:Array'
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

		/**
		 * Insert into instant email queue
		 * 
		 * @param  array $input_array 
		 * @return array               
		 */
		function instant_email_queue($input_array)
		{
			global $server;
        	$api_key = $server->requestHeader['authCredentials']['api_key'];
        	$input_validation = $GLOBALS['this']->common_lib->instant_email_validation($input_array);

        	if (!empty($api_key) && $input_validation) {
    			$auth_status = $GLOBALS['this']->common_lib->authentication($api_key, $input_array);

    			if ($auth_status) {
    				$insert_email = $GLOBALS['this']->email_management_model->insert_instant_email_queue($input_array);

    				if ($insert_email) {
    					return array('success' => 'Email queued successfully');
    				} else {
    					return array('error' => 'Email queued fail');
    				}
    			} else {
    				return array('error' => 'Authentication fail');
    			}
        	} else {
        		return array('error' => 'Authentication fail');
        	}
		}

		$server->service(file_get_contents("php://input"));
	}


}

/* End of file Email_management.php */
/* Location: ./application/controllers/Email_management.php */