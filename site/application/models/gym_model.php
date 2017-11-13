<?php

class Gym_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function getGym($id, $key=NULL)
    {
        $result = $this->db->get_where('gyms', array('gymID' => $id, 'authKey' => $key))->row_array();
        return $result;
    }

    function getActiveGyms()
    {
        $this->db->select('g.*');
        $this->db->from('gyms g');
        $this->db->join('members m', 'm.gymId=g.gymID', 'left');
        $this->db->group_by('g.gymID');
        $this->db->having('max(m.isactive)=1');
        $res = $this->db->get()->result_array();
        foreach ($res as &$x)
        {
            $x['entityName'] = 'gym';
        }
        return $res;
    }

    function getAllGyms()
    {
        $this->db->select('*');
        $this->db->from('gyms');
        $res = $this->db->get()->result_array();
        foreach ($res as &$x)
        {
            $x['entityName'] = 'gym';
        }
        return $res;
    }

    function getGymStats()
    {
        $this->db->select('*');
        $this->db->from('gymVisitsCumulative');
        $this->db->limit((60 / 5) * 24);
        $this->db->order_by('startTime', 'desc');
        $res = $this->db->get()->result_array();
        $res = array_reverse($res);
        foreach ($res as &$x)
        {
            $x['entityName'] = 'stat';
        }
        return $res;
    }

    function getGymVisitsRecords()
    {

        $res = $this->db->count_all('gymVisits');
        return $res;
    }

    function fillGymVisits($period=null)
    {
        $this->db->select('g.gymID, DATE(mv.visitDate) as visitDateGroup, sum(wattHours) as wattHours', false)
            ->from('memberVisits mv')
            ->join('gyms g', 'g.gymID=mv.gymID')
            // ->where('mv.memberID != ', 6)
            ->group_by('mv.gymID')
            ->group_by('visitDateGroup')
            ->order_by('visitDateGroup');
        
        if($period == null)
        {
            $res = $this->db->get()->result_array();
           
        }
        else
        {
            $date = date("Y-m-d");
            $this->db->where('mv.visitDate>=date_sub("' . $date . '",interval ' . $period . ' day)');
            $res = $this->db->get()->result_array();
        }
        
         foreach ($res as $key => $value)
            {
                $this->db->query('INSERT INTO gymVisits (gymID,visitDate,wattHours) VALUES (' . $value['gymID'] . ',"' . $value['visitDateGroup'] . '",' . $value['wattHours'] . ') ON DUPLICATE KEY UPDATE wattHours=' . $value['wattHours'] . ';');
            }
            //die($this->db->last_query());
    }
    function getGymsMapCoords($gymID=null){
        $this->db->select('mapPosition,gymID');
        $this->db->from('gyms');
        if($gymID)
            $this->db->where('gymID',$gymID);
        $res = $this->db->get()->result_array();
        return $res;
    }
    function getGymAddress($gymID){
        $this->db->select('gymName,fullBillingAddress,city,state,country')
                ->from('gyms')
                ->where('gymID',$gymID);
        $res = $this->db->get()->row();
        return $res;
    }

}

?>