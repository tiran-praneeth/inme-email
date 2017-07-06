<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Covernote_customer
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
        $this->CIM->load->library('utilities');
	}

	/**
	 * This funtion use to generate success covernote html template for customer
	 * 
	 * @param  array $data_array 
	 * @return string             
	 */
	public function generate_covernote_success_html($data_array)
	{
		$html_view 	= $this->section_head_html(); // success covernote section 1
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
	private function section_head_html()
	{
		return 'Dear Sir/Madam,
				<br><br>
				<p>We thank you for using insureme.lk.</p>
				<p>A type_of_cover insurance cover note for your vehicle veh_registration_no has been issued under insurence_company is attached herewith.</p>
				<br>
				<p>Please submit the following documents to obtain the full insurance policy.</p>';
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

/* End of file Covernote_customer.php */
/* Location: ./application/libraries/templates/Covernote_customer.php */
