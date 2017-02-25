<?php

/**
 * Created by PhpStorm.
 * User: ntnt
 * Date: 2/25/2017
 * Time: 9:17 AM
 */
class SendEmail
{
    public function send($config,$to,$subject,$message)
    {
        try{
            $email = new CI_Email($config);
            $email->from(EMAIL_SENDER, EMAIL_NAME);
            $email->to($to);
            $email->subject($subject);
            $email->message($message);
            $email->set_newline('\r\n');
            if ($email->send()) {
                return true;
            }
            return false;
        }catch (\Exception $ex){
            return false;
        }
    }
}