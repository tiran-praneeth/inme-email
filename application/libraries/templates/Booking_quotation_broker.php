<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_quotation_broker
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
		$html_view .= $this->vehicle_details_section(); // success covernote section 2

		$final_html_view = $this->CIM->utilities->string_replace($data_array['quotation'], $html_view);

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
					<b>Customer Name - cust_name</b>
				</p>
				<p>
					<b>Customer Email Address - cust_email</b>
				</p>
				<p>
					<b>Customer Mobile Number - cust_mobile</b>
				</p>
				<p>
					<b>Request Number - req_key</b>
				</p>
				<p>
					<b>Quotation Number - qot_number</b>
				</p>
				<p>
					<b>Selected Insurance Company - insurance_comp</b>
				</p>
				<p>
					<b>Total Premium - total_premium</b>
				</p>';
	}

	/**
	 * booking quotation section - vehicle details
	 * 
	 * @return string 
	 */
	private function vehicle_details_section()
	{
		return '<br />
				<hr />
				<p>Vehicle Type - vehicle_type</p>
				<p>Estimated Market Value - sum_insured</p>
				<p>Usage - purpose_of_use</p>
				<p>Fuel Type - fuel_type</p>
				<p>Make - vehicle_make</p>
				<p>Model - vehicle_model</p>
				<p>Year of Manufacture - manufacture_year</p>
				<p>Registration Status - is_registered</p>
				<p>Hire Purchase - higher_purchase</p>
				<p>Earned NCB Years - ncb</p>';
	}

}

/* End of file Booking_quotation_broker.php */
/* Location: ./application/libraries/templates/Booking_quotation_broker.php */
