<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller {

	function __construct()
	{

        parent::__construct();
        $this->load->helper('language');
        $this->load->helper('url');
        $this->_init();
        //$this->template->set_template('promo');
        $this->load->model('global_model');
        $res=$this->global_model->getPromoCounters();
        $this->config->set_item('counters',$res);
	}

	private function _init()
	{
        $this->output->set_template('new_site_template');
		$this->load->js('assets/themes/default/js/jquery-1.9.1.min.js');
        $this->load->js('assets/themes/default/hero_files/bootstrap-transition.js');
		$this->load->js('assets/themes/default/hero_files/bootstrap-collapse.js');
	}


	public function index()
	{
        $_SESSION['current'] = 'Home';
        $this->output->set_template('new_site_template');
        $this->load->view('/themes/content',
            array('content' => $this->load->view('themes/page_tpl/land.php',
                ['slider' => $this->load->view('themes/page_tpl/slider.php', '', true)], TRUE)));

	}

    public function home()
    {
        $_SESSION['current'] = 'Home';
        $this->load->view('themes/page_tpl/home');
    }

    public function products()
    {
        $_SESSION['current'] = 'Products';
        $this->load->view('themes/page_tpl/products');
    }

    public function team()
    {
        $_SESSION['current'] = 'Team';
        $this->load->view('themes/page_tpl/team');
    }

    public function about()
    {
        $this->load->model('member_model');
        $res = $this->member_model->getGymDayVisits(null, '2012-01-06 00:00:00');
        $arr = array();
        $arr['watts'] = array();
        $i = 0;
        foreach ($res as $x) {
            if (!$arr['watts']) {
                $arr['watts'][] = array((int)strtotime($x['visitDate'] . ' -1 day') * 1000, 0);
                $arr['wattsComulative'][] = array((int)strtotime($x['visitDate'] . ' -1 day') * 1000, 0);
            }
            $i++;
            $arr['watts'][] = array((int)strtotime($x['visitDate']) * 1000, (float)$x['wattHours']);
            $arr['wattsComulative'][] = array((int)strtotime($x['visitDate']) * 1000, ((float)($x['wattHours'] + $arr['wattsComulative'][$i - 1][1])));
        }
        $data['watts'] = json_encode($arr['watts']);
        $data['wattsComulative'] = json_encode($arr['wattsComulative']);
        $_SESSION['current'] = 'About';
        $this->parser->parse('themes/page_tpl/about', $data);
    }

    public function contactus()
    {
        $_SESSION['current'] = 'Contact';
        $this->load->view('themes/page_tpl/contactus');
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
}
