<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/order.css" />
<div class="cmbody">
	<div class="mt40 order clearfix">
		<div class="left">
        	<?php $this->load->view('user/left.php');?>
        </div>
		<div class="content">
			<?php $this->load->view('user/user_info.php');?>
            <div class="orderList">
				<div class="title clearfix">
					<div style="text-align: center;">
                    	<?php
																					if (! empty ( $otype )) {
																						switch ($otype) {
																							case 2 :
																								echo '收藏的课程';
																								break;
																							case 4 :
																								echo '收藏的活动';
																								break;
																							case 5 :
																								echo '收藏的导师';
																								break;
																						}
																					} else {
																						echo '收藏的内容';
																					}
																					?>
                    </div>
				</div>
				<ul>
                	<?php if(!empty($info)){foreach($info as $k => $v){?>
                	<li style="height: 138px">
						<div class="clearfix info"
							style="height: 162px; line-height: 162px; text-align: center;">
							<div class="name" style="width: 610px; margin-right: 0px;">
								<div class="left productImg">
									<img src="/zmo/static/img/orderTmp.jpg" alt="" title="" />
								</div><?php echo $v['relation_title'];?>
                            </div>
							<div class="status">
								<a href="" class="btn">去查看</a>
							</div>
						</div>
					</li>
                    <?php }}else{?> 
					<li
						style="height: 38px; text-align: center; line-height: 38px; font-size: 18px;">
						没有相关内容</li>
					<?php } ?>
                </ul>
			</div>
			<!-- 分页开始 -->
			<!--div class="pagination">
                <a href="" class="prev">上一页</a>
                <a class="current" href="">1</a>
                <a href="">2</a>
                <a href="">3</a>
                <a href="">4</a>
                <a href="">5</a>
                <a href="">6</a>
                <span>...</span>
                <a href="">10</a>
                <a href="" class="next">下一页</a>
            </div-->
		</div>
	</div>
</div>
<script>
$(document).ready(function(){

})
</script>

<?php $this->load->view('public/footer.php');?>