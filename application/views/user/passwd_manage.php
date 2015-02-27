<div class="passwordEdit">
	<form action="<?php echo site_url('user/user/do_passwd_manage')?>"
		method="post" enctype="multipart/form-data" id="post_form">
		<div class="detail-title mb60">
			<span>修改密码</span>
		</div>
	    <p class="f24 mb30">请输入您的密码：</p>
	    <div class="mb25">
			<input type="password" class="input-text password old_pwd" placeholder="当前密码" name="old_pwd"/> 
        </div>
	    <div class="mb25">
			<input type="password" class="input-text password pwd" placeholder="新密码" name="pwd"/> 
        </div>
	    <div class="mb35">
			<input type="password" class="input-text password ver_pwd" placeholder="确认密码" name="ver_pwd"/> 
		</div>
		<input type="button" class="input-text submit" value="确定" />
	</form>
</div>
<script type="text/javascript" src="/zmo/static/js/passwordEdit.js"></script>
<script>

$(document).ready(function(){
	$(".code").click(function(){
		alert('已发送验证码，请注意查收');
	});
	$(".submit").click(function(){
		var old_pwd = $(".old_pwd").val();
		if(old_pwd == '' || old_pwd == null || old_pwd =="当前密码" ){
			alert('请填写当前密码');
			return false;
		}
		
		var pwd = $(".pwd").val();
		if(pwd == '' || pwd == null || pwd =="新密码" ){
			alert('请填写新密码');
			return false;
		}
		
		var ver_pwd = $(".ver_pwd").val();
		if(ver_pwd == '' || ver_pwd == null || ver_pwd =="确认密码" ){
			alert('请填写确认密码');
			return false;
		}
				
		if(pwd != ver_pwd ){
			alert('两次输入密码不一致');
			return false;
		}
		
		$("#post_form").submit();	
	});	
});
</script>
