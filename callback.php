<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//����΢����¼�ص�����ļ�����·��ת�Ƶ�login/callback���������codeֵ����ȥ
$code ='';
$url = '';
$str ='';
$code = $_REQUEST['code'];
$url  = "/login/callback";

$str = "<!doctype html>
<html>
    <head>
    <meta charset=\"UTF-8\">
    <title>�Զ���ת</title>
    </head>
<body>";
$str .="<form action=\"{$url}\" method=\"post\" id=\"form\" autocomplete='off'>";
$str .="<input type='hidden' name='code' value='{$code}'>";
$str .="</form>
        </body>
        </html>
        <script type=\"text/javascript\">
           document.getElementById('form').submit();
        </script>";
echo $str;

