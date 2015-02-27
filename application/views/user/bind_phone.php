<div class="bindPhone">
	<div class="detail-title mb60">
		<span> 绑定手机 </span>
	</div>
	<?php if(empty($user_info['mobile'])){?> 
        <form action="<?php echo site_url('user/user/do_bind_phone');?>"
            method="post" enctype="multipart/form-data" id="post_form">
            <p class="f24 mb30">请输入您的手机号码：</p>
            <div class="mb25">
                <input type="text" placeholder="手机号" class="input-text phone" name="mobile"/>
            </div>
            <div class="mb35">
                <input type="text" placeholder="验证码" class="input-text code" name="code"/> 
                <a href="javascript:void(0);" class="input-text codeNumber">获取验证码</a>
            </div>
            <input type="button" class="input-text submit" value="开始绑定" />
        </form>
    <?php } else {?>
	<div>
        您已绑定手机 <?php echo $user_info['mobile'];?> 
    </div>
    <?php }?>
</div>
<script>
$(document).ready(function(){
	$(".codeNumber").click(function(){
		var phone = $(".phone").val();
		phone_reg = /^1[3,5,7,8]\d{9}$/;
		phone_re = new RegExp(phone_reg);
		if(phone_re.test(phone)){
			$.ajax({
				type: "POST",
				url: "<?php echo site_url('pf/send_phone_code');?>",
				data: "phone=" + phone + "&_r=" + Math.random(),
				success: function(msg){
					var info = eval("(" + msg + ")");
					switch(info.ret){
						case 200:
							alert('请您接受验证码短信');
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
			alert('请输入正确的手机号');	
		}
	});

	$(".submit").click(function(){
		var phone = $(".phone").val();
		phone_reg = /^1[3,5,7,8]\d{9}$/;
		phone_re = new RegExp(phone_reg);
		if(!phone_re.test(phone)){
			alert('请填写正确的手机号码');	
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
