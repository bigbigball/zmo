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
            <input type="submit" value="上传头像" style="padding: 1px 6px;" /></a>
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
            <?php if($user_info['occu'] ){?>
                <p>职业：<?php echo $user_info['occu']?></p>
            <?php }else{?>
                <p>职业：自由职业</p>
            <?php }?>
        <?php }?>
    </div>
</div>
