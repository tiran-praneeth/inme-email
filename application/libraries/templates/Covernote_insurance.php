<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Covernote_insurance
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
 		$this->CIM->load->library('utilities');
	}

	/**
	 * This funtion use to generate success covernote html template for insurance company
	 * 
	 * @param  array $data_array 
	 * @return string             
	 */
	public function generate_covernote_success_html($data_array)
	{
		$html_view 	= $this->vehi_details_html(); // success covernote section 1
		$html_view .= $this->policy_docs_list_html($data_array['documents']); // success covernote section 2
		$html_view .= $this->section_end_html(); // success covernote section 3

		$final_html_view = $this->CIM->utilities->string_replace($data_array['covernote'], $html_view);

		return $final_html_view;
	}

	/**
	 * success covernote section - personal details and vehicle details
	 * 
	 * @return string 
	 */
	private function vehi_details_html()
	{
		return 'Dear Sir/Madam,
				<br><br>
				<p>We have issued a type_of_cover insurance cover note for the following vehicle and the details are as below</p>
				<br>
				Customer Name : title name_initials
				<br>
				Vehicle No    : veh_registration_no
				<br>
				Customer Mobile No    : mobile_no
				<br><br>
				<p>We will submit the following documents to obtain the final policy</p>';
	}

	/**
	 * success covernote section - Required document list
	 * 
	 * @return string
	 */
	private function policy_docs_list_html($documents)
	{
		$document_list = '<ol>';

		foreach ($documents as $value) {
			$document_list .= '<li>'.$value.'</li>';
		}

		$document_list .= '</ol>';

		return $document_list;
	}

	/**
	 * success covernote section end
	 * 
	 * @return string 
	 */
	private function section_end_html()
	{
		return '<br><br>
				<p>For more details please contact team insureme 0769069000</p>
				</div>';
	}

}

/* End of file Covernote_insurance.php */
/* Location: ./application/libraries/templates/covernote/Covernote_insurance.php */
