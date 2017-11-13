<?php

class Stats_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getTopMembers($lastMonth = null)
    {
		$date=date('Y-m-d');
        $this->db->select('m.memberID, m.username, sum(wattHours) as wattHours', false)
                ->from('memberVisitsStat mvs')
                ->join('members m', 'm.memberID=mvs.memberID', 'inner')
                ->where('m.memberID != ', 6)
                ->group_by('m.memberID')
                ->order_by('wattHours', 'desc')
                ->limit(5);
        if ($lastMonth)
            $this->db->where('mvs.visitDate>=date_sub("'.$date.'",interval 30 day)');
        $res = $this->db->get()->result_array();
        return $res;
    }

    function getTopGymMembers($gymId,$lastMonth = null)
    {
		$date=date('Y-m-d');
        $this->db->select('m.memberID, m.username, sum(wattHours) as wattHours', false)
                ->from('memberVisitsStat mvs')
                ->join('members m', 'm.memberID=mvs.memberID', 'inner')
                ->where('m.memberID != ', 6)
                ->where('mvs.gymID', $gymId)
                ->group_by('m.memberID')
                ->order_by('wattHours', 'desc')
                ->limit(5);
        if ($lastMonth)
            $this->db->where('mvs.visitDate>=date_sub("'.$date.'",interval 30 day)');
        $res = $this->db->get()->result_array();
        return $res;
    }

    function getTopGyms($lastMonth = null)
    {
		$date=date('Y-m-d');
        $this->db->select('g.gymID, g.gymName, sum(wattHours) as wattHours', false)
                ->from('gymVisits gv')
                ->join('gyms g', 'g.gymID=gv.gymID')
                //->where('mv.memberID != ', 6)
                ->group_by('gv.gymID')
                ->order_by('wattHours', 'desc')
                ->limit(5);
        if ($lastMonth)
            $this->db->where('gv.visitDate>=date_sub("'.$date.'",interval 30 day)');
        $res = $this->db->get()->result_array();
        
        return $res;
    }

    function getTopTeams($lastMonth = null)
    {
		$date=date('Y-m-d');
        $this->db->select('t.teamID, t.teamName,sum(wattHours) as wattHours', false)
                ->from('teamVisits tv')
                ->join('teams t', 't.teamID=tv.teamID', 'inner')
                ->group_by('t.teamID')
                ->order_by('wattHours', 'desc')
                ->limit(5);
        if ($lastMonth)
            $this->db->where('tv.visitDate>=date_sub("'.$date.'",interval 30 day)');
        $res = $this->db->get()->result_array();
        return $res;
    }

}

?>
