<?php
if (!defined('BASEPATH'))    exit('Нет доступа к скрипту');

class Widget{
    
    private $ci;
    private $widgets=array();
    private $stats=array();
    
    public function __construct() {
        $this->ci = & get_instance();   
    }  
    
    public function set($widget_name, $widget_title, $data)
    {
        $this->widgets[] = array('name'=>$widget_name, 'widget_title'=>$widget_title, 'widget_content'=>$data);    
    }

    public function getWidget($id, $name, $title, $preview, $data='', $class='widget sortable', $settings=array())
    {
        $profile=false;
        if(isset($data['profile']))
            $profile=true;
        if($name)
            $data=$this->ci->load->view('widget/'.$name.'.php', $data, TRUE);
        $widget = array('widget_id'=>$id,'widget_preview'=>$preview,'widget_title'=>$title, 'widget_content'=>$data, 'class'=>$class, 'widget_settings'=>$settings,'profile_view'=>$profile);
        return $this->ci->load->view('widget/widget_tpl.php', $widget, TRUE);
    }
    
    
    public function getWidgetLastVisits($title='', $user_id=0)
    {
        if(!$title)
            $title='Last Visits';
        $name='last_visits';
        $this->ci->load->model('member_model');
        $data['visits']=$this->ci->member_model->getMemberLastVisits($user_id?$user_id:$this->ci->session->userdata('logOn'),10);
        return $this->getWidget('last_visits', $name, $title, 'visits.png', $data, 'widget nodrag');
    }

    public function getWidgetRanks($title='', $user_id=0)
    {
        if(!$title)
            $title='Last Visits';
        $name='last_visits';
        $this->ci->load->model('member_model');
        $data['visits']=$this->ci->member_model->getMemberLastVisits($user_id?$user_id:$this->ci->session->userdata('logOn'),10);
        return $this->getWidget('ranks', $name, $title, 'profile.png', $data, 'widget nodrag');
    }

    public function getWidgetSocialRelations($title='Teams')
    {
        $name='social_relations';
        $this->ci->load->model('member_model');
        $res=$this->ci->member_model->getMemberTeams($this->ci->session->userdata('logOn'));
        $data=array();
        $data['teams']=$res;
        return $this->getWidget('soc_rel', $name, $title, 'social.png', $data);
    }


    public function getWidgetGlobalStats($id=null,$settings=null,$title='Statistics Chart')
    {
                $name='fit_global';
        $data='';
        $this->ci->load->model('member_model');
        if($id==null){
            $res = $this->ci->member_model->getMemberDayVisits($this->ci->session->userdata('logOn'));
            
            }
        else{
            
             $res = $this->ci->member_model->getMemberDayVisits($id);
             
            }
            
        $arr=array();
        $i=0;
        $arr['watts']=array();
        $arr['wattsComulative']=array();
        $this->stats['totalWatts']=0;
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
            
            if(strtotime('now -1 month')<=strtotime($x['visitDate']))
            {
                $this->stats['totalWatts']+=$x['wattHours'];
            }
        }

        
        //$data['dates']='['.implode(',',$arr['dates']).']';
        $data['sessionCount']=$i;
        $data['watts']=json_encode($arr['watts']);
        $data['wattsComulative']=json_encode($arr['wattsComulative']);
        
        //print_r($data);
        //exit;
        if($settings==null)
             return $this->getWidget('global_stats',$name, $title, 'stats.png', $data);
        else
            return $this->getWidget('global_stats',$name, $title, 'stats.png', $data, $settings);
    }
    
    public function getWidgetGlobalInfo($title='FitForGreen Global')
    {
        $data='';
        return $this->getWidget('global_info',null, $title, 'global.png', null, 'widget number-widget sortable', array('data-load'=>'/ajax/get_global_stats', 'data-reload'=>'600'));
    }

   
    public function getWidgetLastVisitsGraph($title='',$user_id=0)
    {
        if(!$title)
            $title='Recent Statistics';
        $name='last_visits_graph';
        $this->ci->load->model('member_model');
        $data['visits']=$this->ci->member_model->getMemberLastVisits($user_id?$user_id:$this->ci->session->userdata('logOn'),40);
        if($data['visits'])
            $data['visits']=array_reverse($data['visits']);
        return $this->getWidget('recent_stats',$name, $title, 'stats.png', $data, 'widget nodrag');
    }

    public function getWidgetBurgers($title='',$user_id=0,$profile=false)
    {
        if(!$title)
            $title='Calories to Burgers Last 30 Days';
        $name='burgers';
        $this->ci->load->model('member_model');
        if($user_id){
             $watts=$this->ci->member_model->getMonthlyTotal($user_id);
             $data['totalWatts']=$watts->sumWattHours;
            // die($watts->sumWattHours);
             }
        else{
            $data['totalWatts']= $this->stats['totalWatts'];
        }
        if($profile)
            $data['profile']=true;
        return $this->getWidget('burgers',$name, $title, 'burger.png', $data, 'widget nodrag');
    }
    
    public function getWidgetBulbs($title='',$user_id=0,$profile=false)
    {
        if(!$title)
            $title='Watts to Bulbs Last 30 Days';
        $name='bulbs';
        $this->ci->load->model('member_model');
        if($user_id){
             $watts=$this->ci->member_model->getMonthlyTotal($user_id);
             $data['totalWatts']=$watts->sumWattHours;
            // die($watts->sumWattHours);
             }
        else{
            $data['totalWatts']= $this->stats['totalWatts'];
        }
        if($profile)
            $data['profile']=true;
        return $this->getWidget('bulbs',$name, $title, 'bulb.png', $data, 'widget nodrag');
    }

    public function getWidgetOffice()
    {
        $data=array();
        $this->ci->load->model('member_model');
        $res = $this->ci->member_model->getCompetitions($this->ci->session->userdata('logOn'));
        $data['competitions']=$res;
        return $this->getWidget('office','competitions', 'Competitions', 'place.png',$data);
    }
    
}
