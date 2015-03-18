<div class="cmfooter">
	<div class="footer_menu clearfix">
		<ul class="clearfix">
			<li class="check_menu"><a href="<?php echo site_url('news/news/aboutus')?>">关于我们</a></li>
			<li><a href="<?php echo site_url('news/news/joinus')?>">加入我们</a></li>
			<li><a href="<?php echo site_url('news/news/help')?>">帮助</a></li>
			<li id="feedback"><a href="javascript:void(0);">意见反馈</a></li>
		</ul>
	</div>
	<div class="footer">
		<div class="clearfix code">
			<div class="weixin">
				<div>
					<img src="/static/img/dingyue.jpg" width="110">
				</div>
				<div class="word">微信订阅号</div>
			</div>
			<div class="weixin margin">
				<div>
					<img src="/static/img/fuw.jpg" width="110" />
				</div>
				<div class="word">微信服务号</div>
			</div>
			<div class="weixin ml40">
				<div>
					<img src="/zmo/static/img/weibo.jpg" width="110"/>
				</div>
				<div class="word">官方微博</div>
			</div>
<<<<<<< HEAD
<!--            <div class="weixin ml40">-->
<!--				<div>-->
<!--					<img src="/static/img/weibo.png"  width="110px" />-->
<!--				</div>-->
<!--				<div class="word">微博公共帐号</div>-->
<!--			</div>-->
=======
>>>>>>> f209b2cbc5138685c2469f60ddcdd1846e0e1d96
		</div>
	</div>
	<div class="site_info">
		友情链接 :&nbsp;&nbsp;
		<a href="http://www.tmtpost.com/" target="_blank">钛媒体 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.36kr.com/" target="_blank">36kr &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.huxiu.com/" target="_blank">虎嗅 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.cyzone.cn/" target="_blank">创业邦 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.iresearch.cn/" target="_blank">艾瑞 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.ifanr.com/" target="_blank">爱范儿 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.donews.com/" target="_blank">DoNews &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.iheima.com/" target="_blank">i黑马 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.sootoo.com/" target="_blank">速途网 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.ftchinese.com/" target="_blank">FT中文网 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.xmtnews.com/" target="_blank">新媒体观察 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.bianews.com/" target="_blank">鞭牛士 &nbsp;&nbsp;&nbsp;&nbsp;</a>
		<a href="http://www.eguan.cn/" target="_blank">易观网 &nbsp;&nbsp;&nbsp;&nbsp;</a>
	</div>
	<div class="site_info">Copyright2014-<?php echo date('Y');?> 知家网 zmoclub.com All rights reserved.京ICP备15009682号-1</div>
</div>
<!--反馈弹框-->
<div class="pop_box" id="pop_feedback" style="display: none">
	<h4>请填写您的反馈意见</h4>
	<a href="javascript:;" class="close"
		onclick="$(this).parent('#pop_feedback').hide()"></a> <input
		type="text" placeholder="请输入您注册时的E－mail" class="text feedbackmail"
		onfocus="if($(this).val()=='请输入您注册时的E－mail'){$(this).val('');}"
		onblur="if($(this).val()==''){$(this).val('请输入您注册时的E－mail');}" />
	<textarea onfocus="if($(this).html()=='请输入您的反馈意见'){$(this).html('');}"
		onblur="if($(this).html()==''){$(this).html('请输入您的反馈意见');}"
		class="feedbackinfo">请输入您的反馈意见</textarea>
	<span class="tip">最多输入200字</span> <input type="button" value="提交"
		class="btn" id="popfeedback" />
</div>
<!--反馈弹框-->
<!--登陆弹框-->
<div class="pop_box" id="pop_login"
	<?php if(!empty($_SESSION['uid'])){?> style="display: none" <?php }?>>
	<a href="javascript:;" class="close"
		onclick="$(this).parent('#pop_login').hide()"></a>
	<div class="tab">
		<img src="/zmo/static/img/logo2.png" class="logo" /> <a
			href="javascript:;" rel="logintab" class="curr">会员登录</a>
		<a href="javascript:;" rel="regtab">会员注册</a>
	</div>
	<div class="login_con">
		<div id="logintab">
			<input type="text" class="text" placeholder="请输入您注册时的E－mail"
				id="floginmail" /> <input class="text" type="password"
				placeholder="您的密码" id="floginpwd" />
			<div class="bot">
				<label><input type="checkbox" />&emsp;记住密码</label> <a
					href="javascript:void(0);">忘记密码</a>
			</div>
			<input type="button" class="btn" value="登录" onclick="flogin();" />
		</div>
	</div>
