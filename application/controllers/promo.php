<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->helper('url');
        //$this->_init();
        $this->output->set_template('promo');
        $this->load->model('global_model');
        $res=$this->global_model->getPromoCounters();
        $this->config->set_item('counters',$res);
    }

    public function render($options)
    {
        $this->template->write_view('header', '/promo/header.php', array('menu' => $this->load->view('/promo/menu.php', $options['menu'], TRUE)));
        //$this->template->write_view('menu',    '/promo/menu.php', $options['menu'] );
        //$this->template->write_view('slider',  '/promo/slider.php', $options['slider'] );
        $this->template->write_view('content', '/promo/content.php', $options['data']);
        $this->template->write_view('footer', '/promo/footer.php', $options['footer']);
        $this->template->render();

    }

    public function land()
    {
        /*
        $this->template->write_view('content', '/promo/content.php',
                array('content' => $this->load->view('/promo/page_tpl/home1.php',
                array('slider' => $this->load->view('/promo/slider.php', '',true),
                    'menu' => $this->load->view('/promo/menu.php', array('k'=> 1),true)), TRUE)));
        */
        //$this->template->write_view('header',  '/promo/header.php', array('menu' => $this->load->view('/promo/menu.php', array('k'=> 1), TRUE)));

        $this->template->write_view('content', '/promo/content.php',
            array('content' => $this->load->view('/promo/page_tpl/land.php',
                array('header' => $this->load->view('/promo/header.php', array('menu' => $this->load->view('/promo/menu.php', array('k' => 1), TRUE)), true),
                    'slider' => $this->load->view('/promo/slider.php', '',true)), TRUE)));

        $this->template->render();
    }

    public function index(){
        $this->output->set_template('content', '/promo/content.php',
            array('content' => $this->load->view('/promo/page_tpl/land.php',
                array('header' => $this->load->view('/promo/header.php',
                    array('menu' => $this->load->view('/promo/menu.php',
                        array('k' => 1), TRUE)), true),
                    'slider' => $this->load->view('/promo/slider.php', '',true)), TRUE)));

        // $this->output->set_template->render();
        //$this->load->view('ci_simplicity/welcome');


    }
    /*
    public function cases(){

        $options =array(
        //'header' => array('header'  => null),
        'menu'  => array('k'=> 2),
        //'slider'=>null,
        'data'  => array('content' =>  $this->load->view('/promo/page_tpl/causes.php', null, TRUE) ),
        'footer'=> array('footer'  => null)
       );



         $this->render($options);

    }
    */
    public function team()
    {

        $options = array(
            //'header' => array('header'  => null),
            'menu' => array('k' => 5),
            //null,
            'data' => array('content' => $this->load->view('/promo/page_tpl/team.php', null, TRUE)),
            'footer' => array('footer' => null)
        );

        $this->render($options);

    }


    public function coming_soon()
    {
        $options = array(
            //'header' => array('header'  => null),
            'menu' => array('k' => 0),
            // 'slider'=>array('heading_title'=>'Coming Soon', 'heading_text'=>''),
            'data' => array('content' => $this->load->view('/promo/page_tpl/coming_soon.php', null, TRUE)),
            'footer' => array('footer' => null)
        );

        $this->render($options);

    }

    public function contactus()
    {
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation', 'email'));


        $this->form_validation->set_rules('name','Name', "trim|required");
        $this->form_validation->set_rules('message', 'Message', "trim|required");
        $this->form_validation->set_rules('email',     'Email', "trim|required|valid_email");

        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_message('required', '%s field is required');
        $this->form_validation->set_message('valid_email', 'Please provide a valid e-mail');

        $data = array(
            'name'    =>'',
            'email'         =>'',
            'message'     =>'',
            'errors'        =>''
        );

        if ($this->form_validation->run() == TRUE) {
            $options["name"] = $this->input->post("name");
            $options["email"] = $this->input->post("email");
            $options["message"] = $this->input->post("message");

            //$this->send($options);
            $data['success'] = true;
        }
        else {
            $data['errors'] = validation_errors();
        }

        $options = array(
            //'header' => array('header'  => null),
            'menu' => array('k' => 6),
            //'slider'=>array('heading_title'=>'Contact Us', 'heading_text'=>''),
            'data' => array('content' => $this->load->view('/promo/contactus.php', $data, TRUE)),
            'footer' => array('footer' => null)
        );


        $this->render($options);


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

    public function energy()
    {

        $this->load->model('member_model');
        $res = $this->member_model->getGymDayVisits(null, '2012-01-06 00:00:00');
        $arr=array();
        $arr['watts']=array();
        $i=0;
        foreach($res as $x)
        {
            if(!$arr['watts'])
            {
                $arr['watts'][] = array((int) strtotime($x['visitDate'].' -1 day')*1000, 0);
                $arr['wattsComulative'][] = array((int) strtotime($x['visitDate'].' -1 day')*1000, 0);
            }
            $i++;
            $arr['watts'][] = array((int) strtotime($x['visitDate'])*1000, (float) $x['wattHours']);
            $arr['wattsComulative'][] = array((int) strtotime($x['visitDate'])*1000, ((float) ($x['wattHours'] + $arr['wattsComulative'][$i - 1][1])));
        }
        $data['watts']=json_encode($arr['watts']);
        $data['wattsComulative']=json_encode($arr['wattsComulative']);

        $options = array(
            //'header' => array('header'  => null),
            'menu' => array('k' => 2),
            //'slider'=>array('heading_title'=>'Renewable Energy', 'heading_text'=>''),
            'data' => array('content' => $this->load->view('/promo/page_tpl/energy.php', $data, TRUE)),
            'footer' => array('footer' => null)
        );

        $this->render($options);

    }

    public function social()
    {
        $this->load->model('gym_model');
        $data = array();

        $res=$this->gym_model->getGymsMapCoords();
        foreach($res as $key=>$value){
            $data['p'][''.$value['mapPosition'].'']='<a href="/promo/gym?id='.$value['gymID'].'&iframe=true&width=700&height=400" class="pflink" rel="prettyPhoto">&nbsp;</a>';
        }
        $options = array(
            //'header' => array('header'  => null),
            'menu' => array('k' => 3),
            // 'slider'=>array('heading_title'=>'Social Media', 'heading_text'=>''),
            'data' => array('content' => $this->load->view('/promo/page_tpl/social.php', $data, TRUE)),
            'footer' => array('footer' => null)
        );
        //die(print_r($data));
        $this->render($options);

    }

    public function competition()
    {

        $options = array(
            //'header' => array('footer'  => null),
            'menu' => array('k' => 4),
            //'slider'=>array('heading_title'=>'Friendly Competition', 'heading_text'=>''),
            'data' => array('content' => $this->load->view('/promo/page_tpl/competition.php', null, TRUE)),
            'footer' => array('footer' => null)
        );

        $this->render($options);

    }

    public function gym()
    {
        $this->load->model('member_model');
        $this->load->model('gym_model');

        $gymID=(int)$this->input->get('id');
        $res = $this->member_model->getGymDayVisits($gymID, '2012-01-06 00:00:00');

        $arr=array();
        $arr['watts']=array();
        foreach($res as $x)
        {
            $arr['watts'][] = array((int) strtotime($x['visitDate'])*1000, (float) $x['wattHours']);
        }
        $data['watts']=json_encode($arr['watts']);
        $res=$this->gym_model->getGymAddress($gymID);
        $data['gymName']=$res->gymName;
        $data['gymAddress']=$res->fullBillingAddress.', '.$res->city.', '.$res->state;
        $this->load->view('/promo/page_tpl/gym.php',$data);
    }

    public function prereg()
    {
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation', 'email'));

        $this->form_validation->set_rules('name','Name', "trim|required");
        $this->form_validation->set_rules('email',     'Email', "trim|required|valid_email");

        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_message('required', '%s field is required');
        $this->form_validation->set_message('valid_email', 'Please provide a valid e-mail');

        $data = array(
            'name'    =>'',
            'email'         =>'',
            'errors'        =>''
        );

        if ($this->form_validation->run() == TRUE) {
            $options["name"] = $this->input->post("name");
            $options["email"] = $this->input->post("email");

            $this->sendPreg($options);
            $data['success'] = true;
        }
        else {
            $data['errors'] = validation_errors();
        }

        $options = array(
            'menu' => array('k' => 7),
            'data' => array('content' => $this->load->view('/promo/prereg.php', $data, TRUE)),
            'footer' => array('footer' => null)
        );

        $this->render($options);
    }


    public function sendPreg($options)
    {
        if(empty($options)) return false;
        $this->load->library(array('email'));
        $config = array(
            'protocol' => 'html',
            'charset' => 'UTF-8',
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'newline' => "\r\n"
        );

        $this->email->initialize($config);
        $this->email->from($options['email'], 'New Desirous');
        $this->email->to('support@fitforgreen.com');
        $this->email->cc('support@fitforgreen.com');
        $this->email->subject('New Desirous');
        $this->email->message("<span>".$options['name'].": ".$options['email']."</span>");
        $this->email->send();

        $this->load->model('global_model');
        $this->global_model->fillDesirous($options);
        // echo $this->email->print_debugger();
    }

    public function presentation()
    {
        $this->load->helper('download');
        $data = file_get_contents("./uploads/ffg-solutions.pdf"); // Read the file's contents
        $name = 'Fit for Green In-gym Solutions.pdf';
        force_download($name, $data);
    }

}

?>
