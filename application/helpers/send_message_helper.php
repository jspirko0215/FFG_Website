<?php
/*
 * Send email to '$to email' from '$from email' with $msgToSend text
 */
function _sendEmail($from, $to, $msgToSend, $subject)
{
    $CI =& get_instance();
    $CI->load->library('email');

    $CI->email->clear();
    $CI->email->set_newline("\r\n");
    $CI->email->from($from);
    $CI->email->to($to);
    $CI->email->subject($subject);
    $CI->email->message($msgToSend);

    return $CI->email->send();
}

