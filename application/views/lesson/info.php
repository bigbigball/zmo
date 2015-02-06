<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<script>
function sign_up(){
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('user/user/is_login')?>",
		data: "_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			if(info.ret != 200){
				alert(info.msg);	
			}else{
				$("#post_form").submit();	
			}
		}	
	});	
}
</script>

<div class="cmbody">
	<div class="clearfix mt40 ">
		<form action="<?php echo site_url('buy/sign_up');?>" method="post"
			enctype="multipart/form-data" id="post_form">
			<div class="left" style="width: 585px;">
				<p class="f24 mb20"><?php echo $info['title'];?></p>
				<p class="f16 mb20">导师：<?php if(!empty($info['tutor'])){echo $info['tutor']['name'];}?></p>
				<p class="f16 mb20">
					价格：<span class="price"><?php if($info['is_price'] == 0){ echo '免费';}else{echo $info['price'];}?></span>
				</p>
				<p class="f16 mb20">时间：<?php echo date('m月d日' , $info['stime']);?>
                	（<?php
																	
switch (date ( 'w', $info ['stime'] )) {
																		case '0' :
																			echo '周日';
																			break;
																		case '1' :
																			echo '周一';
																			break;
																		case '2' :
																			echo '周二';
																			break;
																		case '3' :
																			echo '周三';
																			break;
																		case '4' :
																			echo '周四';
																			break;
																		case '5' :
																			echo '周五';
																			break;
																		case '6' :
																			echo '周六';
																			break;
																	}
																	?>）&nbsp;-&nbsp;<?php echo date('m月d日' , $info['etime']);?>
                    （<?php
																				
switch (date ( 'w', $info ['etime'] )) {
																					case '0' :
																						echo '周日';
																						break;
																					case '1' :
																						echo '周一';
																						break;
																					case '2' :
																						echo '周二';
																						break;
																					case '3' :
																						echo '周三';
																						break;
																					case '4' :
																						echo '周四';
																						break;
																					case '5' :
																						echo '周五';
																						break;
																					case '6' :
																						echo '周六';
																						break;
																				}
																				?>）
                </p>
				<p class="f16 mb20">地址：<?php echo $info['address'];?></p>
				<div class="btn-box">
					<input type="hidden" name="id" value="<?php echo $info['id'];?>" />
					<input type="hidden" name="type" value="2">
                    <?php if($is_join){echo '<span style="font-size:18px;">您已经报名</span>';}else{?>
                    <a href="javascript:void(0);" class="btn"
						onclick="sign_up();">报名</a>
                    <?php }?>
                </div>
			</div>
		</form>
		<img src="/zmo/static/tmp/list.png" title="" alt="" class="right ml40" />
	</div>
    <?php if(!empty($info['tutor'])){?>
	<div class="item-title mt60">
		<div class="title">
			<h2>讲师简介</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<div class="clearfix" style="margin-top: 80px;">
		<img src="<?php echo $info['tutor']['portrait'];?>" title="" alt=""
			class="left mr40" />
		<div>
			<p class="f24 mb20"><?php echo $info['tutor']['name'];?></p>
			<p class="f16 mb20">简介：<?php echo $info['tutor']['occupation'];?></p>
			<p class="f16 mb30"
				style="height: 115px; color: #666666; line-height: 26px;"><?php echo $info['tutor']['desc']?></p>
		</div>
	</div>
    <?php }?>
    <div class="item-title mt60">
		<div class="title">
			<h2>课程简介</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<div class="class_content" style="margin-top: 80px;">
    	<?php echo $info['content'];?>
    </div>
	<div class="item-title mt60">
		<div class="title">
			<h2>学员反馈</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<!--评论-->
	<div class="comment" style="margin-top: 80px;">
		<textarea id="comment">不吐不快</textarea>
		<p class="btn_box">
        	<?php if(!empty($_SESSION['uid'])){?>
        	<span>赶紧留下您独特的建议或想法吧~</span>
			<?php }else{?>
            <span>登录之后才能评论哦~</span>
            <?php }?>
            <input type="button" class="input-text" value="发表"
				onclick="comment_submit();">
		</p>
		<ul class="news_comment_user">
		</ul>
		<strong class="bot" id="news_comment_more">展开查看全部</strong>
	</div>
	<!--评论-->
</div>
<script>
function comment_submit(){
	var comment_val = $("#comment").val();
	if(comment_val && comment_val != '不吐不快'){
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('comment/do_comment')?>",
			data: "comment=" + comment_val +"&id=<?php echo $info['id'];?>&type=2&_r=" + Math.random(),
			success: function(msg){
				var info = eval("(" + msg + ")");
				if(info.ret != 200){
					alert(info.msg);	
				}else{
					alert(info.msg);
					flush_comment();
				}
			}	
		});	
	}else{
		alert('请填写评论内容');	
	}
}

function flush_comment(p = 0){
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('comment/get_comment')?>",
		data: "id=<?php echo $info['id'];?>&type=2&page="+p+"&_r=" + Math.random(),
		success: function(msg){
			var info = eval("(" + msg + ")");
			if(info.ret == 200){
				if(info.info.list.length > 0){
					var html ='';					 
					for(i = 0 ; i < info.info.list.length ; i ++){
						html += '<li>';
							html +='<img src="'+info.info.user_info[info.info.list[i].user_id].photo+'"/>';
                			html += '<div class="comment_word">';
                    		html += '<span>'+info.info.user_info[info.info.list[i].user_id].nick_name+'</span>';
                    		html += '<p>'+info.info.list[i].content+'</p>';
                			html += '</div>';
                			html += '<span class="date">'+info.info.list[i].ctime;+'</span>';
						html += '</li>';	
					}
					$(".news_comment_user").html(html);
				}	
			}else{
				if(p != 0){
					alert(info.msg);
				}
			}
		}	
	});		
}
$(document).ready(function(){
	var page = 0 ;
	$("#comment").focus(function(){
		$(this).html('');	
	}).blur(function(){
			
	});
	flush_comment();
	$("#news_comment_more").click(function(){
		page ++ ;
		flush_comment(page);	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>
