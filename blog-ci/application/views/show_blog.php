<head>
    <base href="<?php echo site_url()?>">
    <meta charset="utf-8">
    <link rel="stylesheet" href="resource/css/show_blog.css">
</head>
<body>
    <div id="return-button">
        <a href="index.php/Blog/index">回到首页</a>
    </div>
    <?php
    ?>
    <div id="content">
        <a href="index.php/Sixin/letter/<?php echo $result[0]->uid?>">私信</a>
        <h3><?php echo $result[0]->title?></h3><a href="index.php/Sixin/letter/<?php echo $result[0]->uid?>/"></a>
        <p><span>作者:<?php echo $result[0]->uname?></span><span>时间:<?php echo $result[0]->time?></span></p>
        <p>访问次数:<?php echo $result[0]->hits?></p>
        <p><?php echo $result[0]->content?></p>
    </div>
    <div id="show_comment">
        <?php
            foreach ($comment as $value){
                ?>
                <p>用户:<?php echo $value->uname?></p>
                <p>时间:<?php echo $value->ptime?></p>
                <p><?php echo $value->pcon?></p>
                <a href="index.php/Comment/reply/<?php echo $value->pid?>/<?php echo $result[0]->wid?>">回复</a>

        <?php
            }
        ?>
    </div>
    <form action="index.php/Blog/do_comment" method="post" id="do_comment">
        <input type="hidden" name="wid" value="<?php echo $result[0]->wid?>">
        <textarea name="pconent" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="评论">
    </form>
</body>
