<?php
/*
 * PHP SDK @version 2.0.0 @author connect@qq.com @copyright © 2013, Tencent Corporation. All rights reserved.
 */
require_once (CLASS_PATH . "Oauth.class.php");

/*
 * @brief QC类，api外部对象，调用接口全部依赖于此对象
 */
class WC extends Oauth {
	const GET_USER_INFO_URL = "https://api.weixin.qq.com/sns/userinfo";
//    const GET_ACCESS_TOKEN_URL = "https://api.weixin.qq.com/sns/oauth2/access_token?";
	private $kesArr, $APIMap;
	
	/**
	 * _construct
	 *
	 * 构造方法
	 * 
	 * @access public
	 * @since 5
	 * @param string $access_token
	 *        	access_token value
	 * @param string $openid
	 *        	openid value
	 * @return Object QC
	 */
	public function __construct($access_token = "", $openid = "") {
		parent::__construct ();
		
		// 如果access_token和openid为空，则从session里去取，适用于demo展示情形
		if ($access_token === "" || $openid === "") {
			$this->keysArr = array (
					"oauth_consumer_key" => ( int ) $this->recorder->readInc ( "appid" ),
					"access_token" => $this->recorder->read ( "access_token" ),
					"openid" => $this->recorder->read ( "openid" ) 
			);
		} else {
			$this->keysArr = array (
					"oauth_consumer_key" => ( int ) $this->recorder->readInc ( "appid" ),
					"access_token" => $access_token,
					"openid" => $openid 
			);
		}
		
	}
	
	
	/**
	 * get_access_token
	 * 获得access_token
	 * 
	 * @param
	 *        	void
	 * @since 5.0
	 * @return string 返加access_token
	 */
	public function get_access_token() {
		return $this->recorder->read ( "access_token" );
	}

	public function get_openid() {
		return $this->recorder->read ( "openid" );
	}
    public function getAccessToken(){
        $keysArr = array (

//            "access_token" => $access_token ?$access_token:$this->recorder->read ( "access_token" ),
            "openid" =>  $this->recorder->read ( "openid" ),
//            "appid" => $this->recorder->readInc ( "appid" ),
            "secret" => $this->recorder->readInc ( "appkey" ),
            "code" => $_GET ['code'],
            "grant_type" => "authorization_code"
        );

        // ------构造请求access_token的url
        $token_url = $this->urlUtils->combineURL ( self::GET_ACCESS_TOKEN_URL, $keysArr );
        $response = $this->urlUtils->get_contents ( $token_url );
        $result = json_decode ( $response, true );
        var_dump($result);exit;
    }
    public function get_user_info($access_token=null,$openid=null) {
		$keysArr = array (
				//"grant_type" => "authorization_code",
				"access_token" => $access_token ?$access_token:$this->recorder->read ( "access_token" ),
				"openid" => $this->recorder->read ( "openid" ),
		        //"appid" => $this->recorder->readInc ( "appid" ),
				//"secret" => $this->recorder->readInc ( "appkey" ),
				//"client_secret" => $this->recorder->readInc ( "appkey" ),
				//"code" => $_GET ['code'] 
		);
		
		// ------构造请求access_token的url
		$token_url = $this->urlUtils->combineURL ( self::GET_USER_INFO_URL, $keysArr );
		$response = $this->urlUtils->get_contents ( $token_url );
        return json_decode ( $response, true );
    }
	
}
