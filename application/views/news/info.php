<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<div class="cmbody">
	<div class="newsInfo">
		<h4><?php echo $info['title'];?></h4>
		<p class="time"><?php echo date('Y年m月d日' , $info['ctime']);?>&emsp;by：<?php echo $info['author'];?></p>
		<div class="conBox">
			<img src="/zmo/static/img/newsImg.jpg" />
			<?php echo $info['content'];?>
		</div>
	</div>
</div>
<script>
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