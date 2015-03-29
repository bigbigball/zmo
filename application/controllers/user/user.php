<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model', '', true );
		$this->load->model ( 'lesson_model', '', true );
		$this->load->model ( 'active_model', '', true );
		$this->load->model ( 'teacher_model', '', true );
		$this->load->library ( 'form_validation' );
		$this->config->load("thirdkey");
		$this->weibo = $this->config->item("weibo_conf");
		include_once APPPATH."/libraries"."/saetv2.ex.class.php";

        $this->load->model ( 'buy_model', '', true );
	}
	function weibo_callback() {
		$code = $_REQUEST['code'];//code值由入口文件callback.php传过来
		$obj = new SaeTOAuthV2($this->weibo['WB_AKEY'],$this->weibo['WB_SKEY']);
		if (isset($code)) {
			$keys = array();
			$keys['code'] = $code;
			$keys['redirect_uri'] = $this->weibo['WB_CALLBACK_URL'];
			try {
				$token = $obj->getAccessToken( 'code', $keys ) ;//完成授权
			} catch (OAuthException $e) {
			}
		}
		$c = new SaeTClientV2($this->weibo['WB_AKEY'], $this->weibo['WB_SKEY'], $token['access_token']);
		$ms =$c->home_timeline();
		$uid_get = $c->get_uid();//获取u_id
		$uid = $uid_get['uid'];
		$user_message = $c->show_user_by_id($uid);//获取用户信息
		$params = array();
        $params['type'] = 'wb';
        $params['openid'] = $user_message['id'];
        $params['nick_name'] = $user_message['name'];
		$_SESSION['uname'] = $user_message['name'];
		$info = $this->user_model->login_by_sina ( $params);
        switch ($info ['ret']) {
            case 200 :
                msgs ( '登陆成功', site_url ( 'user/user/center' ) );
                break;
            case 204 :
                err_msgs ( '登录失败', site_url ( 'user/user/login' ) );
                break;
            case 400 :
                err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
                break;
        }
	}
    function wx_callback () {
        if ($this->check_login ()) {
            err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
        }
        $post = $this->input->post ();
        $get = $this->input->get ();

        #ini_set('display_errors', 'on');
        #error_reporting(E_ALL);

        include_once APPPATH . 'third_party/wx/wxConnectAPI.php';
        $wc = new WC ();
        $access_token = $wc->wx_callback();
        $openid = $wc->get_openid();
        $info = $wc->get_user_info ();

        $params = array();
        $params['type'] = 'wx';
        $params['openid'] = $openid;
        $params['nick_name'] = $info['nickname'];
        $params['photo'] = $info['headimgurl'];

        $_SESSION ['tencent_login'] = $params;
        redirect(site_url ( 'user/user/wx_callback_login' ));
    }

    function wx_callback_login () {
        $params = $_SESSION ['tencent_login'];
        $info = $this->user_model->login_by_tencent ( $params);
        switch ($info ['ret']) {
            case 200 :
                msgs ( '登陆成功', site_url ( 'user/user/center' ) );
                break;
            case 204 :
                err_msgs ( '登录失败', site_url ( 'user/user/login' ) );
                break;
            case 400 :
                err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
                break;
        }
    }

	function qq_callback () {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		$get = $this->input->get ();

		include_once APPPATH . 'third_party/qq/qqConnectAPI.php';
		$qc = new QC ();
        $access_token = $qc->qq_callback();
        $openid = $qc->get_openid();

		$qc = new QC ($access_token, $openid);
		$info = $qc->get_user_info ();

        $params = array();
        $params['type'] = 'qq';
        $params['openid'] = $openid;
        $params['nick_name'] = $info['nickname'];
        $params['photo'] = $info['figureurl_qq_1'];
					
        $_SESSION ['tencent_login'] = $params;
        redirect(site_url ( 'user/user/qq_callback_login' ));
    }
	function qq_callback_login () {
        $params = $_SESSION ['tencent_login'];
        $info = $this->user_model->login_by_tencent ( $params);
        switch ($info ['ret']) {
            case 200 :
                msgs ( '登陆成功', site_url ( 'user/user/center' ) );
                break;
            case 204 :
                err_msgs ( '登录失败', site_url ( 'user/user/login' ) );
                break;
            case 400 :
                err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
                break;
        }
    }
	function regist() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$this->load->view ( 'user/regist' );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'm_pwd', 'm_pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				err_msgs ( '参数错误', site_url ( 'user/user/regist' ) );
			}
			$info = $this->user_model->registbyemail ( $post );
			switch ($info ['ret']) {
				case 200 :
					msgs ( '注册成功', site_url ( 'user/user/login' ) );
					break;
				case 204 :
					err_msgs ( '这个邮箱已经注册，请登录或者重新注册', site_url ( 'user/user/regist' ) );
					break;
				case 304 :
					err_msgs ( '您的邀请已使用或者已过期', site_url ( 'user/user/regist' ) );
					break;
				case 205 :
					err_msgs ( '您注册失败请重新注册', site_url ( 'user/user/regist' ) );
					break;
			}
		}
	}
	function phone_regist() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$this->form_validation->set_rules ( 'p_phone', 'p_phone', 'required' );
		$this->form_validation->set_rules ( 'p_pwd', 'p_pwd', 'required' );
		$this->form_validation->set_rules ( 'p_dy_code', 'p_dy_code', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'user/user/regist' ) );
		}
		$post = $this->input->post ();
		$info = $this->user_model->registbyphone ( $post );
		switch ($info ['ret']) {
			case 200 :
				msgs ( '注册成功', site_url ( 'user/user/login' ) );
				break;
			case 204 :
				err_msgs ( '这个邮箱已经注册，请登录或者重新注册', site_url ( 'user/user/regist' ) );
				break;
			case 304 :
				err_msgs ( '您的邀码请已使用或者已过期', site_url ( 'user/user/regist' ) );
				break;
			case 305 :
				err_msgs ( '您的手机验证码输入错误或已失效', site_url ( 'user/user/regist' ) );
				break;
			case 205 :
				err_msgs ( '该手机号已经注册过，请您登录', site_url ( 'user/user/login' ) );
				break;
		}
	}
	function login() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$config ['bd'] = $this->config->item ( 'bd' );
			$config ['qq'] = $this->config->item ( 'qq' );
			$config ['wx'] = $this->config->item ( 'wx' );
			$data ['config'] = $config;
			$o = new SaeTOAuthV2( $this->weibo['WB_AKEY'] , $this->weibo['WB_SKEY'] );
			$code_url = $o->getAuthorizeURL( $this->weibo['WB_CALLBACK_URL'] );
			$data ['code_url'] = $code_url;
			$this->load->view ( 'user/login', $data );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
			}
			$info = $this->user_model->login ( $post );
			switch ($info ['ret']) {
				case 200 :
					msgs ( '登陆成功', site_url ( 'user/user/center' ) );
					break;
				case 204 :
					err_msgs ( '邮箱或者密码错误，请重新输入', site_url ( 'user/user/login' ) );
					break;
				case 400 :
					err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
					break;
			}
		}
	}
	function ajax_login() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$config ['bd'] = $this->config->item ( 'bd' );
			$config ['qq'] = $this->config->item ( 'qq' );
			$config ['wx'] = $this->config->item ( 'wx' );
			$data ['config'] = $config;
			$this->load->view ( 'user/login', $data );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				echo json_encode ( array (
						'ret' => 400,
						'message' => '参数错误' 
				) );
				exit ();
			}
			$info = $this->user_model->login ( $post );
			switch ($info ['ret']) {
				case 200 :
					echo json_encode ( array (
							'ret' => 200,
							'message' => '登陆成功' 
					) );
					exit ();
					break;
				case 204 :
					echo json_encode ( array (
							'ret' => 204,
							'message' => '邮箱或者密码错误，请重新输入' 
					) );
					exit ();
					break;
				case 400 :
					echo json_encode ( array (
							'ret' => 400,
							'message' => '参数错误' 
					) );
					exit ();
					break;
			}
		}
	}
	function center() {
		/*
		 * $user_info = $this->user_model->get_user_info(); $data['user_info'] = $user_info; $this->load->view('user/center' , $data);
		 */
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
		$this->order ();
	}
    function do_upload()
    {
        error_reporting(0);
        $config['upload_path'] = './upload/avatar/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
//        $config['max_width']  = '186';
//        $config['max_height']  = '154';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('uploadAvatar'))
        {
            $error = array('error' => $this->upload->display_errors());
            $_FILES =array();
            $url = 'http://zmoclub.com/index.php/user/user/order.html';
            header('Location:'.$url);

        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $image_url = 'upload/avatar/'.$data['upload_data']['file_name'];
            $data1 ['photo'] = $image_url;
            $info = $this->db->where ( 'id', $_SESSION ['uid'] )->update ( 'user', $data1 );
            $url = 'http://zmoclub.com/index.php/user/user/order.html';
            $_FILES =array();
            header('Location:'.$url);
            return $info;
        }
    }
    function buy_year(){
        if (! $this->check_login ()) {
            err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
        }
        $this->load->model ( 'buy_model', '', true );
        $this->db->select ( '*' );
        $this->db->from ( 'year' );
        $query = $this->db->get ();
        if ($query->num_rows () > 0) {
            $info = $query->row_array ();
            if($info){
                $post['id'] = $info['id'];
                $post['type'] = 6;
                $post['is_year'] = md5('afddkfjdkfjd123438');
                $info = $this->buy_model->sign_up ( $post );
                if($info['ret']==200){
                    $oid=$info['oid'];
                    $uri = "/order/order/buy.html?oid=".$oid;
                    redirect($uri,'location');
                }
            }
        }
    }
    function order() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
        if(!empty($_FILES)){
            $this->do_upload();
        }
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'my_order_pay';
		$otype = 0;
		switch ($action) {
			case 'my_order_pay' :
				$otype = 2;
				break;
			case 'my_order_nopay' :
				$otype = 0;
				break;
			case 'my_order_error' :
				$otype = 3;
				break;
			default :
				$otype = 1;
		}
		$post ['otype'] = $otype;
		$this->load->model ( 'order_model', '', true );
		$order = $this->order_model->center ( $post );
		$user_info = $this->user_model->get_user_info ();
		$data ['order'] = $order;
		$data ['user_info'] = $user_info;
		$data ['action'] = 'order';
        $this->load->view ( 'user/order', $data );
    }
	function collect() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
		
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'my_order_pay';
		$otype = 0;
		switch ($action) {
			case 'collect_lesson' :
				$otype = 2;
				break;
			case 'collect_active' :
				$otype = 3;
				break;
			case 'collect_tutor' :
				$otype = 4;
				break;
			default :
				$otype = 1;
		}
		$post ['otype'] = $otype;
		$this->load->model ( 'collection_model', '', true );
		$collects = $this->collection_model->center ( $post );
		$infos = array();
		if ($otype == 2) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->lesson_model->getinfo($relation_id);
				}
			}
		} else if ($otype == 3) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->active_model->getinfo($relation_id);
				}
			}
		} else if ($otype == 4) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->teacher_model->getinfo($relation_id);
				}
			}
		}
		
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['action'] = 'collect';
		$data ['infos'] = $infos;
		$data ['otype'] = $otype;
		
		$this->load->view ( 'user/collect', $data );
	}
	function sms() {
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'sms_contacts';
		$sms_type = 1;
		switch ($action) {
			case 'sms_contacts' :
				$data ['file'] = 'sms_contacts';
				$sms_type = 1;
				break;
			case 'sms_order' :
				$data ['file'] = 'sms_order';
				$sms_type = 2;
				break;
			case 'sms_push' :
				$data ['file'] = 'sms_push';
				$sms_type = 3;
				break;
		}
		
		$post ['sms_type'] = $sms_type;
		$this->load->model ( 'sms_model', '', true );
		$sms = $this->sms_model->center ( $post );
		
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['sms'] = $sms;
		$data ['action'] = 'sms';
		$this->load->view ( 'user/sms', $data );
	}
	function other() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}

		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'bind_phone';
		switch ($action) {
			case 'bind_phone' :
				$data ['file'] = 'bind_phone';
				break;
			case 'verify_mail' :
				$data ['file'] = 'verify_mail';
				break;
			case 'passwd_manage' :
				$data ['file'] = 'passwd_manage';
				break;
		}
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['action'] = 'other';
		$this->load->view ( 'user/other', $data );
	}
	function do_bind_phone() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}

		$this->form_validation->set_rules ( 'mobile', 'mobile', 'required' );
		$this->form_validation->set_rules ( 'code', 'code', 'required' );
		if ($this->form_validation->run () == FALSE) {
		    err_msgs ( '参数错误', site_url('user/user/other',array('action' => 'bind_phone')) );
		}

		$post = $this->input->post ();
		$info = $this->user_model->bind_phone( $post );
		switch ($info ['ret']) {
			case 200 :
		        msgs ( '绑定成功', site_url('user/user/other',array('action' => 'bind_phone')) );
				break;
			case 204 :
		        err_msgs ( '该手机号已经绑定过其他帐号', site_url('user/user/other',array('action' => 'bind_phone')) );
				break;
			case 305 :
		        err_msgs ( '您的手机验证码输入错误或已失效', site_url('user/user/other',array('action' => 'bind_phone')) );
				break;
		}

		msgs ( '绑定失败', site_url('user/user/other',array('action' => 'bind_phone')) );
    }
	function do_verify_mail() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}

		$this->form_validation->set_rules ( 'email', 'email', 'required' );
		$this->form_validation->set_rules ( 'code', 'code', 'required' );
		if ($this->form_validation->run () == FALSE) {
		    err_msgs ( '参数错误', site_url('user/user/other',array('action' => 'verify_mail')) );
		}

		$post = $this->input->post ();
		$info = $this->user_model->verify_mail( $post );
		switch ($info ['ret']) {
			case 200 :
		        msgs ( '绑定成功', site_url('user/user/other',array('action' => 'verify_mail')) );
				break;
			case 204 :
		        err_msgs ( '该邮箱已经绑定过其他帐号', site_url('user/user/other',array('action' => 'verify_mail')) );
				break;
			case 305 :
		        err_msgs ( '您的邮箱验证码输入错误或已失效', site_url('user/user/other',array('action' => 'verify_mail')) );
				break;
		}

		msgs ( '绑定失败', site_url('user/user/other',array('action' => 'verify_mail')) );
    }
	function do_passwd_manage() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}

		$this->form_validation->set_rules ( 'old_pwd', 'old_pwd', 'required' );
		$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
		$this->form_validation->set_rules ( 'ver_pwd', 'ver_pwd', 'required' );
		if ($this->form_validation->run () == FALSE) {
		    err_msgs ( '参数错误', site_url('user/user/other',array('action' => 'passwd_manage')) );
		}

		$post = $this->input->post ();
		$user_info = $this->user_model->get_user_info ();
        if ($user_info['passwd'] != md5($post['old_pwd'])) {
			err_msgs ( '原始密码有误，请重新输入', site_url ( 'user/user/other', array (
					'action' => 'passwd_manage' 
			) ) );
        }

		if ($post ['pwd'] != $post ['ver_pwd']) {
			err_msgs ( '您输入的两次密码不一致，请重新输入', site_url ( 'user/user/other', array (
					'action' => 'passwd_manage' 
			) ) );
		}
		$info = $this->user_model->update_pwd ( $post );
		msgs ( '修改成功', site_url ( 'user/user/center' ) );
	}
	function loginout() {
		if ($this->check_login ()) {
			if (! empty ( $_COOKIE )) {
				foreach ( $_COOKIE as $k => $v ) {
					setcookie ( $k, $v, time () - 3600 );
					// session_destroy();
					unset ( $_SESSION ['uid'] );
					unset ( $_SESSION ['name'] );
					unset ( $_SESSION ['uname'] );
				}
			}
			msgs ( '您成功退出登陆', site_url ( 'home/index' ) );
		} else {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
		}
	}
	function bdlogin() {
		$get = $this->input->get ();
		$api = $this->config->item ( 'bd' );
		$status = 0;
		if (! empty ( $_SESSION ['third'] ) && ! empty ( $_SESSION ['atoken'] ) && ! empty ( $_SESSION ['rtoken'] )) {
			$post ['refresh_token'] = $_SESSION ['rtoken'];
			$post ['access_token'] = $_SESSION ['atoken'];
			$status = $this->user_model->bdlogin ( $post );
		} else {
			$post ['code'] = $get ['code'];
			$post ['client_id'] = $api ['key'];
			$post ['client_secret'] = $api ['skey'];
			$post ['redirect_uri'] = $api ['rurl'];
			$post ['grant_type'] = 'authorization_code';
			$info = callHttpGet ( $api ['token'], $post );
			if (! isset ( $info ['error'] )) {
				$post ['expires_in'] = $info ['expires_in'];
				$post ['refresh_token'] = $info ['refresh_token'];
				$post ['access_token'] = $info ['access_token'];
				$post ['session_secret'] = $info ['session_secret'];
				$post ['session_key'] = $info ['session_key'];
				$post ['scope'] = $info ['scope'];
				$_SESSION ['third'] = 1;
				$_SESSION ['atoken'] = $info ['access_token'];
				$_SESSION ['rtoken'] = $info ['refresh_token'];
				$status = $this->user_model->bdlogin ( $post );
			}
		}
		if ($status) {
			msgs ( '登入成功', site_url ( 'home/index' ) );
		}
	}
	function qq_login() {
		include_once APPPATH . 'third_party/qq/qqConnectAPI.php';
		$qc = new QC ();
		$qc->qq_login ();
	}
	function wx_login() {
		include_once APPPATH . 'third_party/wx/wxConnectAPI.php';
		$qc = new WC ();
		$qc->wx_login ();
	}
	function is_login() {
		if (! empty ( $_SESSION ['uid'] )) {
			exit ( json_encode ( array (
					'ret' => 200,
					'msg' => '您已经登陆' 
			) ) );
		}
		exit ( json_encode ( array (
				'ret' => 204,
				'msg' => '您还没有登陆' 
		) ) );
	}
	function get_phone_number() {
		$info = $this->user_model->get_phone_number ();
		$data ['ret'] = 204;
		if ($info) {
			$data ['ret'] = 200;
			$data ['info'] = $info;
		}
		exit ( json_encode ( $data ) );
	}
	function get_mail() {
		$info = $this->user_model->get_mail ();
		$data ['ret'] = 204;
		if ($info) {
			$data ['ret'] = 200;
			$data ['info'] = $info;
		}
		exit ( json_encode ( $data ) );
	}
	private function check_login() {
		if (! empty ( $_SESSION ['uid'] )) {
			return true;
		}
		return false;
	}

	function find_pwd() {
        if ($this->check_login ()) {
            err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
        }

        $post = $this->input->post ();
        if (empty ( $post )) {
            $this->load->view ( 'user/find_pwd' );
        } else {
            $this->form_validation->set_rules ( 'p_phone', 'p_phone', 'required' );
            $this->form_validation->set_rules ( 'p_pwd', 'p_pwd', 'required' );
            $this->form_validation->set_rules ( 'p_dy_code', 'p_dy_code', 'required' );
            if ($this->form_validation->run () == FALSE) {
                err_msgs ( '参数错误', site_url ( 'user/user/find_pwd' ) );
            }

            $info = $this->user_model->find_pwd ( $post );
            switch ($info ['ret']) {
                case 200 :
                    msgs ( '修改成功', site_url ( 'user/user/login' ) );
                    break;
                case 305 :
                    err_msgs ( '您的手机验证码输入错误或已失效', site_url ( 'user/user/find_pwd' ) );
                    break;
                case 205 :
                    err_msgs ( '您的手机号还没有注册，请注册', site_url ( 'user/user/regist' ) );
                    break;
            }
        }
    }
	function email_find_pwd() {
        if ($this->check_login ()) {
            err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
        }

        $post = $this->input->post ();
        if (empty ( $post )) {
            $this->load->view ( 'user/find_pwd' );
        } else {
            $this->form_validation->set_rules ( 'm_mail', 'm_mail', 'required' );
            $this->form_validation->set_rules ( 'm_pwd', 'm_pwd', 'required' );
            $this->form_validation->set_rules ( 'm_dy_code', 'm_dy_code', 'required' );
            if ($this->form_validation->run () == FALSE) {
                err_msgs ( '参数错误', site_url ( 'user/user/find_pwd' ) );
            }

            $info = $this->user_model->email_find_pwd ( $post );
            switch ($info ['ret']) {
                case 200 :
                    msgs ( '修改成功', site_url ( 'user/user/login' ) );
                    break;
                case 305 :
                    err_msgs ( '您的邮箱验证码输入错误或已失效', site_url ( 'user/user/find_pwd' ) );
                    break;
                case 205 :
                    err_msgs ( '您的邮箱还没有注册，请注册', site_url ( 'user/user/regist' ) );
                    break;
            }
        }
    }
}
