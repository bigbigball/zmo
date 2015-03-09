<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
$config ['bd'] ['key'] = 'R8kK9XGsNaXIzv3458sMbAmv';
$config ['bd'] ['skey'] = 'gScQSVNLdCRjnvOCjW6ztX0UKIHHhGst';
$config ['bd'] ['token'] = 'https://openapi.baidu.com/oauth/2.0/token';
$config ['bd'] ['isappuser'] = 'https://openapi.baidu.com/rest/2.0/passport/users/isAppUser';
$config ['bd'] ['getinfo'] = 'https://openapi.baidu.com/rest/2.0/passport/users/getInfo';
$config ['bd'] ['rurl'] = 'http://zmo.cmlove.cm/index.php/user/user/bdlogin.html';

$config ['qq'] ['appid'] = '101197438';
$config ['qq'] ['appkey'] = 'd182f14a41ee8a8b1ade654806331448';
$config ['qq'] ['callback'] = 'http://www.zmoclub.com/index.php/user/user/qq_callback.html';
$config ['qq'] ['state'] = '5c3eaeb36be89510bebbc0cb29fd71f4';
$config ['qq'] ['scope'] = 'get_user_info';
$config ['qq'] ['errorReport'] = true;
$config ['qq'] ['storageType'] = 'file';
$config ['qq'] ['host'] = 'zmoclub.com';
$config ['qq'] ['user'] = 'root';
$config ['qq'] ['password'] = 'root';
$config ['qq'] ['database'] = 'test';

$config ['wx'] ['key'] = '5EYhWHaSZtA4dglRT0SHPutpH5V55sAb';

$config["weibo_conf"] = array(
    "WB_AKEY" => '2821172473',
    "WB_SKEY" =>'5a904a769716426f3aa75a5202ea5703',
    "WB_CALLBACK_URL" => 'http://zmoclub.com/callback.php'
);
