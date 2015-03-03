<?php

class Email {

	private $api;
	public function __construct() {
		$this->ci = &get_instance ();
		$this->api = $this->ci->config->item ( 'email' );
	}

    public function sendVcode($to_email, $vcode) {
        try {
            $content = "您的验证码为：<br><br>" . $vcode;
            $subject = '邮箱验证码';
            $this->sendEmail($to_email, $subject, $content);
        } catch (Exception $e) {
            echo $e->getMessage()."\n";
            return false;
        }

        return true;
    }

    public function sendEmail($to_email, $subject, $content) {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->CharSet = "UTF-8";
        $mail->Encoding = "base64";
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'ssl';
        $mail->Host = $this->api ['smtp']; 
        $mail->Username = $this->api ['email']; 
        $mail->Password = $this->api ['password'];
        $mail->From = $this->api ['email'];
        $mail->FromName = $this->api ['sender'];
        $mail->AddAddress($to_email, '知家用户');

        $mail->Subject = $subject; 
        $html = $content;
        $mail->MsgHTML($html);	
        $mail->IsHTML(true); 		
        $mail->Send();
    }
}
