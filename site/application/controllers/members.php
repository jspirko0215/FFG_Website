<?php

define("MAX_SIZE", "100");
if(!defined('BASEPATH'))
    exit('??? ??????? ? ???????');

class Members extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('language');
        $this->template->set_template('main');

        // The fb_ignited library is already auto-loaded so call the user and app.
        // $this->fb_me = $this->fb_ignited->fb_get_me();
        $this->fb_app = $this->fb_ignited->fb_get_app();

// This is a Request System I made to be used to work with Facebook Ignited.
// NOTE: This is not mandatory for the system to work.
//        if ($this->input->get('request_ids'))
//        {
//            $requests = $this->input->get('request_ids');
//            $this->request_result = $this->fb_ignited->fb_accept_requests($requests);
//        }
    }

    // Convert data from columns posLongitude & posLatitude to posX, posY in pixels
    public function index()
    {
        $this->acl();
        redirect('/members/dashboard');
    }

    private function acl()
    {
        if(!$this->session->userdata('logOn'))
        {
            redirect('/members/login');
            exit;
        }
    }

    public function stats()
    {
        $this->acl();
        $data = array();
        $this->load->model('member_model');
        $data['visits'] = $this->member_model->getMemberLastVisits($this->session->userdata('logOn'), 500);
        $this->template->write_view('content', 'detailed_stats.php', $data);
        $this->template->render();
    }

    public function check_fb()
    {
        $id = $this->input->post('id');
        if($id)
        {
            $this->load->model('member_model', '', TRUE);
            $mid = $this->member_model->check_fb_profile($id);
            if($mid)
            {
                $this->session->set_userdata('logOn', $mid['memberID']);
                $this->session->set_userdata('fb_id', $mid['facebook_id']);
                echo('ok');
                exit;
            }
            else
            {
                echo('error');
                exit;
            }
        }
    }

    public function fblogin()
    {


//        $this->fb_app = $this->fb_ignited->fb_get_app();
//        $user = $this->fb_ignited->fb_get_user();
//
//        echo('<pre> ------ ');
//        print_r($user);
//        echo(' ----------</pre>');
//        exit();
//
//        if($user){
//           $user_info = $this->fb_ignited->fb_get_me();
//               echo('<pre> ------ ');
//        print_r($user_info);
//        echo(' ----------</pre>');
//        exit();
//           redirect('/members/login?error=1', "refresh");
//
//        }else{
//            $url = $this->fb_ignited->fb_login_url();
//            header("Location: $url");
//        }
    }

    public function login()
    {

//        $this->fb_app = $this->fb_ignited->fb_get_app();
//        $user = $this->fb_ignited->fb_get_user();
//
//	/* ???????????? ????????? ? fb */
//        if($user){
//            if($this->member_model->check_fb_profile($user)){
//                $this->session->userdata('logOn');
//                redirect('/members/dashboard');
//            }
//        }
//
        if($this->session->userdata('logOn'))
            redirect('/members/dashboard');


        $data = array();

        $data['error'] = $this->input->get('error');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field' => 'login',
                'label' => 'login',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_message('required', 'error_required_%s');


        $data['errors'] = '';
        if($this->input->post('submit'))
        {


            if($this->form_validation->run() == FALSE)
            {
                $this->form_validation->set_error_delimiters('', '');
                $data['errors'] = lang(form_error('login')) . '<br />' .
                    lang(form_error('password')) . '<br />';
            }
            else
            {
                $this->load->model('member_model', '', TRUE);

                $row = $this->member_model->auth(
                        $this->input->post('login', TRUE), $this->input->post('password', TRUE)
                );
                if($row)
                {
                    $session_data = array('logOn' => $row['memberID']);
                    $this->session->set_userdata($session_data);
                    $this->member_model->LoggedHistory($row['memberID'], 1);
                    echo(json_encode(array('ok' => 1, 'error' => '')));
                    exit;
                }
                else
                {
                    $data['errors'] = lang('error_invalid_login_pass');
                    echo(json_encode(array('ok' => 0, 'error' => $data['errors'])));
                    exit;
                }
            }
        }
        else
        {
            $data['login'] = '';
            $data['password'] = '';
        }

        $data['fb'] = $this->fb_app;
        $data['cron_facebookid'] = $this->config->item('cron_facebookid');

        $this->template->write_view('content', 'login_view.php', $data);
        $this->template->render();
    }

    public function forgot()
    {
        if($this->session->userdata('logOn'))
            redirect('/members/dashboard');

        $this->load->helper(array('form', 'url', 'send_message'));
        $this->load->library('form_validation');
        $this->load->model('member_model', '', TRUE);


        $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email|callback_isEmail_check");
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('isEmail_check', 'Enter valid email');



        if($this->input->post('submit'))
        {

            if($this->form_validation->run() == FALSE)
            {
                $data['errors'] = validation_errors();
                echo(json_encode(array('ok' => 0, 'error' => $data['errors'])));
                exit;
            }
            else
            {
                $data['email'] = $this->input->post("email");
                $data['forgot_code'] = $this->member_model->forgot_password($data['email']);

                $subject = 'Recover forgotten password';
                $to = $data['email'];
                $msg = 'Link to recover password: ' . base_url() . 'members/change_password?forgot_code=' . $data['forgot_code'] . '';
                _sendEmail('admin@fitforgreen.net', $to, $msg, $subject);
                echo(json_encode(array('ok' => 1, 'error' => '')));
                exit;
            }
        }
        else
        {
            $data['email'] = '';
            $data['errors'] = '';
        }


        $this->template->write_view('content', 'forgot_pass_view.php', $data);
        $this->template->render();
    }

    public function change_password()
    {
        if($this->session->userdata('logOn'))
            redirect('/members/dashboard');
        if(!$this->input->get_post('forgot_code'))
            redirect('/members/login');

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('member_model', '', TRUE);

        $this->form_validation->set_rules('password', 'Password', "trim|required");

        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', '%s is required');

        if($this->input->post('submit'))
        {
            if($this->form_validation->run() == FALSE)
            {
                $data['errors'] = validation_errors();
                echo(json_encode(array('ok' => 0, 'error' => $data['errors'])));
                exit;
            }
            else
            {
                $password = $this->input->post('password');
                $forgot = $this->input->post('forgot_code');
                $res = $this->member_model->change_forgotten_pass($forgot, $password);
                if($res)
                {
                    echo(json_encode(array('ok' => 1, 'error' => '')));
                    exit;
                }
                else
                {

                    echo(json_encode(array('ok' => 0, 'error' => 'Forgot code is wrong')));
                    exit;
                }
            }
        }
        else
        {
            $data['password'] = '';
            $data['errors'] = '';
        }

        // redirect('/members/login');


        $this->template->write_view('content', 'change_pass_view.php', $data);
        $this->template->render();
    }

    public function logout()
    {
        $this->load->helper('url');
        $this->load->model('member_model');

        $user_id = $this->session->userdata('logOn');
        if($user_id)
        {
            $this->member_model->LoggedHistory($user_id, 0);
            $this->session->sess_destroy();  // remove session
        }
        redirect('members/login'); // redirect to Login
    }

    public function dashboard()
    {
        $this->acl();
        $this->load->library('widget');


        define('LIMIT_ROWS_FOR_PAGE', 5);

        $this->load->helper(array('url', 'form'));
        $this->load->model('member_model');
        $this->load->library('pagination');

        $user_id = $this->session->userdata('logOn');



        //$this->widget->set('office_view', 'widget_1', 1);
        $data['widget_9'] = $this->widget->getWidgetGlobalStats();

        $data['widget_1'] = $this->widget->getWidgetLastVisitsGraph();
        $data['widget_2'] = $this->widget->getWidgetLastVisits();
        $data['widget_3'] = $this->widget->getWidgetSocialRelations();
        //$data['widget_4'] = '';
        $data['widget_5'] = $this->widget->getWidgetGlobalInfo();
        $data['widget_6'] = $this->widget->getWidgetBurgers();
        $data['widget_7'] = $this->widget->getWidgetBulbs();
        $data['widget_8'] = $this->widget->getWidgetOffice();

        $data['uid'] = $user_id;


        $this->template->write_view('content', 'dashboard.php', $data);
        $this->template->render();
    }

    function myprofile()
    {
        $data = array();
        $this->load->helper(array('form', 'url'));
        $this->load->model('member_model', '', TRUE);
        $this->load->library('form_validation');
        $this->fb_app = $this->fb_ignited->fb_get_app();

        $uid = $this->session->userdata('logOn');
        if(!$uid)
            redirect('/members/login', 'refresh'); // If no session, redirect to Login

        $data = array('email' => '',
            'lastName' => '',
            'firstName' => '',
            'phone' => '',
            'state' => $this->utility->drawSelectState('state', null, false),
            'city' => '',
            'height' => '',
            'weight' => '',
            'errors' => '',
            'password' => '',
            'facebook' => ''
        );



        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_email_check'
            ),
            array(
                'field' => 'firstName',
                'label' => 'FirstName',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'lastName',
                'label' => 'LastName',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim'
            ),
            array(
                'field' => 'phone',
                'label' => 'Telephone',
                'rules' => 'trim'
            )
