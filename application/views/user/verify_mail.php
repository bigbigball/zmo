<div class="emailValidate">
	<div class="detail-title mb60">
		<span> 绑定邮箱 </span>
	</div>
	<?php if(empty($user_info['email'])){?> 
        <form action="<?php echo site_url('user/user/do_verify_mail');?>"
            method="post" enctype="multipart/form-data" id="post_form">
            <p class="f24 mb30">请输入您的邮箱：</p>
            <div class="mb25">
                <input type="text" placeholder="邮箱地址" class="input-text emailBox" name="email"/>
            </div>
            <div class="mb35">
                <input type="text" placeholder="验证码" class="input-text code" name="code"/> 
                <a href="javascript:void(0);" class="input-text codeNumber">获取验证码</a>
            </div>
            <input type="button" class="input-text submit" value="开始绑定" />
	    </form>
    <?php } else {?>
	<div>
        您已绑定邮箱 <?php echo $user_info['email'];?> 
    </div>
    <?php }?>
</div>
<script>
$(document).ready(function(){
	$(".codeNumber").click(function(){
		var email = $(".emailBox").val();
		var email_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/; ;
		var email_reg = new RegExp(email_reg);  
		if(email_reg.test(email)){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('pf/send_email_code');?>",
				data: "email=" + email + "&_r=" + Math.random(),
				success: function(msg){
					var info = eval("(" + msg + ")");
					switch(info.ret){
						case 200:
							alert('请您接受验证码邮件');
							break;
						case 400:
							alert('参数错误');
							break;
						case 500:
							alert('发送失败，请重新发送');
							break;	
					}
				}
			});
		}else{
			alert('请输入正确的邮箱地址');	
		}
	});

	$(".submit").click(function(){
		var email = $(".emailBox").val();
		var email_reg = /^[-,_,A-Z,a-z,0-9]+@([_,A-Z,a-z,0-9]+\.)+[A-Za-z0-9]{2,3}$/; ;
		var email_reg = new RegExp(email_reg);  
		if(!email_reg.test(email)){
			alert('请填写邮箱帐号');
			return false;
        }

		var code = $(".code").val();
		if(code == '' || code == null || code =="验证码" ){
			alert('请填写验证码');
			return false;
		}

	    $("#post_form").submit();
	});
});
</script>
