<?php

class Global_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getYearStats($gymId=null, $limit=12)
    {
        $this->db->_protect_identifiers = false;
        $this->db->select('*');
        $this->db->from('globalStats');
        $this->db->group_by('DATE_FORMAT(DATE,"%Y-%m")');
        if($gymId)
            $this->db->where('gymID', $gymId);
        $this->db->order_by('id','desc');
        $this->db->limit($limit);
        $res=$this->db->get()->result_array();
        $this->db->_protect_identifiers = true;
        $res=array_reverse($res);
        return $res;
    }
    
    function getPromoCounters()
    {
        $res=array();
        $this->db->select('count(*) as membersCount');
        $this->db->from('members');
        $row = $this->db->get()->row_array();
        $res['membersCount']=$row['membersCount'];
        
        $this->db->select('count(*) as teamsCount');
        $this->db->from('teams');
        $row = $this->db->get()->row_array();
        $res['teamsCount']=$row['teamsCount'];
        
        $this->db->select('sum(wattHours) as wattHoursCount');
        $this->db->from('gymVisits');
        $row = $this->db->get()->row_array();
        $res['wattHoursCount']=$row['wattHoursCount'];
        
        $this->db->select('sum(workoutDurationSeconds) as workoutDurationCount');
        $this->db->from('memberVisits');
        $row = $this->db->get()->row_array();
        $res['workoutDurationCount']=round($row['workoutDurationCount'],2);
        
        return $res;
    }

    function addDummyStats()
    {
        $date=strtotime('-12 month');
        do
        {
            $date=strtotime('+1 day',$date);
            $x=rand(2000,5000);
            $stats=array();
            $stats['calories'] = $x;
            $stats['wattHours'] = $x*0.9;
            $stats['date'] = date('Y-m-d',$date);
            $stats['gymID'] = 101;
            $this->db->insert('globalStats', $stats);
         }while($date<strtotime('now'));
        
        /*$member=array();
        $member['username'] = $data['username'];
        $member['firstName'] = $data['firstName'];
        $member['lastName'] = $data['lastName'];
        $member['dateOfBirth'] = $data['dateOfBirth'];
        $member['phone'] = $data['telephone'];
        $member['email'] = $data['email'];
        $member['password'] = md5($data['password']);
        $member['gymID'] = $data['gymID'];
        return $this->db->insert('members', $member);*/
    }
    
    public function fillDesirous($options)
    {
        $this->db->insert("preregistration", $options);
    }

}

?>