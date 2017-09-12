<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author ICL12
 */
class test extends CI_Controller {

    public function index() {
        $sendMail = $this->sendMail("umarakbar25@gmail.com", "100deals.pk", "<h1>Hello Umar</h1>");
        if ($sendMail) {
            echo "Success";
        } else {
            echo "Fail";
        }
    }

    protected function sendMail($emailTo, $subject, $message) {
        $this->load->library('email', $this->configMail());
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from('newsletter@100deals.pk', '100Deals.pk');
        $this->email->to($emailTo);
        $this->email->subject($subject);
        $this->email->message($message);
        if ($this->email->send()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function configMail() {
        return array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.100deals.pk',
            'smtp_port' => 25,
            'smtp_user' => 'newsletter@100deals.pk',
            'smtp_pass' => 'Lunarlunar123',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
    }

}
