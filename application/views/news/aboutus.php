<?php $this->load->view('public/header.php');?>
<link rel="stylesheet" type="text/css" href="/zmo/static/style/detail.css" />
<script src="/zmo/static/js/basic.js"></script>
<div class="cmbody">
	<div class="clearfix mt40">
		<div class="leftBanner tab">
			<a href="javascript:;" rel="1-1"
               <?php if(!isset($_GET['join'])):?>
               class="curr"
                <?php endif;?>
                >关于知家</a>
            <a href="javascript:;" rel="1-2"
                <?php if(isset($_GET['join'])):?>
                    class="curr"
                <?php endif;?>
                >加入我们</a>
            <a href="javascript:;" rel="1-3"
                >关于ZMO联盟</a>
		</div>
		<div class="about_rt">
			<div id="1-1" class="about_con"
                <?php if(!isset($_GET['join'])){?>
                 style="display: block"
                <?php }else{?>
                    style="display: none"
                <?php }?>
                 >
				<h4>知家</h4>
				<p>知家，面向未来，弘扬创客精神，研究创客基因，链接创客与传统企业，帮助企业成功转型。</p>
				
			</div>
			<div id="1-2" class="about_con"
                <?php if(isset($_GET['join'])):?>
                    style="display: block"
                <?php endif;?>
                >
				<h4>加入我们</h4>
				<p>自媒体时代，各种不同的声音来自四面八方，“主流媒体”的声音逐渐变弱，人们不再接受被一个“统一的声音”告知对或错，每一个人都在从独立获得的资讯中，对事物做出判断。</p>
				<p>自媒体有别于由专业媒体机构主导的信息传播，它是由普通大众主导的信息传播活动，由传统的“点到面”的传播，转化为“点到点”的一种对等的传播概念。同时，它也是指为个体提供信息生产、积累、共享、传播内容兼具私密性和公开性的信息传播方式。</p>
				<p>早在上个世纪，著名传播学家麦克卢汉就提出过“媒介即讯息”的相似理论。其含义是：媒介本身才是真正有意义的讯息，即人类只有在拥有了某种媒介之后才有可能从事与之相适应的传播和其他社会活动。媒介最重要的作用就是“影响了我们理解和思考的习惯”。因此对于社会来说，真正有意义、有价值的“讯息”不是各个时代的媒体所传播的内容，而是这个时代所使用的传播工具的性质、它所开创的可能性以及带来的社会变革。</p>
				<p>表现渠道论坛、博客、微博、微信以及新兴的视频网站构成了自媒体现存的主要表达渠道，然而随着个人用户对互联网的深度使用，以阔地网络为代表的个人门户类网站将成为自媒体的新兴载体。理由在于：</p>
				<p>体中，因此个人门户理所当然地将成为自媒体的最佳表达途径。</p>
			</div>
			<div id="1-3" class="about_con">
				<h4>关于ZMO联盟</h4>
				<p>ZMO联盟，是专为企业自媒体人定制的社群组织，以帮助企业完善自媒体渠道建设、培养自媒体运营人才、优化自媒体传播策略、整合企业自媒体资源为己任，使其成为传统企业互联网转型的第一站。 
</p>
				<p>ZMO联盟就是由各行各业中具有互联网思维的企业家、经理人、投资人、互联网研究专家、媒体大咖和创业达人组成的圈子。这里面有各个行业中的“大象”，亦有新生代的“蚂蚁”，在这个圈子里，大家可以互相学习，互为老师。 
自媒体运营最重要的部分就是与别人进行合作，资源共享。ZMO联盟就是一个属于自媒体人的圈子，并且通过线下课堂、线上分享、沙龙活动、个案辅导等多种形式为会员提供多方面的分享，只为把自媒体人聚集在一起，让大家“抱团取暖”。</p>
				<p>ZMO联盟会员成长计划</p>
				<p>O2O实战训练 
行业名师联手打造国际一流的实战训练，快速复制人才。 
每周大咖分享 
每周邀请一位企业自媒体大咖进行经验分享与交流。 
账号评估分析 
对企业自媒体运营能力进行评估和监控，实施个性辅导。 
行业发展报告 
每周分析全网数据，形成行业报告，为企业提供决策依据。 
资源整合互换 
账号互推，粉丝交换，最大化资源整合，更好服务企业社群。 
扩大组织边界 
去中心，横向连接，组织联动，协同工作，提高效率，实现价值。</p>
				<p>ZMO导师团  <br/>
陆小华 中国政法大学新闻与传播学院院长 <br/>
刘东明 腾讯智慧营销研究院首批专家  <br/>
徐志斌 畅销书《社交红利》作者，专注互联网与创业领域  <br/>
项建标 国内创业投资领域著名自媒体“B座12楼”发起人  <br/>
徐 杨 微播易CEO  <br/>
申 晨 熊猫自媒体联盟发起人、知名媒体评论人  <br/>
肖明超 资深消费者行为与趋势专家，商业趋势观察家  <br/>
梁洪军 凤巢社创始人、社长  <br/>
高雄勇 一个在传统企业的互联网人  <br/>
段博惠 Binggo咖啡合伙人，中国私董会主持人资深导师  <br/>
郑 重 资深传媒人，实效传播专  <br/>
孔剑平 社群经济研究院发起人  <br/>
黄 欢 上海欢欢邦信息科技有限公司CEO  <br/>
潘定国 五格货栈创始人、传统ERP行业十年创业经历  <br/>
陈良红 6628运动社交平台发起人、同道会董事长  <br/>
金 奎 淘宝大学讲师，原麦包包淘宝运营产品经理  <br/>
刘函瑜 北京千寻尚艺科技公司创始人  <br/>
刘志霞 资深微博运营官、新浪媒体微博负责人  <br/>
李博炜 京东金融集团新媒体主管</p>
			</div>
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