//                array(
//                    'field' => 'state',
//                    'label' => 'State',
//                    'rules' => 'trim|required'
//                ),
//                array(
//                    'field' => 'city',
//                    'label' => 'City',
//                    'rules' => 'trim|required'
//                ),
//                array(
//                    'field' => 'new_password',
//                    'label' => 'Password',
//                    'rules' => 'trim|matches[confirm_password]'
//                ),
//                array(
//                    'field' => 'confirm_password',
//                    'label' => 'Confirm password',
//                    'rules' => 'trim|matches[new_password]'
//                )
        );
        $this->form_validation->set_rules($config);

        $this->form_validation->set_message('required', '%s is required');
        $this->form_validation->set_message('valid_email', '%s is is not valid');
        $this->form_validation->set_message('matches', 'Passwords not matched');
        $this->form_validation->set_message('email_check', 'Email is registred in database');
        if($this->input->post('submit'))
        {
            if($this->form_validation->run() == FALSE)
            {
                echo(json_encode(array('ok' => 0, 'error' => validation_errors())));
                exit;
            }
            else
            {
//                if (isset($_FILES['avatar']['name'])) {
//                    $image = $_FILES['avatar']['name'];
//                    var_dump($image);
//                    if ($image) {
//                        $this->storeFile($uid);
//                    }
//                }
                $member = array();
                $member['email'] = $this->input->post('email');
                $member['firstName'] = $this->input->post('firstName');
                $member['lastName'] = $this->input->post('lastName');
                $member['phone'] = $this->input->post('phone');
                if($this->input->post('password'))
                    $member['password'] = $this->input->post('password');
                $member['state'] = $this->input->post('state');
                $member['city'] = $this->input->post('city');
                $member['height'] = $this->input->post('height');
                $member['weight'] = $this->input->post('weight');
                $member['dateOfBirth'] = $this->input->post('date');
                if($this->input->post('post_fb') == 'true')
                    $member['post_fb'] = 1;
                else
                    $member['post_fb'] = 0;

                $avatar_file = $this->input->post('avatar');
                if($avatar_file && file_exists(FCPATH . 'uploads/preload/' . $avatar_file))
                {
                    copy(FCPATH . 'uploads/preload/' . $avatar_file, FCPATH . 'uploads/userpics/' . $avatar_file);
                    $member['avatar'] = $avatar_file;

                    //print_r(FCPATH.'/uploads/preload/'.$avatar_file);
                }

                $facebook = $this->input->post('facebook');
                if($facebook)
                {
                    $user = $this->fb_ignited->fb_get_user();
                    if($user)
                    {
                        $user_info = $this->fb_me = $this->fb_ignited->fb_get_me();
                        $member['facebook_login'] = $facebook;
                        $member['facebook_id'] = $user_info['id'];
                    }
                }

                $this->member_model->update_member_prefs($uid, $member);
                echo(json_encode(array('ok' => 1, 'error' => '')));
                exit;
            }
        }
        else
        {
            $data = $this->member_model->getUserRow($uid);
            $data['facebook'] = $data['facebook_id'];
            $data['uid'] = $uid;
            $data['state'] = $this->utility->drawSelectState('state', $data['state'], false);
        }


        $data['fb'] = $this->fb_app;
        $this->template->write_view('content', 'profile_edit_view.php', $data);
        $this->template->render();
    }

    function email_check($email)
    {
        $uid = $this->session->userdata('logOn');
        if(!$uid)
            redirect('members/login'); // If no session, redirect to Login



//$this->load->model('member_model', '', TRUE);
        return $this->member_model->isAlreadyEmail($uid, $email);
    }

    function isEmail_check($email)
    {
        return $this->member_model->isEmail($email);
    }

    function registration() // ??????????? ? global
    {
       // $this->session->sess_destroy();
        if($this->session->userdata('logOn'))
            redirect('/members/dashboard');

        $this->load->helper(array('form'));
        $this->load->model('member_model');
        $this->load->library(array('form_validation'));

        $this->fb_app = $this->fb_ignited->fb_get_app();


        $this->form_validation->set_rules('username', 'Username', "trim|required"); //callback_uniq_cpname_check
        $this->form_validation->set_rules('firstname', 'Firstname', "trim|required");
        $this->form_validation->set_rules('lastname', 'Lastname', "trim|required");
        $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email");
        $this->form_validation->set_rules('password', 'Password', "trim|required");

        $this->form_validation->set_error_delimiters('<li>', '</li>');
        $this->form_validation->set_message('required', '%s is required');

        $data = array();

        $data['fb'] = $this->fb_app;

        $data['state'] = $this->utility->drawSelectState('state', null, false);
        $data['username'] = '';
        $data['firstname'] = '';
        $data['lastname'] = '';
        $data['email'] = '';
        $data['city'] = '';
        $data['height'] = '';
        $data['weight'] = '';
        $data['password'] = '';
        $data['confirm_password'] = '';
        $data['telephone'] = '';
        if($this->input->post('submit'))
        {
            if($this->form_validation->run() == TRUE)
            {
                $member = array();
                $member["gymID"] = 101;
                $member["username"] = $this->input->post("username");
                $member["firstName"] = $this->input->post("firstname");
                $member['lastName'] = $this->input->post("lastname");
                $member["email"] = $this->input->post("email");
                $member["city"] = $this->input->post("city");
                $member["height"] = $this->input->post("height");
                $member["weight"] = $this->input->post("weight");
                $member["state"] = $this->input->post("state");
                $member["password"] = $this->input->post("password");
                $member["telephone"] = $this->input->post("telephone");
                $member["dateOfBirth"] = $this->input->post("date");


                /* attach fb account */
                $member['facebook_id'] = $this->input->post('facebook_id');
                $member['facebook_login'] = $this->input->post('facebook_login');
                $member['facebook_token'] = $this->input->post('facebook_token');


                if($member['facebook_id'])
                {
                    $img = file_get_contents('https://graph.facebook.com/' . $member['facebook_id'] . '/picture?type=large');
                    $file = FCPATH . 'uploads/userpics/' . $member['facebook_id'] . '.jpg';
                    file_put_contents($file, $img);

                    $member['avatar'] = $member['facebook_id'] . '.jpg';
                }
                else
                {

                    $avatar_file = $this->input->post('avatar');
                    if($avatar_file && file_exists(FCPATH . 'uploads/preload/' . $avatar_file))
                    {
                        copy(FCPATH . 'uploads/preload/' . $avatar_file, FCPATH . 'uploads/userpics/' . $avatar_file);
                        $member['avatar'] = $avatar_file;
                    }
                }
                $insert_id = $this->member_model->addMember($member);

                if($insert_id)
                {
                    $session_data = array('logOn' => $insert_id);
                    $this->session->set_userdata($session_data);
                    $this->member_model->LoggedHistory($insert_id, 1);
                    echo(json_encode(array('ok' => 1, 'error' => '')));
                    exit;
                }
                else
                {
                    echo(json_encode(array('ok' => 0, 'error' => 'Such username or email already exist.')));
                    exit;
                }
            }
            else
            {
                $data['errors'] = validation_errors();
                echo(json_encode(array('ok' => 0, 'error' => $data['errors'])));
                exit;
            }
        }
        else
        {

        }
        $this->template->write_view('content', 'registration_view.php', $data);
        $this->template->render();
    }

    function posttofb($fb_uid = null, $msg_obj = null)
    {
        $this->fb_app = $this->fb_ignited->fb_get_app();


        if(!$fb_uid)
        {
            $fb_uid = $this->session->userdata('fb_id');
            $uid = $this->session->userdata('logOn');
        }
        if($this->input->post('message'))
        {

            if($this->input->post('message') && $this->input->post('message') == 'burger')
            {
                $token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $this->fb_app['fb_appid'] . "&client_secret=" . $this->fb_app['fb_secret'] . "&grant_type=client_credentials");
                $params = null;
                parse_str($token, $params);
                $access_token = $params['access_token'];
                //print_r($access_token);

                $this->load->model('member_model');
                $fbid = $this->member_model->getFbifFromUid($uid);
                $msg_obj = array('method' => 'feed',
                    'message' => '',
                    'picture' => 'http://www.fitforgreen.net/images/widgets/burger.png', //If available, a link to the picture included with this post
                    'link' => 'http://www.facebook.com/pages/Fit-for-Green/196705463732605', //The link attached to this post
                    'name' => 'My FitForGreen\'s progress', //The name of the link
                    'caption' => '', //The caption of the link (appears beneath the link name)
                    'description' => '', //A description of the link (appears beneath the link caption)'
                    'icon' => 'http://www.fitforgreen.net/images/favicon.png', //A link to an icon representing the type of this post
                );
                $watts = $this->member_model->sumWattsPostFb($uid);
                $calories = cal($watts->wattHours);
                $equiv = round(cal($watts->wattHours) / 350, 1);
                $msg_obj['description'].='Over the last 30 days I burnt ' . $calories . ' calories, it\'s an equivalent of ' . $equiv . ' ¼ lb hamburgers';
                $fb_uid = $fbid->facebook_id;
            }
            elseif($this->input->post('message') && $this->input->post('message') == 'bulb')
            {
                $token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $this->fb_app['fb_appid'] . "&client_secret=" . $this->fb_app['fb_secret'] . "&grant_type=client_credentials");
                $params = null;
                parse_str($token, $params);
                $access_token = $params['access_token'];
                //print_r($access_token);

                $this->load->model('member_model');
                $fbid = $this->member_model->getFbifFromUid($uid);
                $msg_obj = array('method' => 'feed',
                    'access_token' => $access_token,
                    'message' => '',
                    'picture' => 'http://www.fitforgreen.net/images/widgets/bulb.png', //If available, a link to the picture included with this post
                    'link' => 'http://www.facebook.com/pages/Fit-for-Green/196705463732605', //The link attached to this post
                    'name' => 'My FitForGreen\'s progress', //The name of the link
                    'caption' => '', //The caption of the link (appears beneath the link name)
                    'description' => '', //A description of the link (appears beneath the link caption)'
                    'icon' => 'http://www.fitforgreen.net/images/favicon.png', //A link to an icon representing the type of this post
                );
                $watts = $this->member_model->sumWattsPostFb($uid);
                $hours = round($watts->wattHours / 60, 1) ? round($watts->wattHours / 60, 1) : round($watts->wattHours / 60, 2);
                $msg_obj['description'].='Over the last 30 days I generated ' . $watts->wattHours . ' watts, it\'s enough to light a typical house bulb for ' . $hours . ' hours';

                $fb_uid = $fbid->facebook_id;
                //die(print_r($access_token));
            }
        }
        else
        {
            if(!$msg_obj)
            {
                $msg_obj = array('method' => 'feed',
                    'message' => '',
                    'picture' => 'http://www.fitforgreen.net/images/widgets/bulb.png', //If available, a link to the picture included with this post
                    'link' => 'http://www.fitforgreen.net', //The link attached to this post
                    'name' => 'My Progress on FitForGreen', //The name of the link
                    'caption' => '', //The caption of the link (appears beneath the link name)
                    'description' => '0 watts, lights a typical house bulb for 0 hours', //A description of the link (appears beneath the link caption)'
                    'icon' => 'http://www.fitforgreen.net/images/favicon.png', //A link to an icon representing the type of this post
                );
            }
        }

        $res = $this->fb_ignited->fb_feed("post", $fb_uid, $msg_obj);
        if(!$res)
            return false;
        else
            return true;
    }

    function posttofbpage()
    {

        $this->load->model('member_model');
        $this->fb_app = $this->fb_ignited->fb_get_app();
        $fb_pid = $this->config->item('cron_facebookpageid');
        $fb_uid = $this->config->item('cron_facebookid');
        $tmp = $this->member_model->getCronAccessToken($fb_uid);
        $fb_uat = $tmp->facebook_token;
        $date = date("Y-m-d H:i:s");
        $tmp = $this->member_model->sumWattsPostFbPage($date);
        $watts = $tmp->wattHours;

        $result = file_get_contents("https://graph.facebook.com/" . $fb_uid . "/accounts?access_token=" . $fb_uat . "");
        $accounts = json_decode($result, true);
        foreach ($accounts["data"] as $page)
        {
            if($page["id"] == $fb_pid)
            {
                $page_access_token = $page["access_token"];
                break;
            }
        }

        $msg_obj = array('access_token' => $page_access_token,
            'message' => '',
            'picture' => 'http://www.fitforgreen.net/images/widgets/green_energy.png',
            'link' => 'http://www.fitforgreen.net',
            'name' => 'Fit for Green Accomplishment',
            'caption' => '',
            'description' => 'Today Fit for Green members donated '.cal($watts).' unwanted calories as they exercised.  We turned that into '.$watts.' watt-hours of green energy and offset our carbon footprint by '.round($watts*0.00059368,2).' kg of CO2 !'
        );



        $t = $this->fb_ignited->fb_feed("post", $fb_pid, $msg_obj);

        // $this->fb_ignited->fb_feed("delete", $t,$msg_obj);
    }

    function updateAccessToken()
    {
        $this->fb_app = $this->fb_ignited->fb_get_app();
        $code = $this->input->get('code');
        $fb_uid = $this->config->item('cron_facebookid');
        $result = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $this->fb_app['fb_appid'] . "&redirect_uri=" . base_url() . "members/updateAccessToken&client_secret=" . $this->fb_app['fb_secret'] . "&code=" . $code . "");
        $params = null;
        parse_str($result, $params);
        $access_token = $params['access_token'];
        $this->load->model('member_model');
        $fbid = $this->member_model->setNewcronAccessToken($fb_uid, $access_token);
        redirect('members/dashboard', 'refresh');

        return true;
    }

    function getExtension($str)
    {
        $i = strrpos($str, ".");
        if(!$i)
        {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    function storeFile($member_id)
    {
        $errors = 0;
        $filename = stripslashes($_FILES['image']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
        if(($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
        {
            //print error message
            echo '<h1>Unknown extension!</h1>';
            $errors = 1;
        }
        else
        {
            $size = filesize($_FILES['image']['tmp_name']);
            if($size > MAX_SIZE * 1024)
            {
                echo '<h1>You have exceeded the size limit!</h1>';
                $errors = 1;
            }
            $image_name = time() . '.' . $extension;
            $newname = "/uploads/userpics/" . $image_name;

            $copied = copy($_FILES['image']['tmp_name'], $newname);
            if(!$copied)
            {
                echo '<h1>Copy unsuccessfull!</h1>';
                $errors = 1;
            }
            else
            {
                $this->member_model->avatar = $new_name;
            }
        }
    }

    function upload_avatar()
    {

        $this->load->helper('upload');
        $filename = '';
        $filesize = 0;
        $file = null;

        $path = 'uploads/preload/';

        if(isset($_GET['qqfile']))
        {
            $file = new qqUploadedFileXhr();
        }
        elseif(isset($_FILES['qqfile']))
        {
            $file = new qqUploadedFileForm();
        }
        elseif(isset($_POST['qqfile']))
        {
            $file = new qqUploadedFileXhr();
        }
        else
        {
            die('{error: "server-error file not passed"}');
        }



        if($file)
        {
            $filename = $file->getName();
            $filesize = $file->getSize();

            if($filesize == 0)
                die('{error: "server-error file size is zero"}');

            $pathinfo = pathinfo($file->getName());
            $filename = $pathinfo['filename'];
            $filename = md5($filename . time());
            $ext = strtolower($pathinfo['extension']);

            $file->save(FCPATH . $path . $filename . '.' . $ext);

            $this->load->library('uploads');
            $this->uploads->set_uploads(FCPATH . $path . $filename . '.' . $ext);
            if($this->uploads->uploaded)
            {

                $this->uploads->image_x = 84;
                $this->uploads->image_y = 84;
                $this->uploads->image_crop = true;
                //$this->uploads->image_ratio_fill = true;
                $this->uploads->image_unsharp = true;
                $this->uploads->file_overwrite = true;
                $this->uploads->process(FCPATH . $path);
                if($this->uploads->processed)
                {
                    echo (json_encode(array('success' => true, 'filename' => $filename . '.' . $ext, 'filesize' => $filesize)));
                    exit();
                }
            }
        }
        die('{error: "server-error query params not passed"}');
    }

    function delete_avatar()
    {
        $filename = $this->input->post('filename');
        if($filename)
        {
            $path_preload = FCPATH . 'uploads/preload/';
            if(file_exists($path_preload . $filename))
            {
                unlink($path_preload . $filename);
            }
            $path_user = FCPATH . 'uploads/userpics/';
            if(file_exists($path_user . $filename))
            {
                unlink($path_user . $filename);
            }
            $this->load->model('member_model', '', TRUE);
            $this->member_model->delete_avatar($filename);
        }
    }

    function cron()
    {
        $this->load->model('member_model');
        $date = date("Y-m-d H:i:s");
        //die(print_r($date));
        $users = $this->member_model->selectUserResults($date);
        $gyms_t = $this->member_model->selectGymResults($date);
        $gyms = array();

        //application token
        if(!empty($users))
        {
            $token = file_get_contents("https://graph.facebook.com/oauth/access_token?client_id=" . $this->fb_app['fb_appid'] . "&client_secret=" . $this->fb_app['fb_secret'] . "&grant_type=client_credentials");
            $params = null;
            parse_str($token, $params);
            $access_token = $params['access_token'];
            //print_r($access_token);
            //end application token

            foreach ($gyms_t as $key => $value)
            {
                $gyms[$value['gymId']] = array('gymName' => $value['gymName'], 'wattHours' => $value['wattHours']);
            }

            $message = array('method' => 'feed',
                'access_token' => $access_token,
                'message' => '',
                'picture' => 'http://www.fitforgreen.net/images/widgets/green_energy.png', //If available, a link to the picture included with this post
                'link' => 'http://www.facebook.com/pages/Fit-for-Green/196705463732605', //The link attached to this post
                'name' => ' My Fit for Green Accomplishment', //The name of the link
                'caption' => '', //The caption of the link (appears beneath the link name)
                'description' => '', //A description of the link (appears beneath the link caption)'
                'icon' => 'http://www.fitforgreen.net/images/favicon.png', //A link to an icon representing the type of this post
            );

            foreach ($users as $key => $value)
            {
                //die($value['facebook_id']);
                $uid = $value['facebook_id'];
                $name = $value['username'];
                if($value['firstName'] != '' && $value['lastName'] != '')
                    $name = $value['firstName'] . ' ' . $value['lastName'];
                $message['description'] = '' . $name . ' just worked out at the ' . $value['gymName'] . ' using Fit for Green and created ' . $value['wattHours'] . ' watt-hours of green energy.';
                foreach ($gyms as $k => $v)
                {
                    if($value['gymId'] == $k)
                    {
                        $message['description'].=' So far today the ' . $v['gymName'] . ' has generated ' . $v['wattHours'] . ' watt-hours of power from their cardio equipment.';
                    }
                }

                if($value['visitId'] > $value['lastPostedFbId'])
                {
                    $res = $this->posttofb($uid, $message);
                    $this->member_model->changePostFbId($value['memberId'], $value['visitId']);
                    $logData = array('memberId' => $value['memberId'], 'facebook_id' => $value['facebook_id'], 'postDate' => $date, 'lastPostFbId' => $value['visitId'], 'message' => $message['description']);
                    $this->member_model->logFb($logData);
                }
            }
        }

        echo "Successful!";
        // print_r($users);
        // print_r($gyms);
    }



    function check_fb_assigned()
    {
        $this->load->model('member_model');
        if($this->input->post('memberId'))
            $uid = $this->input->post('memberId');

        $res = $this->member_model->assigned_mid($uid);
        echo json_encode($res);
    }

}
