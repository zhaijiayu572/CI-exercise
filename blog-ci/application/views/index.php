<meta charset="utf-8">
<base href="<?php echo site_url()?>">
<link rel="stylesheet" href="resource/css/index.css">
<script src="resource/js/jquery-1.9.1.min.js"></script>
<body>
<form id="search-box" method="get" action="index.php/Blog/search">
    <input type="text" name="keyword">
    <input type="submit" name="sub" value="搜索">
</form>
<?php
    if(isset($_SESSION['uid'])){
        $uid = $this->session->uid;
        $uname = $this->session->uname;
        if(isset($result)){
            ?>
            <div id="wel-box">
                <p>欢迎,<?php echo $uname?></p>
            </div>
            <?php
            foreach ($result as $value){
                ?>
                <div class="blog">
                    <h3><a href="#"><?php echo $value->title?></a></h3>
                    <span>作者:<?php echo $value->uname?></span><span>时间:<?php echo $value->time?></span>
                    <p><?php echo $value->content?></p>
                    <hr>
                </div>


<?php
            }
        }else{
            echo "error";
            echo "<script>location='".site_url('User/index')."'</script>";
        }
    }else{
        header("location:".site_url()."/User/login");
    }
?>
</body>