</div>
<!--登陆弹框-->
<!-- begin -->
<style type="text/css">
.main-im{position:fixed;right:10px;top:300px;z-index:100;width:110px;height:272px;}
.main-im .qq-a{display:block;width:106px;height:116px;font-size:14px;color:#0484cd;text-align:center;position:relative;}
.main-im .qq-a span{bottom:5px;position:absolute;width:90px;left:10px;}
.main-im .qq-hover-c{width:70px;height:70px;border-radius:35px;position:absolute;left:18px;top:10px;overflow:hidden;z-index:9;}
.main-im .qq-container{z-index:99;position:absolute;width:109px;height:118px;border-top-left-radius:10px;border-top-right-radius:10px;border-bottom:1px solid #dddddd;background:url(http://demo.lanrenzhijia.com/2015/service0119/images/qq-icon-bg.png) no-repeat center 8px;}
.main-im .img-qq{max-width:60px;display:block;position:absolute;left:6px;top:3px;-moz-transition:all 0.5s;-webkit-transition:all 0.5s;-o-transition:all 0.5s;transition:all 0.5s;}
.main-im .im-qq:hover .img-qq{max-width:70px;left:1px;top:8px;position:absolute;}
.main-im .im_main{background:#F9FAFB;border:1px solid #dddddd;border-radius:10px;background:#F9FAFB;display:none;}
.main-im .im_main .im-tel{color:#000000;text-align:center;width:109px;height:105px;border-bottom:1px solid #dddddd;}
.main-im .im_main .im-tel div{font-weight:bold;font-size:12px;margin-top:6px;}
.main-im .im_main .im-tel .tel-num{font-family:Arial;font-weight:bold;color:#e66d15;}
.main-im .im_main .im-tel:hover{background:#fafafa;}
.main-im .im_main .weixing-container{width:55px;height:47px;border-right:1px solid #dddddd;background:#f5f5f5;border-bottom-left-radius:10px;background:url(http://demo.lanrenzhijia.com/2015/service0119/images/weixing-icon.png) no-repeat center center;float:left;}
.main-im .im_main .weixing-show{width:112px;height:172px;background:#ffffff;border-radius:10px;border:1px solid #dddddd;position:absolute;left:-125px;top:-126px;}
.main-im .im_main .weixing-show .weixing-sanjiao{width:0;height:0;border-style:solid;border-color:transparent transparent transparent #ffffff;border-width:6px;left:112px;top:134px;position:absolute;z-index:2;}
.main-im .im_main .weixing-show .weixing-sanjiao-big{width:0;height:0;border-style:solid;border-color:transparent transparent transparent #dddddd;border-width:8px;left:112px;top:132px;position:absolute;}
.main-im .im_main .weixing-show .weixing-ma{width:104px;height:103px;padding-left:5px;padding-top:5px;}
.main-im .im_main .weixing-show .weixing-txt{position:absolute;top:110px;left:7px;width:100px;margin:0 auto;text-align:center;}
.main-im .im_main .go-top{width:50px;height:47px;background:#f5f5f5;border-bottom-right-radius:10px;background:url(http://demo.lanrenzhijia.com/2015/service0119/images/totop-icon.png) no-repeat center center;float:right;}
.main-im .im_main .go-top a{display:block;width:52px;height:47px;}
.main-im .close-im{position:absolute;right:10px;top:-12px;z-index:100;width:24px;height:24px;}
.main-im .close-im a{display:block;width:24px;height:24px;background:url(http://demo.lanrenzhijia.com/2015/service0119/images/close_im.png) no-repeat left top;}
.main-im .close-im a:hover{text-decoration:none;}
.main-im .open-im{cursor:pointer;margin-left:68px;width:40px;height:133px;background:url(http://demo.lanrenzhijia.com/2015/service0119/images/open_im.png) no-repeat left top;}
</style>
<div class="main-im">
	<div id="open_im" class="open-im">&nbsp;</div>  
	<div class="im_main" id="im_main">
		<div id="close_im" class="close-im"><a href="javascript:void(0);" title="点击关闭">&nbsp;</a></div>
		<a href="http://wpa.qq.com/msgrd?v=3&uin=800043692&site=qq&menu=yes" target="_blank" class="im-qq qq-a" title="在线QQ客服">
			<div class="qq-container"></div>
			<div class="qq-hover-c"><img class="img-qq" src="http://demo.lanrenzhijia.com/2015/service0119/images/qq.png"></div>
			<span> QQ在线咨询</span>
		</a>
		<div class="im-tel">
			<div>咨询电话一</div>
			<div class="tel-num">18801033475</div>
			<div>咨询电话二</div>
			<div class="tel-num">17001207779</div>
		</div>
		
	</div>
</div>
<script src="http://www.lanrenzhijia.com/ajaxjs/jquery.min.js"></script>
<script>
$(function(){
	$('#close_im').bind('click',function(){
		$('#main-im').css("height","0");
		$('#im_main').hide();
		$('#open_im').show();
	});
	$('#open_im').bind('click',function(e){
		$('#main-im').css("height","272");
		$('#im_main').show();
		$(this).hide();
	});
	$('.go-top').bind('click',function(){
		$(window).scrollTop(0);
	});
	$(".weixing-container").bind('mouseenter',function(){
		$('.weixing-show').show();
	})
	$(".weixing-container").bind('mouseleave',function(){        
		$('.weixing-show').hide();
	});
});
</script>
<!-- end-->
</body>
<script>
function flogin(){
	var mail = $("#floginmail").val();
	var pwd = $("#floginpwd").val();
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('user/user/ajax_login')?>",
		data: "mail="+mail+"&pwd="+pwd+"&_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			alert(info.message);
			window.location.href=window.location.href;
		}	
	});
}
$(document).ready(function(){
	$("#feedback").click(function(){
		$("#pop_feedback").show();
	});
	$("#popfeedback").click(function(){
		var mail = $(".feedbackmail").val();
		var info = $(".feedbackinfo").val();
		var mail_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/;
		var mail_reg = new RegExp(mail_reg);
		if(!mail_reg.test(mail)){
			alert('请填写正确的邮箱');
		}else{
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('sms/message/feedback')?>",
				data: "mail="+mail+"&info="+info+"&_r=" + Math.random(),
				success: function(msg){
					var info = eval("(" + msg + ")");
					alert(info.message);
					window.location.href=window.location.href;
				}	
			});
		}
	});
	$(".teacher").children(".teacher_info").each(function(){
		$(this).mouseover(function(){
			$(".teacher").children(".teacher_info").each(function(){
				$(this).children(".teacher_photo").removeClass("check_phone");	
				$(this).children(".teacher_name").removeClass("check_name");
				$(this).children(".teacher_photo").children("img").animate({width:"117px" , height:"117px"} , 0);
				$(this).children(".teacher_name").children(".teacher_desc").removeClass("check_desc");
			});
			$(this).children(".teacher_photo").addClass("check_phone");	
			$(this).children(".teacher_name").addClass("check_name");
			$(this).children(".teacher_photo").children("img").animate({width:"130px" , height:"131px"} , 0);
			$(this).children(".teacher_name").children(".teacher_desc").addClass("check_desc");
		});
		$(this).mouseout(function(){
			$(this).children(".teacher_photo").removeClass("check_phone");	
			$(this).children(".teacher_name").removeClass("check_name");
			$(this).children(".teacher_photo").children("img").animate({width:"117px" , height:"117px"} , 0);
			$(this).children(".teacher_name").children(".teacher_desc").removeClass("check_desc");
		});
	});
//轮播
	var $bigImg=$(".lunbo_img div");
	var i=0;
	var iNow=0;
	function tab(){
		for(i=0; i<$bigImg.length; i++){
			$bigImg.stop().animate({opacity:0}).removeClass("curr");
		}
		$bigImg.eq(iNow).stop().animate({opacity:1}).addClass("curr");
	}
	function turnNext(){
		iNow++;
		if(iNow>=$bigImg.length){
			iNow=0;	
		}
		tab();
	}
	function turnPrev(){
		iNow--;
		if(iNow==0){
			iNow=$bigImg.length-1;	
		}
		tab();
	}		
	var timer=setInterval(turnNext,3000);
	$(".left_button").click(function(){
		clearInterval(timer);
		turnPrev();
		timer=setInterval(turnNext,3000);
	});
	$(".right_button").click(function(){
		clearInterval(timer);
		turnNext();
		timer=setInterval(turnNext,3000);
	});

});
</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?7a524bf5f29267aec63a8b0f9dcc7fcf";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

</html>
