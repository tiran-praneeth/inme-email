<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server_time_model extends CI_Model {

	/* 
     * Timezone change
     */
    function __construct()
    {
        parent::__construct();
        $this->db->query("SET time_zone='+5:30'");
    }

}

/* End of file Server_time_model.php */
/* Location: ./application/models/Server_time_model.php */