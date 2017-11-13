<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct() {
        parent::__construct();
     
        
    }

    public function get_global_stats()
    {
         $this->template->render();
    }

    
    public function index()
    {
         $this->template->render();
    }
}
