<?php

class Member_model extends CI_Model
{

    var $email;
    var $lastname;
    var $firstname;
    var $telephone;
    var $state;
    var $city;
    var $new_password;
    var $height;
    var $weight;

    function __construct()
    {
        parent::__construct();
    }

    function auth($username, $password)
    {
        $result = $this->db->get_where('members', array('username' => $username, 'password' => md5($password)))->row_array();
        if ($result) {
            $this->db->where('memberID', $result['memberID']);
            $this->db->update('members', array('isActive' => 1));
        }
        return $result;
    }

    function checkEmailUpdate($user_id, $email)
    {
        if (!$user_id)
            return false;

        $result = $this->db->get_where('members', array('memberID !=' => $user_id, 'email' => $email))->row_array();
        return $result;
    }

    function checkEmail($email)
    {
        $result = $this->db->get_where('members', array('email' => $email))->row_array();
        return $result;
    }

    function checkFB($facebook_id)
    {
        $result = $this->db->get_where('members', array('facebook_id' => $facebook_id))->row_array();
        return $result;
    }

    function checkUsername($username)
    {
        $result = $this->db->get_where('members', array('username' => $username))->row_array();
        return $result;
    }

    function check_fb_profile($user_id)
    {

        if (!$user_id)
            return false;

        $this->db->select('*');
        $this->db->where('facebook_id', $user_id);
        $obj = $this->db->get('members')->row_array();
        return $obj;
    }

