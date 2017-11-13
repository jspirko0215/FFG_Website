<?php
if(!defined('BASEPATH'))
    exit('Нет доступа к скрипту');

class Cron extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
        $this->template->set_template('main');
        $this->fb_app = $this->fb_ignited->fb_get_app();

    }
        function cronstats()
    {
        $this->load->model('gym_model');
        $this->load->model('member_model');

        $gyms = $this->gym_model->getGymVisitsRecords();
        $teams = $this->member_model->getTeamVisitsRecords();
		$teamsCompetition = $this->member_model->getTeamCompetitionVisitsRecords();
        $members = $this->member_model->getMemberVisitsStatRecords();
        
        $period=1;
        /*-------------------------------------------*/
        if(!$gyms)
            $this->gym_model->fillGymVisits();
        else
            $this->gym_model->fillGymVisits($period);
        /*-------------------------------------------*/
        if(!$teams)
            $this->member_model->fillTeamVisits();
        else
            $this->member_model->fillTeamVisits($period);
		/*-------------------------------------------*/
		if(!$teamsCompetition)
            $this->member_model->fillTeamCompetitionVisits();
        else
            $this->member_model->fillTeamCompetitionVisits($period);
        /*-------------------------------------------*/
        if(!$members)
            $this->member_model->fillMemberVisitsStat();
        else
            $this->member_model->fillMemberVisitsStat($period);
    }
    
}
?>
