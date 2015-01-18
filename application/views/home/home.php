<?php $this->load->view('public/header.php');?>
<div class="cmlunbo">
	<div class="lunbo_img">
		<div style="display: block">
			<img src="/zmo/static/tmp/banner1.jpg" />
		</div>
		<div>
			<img src="/zmo/static/tmp/banner2.jpg" />
		</div>
		<div>
			<img src="/zmo/static/tmp/banner3.jpg" />
		</div>
		<div>
			<img src="/zmo/static/tmp/banner4.jpg" />
		</div>
	</div>
	<div class="button clearfix">
		<div class="left_button"></div>
		<div class="right_button"></div>
	</div>
</div>
<div class="cmbody">
	<!---block start------>
	<div class="block">
		<div class="title clearfix">
			<div class="title_line"></div>
			<div class="title_text title1"></div>
			<div class="title_line"></div>
		</div>
		<div class="info">
            <?php $first = array_shift($lesson);?>
            <div class="bigimg">
				<a href="<?php echo site_url('lesson/lesson/info/'.$first['id'])?>"><div
						class="desc"></div></a>
			</div>
			<div class="imgtab clearfix">
                <?php if(!empty($lesson)){foreach($lesson as $k => $v){?>
                <div class="imgblock imgleft">
					<a href="<?php echo site_url('lesson/lesson/info/'.$v['id']);?>">
						<div class="tabimg">
                    <?php if(!empty($v['thumb'])){?>
                    <img src="<?php echo $v['thumb'];?>" />
                    <?php }else{?>
                    <img src="/zmo/static/tmp/news1.png" />
                    <?php }?>
                    </div>
						<div class="tabtitle clearfix">
							<div class="left number">第<?php echo $k + 1;?>期</div>
							<div class="left content_title"><?php echo $v['title'];?></div>
						</div>
					</a>
				</div>
                <?php }}?>
            </div>
		</div>
	</div>
	<!---block end---->
	<!---block start------>
	<div class="block">
		<div class="title clearfix">
			<div class="title_line"></div>
			<div class="title_text title2"></div>
			<div class="title_line"></div>
		</div>
		<div class="info">
			<div class="video_img clearfix">
				<?php if(!empty($video)){foreach($video as $k => $v){?>
                <div class="video <?php if($k == 1){ echo 'imglr';}?>">
					<div class="videoimg">
						<a
							href="<?php echo site_url('video/video/info' , array('id' => $v['id']))?>">
                        <?php if(false){//!empty($v['img'])?>
                        <img src="<?php echo $v['img'];?>" width="325px" />
                        <?php }else{?>
                        <img src="/zmo/static/tmp/video1.png" width="325px" />
                        <?php }?>
                        </a>
					</div>
					<div class="videoname"><?php echo $v['title'];?></div>
				</div>
                <?php }}?>
            </div>
		</div>
	</div>
	<!----block end---->

	<!---block start------>
	<div class="block">
		<div class="title clearfix">
			<div class="title_line"></div>
			<div class="title_text title3"></div>
			<div class="title_line"></div>
		</div>
		<div class="active clearfix">
			<div class="active_block acitve_relative">
				<div>
					<img src="/zmo/static/tmp/active1.png" width="325px;" />
				</div>
				<div class="active_info">
					<div class="active_title">北京青年创业大讲堂</div>
					<div class="active_desc">
						<span class="active_tag">沙龙</span> 10月31日 14：00-16：00
					</div>
				</div>
			</div>
			<div class="active_block clearfix activelr">
				<div class="acitve_relative">
					<img src="/zmo/static/tmp/active2.png" width="325px;" />
					<div class="active_info">
						<div class="active_title">Binggo公开课</div>
						<div class="active_desc">
							<span class="active_tag">沙龙</span> 10月31日 14：00-16：00
						</div>
					</div>
				</div>
				<div style="margin-top: 2px;" class="acitve_relative">
					<img src="/zmo/static/tmp/active3.png" width="325px;" />
					<div class="active_info">
						<div class="active_title">Binggo科学家来了</div>
						<div class="active_desc">
							<span class="active_tag">分享</span> 10月31日 14：00-16：00
						</div>
					</div>
				</div>
			</div>
			<div class="active_block acitve_relative">
				<div>
					<img src="/zmo/static/tmp/active4.png" width="325px;" />
				</div>
				<div class="active_info">
					<div class="active_title">周五公开课</div>
					<div class="active_desc">
						<span class="active_tag">沙龙</span> 10月31日 14：00-16：00
					</div>
				</div>
			</div>
		</div>
	</div>
	<!----block end---->
	<!---block start------>
	<div class="block">
		<div class="title clearfix">
			<div class="title_line"></div>
			<div class="title_text title4"></div>
			<div class="title_line"></div>
		</div>
		<div class="teacher clearfix">
            <?php if(!empty($teacher)){foreach($teacher as $k=> $v){?>
            <div class="teacher_info">
				<div class="teacher_photo">
					<a href="<?php echo site_url('teacher/teacher/info/'.$v['id']);?>"><img
						src="<?php echo $v['portrait'];?>" width="250" height="225" /></a>
					<span></span>
				</div>
				<div class="teacher_name">
					<div><?php echo $v['name'];?></div>
					<div class="teacher_desc"><?php echo $v['occ'];?></div>
				</div>
			</div>
            <?php }}?>
        </div>
	</div>
	<!----block end---->
	<!---block start------>
	<div class="block">
		<div class="title clearfix">
			<div class="title_line"></div>
			<div class="title_text title5"></div>
			<div class="title_line"></div>
		</div>
		<div class="newinfo clearfix">
            <?php if(!empty($news)){foreach($news as $k => $v){?>
            <div class="newinfo_block">
				<div class="newinfo_img">
                <?php if(!empty($v['img'])){?>
                <img src="<?php echo $v['img'];?>" />
                <?php }else{?>
                <img src="tmp/newinfo1.png" />
                <?php }?>
                </div>
				<div class="newinfo_title"><?php echo $v['title'] ;?></div>
				<div class="newinfo_border"></div>
				<div class="newinfo_desc">
					<p><?php echo $v['desc'];?></p>
				</div>
				<div class="newinfo_us">BY<?php echo $v['author'] . ' '. date('m.d H:i' , $v['ctime']);?></div>
				<a href="<?php echo site_url('news/news/info/'.$v['id']);?>"
					class="more">查看详情&gt;&gt;</a>
			</div>
            <?php }}?>
        </div>
	</div>
	<!----block end---->
	<!---bg img---->
</div>
<?php $this->load->view('public/footer.php');?>
<script>
</script>