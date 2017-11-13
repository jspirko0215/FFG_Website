<?php

class Api2_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function fbAuth($facebook_id,$facebook_login)
    {
        $res=$this->db->get_where('members',array('facebook_id'=>$facebook_id,'facebook_login'=>$facebook_login))->row_array();
        if($res)
        {
            $this->db->where('memberID', $res['memberID']);
            $this->db->update('members', array('isActive' => 1));
        }
        return $res;
    }
    
    public function getStats($memberId,$from,$to)
    {
        $this->db->where('memberID', $memberId);
        if($from !=null)
            $this->db->where('visitDate >=', $from);
        if($to !=null)
            $this->db->where('visitDate <=', $to);
        $res=$this->db->get_where('memberVisitsStat')->result();
        return $res;
    }
    
    public function getVisits($memberId,$from,$to)
    {
        $this->db->where('memberID', $memberId);
        if($from !=null)
            $this->db->where('visitDate >=', $from);
        if($to !=null)
            $this->db->where('visitDate <=', $to);
        $res=$this->db->get_where('memberVisits')->result();
        return $res;
    }
    
    public function getGlobalStats($from,$to)
    {
        if($from !=null)
            $this->db->where('visitDate >=', $from);
        if($to !=null)
            $this->db->where('visitDate <=', $to);
        $res=$this->db->get_where('gymVisits')->result();
        return $res;
    }
    
    public function getGyms()
    {
        $res=$this->db->select('*')
                ->from('gyms')
                ->get()
                ->result();
        return $res;
    }
    
    public function getGymInfo($gymId)
    {
        $res=$this->db->get_where('gyms',array('gymID'=>$gymId))->row_array();
        return $res;
    }
    
    public function getGymStats($gymId,$from,$to)
    {
        $this->db->where('gymID', $gymId);
        if($from !=null)
            $this->db->where('visitDate >=', $from);
        if($to !=null)
            $this->db->where('visitDate <=', $to);
        $res=$this->db->get('gymVisits')->result();
        return $res;
    }
    
    public function getDetailedStats($date)
    {
        $this->db->select('sum(wattHours) as wattHours,HOUR(visitDate) as hour')
                ->from('memberVisits')
                ->group_by('hour')
                ->order_by('hour')
                ->where('DATE(visitDate)',$date);
        $res=$this->db->get()->result();
        return $res;
    }
    
    public function logWorkout($data)
    {
        $data['visitDate']=date('Y-m-d H:i:s');
        $this->db->insert('memberVisits',$data);
        return $data;
    }
    
    public function logGame($data)
    {
        $data['visitDate']=date('Y-m-d H:i:s');
        $this->db->insert('gameStats',$data);
        return $data;
    }
    
    public function insertWorkoutType($name,$description=null)
    {
        $res=$this->db->select('id')
                ->from('workoutType')
                ->where('name',$name)
                ->get()
                ->row_array();
        if(!$res)
        {
            $this->db->set('name',$name)
                    ->set('description',$description)
                    ->set('other',1)
                    ->insert('workoutType');
            return $this->db->insert_id();
        }
        else
            return $res['id'];
    }
    
    public function getWorkoutClassifications()
    {
        $res=$this->db->select('*')
                ->from('workoutClassification')
                ->get()
                ->result();
        return $res;
    }
    
    public function getWorkoutType($private=null)
    {
        if($private==null || $private=='false')
            $this->db->where('other',0);
        $res=$this->db->select('*')
                ->from('workoutType')
                ->get()
                ->result();
        return $res;
    }
    
}

?>