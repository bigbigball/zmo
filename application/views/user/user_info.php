<div class="userInfo clearfix">
    <div class="avastar">
        <?php if(!empty($user_info)){?>
            <?php if($user_info['from'] == 1){?>
                <img
                    src="http://tb.himg.baidu.com/sys/portrait/item/<?php echo $user_info['portrait'];?>"
                    alt="" title="" height="154px" width="187px;" />
            <?php }else{?>
                <?php if($user_info['photo'] ){?>
                    <img height="154px" width="187px;" src="http://zmoclub.com/<?php echo $user_info['photo'];?>" alt="" title="" />
                <?php }else{?>
                    <img src="/zmo/static/img/avastarTmp.jpg" alt="" title="" />
                <?php }?>
            <?php }?>
        <?php }else{?>
            <img src="/zmo/static/img/avastarTmp.jpg" alt="" title="" />
        <?php }?>
        <form role="form" id="local_form" method="post" enctype="multipart/form-data" action="<?php echo site_url('user/user/order')?>">
        <div class="shadow"></div>
            <a href="" class="uploadBtn" style="background: #333333;width: 100%;height: 37px;"><input type="file" style="padding-left: 45px;color: #333;width: 60%;" value=" " name="uploadAvatar"  />
                <?php if($user_info['photo'] ){?>
                <input type="submit" value="修改头像" style="padding: 1px 6px;" /></a>
            <?php }else{?>
                <input type="submit" value="上传头像" style="padding: 1px 6px;" /></a>
            <?php }?>
        </form>
    </div>
    <div class="info">
        <?php if(!empty($user_info)){?>
            <?php if($user_info['nick_name'] ){?>
                <h2><?php echo $user_info['nick_name'];?></h2>
            <?php }else{?>
                <?php if($user_info['email'] ){?>
                    <h2><?php echo $user_info['email'];?></h2>
                <?php }else{?>
                    <h2><?php echo $user_info['mobile'];?></h2>
                <?php }?>
            <?php }?>
            <?php if($user_info['year']==0 ){?>
                <p>会员：普通会员 <a href="/index.php/user/user/buy_year"  style="font-size: 18px;padding: 5px;
margin-bottom: 20px;
font-weight: normal;text-align: center;width:55%;background: #01a8ee;color: #fff;">升级年费会员</a></p>
            <?php }else{?>
                <p style="font-size: 18px;padding: 5px;
margin-bottom: 20px;text-align: center;width:55%;
font-weight: normal;background: #01a8ee;color: #fff;" >会员：尊贵会员</p>
            <?php }?>
        <?php }?>
    </div>
</div>
