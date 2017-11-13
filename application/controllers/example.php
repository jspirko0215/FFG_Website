<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('global_model');
        $res=$this->global_model->getPromoCounters();
        $this->config->set_item('counters',$res);
		$this->load->helper('url');

		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('template');

		$this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');
	}


	public function index()
	{
		echo "<br>";
        echo "<br>";
        $this->load->view('promo/content');
	}

    public function home()
    {
        echo "<br>";
        echo "<br>";
        $this->load->view('themes/page_tpl/home');
    }

    public function team()
    {
        echo "<br>";
        echo "<br>";
        $this->load->view('themes/page_tpl/team');
    }

    public function contactus()
    {
        echo "<br>";
        echo "<br>";
        $this->load->view('themes/contactus');
    }

    public function send($options)
    {


        if(empty($options) ) return false;
        $this->load->library(array('email'));
        $config = array(
            'protocol' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'newline' => "\r\n"
        );

        $this->email->initialize($config);
        $message = $this->load->view('/promo/mail_tpl.php', $options, TRUE);
        $this->email->from($options['email'], 'New Comments');
        $this->email->to('support@fitforgreen.com');
        $this->email->cc('support@fitforgreen.com');
        $this->email->subject('New Comments');
        $this->email->message($message);
        $this->email->send();
        // echo $this->email->print_debugger();
    }

    public function example_1()
    {
        $this->load->view('ci_simplicity/example_1');
        //echo site_url('pages/view/home');
    }

	public function example_2()
	{
		$this->output->set_template('simple');
		$this->load->view('ci_simplicity/example_2');
	}

	public function example_3()
	{
		$this->load->section('sidebar', 'ci_simplicity/sidebar');
		$this->load->view('ci_simplicity/example_3');
	}

	public function example_4()
	{
		//$this->output->unset_template();
		$this->load->view('ci_simplicity/example_4');
	}
}
