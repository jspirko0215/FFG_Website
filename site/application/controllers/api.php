<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{

    private $writer;
    private $data;

    public function __construct()
    {
        $this->writer = new XMLWriter();
        $this->writer->openMemory();
        parent::__construct();
    }

    public function index()
    {
        echo 'Api';
    }

    public function auth()
    {
        $this->load->library('fit_api');
        $this->fit_api->auth();
    }

    public function register()
    {
        $this->load->library('fit_api');
        $this->fit_api->addMember();
    }

    public function get_active_gyms()
    {
        $this->load->library('fit_api');
        $this->fit_api->getActiveGyms();
    }

    public function get_gym_stats()
    {
        $this->load->library('fit_api');
        $this->fit_api->getGymStats();
    }

    public function get_count_members()
    {
        //system('echo "'. 'ccc' . "\n" . '" > test.txt' );
        $this->load->library('fit_api');
        $this->fit_api->getCountMembers();
    }
    
    public function get_leaderboard()
    {
        $this->load->library('fit_api');
        $this->fit_api->getLeaderboard();
    }

}