<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function __construct() {
        parent::__construct();


    }

    public function test()
    {
        $this->load->model('global_model','',TRUE);
        $this->global_model->addDummyStats();
    }

    public function get_global_stats()
    {
        $this->load->model('global_model','',TRUE);
         $res=$this->global_model->getPromoCounters();
         echo $this->load->view('ajax/global_stats_template.php', $res, TRUE);
    }


    public function index()
    {
         echo "ajax";
    }

    public function sync_widgets()
    {
        $user_id = $this->session->userdata('logOn');
        $this->load->model('member_model','',TRUE);
        //set
        if(isset($_POST['data']))
        {
            $this->member_model->setWidgets($user_id,$_POST['data']);
        }
        //get
        else
        {
            $res=$this->member_model->getWidgets($user_id);
            echo $res;
        }
    }
    
    public function counters()
    {
        $this->load->model('global_model');
        $res=$this->global_model->getPromoCounters();

        echo json_encode($res);
        
    }
    
    public function go()
    {
        $this->load->model('member_model');
        $res=$this->member_model->getMemberTeams(87);
header('Content-Type: application/json, charset=utf-8');
        echo json_encode($res);
        
    }
    public function assign_fb()
    {
        $this->load->model('member_model');
        $data['memberId']=$this->input->post('memberId');
        $data['facebook_id']=$this->input->post('facebook_id');
        $data['facebook_login']=$this->input->post('facebook_login');
        $data['facebook_token']=$this->input->post('facebook_token');
        $res=$this->member_model->assign_fb_profile($data);
        echo json_encode($res);
        
    }
    public function unassign_fb()
    {
        $this->load->model('member_model');
        $data['memberId']=$this->input->post('memberId');
        $res=$this->member_model->unassign_fb_profile($data['memberId']);
        echo json_encode($res);
    }
    public function check_fb_user()
    {
        $this->load->model('member_model');
        
        $facebookId=$this->input->post('facebook_id');
        $res=$this->member_model->isfbProfileAlready($facebookId);
        
        echo json_encode($res);
    }
    
}
