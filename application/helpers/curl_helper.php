<?php
if (! function_exists ( 'callHttpCommon' )) {
	function callHttpCommon($url, $type = 'GET', $useragent = '', $params = null, $header = '', $encoding = '', $referer = '', $cookie = '') {
		$ch = curl_init ();
		$timeout = 30;
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		if ('' != $useragent) {
			curl_setopt ( $ch, CURLOPT_USERAGENT, $useragent );
		}
		if ('' != $encoding) {
			curl_setopt ( $ch, CURLOPT_ENCODING, $encoding );
		}
		if ('' != $header) {
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $header );
		}
		if (null != $params) {
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $params );
		}
		if ('' != $referer) {
			curl_setopt ( $ch, CURLOPT_REFERER, $referer );
		}
		if ('' != $cookie) {
			curl_setopt ( $ch, CURLOPT_COOKIE, $cookie );
		}
		switch ($type) {
			case "GET" :
				curl_setopt ( $ch, CURLOPT_HTTPGET, true );
				break;
			case "POST" :
				curl_setopt ( $ch, CURLOPT_POST, true );
				break;
			case "PUT" :
				curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
				break;
			case "DELETE" :
				curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
				break;
		}
		$result = curl_exec ( $ch );
		$curl_errno = curl_errno ( $ch );
		$curlinfo = curl_getinfo ( $ch );
		curl_close ( $ch );
		ss ( $result );
		if ($curl_errno > 0) {
			return false;
		}
		$ret = json_decode ( $result, TRUE );
		return $ret;
	}
}
if (! function_exists ( 'vpost' )) {
	function vpost($url, $method, $date = null) {
		$curl = curl_init ( $url );
		if ($method == 'post' || $method == 'POST') {
			curl_setopt ( $curl, CURLOPT_POST, 1 );
		} elseif ($method == 'get' || $method == 'GET') {
			curl_setopt ( $curl, CURLOPT_HTTPGET, 1 );
		}
		$header = array (
				"Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5",
				"ContentType: text/xml",
				"Content-Type: multipart/form-data",
				"Accept-Language: ru-ru,ru;q=0.7,en-us;q=0.5,en;q=0.3",
				"Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
				"Keep-Alive: 300" 
		);
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, array (
				'Content-Type: text/xml' 
		) );
		// curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // 对认证证书来源的检查
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 2 ); // 从证书中检查SSL加密算法是否存在
		curl_setopt ( $curl, CURLOPT_USERAGENT, $_SERVER ['HTTP_USER_AGENT'] ); // 模拟用户使用的浏览器
		curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
		curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer
		/*
		 * curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); curl_setopt($curl, CURLOPT_POST, 1); curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml')); curl_setopt($curl, CURLOPT_POSTFIELDS, $date); curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); $output = curl_exec($curl); curl_close($curl);
		 */
		// exit;
		if (isset ( $date ) && $date) {
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, $date ); // Post提交的数据包
		}
		// curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息
		curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
		                                         // curl_setopt($curl, CURLOPT_HEADER, 1); // 显示返回的Header区域内容
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
		$tmpInfo = curl_exec ( $curl ); // 执行操作
		curl_close ( $curl ); // 关键CURL会话
		return $tmpInfo;
	}
}
if (! function_exists ( 'callHttpPost' )) {
	function callHttpPost($url, $params = null) {
		$header = array (
				"Content-Type: application/x-www-form-urlencoded;" 
		);
		$post_url = '';
		foreach ( $params as $key => $value ) {
			if (! empty ( $value )) {
				$post_url .= $key . '=' . urlencode ( $value ) . '&';
			} else {
				$post_url .= $key . '=' . $value . '&';
			}
		}
		$post_url = rtrim ( $post_url, '&' );
		$result = callHttpCommon ( $url, 'POST', '', $post_url );
		$result = json_decode ( $result, true );
		return $result;
	}
}

if (! function_exists ( 'callHttpGet' )) {
	function callHttpGet($url, $params = null) {
		$post_url = '';
		foreach ( $params as $key => $value ) {
			if (! empty ( $value )) {
				$post_url .= $key . '=' . urlencode ( $value ) . '&';
			} else {
				$post_url .= $key . '=' . $value . '&';
			}
		}
		$post_url = rtrim ( $post_url, '&' );
		$result = json_decode ( vpost ( $url . '?' . $post_url, 'GET' ), true );
		return $result;
	}
}

if (! function_exists ( 'callHttpRequest' )) {
	function callHttpRequest($url, $params = array()) {
		return callHttpPost ( $url, $params );
	}
}

