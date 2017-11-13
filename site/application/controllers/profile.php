<?php

if (!defined('BASEPATH'))
    exit('Нет доступа к скрипту');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('main');
    }

    public function index($username)
    {
        redirect('members/dashboard');
    }

    public function info($username)
    {
        $this->acl();
        if ($username)
        {
            $this->load->model('member_model');
            $user = $this->member_model->getMemberByName($username);
            if ($user)
            {
                $this->load->library('widget');

               // $data['widget_1'] = $this->widget->getWidgetLastVisitsGraph('', $user['memberID']);
                //$data['widget_2'] = $this->widget->getWidgetLastVisits('', $user['memberID']);
                $data['widget_1'] = $this->widget->getWidgetGlobalStats($user['memberID'],'widget nodrag');
                $data['widget_2'] = $this->widget->getWidgetBurgers('',$user['memberID'],true);
                $data['widget_3'] = $this->widget->getWidgetBulbs('',$user['memberID'],true);
                $data['user'] = $user;
               // die(print_r($data['user']));
                $this->template->write_view('content', 'profile.php', $data);
                $this->template->render();
            }
            else
                redirect('members/dashboard');
        }
        else 
            redirect('members/dashboard');
    }

    private function acl()
    {
        if (!$this->session->userdata('logOn'))
        {
            redirect('/members/login');
            exit;
        }
    }

}