    function addMember($data)
    {
        if (!$this->isExist($data['username'], $data['email'])) {
            $member = array();

            if (isset($data['username']) && $data['username']) {
                $member['username'] = $data['username'];
            }

            if (isset($data['firstName']) && $data['firstName']) {
                $member['firstName'] = $data['firstName'];
            }

            if (isset($data['lastName']) && $data['lastName']) {
                $member['lastName'] = $data['lastName'];
            }

            if (isset($data['dateOfBirth']) && $data['dateOfBirth']) {
                $member['dateOfBirth'] = date('Y-m-d', strtotime($data['dateOfBirth']));
            }
            if (isset($data['telephone']) && $data['telephone']) {
                $member['phone'] = $data['telephone'];
            }

            if (isset($data['email']) && $data['email']) {
                $member['email'] = $data['email'];
            }

            if (isset($data['city']) && $data['city']) {
                $member['city'] = $data['city'];
            }

            if (isset($data['state']) && $data['state']) {
                $member['state'] = $data['state'];
            }

            if (isset($data['height']) && $data['height']) {
                $member['height'] = $data['height'];
            }

            if (isset($data['weight']) && $data['weight']) {
                $member['weight'] = $data['weight'];
            }

            $member['password'] = md5($data['password']);
            $member['gymID'] = $data['gymID'];
            $member['widgets'] = $this->config->item('widgets_default');

            if (isset($data['facebook_id']) && $data['facebook_id']) {
                $member['facebook_id'] = $data['facebook_id'];
            }

            if (isset($data['facebook_login']) && $data['facebook_login']) {
                $member['facebook_login'] = $data['facebook_login'];
            }

            if (isset($data['facebook_token']) && $data['facebook_token']) {
                $member['facebook_token'] = $data['facebook_token'];
            }

            if (isset($data['avatar']) && $data['avatar']) {
                $member['avatar'] = $data['avatar'];
            }

            $this->db->insert('members', $member);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function isExist($username, $email)
    {
        $this->db->select('memberID');
        $this->db->from('members');
        $this->db->where('username', $username);
        $this->db->or_where('email', $email);
        $row = $this->db->get()->row();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    function getCountMembers()
    {
        $count = $this->db->count_all_results('members'); // Count all users in global database
        return $count;
    }

    function getWidgets($member_id)
    {
        $this->db->select('widgets');
        $this->db->from('members');
        $this->db->where('memberID', $member_id);
        $res = $this->db->get()->row_array();
        return $res['widgets'];
    }

    function setWidgets($user_id, $data)
    {
        $this->db->update('members', array('widgets' => $data), array('memberID' => $user_id));
    }

    function loggedHistory($uid, $action) // Write history login/logout user
    {
        $query = 'INSERT INTO feu_history (memberID, action, timedate_action) VALUES (?, ?, now())';
        $this->db->query($query, array($uid, $action));
    }

    function getHistory($user_id, $page, $on_page)
    {
        $this->db->where('memberID', $user_id);
        $this->db->limit($on_page, ($page - 1) * $on_page);
        $this->db->order_by("timedate_action", "asc");
        $dbr = $this->db->get_where('feu_history', array('memberID' => $user_id));
        return $dbr;
    }

    function getCountRowsFeuHistory($user_id)
    {
        $this->db->where('memberID', $user_id);
        $count = $this->db->count_all_results('feu_history'); // Count all users in global database
        return $count;
    }

    function getUserRow($user_id)
    {
        $this->db->where('memberID', $user_id);
        $row = $this->db->get('members')->result_array(); // Count all users in global database
        return $row[0];
    }

    function getMemberByName($username)
    {
        $this->db->where('username', $username);
        $row = $this->db->get('members')->result_array(); // Count all users in global database
        return isset($row[0]) ? $row[0] : null;
    }

    function update_member_prefs($user_id, $data)
    {
        $this->db->where('memberID', $user_id);
        if (isset($data['password'])) {
            $this->db->set('password', md5($data['password']));
            unset($data['password']);
        }


        $this->db->update('members', $data);
    }

    function isAlreadyEmail($user_id, $email)
    {
        $this->db->where('email', $email);
        $row = $this->db->get('members', 1)->result_array();
        if (!$row)
            return TRUE;
        elseif ($row[0]['memberID'] == $user_id)
            return TRUE; // ??? ???????, ??? ??????????? field email is UNIQUE
        return FALSE;
    }

    function isEmail($email)
    {
        $this->db->select('email')
            ->from('members')
            ->where('email', $email);
        $row = $this->db->get()->row();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    function getMemberLastVisits($memberId, $limit = 20, $order = 'desc')
    {
        $this->db->select('mv.*, gymName');
        $this->db->from('memberVisits mv');
        $this->db->join('gyms g', 'mv.gymId=g.gymID', 'left');
        $this->db->where('memberID', $memberId)
            ->where('wattHours > ', 0);
        $this->db->order_by('visitDate', $order);
        $this->db->limit($limit);
        $res = $this->db->get()->result_array();
        foreach ($res as $k => $v) {
            $res[$k]['calories'] = cal($v['wattHours']);
        }
        return $res;
    }

    function getGymDayVisits($gymId = null, $startDate = null, $endDate = null, $limit = null)
    {
        $this->db->select('visitDate, sum(wattHours) as wattHours', false)
            ->from('gymVisits gs');
        if ($gymId)
            $this->db->where('gymID', $gymId);
        if ($startDate)
            $this->db->where('visitDate >= ', $startDate);
        if ($endDate)
            $this->db->where('visitDate<=', $endDate, false);
        $this->db->group_by('visitDate')
            ->order_by('visitDate');
        if ($limit)
            $this->db->limit($limit);
        $res = $this->db->get()->result_array();

        return $res;
    }

    function getMemberDayVisits($memberId = null, $startDate = null, $endDate = null, $limit = null)
    {
        $this->db->select('CONCAT(visitDate," 12:00:00") as visitDate, sum(wattHours) as wattHours', false)
            ->from('memberVisitsStat mvs');
        $this->db->where('wattHours > "0"');//??????? ???????????
        if ($memberId)
            $this->db->where('memberID', $memberId);
        if ($startDate)
            $this->db->where('visitDate >= ', $startDate);
        if ($endDate)
            $this->db->where('visitDate<=', $endDate, false);
        $this->db->group_by('visitDate')
            ->order_by('visitDate');
        if ($limit)
            $this->db->limit($limit);
        $res = $this->db->get()->result_array();

        return $res;
    }

    function getMemberTeams($memberId)
    {
        $this->db->select('t.*');
        $this->db->from('teams t');
        $this->db->join('teamRegistrations tr', 'tr.teamID=t.teamID', 'inner');
        $this->db->where('tr.memberID', $memberId);
        $res = $this->db->get()->result_array();
        foreach ($res as &$x) {
            $x['members'] = $this->getTeamMembers($x['teamID']);
        }
        return $res;
    }

    function getTeamMembers($teamId, $limit = 5)
    {
        $this->db->select('m.*');
        $this->db->from('members m');
        $this->db->join('teamRegistrations tr', 'tr.memberID=m.memberID', 'inner');
        $this->db->where('tr.teamID', $teamId);
        $this->db->limit($limit);
        $res = $this->db->get()->result_array();
        return $res;
    }

    function getCompetitions($memberId)
    {
        $res = array();
        $this->db->select('*')
            ->from('competitions c')
            ->join('competitionRegistrations cr', 'cr.competitionID=c.competitionID', 'inner')
            ->join('teamRegistrations tr', 'tr.teamID=cr.teamID', 'inner')
            ->where('tr.memberID', $memberId)
            ->where('(now()>=cr.startDate  OR startDate="0000-00-00 00:00:00") and (now()<=cr.endDate OR endDate="0000-00-00 00:00:00")');
        $competitions = $this->db->get()->result_array();
        foreach ($competitions as $c) {
            $topTeams = $this->getCompetitionStats($c['competitionID']);
            $topMembers = $this->getCompetitionMembers($c['competitionID']);
            $res[] = array(
                'competitionID' => $c['competitionID'],
                'competitionName' => $c['competitionName'],
                'stats' => $topTeams,
                'members' => $topMembers
            );
        }
        return $res;
    }

    function getCompetitionStats($competitionID)
    {
        $this->db->select('t.teamID, t.teamName,sum(wattHours) as wattHours', false)
            ->from('teamCompetitionVisits tcv')
            ->join('teams t', 't.teamID=tcv.teamID', 'inner')
            ->where('tcv.competitionID', $competitionID)
            ->group_by('t.teamID')
            ->order_by('wattHours', 'desc')
            ->limit(5);

        $res = $this->db->get()->result_array();
        return $res;
    }

    function getCompetitionMembers($competitionID)
    {
        $this->db->select('m.memberID, m.username, m.avatar, t.teamName, sum(wattHours) as wattHours', false)
            ->from('memberVisitsStat mv')
            ->join('members m', 'm.memberID=mv.memberID', 'inner')
            ->join('teamRegistrations tr', 'tr.memberID=m.memberID', 'inner')
            ->join('teams t', 't.teamID=tr.teamID', 'inner')
            ->join('competitionRegistrations cr', 'cr.teamID=t.teamID', 'inner')
            ->where('(mv.visitDate>=cr.startDate  OR startDate="0000-00-00 00:00:00") and (mv.visitDate<=cr.endDate OR endDate="0000-00-00 00:00:00")')
            ->where('cr.competitionID', $competitionID)
            ->group_by('m.memberID')
            ->order_by('wattHours', 'desc')
            ->limit(3);
        $res = $this->db->get()->result_array();
        return $res;
    }

    function getMonthlyTotal($memberId)
    {
        $date = date("Y-m-d");
        $this->db->select('sum(wattHours) as sumWattHours')
            ->from('memberVisitsStat mv')
            ->where("(mv.visitDate > '" . $date . "' - interval 30 day)")
            ->where('memberID', $memberId);
        $res = $this->db->get()->row();

        return $res;
        //return array('sumWattHours' => '550', 'sumCalories' => '1080');
    }

    function delete_avatar($filename)
    {
        $this->db->set('avatar', '');
        $this->db->where('avatar', $filename);
        $this->db->update('members');
    }

    function assign_fb_profile($data)
    {

        if ($data) {
            if (isset($data['facebook_id']) && $data['facebook_id']) {
                $member['facebook_id'] = $data['facebook_id'];
            }

            if (isset($data['facebook_login']) && $data['facebook_login']) {
                $member['facebook_login'] = $data['facebook_login'];
            }

            if (isset($data['facebook_token']) && $data['facebook_token']) {
                $member['facebook_token'] = $data['facebook_token'];
            }
            if (isset($data['memberId']) && $data['memberId']) {
                $member['memberId'] = $data['memberId'];
            }
            $temp = $this->already_assigned_fb($member['facebook_id']);
            if ($temp) {
                return false;
            } else {
                $this->db->set('facebook_id', $member['facebook_id'])
                    ->set('facebook_login', $member['facebook_login'])
                    ->set('facebook_token', $member['facebook_token'])
                    ->where('memberID', $member['memberId'])
                    ->update('members');
                return true;
            }
        }
    }

    function already_assigned_fb($facebook_id)
    {


        $this->db->select('facebook_id')
            ->from('members')
            ->where('facebook_id', $facebook_id);
        $row = $this->db->get()->row();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    function assigned_mid($uid)
    {

        $this->db->select('facebook_id as fid')
            ->from('members')
            ->where('memberID', $uid);
        $row = $this->db->get()->row();
        if ($row->fid != null) {
            return true;
        } else {
            return false;
        }
    }

    function forgot_password($memberEmail)
    {
        $this->db->set('forgot_code', md5($memberEmail))
            ->where('email', $memberEmail)
            ->update('members');
        return md5($memberEmail);
    }

    function change_forgotten_pass($forgot_code, $password)
    {
        $this->db->select('forgot_code')
            ->from('members')
            ->where('forgot_code', $forgot_code);
        $row = $this->db->get()->row();
        if ($row) {
            $res = $this->db->set('password', md5($password))
                ->set('forgot_code', '')
                ->where('forgot_code', $forgot_code)
                ->update('members');
            return true;
        } else {
            return false;
        }
    }

    function isfbProfileAlready($facebookId)
    {
        $this->db->select('facebook_id')
            ->from('members')
            ->where('facebook_id', $facebookId);
        $row = $this->db->get()->row();
        if (!$row) {
            return true;
        } else {
            return false;
        }
    }

    function selectUserResults($date)
    {
        $this->db->select('m.memberId, m.firstName, m.lastName, m.username,m.facebook_id,g.gymId, g.gymName,sum(mv.wattHours) as wattHours, max(mv.visitId) as visitId, m.lastPostedFbId')
            ->from('memberVisits mv')
            ->join('members m', 'm.memberID=mv.memberID', 'inner')
            ->join('gyms g', 'g.gymID=mv.gymID', 'inner')
            ->where("(mv.visitDate between '" . $date . "' - interval 1 hour and '" . $date . "' AND m.post_fb=1 AND m.facebook_id!='' AND m.facebook_id IS NOT NULL)")
            ->group_by('m.memberID')
            ->order_by('visitId');

        $res = $this->db->get()->result_array();
        return $res;
    }

    function selectGymResults($date)
    {
        $this->db->select('g.gymId, g.gymName, sum(mv.wattHours) as wattHours')
            ->from('memberVisits mv')
            ->join('gyms g', 'g.gymID=mv.gymID', 'inner')
            ->where("(mv.visitDate > '" . $date . "' - interval 1 day)")
            ->group_by('g.gymId');


        $res = $this->db->get()->result_array();
        return $res;
    }

    function changePostFbId($uid, $lastPostedFbId)
    {
        $res = $this->db->set('lastPostedFbId', $lastPostedFbId)
            ->where('memberId', $uid)
            ->update('members');
    }

    function logFb($data)
    {

        $this->db->insert('fbLogs', $data);
    }

    function sumWattsPostFb($uid)
    {
        $this->db->select('sum(wattHours) as wattHours')
            ->from('memberVisits')
            ->where('memberId', $uid)
            ->where('(visitDate > now() - interval 30 day)');
        $row = $this->db->get()->row();
        return $row;
    }

    function sumWattsPostFbPage($date)
    {
        $this->db->select('sum(wattHours) as wattHours')
            ->from('memberVisits ')
            ->where("(visitDate > '" . $date . "' - interval 1 day)");
        $res = $this->db->get()->row();
        return $res;
    }

    function unassign_fb_profile($uid)
    {

        $this->db->set('facebook_id', '')
            ->set('facebook_token', '')
            ->set('facebook_login', '')
            ->where('memberID', $uid)
            ->update('members');
        return true;
    }

    function getFbifFromUid($uid)
    {
        $this->db->select('facebook_id')
            ->from('members')
            ->where('memberID', $uid);
        $res = $this->db->get()->row();
        return $res;
    }

    function setNewcronAccessToken($fb_uid, $access_token)
    {
        $this->db->set('facebook_token', $access_token)
            ->where('facebook_id', $fb_uid)
            ->update('members');
        return true;
    }

    function getCronAccessToken($fb_uid)
    {
        $this->db->select('facebook_token')
            ->from('members')
            ->where('facebook_id', $fb_uid);
        $res = $this->db->get()->row();
        return $res;
    }

    function getTeamVisitsRecords()
    {

        $res = $this->db->count_all('teamVisits');
        return $res;
    }

    function getTeamCompetitionVisitsRecords()
    {

        $res = $this->db->count_all('teamCompetitionVisits');
        return $res;
    }

    function getMemberVisitsStatRecords()
    {

        $res = $this->db->count_all('memberVisitsStat');
        return $res;
    }

    function fillTeamVisits($period = null)
    {

        $this->db->select('t.teamID,DATE(mv.visitDate) as visitDateGroup,sum(wattHours) as wattHours', false)
            ->from('memberVisits mv')
            ->join('members m', 'm.memberID=mv.memberID', 'inner')
            ->join('teamRegistrations tr', 'tr.memberID=m.memberID', 'inner')
            ->join('teams t', 't.teamID=tr.teamID', 'inner')
            ->where('mv.visitDate >= tr.registrationDate')
            ->group_by('t.teamID')
            ->group_by('visitDateGroup')
            ->order_by('visitDateGroup');


        if ($period == null) {
            $res = $this->db->get()->result_array();
        } else {
            $date = date("Y-m-d");
            $this->db->where('mv.visitDate>=date_sub("' . $date . '",interval ' . $period . ' day)');
            $res = $this->db->get()->result_array();
        }
        foreach ($res as $key => $value) {
            $this->db->query('INSERT INTO teamVisits (teamID,visitDate,wattHours) VALUES (' . $value['teamID'] . ',"' . $value['visitDateGroup'] . '",' . $value['wattHours'] . ') ON DUPLICATE KEY UPDATE wattHours=' . $value['wattHours'] . ';');
        }
    }

    function fillTeamCompetitionVisits($period = null)
    {

        $this->db->select('t.teamID,cr.competitionID, DATE(mv.visitDate) as visitDateGroup,sum(wattHours) as wattHours', false)
            ->from('memberVisits mv')
            ->join('members m', 'm.memberID=mv.memberID', 'inner')
            ->join('teamRegistrations tr', 'tr.memberID=m.memberID', 'inner')
            ->join('teams t', 't.teamID=tr.teamID', 'inner')
            ->join('competitionRegistrations cr', 'cr.teamID=t.teamID', 'inner')
            ->where('(mv.visitDate>=cr.startDate  OR startDate="0000-00-00 00:00:00") and (mv.visitDate<=cr.endDate OR endDate="0000-00-00 00:00:00") and mv.visitDate>=tr.registrationDate')
            ->where('mv.visitDate >= tr.registrationDate')
            ->group_by('t.teamID, ')
            ->group_by('visitDateGroup')
            ->order_by('visitDateGroup');


        if ($period == null) {
            $res = $this->db->get()->result_array();
        } else {
            $date = date("Y-m-d");
            $this->db->where('mv.visitDate>=date_sub("' . $date . '",interval ' . $period . ' day)');
            $res = $this->db->get()->result_array();
        }
        foreach ($res as $key => $value) {
            $this->db->query('INSERT INTO teamCompetitionVisits (teamID,competitionID,visitDate,wattHours) VALUES (' . $value['teamID'] . ',' . $value['competitionID'] . ',"' . $value['visitDateGroup'] . '",' . $value['wattHours'] . ') ON DUPLICATE KEY UPDATE wattHours=' . $value['wattHours'] . ';');
        }
    }

    function fillMemberVisitsStat($period = null)
    {

        $this->db->select('m.memberID, mv.gymID,DATE(mv.visitDate) as visitDateGroup, sum(wattHours) as wattHours', false)
            ->from('memberVisits mv')
            ->join('members m', 'm.memberID=mv.memberID', 'inner')
            ->where('m.memberID != ', 6)
            ->group_by('m.memberID')
            ->group_by('mv.gymID')
            ->group_by('visitDateGroup')
            ->order_by('visitDateGroup');

        if ($period == null) {

            $res = $this->db->get()->result_array();
        } else {
            $date = date("Y-m-d");
            $this->db->where('mv.visitDate>=date_sub("' . $date . '",interval ' . $period . ' day)');
            $res = $this->db->get()->result_array();
        }
        foreach ($res as $key => $value) {
            $this->db->query('INSERT INTO memberVisitsStat (memberID,gymID,visitDate,wattHours) VALUES (' . $value['memberID'] . ',' . $value['gymID'] . ',"' . $value['visitDateGroup'] . '",' . $value['wattHours'] . ') ON DUPLICATE KEY UPDATE wattHours=' . $value['wattHours'] . ';');
        }
    }

}

?>