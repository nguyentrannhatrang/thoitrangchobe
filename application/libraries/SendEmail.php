<?php

/**
 * Created by PhpStorm.
 * User: ntnt
 * Date: 2/25/2017
 * Time: 9:17 AM
 */
class SendEmail
{
    public function send($to,$subject,$message)
    {
        $email = new CI_Email($this->emailConfig());
        $email->from(EMAIL_SENDER, EMAIL_NAME);
        $email->to($to);
        $email->subject($subject);
        $email->message($message);

        if ($email->send()) {
            return true;
        }

        return false;
    }

    /**
     * Email Configurations
     * ** Please deactivate Second-step verification for the smtp_user **
     */
    private function emailConfig()
    {
        $config = array(
            'protocol' 	=> 'smtp' ,
            'smtp_host' => 'ssl://smtp.googlemail.com' ,
            'smtp_port' => 465 ,
            'smtp_user' => 'someone@gmail.com' ,
            'smtp_pass' => 'your password',
            'mailtype'	=> 'html',
            'charset' 	=> 'utf-8',
            'newline' 	=> "\r\n",
            'wordwrap' 	=> TRUE
        );

       return $config;
    }
}