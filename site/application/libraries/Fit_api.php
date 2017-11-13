<?php

require_once "Api_base.php";

class Fit_api extends Api_base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function auth()
    {
        $this->validationRules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
        );
        if ($this->validateRequest())
        {
            $this->CI->load->model('Member_model', '', TRUE);
            $res = $this->CI->Member_model->auth($this->request['username'], $this->request['password']);
            if ($res)
            {
                $this->successResponse($res);
            } else
            {
                $this->addError(0, 'User not found');
            }
        }
        if ($this->hasErrors())
        {
            $this->errorResponse();
        }
    }

    public function addMember()
    {
        $this->validationRules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
            array(
                'field' => 'dateOfBirth',
                'label' => 'Date of birth',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email'
            )
        );
        if ($this->validateRequest())
        {
            $this->CI->load->model('Member_model', '', TRUE);
            if ($this->CI->Member_model->checkUsername($this->request['username']))
            {
                $this->addError(0, 'Such Username already exists', 'username');
            }
            if ($this->CI->Member_model->checkEmail($this->request['email']))
            {
                $this->addError(0, 'Such E-mail already exists', 'email');
            }
			if ($this->request['facebook_login']&&$this->CI->Member_model->checkFB($this->request['facebook_id']))
            {
                $this->addError(0, 'This FaceBook profile already linked to FFG');
            }
            if (!$this->hasErrors())
            {
                $row = $this->request;
                unset($row['authKey']);
				if(isset($row['facebook_id'])&&$row['facebook_id'])
                {
                    $img = file_get_contents('https://graph.facebook.com/' . $row['facebook_id'] . '/picture?type=large');
                    $file = FCPATH . 'uploads/userpics/' . $row['facebook_id'] . '.jpg';
                    file_put_contents($file, $img);
                    $row['avatar'] = $row['facebook_id'] . '.jpg';
                }
                if ($this->CI->Member_model->addMember($row))
                {
                    $row['memberID'] = $this->CI->db->insert_id();
                    $this->successResponse($row);
                } else
                {
                    $this->addError(0, 'Registration error');
                }
            }
        }
        if ($this->hasErrors())
        {
            $this->errorResponse();
        }
    }

    public function getActiveGyms()
    {
        if ($this->validateRequest())
        {
            $this->CI->load->model('Gym_model');
            if (isset($this->request['demo']))
            {
                $res = $this->CI->Gym_model->getAllGyms();
            } else
            {
                $res = $this->CI->Gym_model->getActiveGyms();
            }
            $this->successResponse($res);
        }
    }

    public function getGymStats()
    {
        if ($this->validateRequest())
        {
            $this->CI->load->model('Gym_model');
            $res = $this->CI->Gym_model->getGymStats();
            foreach ($res as &$x)
            {
                unset($x['authKey']);
            }
            $this->successResponse($res);
        }
    }

    public function getCountMembers()
    {
        $this->CI->load->model('Member_model', '', TRUE);
        $count = $this->CI->Member_model->getCountMembers();
        $result = array('ansver' => ($count ? strval($count) : 'Нет пользователей'));
        $this->successResponse($result); // 0 or Count
    }
    
    public function getLeaderBoard()
    {
        if ($this->validateRequest())
        {
            $this->CI->load->model('Stats_model', '', TRUE);
            $data = array();
            $gymId = $this->request['gymID'];
            $data['top_members'] = json_encode($this->CI->Stats_model->getTopMembers());
            $data['top_gymmembers'] = json_encode($this->CI->Stats_model->getTopGymMembers($gymId));
            $data['top_gyms'] = json_encode($this->CI->Stats_model->getTopGyms());
            $data['top_teams'] = json_encode($this->CI->Stats_model->getTopTeams());
            
            $data['top_members_30'] = json_encode($this->CI->Stats_model->getTopMembers(true));
            $data['top_gymmembers_30'] = json_encode($this->CI->Stats_model->getTopGymMembers($gymId,true));
            $data['top_gyms_30'] = json_encode($this->CI->Stats_model->getTopGyms(true));
            $data['top_teams_30'] = json_encode($this->CI->Stats_model->getTopTeams(true));


            $this->successResponse($data); // 0 or Count
        }
        if ($this->hasErrors())
        {
            $this->errorResponse();
        }
    }

}

?>
