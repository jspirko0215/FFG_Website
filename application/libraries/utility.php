<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Utility
{
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function drawSelectState($name='state', $selected=null, $required = true)
    {
        $this->CI->db->select('*');
        $this->CI->db->from('states');
        $res=$this->CI->db->get()->result_array();
        $options=array();
        foreach($res as $row)
        {
            $options[$row['name']]=$row['fullname'];
        }
        if($required)
            return form_dropdown($name, $options, $selected, 'style="width:150px; opacity:0" id="state" required');
        
        return form_dropdown($name, $options, $selected, 'style="width:150px; opacity:0" id="state"');
    }
}

?>
