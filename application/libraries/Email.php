<?php

class Email {

	private $api;
	public function __construct() {
		$this->ci = &get_instance ();
		$this->api = $this->ci->config->item ( 'sms' );
	}

    public function sendVcode($to_email, $vcode) {
        try {
            $this->sendEmail($to_email, $vcode);
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendEmail($to_email, $content) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
        $mail->Host = $smtp; 
        $mail->Username = $youremail; 
        $mail->Password = $password;
        $mail->From = $youremail; 
        $mail->FromName = "";
        $mail->AddAddress($ymail,$yname);

        $mail->Subject = '';
        $html = '';
        $mail->MsgHTML($html);	
        $mail->IsHTML(true); 		
        $mail->Send();
    }
}
