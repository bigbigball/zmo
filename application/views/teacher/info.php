<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<div class="cmbody">
	<div class="clearfix mt40 ">
		<img src="/<?php echo $info['portrait'];?>" title="" alt=""
			class="left mr40" />
		<div>
			<p class="f24 mb20"><?php echo $info['name']?></p>
			<p class="f16 mb20">简介：<?php echo $info['occupation'];?></p>
			<p class="f16 mb30" style="height: 115px;"><?php echo $info['desc'];?></p>
			<div class="btn-box">
				<input type="hidden" value="<?php echo $info['id'];?>" id="tid" />
                <?php if($is_collect){?>
                <a
					style="color: #000; font-size: 20px; margin-top: 50px; display: block;">已收藏</a>
                <?php }else{?>
                <a href="javascript:void(0);" class="btn"
					style="margin-top: 15px;" onclick="collection('4');">收藏</a>
                <?php }?>
            </div>
		</div>
	</div>
	<div class="item-title mt60">
		<div class="title">
			<h2>课程介绍</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<div class="introduction">
    	<?php if(!empty($info['lesson'])){foreach($info['lesson'] as $k => $v){?>
    	<div class="introduction_block clearfix introduction_line">
			<div class="left ibimg">
				<div>
					<img src="/zmo/static/tmp/list.png" />
				</div>
				<div class="ibimg_tag">视频课程</div>
			</div>
			<div class="left iinfo">
				<div class="ititle"><?php echo $v['title'];?></div>
				<div class="iteachter mt20">导师：<?php echo $info['name'];?></div>
				<div class="ctag clearfix mt10">
					<div class="left">标签：</div>
                    <?php $tags = explode('|' , $v['tag']);if(!empty($tags)){foreach($tags as $tk => $tv){?>
                    <div class="left ctags"><?php echo $tv;?></div>
                    <?php }}?>
                </div>
				<div class="idesc mt15">
                课程简介：<?php echo $v['desc']?>
                </div>
				<div class="iprice mt10">
					价格：<span class="price"><?php if($v['is_price'] == 1){ echo $v['price'];}else{echo '免费';}?></span>
				</div>
				<div class="clearfix">
					<div class="ibutton mt15 left">
						<a href="javascrript:void(0);">播放</a>
					</div>
				</div>
			</div>
		</div>
        <?php }}?>
    </div>

	<div class="item-title mt60">
		<div class="title">
			<h2>相关资讯</h2>
			<div>INTRODUCTION</div>
		</div>
	</div>
	<div class="introduction">
    	<?php if(!empty($info['news'])){foreach($info['news'] as $k => $v){?>
    	<div class="introduction_block clearfix">
			<div class="left ibimg">
				<div>
					<img src="/zmo/static/tmp/news_list1.png" />
				</div>
			</div>
			<div class="left iinfo">
				<div class="ititle"><?php echo $v['title']?></div>
				<div class="idesc mt15">
                <?php echo $v['desc'];?>[详细]
                </div>
				<div class="iprice mt10">
					<span class="price">By<?php echo $v['author']?></span><span
						class="ml10"><?php echo date('Y年m月d日 H:i',$v['ntime'])?></span><span
						class="ml10">阅读(<?php echo $v['rnum']?>)</span>
				</div>
			</div>
		</div>
        <?php }}?>
    </div>
</div>

<script>
function collection(type){
	tid = $("#tid").val();
	if(!tid){
		alert('您没有选择要收藏的老师');	
	}
	if(!type){
		alert('参数错误，请刷新页面');	
	}
	if(tid && type){
		$.ajax({
			type: "POST",
		    url: "<?php echo site_url('collection/collect')?>",
		    data: "type=" + type + "&id=" + tid,
		    success: function(msg){
			  var info = eval("(" + msg + ")");
			  alert(info.msg);
			 window.location.reload();
		    }	
		});	
	}
}
$(document).ready(function(){
	$(".ltat div").each(function(){
		$(this).click(function(){
			$(".ltat div").each(function(){$(this).removeClass('check');});
			$(this).addClass('check');
		});
	});
	$(".rtag div").each(function(){
		$(this).click(function(){
			$(".rtag div").each(function(){$(this).removeClass('check');});
			$(this).addClass('check');	
		});	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>