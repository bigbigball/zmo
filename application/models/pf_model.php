<?php
class Pf_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function send_phone_rand_code($post) {
		$vcode = $this->get_rand_code ();
		$sms = new Sms ();
		$ret = $sms->sendSms ( $post ['phone'], '您的验证码是:' . $vcode );
		$sinfo = intval ( substr ( $ret, (strpos ( $ret, '=' ) + 1), (strpos ( $ret, '&' ) - strlen ( $ret )) ) );
		if ($sinfo === 0) {
			$data ['phone'] = $post ['phone'];
			$data ['code'] = $vcode;
			$data ['expire'] = time () + 120;
			$data ['ctime'] = time ();
			$data ['type'] = 0;
			$this->db->insert ( 'vcode', $data );
		}
		return true;
	}
	function send_email_rand_code($post) {
		$vcode = $this->get_rand_code ();
		$email = new Email ();
		$ret = $email->sendVcode( $post ['email'], $vcode );
		if ($ret) {
			$data ['mail'] = $post ['email'];
			$data ['code'] = $vcode;
			$data ['expire'] = time () + 300;
			$data ['ctime'] = time ();
			$data ['type'] = 0;
			$this->db->insert ( 'vcode', $data );
		}
		return true;
	}
	private function get_rand_code() {
		$rand_str = md5 ( 'cmlove_phone_rand_code' . time () );
		return substr ( $rand_str, 18, 6 );
	}
}
