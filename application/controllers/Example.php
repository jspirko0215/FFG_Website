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
        $this->load->model('global_model');
        $res2 = $this->global_model->getGlobalStats();

        $i = 0;
        $arr1 = array();
        $arr1['stats'] = array();
        foreach ($res2 as $result) {
            if (!$arr1['stats']) {
                $arr1['stats'][] = array((int)strtotime($result['visitDate'] . ' -1 day') * 1000, 0);
                $arr1['lightsCumulative'][] = array((int)strtotime($result['visitDate'] . ' -1 day') * 1000, 0);
                $arr1['membersCumulative'][] = array((int)strtotime($result['visitDate'] . ' -1 day') * 1000, 0);
                $arr1['charityCumulative'][] = array((int)strtotime($result['visitDate'] . ' -1 day') * 1000, 0);
            }
            $i++;
            $arr1['lightsCumulative'][] = array((int)strtotime($result['visitDate']) * 1000, ((float)($result['wattHours'] / 200000 + $arr1['lightsCumulative'][$i - 1][1])));
            $arr1['membersCumulative'][] = array((int)strtotime($result['visitDate']) * 1000, ((int)($result['memberCount'] + $arr1['membersCumulative'][$i - 1][1])));
            $arr1['charityCumulative'][] = array((int)strtotime($result['visitDate']) * 1000, ((int)($result['dailyDonation'] + $arr1['charityCumulative'][$i - 1][1])));
        }
        //print_r(array_values($arr1['wattsCumulative']));
        //echo "<br/>";
        //echo "<br/>";

        $data['wattsCumulative'] = json_encode($arr1['wattsCumulative']);
        $data['membersCumulative'] = json_encode($arr1['membersCumulative']);
        $data['charityCumulative'] = json_encode($arr1['charityCumulative']);

        $_SESSION['current'] = 'About';
        $this->parser->parse('themes/page_tpl/about', $data);

    }

    public function contactus()
    {
        $_SESSION['current'] = 'Contact';

        $this->load->helper(array('form'));
        $this->load->library(array('form_validation', 'email'));

        $this->form_validation->set_rules('name', 'Name', "trim|required");
        $this->form_validation->set_rules('message', 'Message', "trim|required");
        $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email");

        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_message('required', '%s field is required');
        $this->form_validation->set_message('valid_email', 'Please provide a valid e-mail');

        $data = array(
            'name' => '',
            'email' => '',
            'message' => '',
            'errors' => ''
        );

        if ($this->form_validation->run() == TRUE) {
            $options["name"] = $this->input->post("name");
            $options["email"] = $this->input->post("email");
            $options["message"] = $this->input->post("message");

            $this->send($options);
            $data['success'] = true;
        } else {
            $data['errors'] = validation_errors();
        }


        $this->parser->parse('themes/page_tpl/contactus', $data);

    }


    public function send($options)
    {

        if(empty($options) ) return false;

        $this->load->library('email');

        $config['protocol'] = 'smtp';

        $config['smtp_host'] = 'ssl://smtpout.secureserver.net';

        $config['smtp_port'] = '465';

        $config['smtp_timeout'] = '7';

        $config['smtp_user'] = 'jspirko@fitforgreen.com';

        $config['smtp_pass'] = '5p1rk0';

        $config['charset'] = 'utf-8';

        $config['newline'] = "\r\n";

        $config['mailtype'] = 'html'; // or html

        $config['validation'] = TRUE; // bool whether to validate email or not

        $this->email->initialize($config);

        $message = $this->load->view('/promo/mail_tpl.php', $options, TRUE);
        $this->email->from($options['email'], 'Fit for Green Website Inquiry');
        $this->email->to('support@fitforgreen.com');
        $this->email->subject('Website Comments');
        $this->email->message($message);
        $this->email->send();

        $this->email->send();

        echo $this->email;

    }
}
