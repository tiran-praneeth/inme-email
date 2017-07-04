<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_lib
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
        $this->CIM->load->library('utilities');
        $this->load->model('email_management_model');
	}


	public function authentication($api_key, $input_array)
	{
        $auth_status = $this->email_management_model->app_authentication($api_key, $input_array['app_code']);
        return $auth_status;
	}

    /**
     * This function use to check whether instant email inputs are well formatted.
     * 
     * @param  array $input_array 
     * @return boolean              
     */
	public function instant_email_validation($input_array)
	{
		$is_array_formatted = $this->CIM->utilities->array_keys_exist($input_array, 'app_code','email_template', 'primary_email', 'cc_email','bcc_email', 'email_data', 'attached_url');
        return $is_array_formatted;
	}

	/**
     * This funtion use to send emails
     * 
     * @param  mixed  $primary_emails primary email/s
     * @param  mixed  $cc_emails      cc email/s
     * @param  mixed  $bcc_emails     bcc email/s
     * @param  string $subject        email subject
     * @param  string $message        email body
     * @param  mixed  $attach_url     emails attachment/s
     * @return mixed                  
     */
    public function send_email($primary_emails, $cc_emails = null, $bcc_emails = null, $subject, $message, $attach_url = null)
    {
        $this->CIM->load->library('email'); // load email library
        $this->CIM->email->clear(true);

        $this->CIM->email->from('info@insureme.lk', 'insureme.lk');
        $this->CIM->email->to($primary_emails);

        if (!empty($cc_emails)) {
            $this->CIM->email->cc($cc_emails);
        }

        if (!empty($bcc_emails)) {
            $this->CIM->email->bcc($bcc_emails);
        }

        $this->CIM->email->subject($subject);
        $this->CIM->email->message($message);

        if (!empty($attach_url)) {
            foreach ($attach_url as $value) {
                $this->CIM->email->attach($value);
            }
        }
        
        if ($this->CIM->email->send()) {
            return 1;
        } else {
            return (ENVIRONMENT === 'production') ? 0 : show_error($this->CIM->email->print_debugger()); // Email debugger option 
        }
    }

}

/* End of file Common_lib.php */
/* Location: ./application/libraries/Common_lib.php */
