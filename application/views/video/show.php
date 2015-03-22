<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/list.css" />
<div class="cmbody">
 <ol class="breadcrumb">
 当前位置：
  <li><a href="<?php echo site_url('home/index')?>">首页</a></li>
  <li class="active">视频</li>
</ol>
 </div>
<div class="cmbody">
	<div class="list">
		<div class="tag clearfix">
			<!--<div class="left ltat clearfix">
				<a href="<?php echo site_url('video/video/show')?>"><div
						class="left <?php if($type == 0){?>check<?php }?>">全部课程</div></a>
				<a
					href="<?php echo site_url('video/video/show' , array('type' => 1))?>"><div
						class="mr1 <?php if($type == 1){?>check<?php }?>"
						style="margin-left: 1px;">其他课程</div></a> <a
					href="<?php echo site_url('video/video/show' , array('type' => 2))?>"><div
						<?php if($type == 2){?> class="check" <?php }?>>其它推荐</div></a>
			</div>-->
            <?php
                    $category1=0;
                ?>
            <?php if(isset($_GET['category'])):?>
                <?php $category1 = 1;?>
            <?php endif;?>
            <?php if(isset($category)):?>
            <div class="left ltat clearfix">
                <a href="<?php echo site_url('video/video/show')?>">
                    <div style="width: 100px;" class="left
                    <?php if($category1 == 0){?>check<?php }?>
                     " >
                    全部课程
                    </div>
                </a>
                <?php
                    $type =0;
                ?>
                <?php if(isset($_GET['type'])):?>
                    <?php $type = $_GET['type'];?>
                <?php endif;?>
                <?php foreach($category as $key=>$v ):?>
                <a
                    href="<?php echo site_url('video/video/show', array('type' => $type,'category'=>$v['code']))?>">
                    <div
                        <?php if(isset($_GET['category']) and $v['code'] == $_GET['category']){?> class="check" <?php }?>>
                        <?php echo $v['name'] ?>
                    </div>
                </a>
                <?php endforeach;?>
            </div>
            <?endif;?>
		</div>
		<div class="info">
        	<?php if(!empty($list)){ foreach($list as $k => $v){?>
        	<div class="clearfix">
            	<?php if(!empty($v)){foreach($v as $vk => $vv){?>
            	<div class="vblock left">
					<div class="vimg">
						<a
							href="<?php echo site_url('video/video/info' , array('id' => $vv['id']));?>"><img
							src="<?php echo $vv['img'];?>" /></a>
					</div>
					<a
						href="<?php echo site_url('video/video/info' , array('id' => $vv['id']));?>"><div
							class="vtitle"><?php echo $vv['title'];?></div></a>
				</div>
                <?php }}?>
            </div>
            <?php }}?>
        </div>
		<div class="pagination">
			<?php echo $page ;?>
        </div>
	</div>
</div>
<script>
$(document).ready(function(){

});
</script>

<?php $this->load->view('public/footer.php');?>