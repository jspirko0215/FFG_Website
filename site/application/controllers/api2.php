<?php

class Api2 extends API2_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        //header('Location: /docs/api-specs.php');
    }

    public function auth()
    {
        $this->load->model('Member_model', '', TRUE);
        $res = $this->Member_model->auth($this->request['username'], $this->request['password']);
        if ($res)
        {
            $this->response['user'] = $this->transform($res);
        }
        else
        {
            $this->addError('User not found');
        }
    }

    public function fbAuth()
    {
        $this->load->model('api2_model','',TRUE);
        $facebook_id=$this->request['facebook_id'];
        $facebook_login=$this->request['facebook_login'];
        $res=$this->api2_model->fbAuth($facebook_id,$facebook_login);
        if($res)
        {
            $this->response['user']=$this->transform($res,'fbUser');
        }
        else
        {
            $this->addError('User not found');
        }
    }

    public function getMemberStats()
    {
        $this->load->model('api2_model','',TRUE);

        $memberId=$this->request['memberId'];
        $fromDate=$this->param('fromDate');
        $endDate=$this->param('endDate');
        $res=$this->api2_model->getStats($memberId,$fromDate,$endDate);
        if($res)
        {
            $outData=array();
            foreach ($res as $row)
            {
                $outData[]=array('date' => $row->visitDate, 'watt' => $row->wattHours);
            }
            $this->response['stats_set']=$outData;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getMemberVisits()
    {
        $this->load->model('api2_model', '', TRUE);

        $memberId = $this->request['memberId'];
        $fromDate = $this->param('fromDate');
        $endDate = $this->param('endDate');
        $res = $this->api2_model->getVisits($memberId, $fromDate, $endDate);
        if ($res)
        {
            $outData = array();
            foreach ($res as $row)
            {
                $outData[] = array('date' => $row->visitDate, 'watt' => $row->wattHours);
            }
            $this->response['visit_set'] = $outData;
        } else
        {
            $this->addError('Data not found');
        }
    }

    public function getGlobalStats()
    {
        $this->load->model('api2_model', '', TRUE);
        $fromDate=$this->param('fromDate');
        $endDate=$this->param('endDate');
        $res=$this->api2_model->getGlobalStats($fromDate,$endDate);
        if($res)
        {
            $outData = array();
            foreach ($res as $row)
            {
                $outData[] = array('date' => $row->visitDate, 'watt' => $row->wattHours);
            }
            $this->response['stats_set'] = $outData;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getGymStats()
    {
        $this->load->model('api2_model','',TRUE);

        $gymId=$this->request['gymId'];
        $fromDate=$this->param('fromDate');
        $endDate=$this->param('endDate');
        $res=$this->api2_model->getGymStats($gymId,$fromDate,$endDate);
        if($res)
        {
            $outData=array();
            foreach ($res as $row)
            {
                $outData[]=array('date' => $row->visitDate, 'watt' => $row->wattHours);
            }
            $this->response['stats_set']=$outData;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getGyms()
    {
        $this->load->model('api2_model', '', TRUE);
        $res=$this->api2_model->getGyms();
        if($res)
        {
            $outData=array();
            foreach ($res as $row)
            {
                $tmp=array();
                foreach($row as $key=>$value)
                    $tmp[$key]=$value;
                $outData[]=$tmp;
            }
            $this->response['gym_set']=$this->transform($outData);
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getGymInfo()
    {
        $this->load->model('api2_model', '', TRUE);
        $gymId=$this->request['gymId'];
        $res=$this->api2_model->getGymInfo($gymId);
        if($res)
        {
            $this->response['gym']=$this->transform($res);
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getDetailedStats()
    {
        $this->load->model('api2_model', '', TRUE);
        $date=$this->request['date'];
        $res=$this->api2_model->getDetailedStats($date);
        if($res)
        {
            $outData=array();
            for($i=0;$i<24;$i++)
                $outData[$i]=array('hour' => date('H:i:s',strtotime($i.':0:0')), 'watt' => 0);
            foreach ($res as $row)
            {

                $outData[intval($row->hour)]=array('hour' => date('H:i:s',strtotime($row->hour.':00:00')), 'watt' => $row->wattHours);
            }

            $this->response['stats_set']=$outData;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function logWorkout()
    {
        $this->load->model('api2_model', '', TRUE);
        $data=$this->request;
        if(isset($this->request['workoutTypeOther']))
        {
            $id=$this->api2_model->insertWorkoutType($this->request['workoutTypeOther']);
            $data['workoutTypeID']=$id;
            unset($data['workoutTypeOther']);
        }
        if($res=$this->api2_model->logWorkout($data))
        {
            $this->response['logWorkout']=$this->transform($res);
        }
        else
        {
            $this->addError('Error');
        }
    }

    public function logGame()
    {
        $this->load->model('api2_model', '', TRUE);
        $data=$this->request;
        if(isset($this->request['workoutTypeOther']))
        {
            $id=$this->api2_model->insertWorkoutType($this->request['workoutTypeOther']);
            $data['workoutTypeID']=$id;
            unset($data['workoutTypeOther']);
        }
        if($res=$this->api2_model->logWorkout($data))
        {
            $this->response['logWorkout']=$this->transform($res);
        }
        else
        {
            $this->addError('Error');
        }
    }


    public function getWorkoutClassifications()
    {
        $this->load->model('api2_model', '', TRUE);
        $res=$this->api2_model->getWorkoutClassifications();
        if($res)
        {
            $tmp=array();
            foreach($res as $wc)
                $tmp[]=array('id'=>$wc->id,'name'=>$wc->name,'description'=>$wc->description);
            $this->response['WorkoutClassification_set']=$tmp;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function getWorkoutType()
    {
        $this->load->model('api2_model', '', TRUE);
        $res=$this->api2_model->getWorkoutType($this->param('private'));
        if($res)
        {
            $tmp=array();
            foreach($res as $wc)
                $tmp[]=array('id'=>$wc->id,'name'=>$wc->name,'description'=>$wc->description);
            $this->response['WorkoutType_set']=$tmp;
        }
        else
        {
            $this->addError('Data not found');
        }
    }

    public function register()
    {
        $this->load->model('Member_model', '', TRUE);
        if ($this->Member_model->checkUsername($this->request['username']))
        {
            $this->addError('Such Username already exists', 'username');
        }
        if ($this->Member_model->checkEmail($this->request['email']))
        {
            $this->addError('Such E-mail already exists', 'email');
        }
        if (isset($this->request['facebook_login']) && $this->Member_model->checkFB($this->request['facebook_id']))
        {
            $this->addError('This FaceBook profile already linked to FFG');
        }
        if (!$this->hasErrors())
        {
            $row = $this->request;
            $row['gymID']=0;
            unset($row['authKey']);
            if (isset($row['facebook_id']) && $row['facebook_id'])
            {
                $img = file_get_contents('https://graph.facebook.com/' . $row['facebook_id'] . '/picture?type=large');
                $file = FCPATH . 'uploads/userpics/' . $row['facebook_id'] . '.jpg';
                file_put_contents($file, $img);
                $row['avatar'] = $row['facebook_id'] . '.jpg';
            }
            if ($this->Member_model->addMember($row))
            {
                $row['memberID'] = $this->db->insert_id();
                $this->response['user'] = $this->transform($row);
            }
            else
            {
                $this->addError(0, 'Registration error');
            }
        }
    }

    public function updateProfile()
    {
        $this->load->model('Member_model', '', TRUE);
        if ($this->Member_model->getUserRow($this->request['memberId']) == null)
        {
            $this->addError('User with such id is not exists', 'memberId');
        }

        if (isset($this->request['email']) && $this->Member_model->checkEmailUpdate($this->request['memberId'], $this->request['email']))
        {
            $this->addError('Such E-mail already taken', 'email');
        }

        if (!$this->hasErrors())
        {
            if(isset($this->request['firstname']) && $this->request['firstname'] != "")
                $data['firstName'] = $this->request['firstname'];

            if(isset($this->request['lastname']) && $this->request['lastname'] != "")
                $data['lastName'] = $this->request['lastname'];

            if(isset($this->request['password']) && $this->request['password'] != "")
                $data['password'] = $this->request['password'];

            if(isset($this->request['email']) && $this->request['email'] != "")
            	$data['email'] = $this->request['email'];

            if(isset($this->request['state']) && $this->request['state'] != "")
                $data['state'] = $this->request['state'];

            if(isset($this->request['city']) && $this->request['city'] != "")
                $data['city'] = $this->request['city'];

            if(isset($this->request['height']) && $this->request['height'] != "")
                $data['height'] = $this->request['height'];

            if(isset($this->request['weight']) && $this->request['weight'] != "")
                $data['weight'] = $this->request['weight'];

            if(isset($this->request['phone']) && $this->request['phone'] != "")
                $data['phone'] = $this->request['phone'];

            if(isset($this->request['dob']) && $this->request['dob'] != "")
                $data['dateOfBirth'] = date('Y-m-d', strtotime($this->request['dob']));

//            if (isset($row['facebook_id']) && $row['facebook_id'])
//            {
//                $img = file_get_contents('https://graph.facebook.com/' . $row['facebook_id'] . '/picture?type=large');
//                $file = FCPATH . 'uploads/userpics/' . $row['facebook_id'] . '.jpg';
//                file_put_contents($file, $img);
//                $row['avatar'] = $row['facebook_id'] . '.jpg';
//            }

            if ($this->Member_model->update_member_prefs($this->request['memberId'], $data))
            {
                $data['memberID'] = $this->request['memberId'];
                $this->response['user'] = $this->transform($data);
            }
            else
            {
                $this->addError(0, 'Update profile error');
            }
        }
    }

}