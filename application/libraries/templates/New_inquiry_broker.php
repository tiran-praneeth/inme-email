<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_inquiry_broker
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
	 * booking quotation section - personal details and premium details
	 * 
	 * @return string 
	 */
	private function section_head_html()
	{
		return 'Dear Sir/Madam,
				<br><br>
				<p>
					<b>Customer Name - cx_name</b>
				</p>
				<p>
					<b>Customer Email Address - cx_email</b>
				</p>
				<p>
					<b>Customer Mobile Number - cx_mobile</b>
				</p>
				<p>
					<b>Insurance Type - insurance_type</b>
				</p>
				<p>
					<b>Customer Message - cx_message</b>
				</p>';
	}

}

/* End of file New_inquiry_broker.php */
/* Location: ./application/libraries/templates/New_inquiry_broker.php */
