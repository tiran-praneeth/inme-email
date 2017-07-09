<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_inquiry_customer
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
        $this->CIM->load->library('utilities');
	}

	/**
	 * This funtion use to generate new inquiry html template for broker
	 * 
	 * @param  array $data_array 
	 * @return string             
	 */
	public function generate_New_inquiry_html($data_array)
	{

		$html_view  = $this->section_head_html(); // success covernote section 1

		$final_html_view = $this->CIM->utilities->string_replace($data_array['inquiry'], $html_view);

		return $final_html_view;
	}

	/**
	 * booking quotation section - quotation details
	 * 
	 * @return string 
	 */
	private function section_head_html()
	{
		return 'Dear Sir/Madam,
				<br><br>
				<p>Thank you for your inquiry. We will respond as soon as possible generally within a few hours. If you do not hear from us within 48 hours, kindly give us a call at 0769069000 as your message did not get to us.</p>
				<br>';
	}

	/**
	 * booking quotation section end
	 * 
	 * @return string 
	 */
	private function section_end_html()
	{
		return '<p>Thank you very much for providing information. Team InsureMe will be in touch with you shortly.</p>';
	}

	

}

/* End of file New_inquiry_customer.php */
/* Location: ./application/libraries/templates/New_inquiry_customer.php */
