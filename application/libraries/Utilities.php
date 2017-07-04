<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities
{
	protected $CIM;

	public function __construct()
	{
        $this->CIM =& get_instance();
	}

    /**
     * This Function use to display an array in a readable format. 
     * And this print data array withing <pre> tags.
     * 
     * @param  array $arr 
     * @return void
     */
    public function print_r_pre($arr)
    {
       echo '<pre>';
       print_r($arr);
       echo '</pre>';   
    }

    /**
     * This Function use to replace text by string array
     * 
     * @param  array  $arr_string 
     * @param  string $text       
     * @return string             
     */
	public function string_replace($arr_string, $text) 
    {
        foreach($arr_string as $key => $value) {
            $text = str_replace($key, $value, $text);
        }
        return $text;
    }

    /**
     * This function check if multiple array keys exist
     * 
     * @param  array  $array 
     * @param  Mixed  $keys  
     * @return boolean       
     */
    public function array_keys_exist(array $array, $keys)
    {
        $count = 0;
        if (!is_array($keys)) {
            $keys = func_get_args();
            array_shift($keys);
        }
        foreach ($keys as $key) {
            if (array_key_exists($key, $array)) {
                $count ++;
            }
        }
        return count($keys) === $count;
    }
    

}

/* End of file Utilities.php */
/* Location: ./application/libraries/Utilities.php */
