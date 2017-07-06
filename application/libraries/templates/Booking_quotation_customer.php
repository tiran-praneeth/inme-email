<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_quotation_customer
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
        $this->CIM->load->library('utilities');
	}

	/**
	 * This funtion use to generate booking quotation html template for broker
	 * 
	 * @param  array $data_array 
	 * @return string             
	 */
	public function generate_Booking_quotation_html($data_array)
	{

		$html_view  = $this->section_head_html(); // success covernote section 1
		$html_view .= $this->section_end_html(); // success covernote section 2

		$final_html_view = $this->CIM->utilities->string_replace($data_array['quotation'], $html_view);

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
				<p>
					<b>Your Request Number - req_key</b>
				</p>
				<p>
					<b>Your Quotation Number - qot_number</b>
				</p>';
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

/* End of file Booking_quotation_customer.php */
/* Location: ./application/libraries/templates/Booking_quotation_customer.php */
