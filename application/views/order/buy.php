<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 orderSure">
		<div class="clearfix">
			<a href="" class="right link">支付遇到问题？</a>
			<div class="procedure clearfix">
				<div class=" step step1 active">确认订单</div>
				<div class=" step step2">在线支付</div>
				<div class=" step step2">支付完成</div>
			</div>
		</div>
		<form action="<?php echo site_url('order/order/pay')?>" method="post"
			enctype="multipart/form-data" id="post_form">
			<div class="orderContent mt50">
				<div class="title" style="margin-bottom: 10px;"><?php echo $goods['title']?></div>
            <?php if(!empty($goods['tutor'])){?>
                <?php foreach($goods['tutor'] as $key =>$val): ?>
            <div class="subTitle" style="margin-top: 10px;">导师：<?php echo $val['name'];?></div>
                    <?php endforeach; ?>
            <?php }?>
            <?php if($order['info']['type'] != 5){?>
                <div class="title" style="margin-top: 10px;margin-bottom: 8px;">课程简介</div>
            <?php }?>
            <?php if(!empty($goods['desc'])){?>
            <div class="content "><?php echo $goods['desc'];?></div>
            <?php }?>
				<div class="price">
                    价格：<span class=" f40 blue"><?php echo $order['info']['price'];?>元</span>
				</div>
				<div class="btn-box">
					<input type="hidden" value="<?php echo $order['info']['oid'];?>"
						name="oid" /> <a href="javascript:void(0);" class="btn">提交订单</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".btn").click(function(){
		$("#post_form").submit();	
	});
});
</script>

<?php $this->load->view('public/footer.php');?>