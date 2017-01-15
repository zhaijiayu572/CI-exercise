<head>
    <base href="<? echo site_url()?>">
    <meta charset="utf-8">
</head>
<body>
<?php
if(isset($_SESSION['uid'])){

}else{
    $a = $this->uri->segment(1);
    $b = $this->uri->segment(2);
    redirect("User/login/$a/$b");
}
?>
<form action="index.php/Blog/do_add_blog" method="post">
    标题:<input type="text" name="title">&nbsp;&nbsp;
    <select name="catalog" id="">
        <?php
            foreach ($catalog as $value){
                echo "<option value='$value->cid'>".$value->cname."</option>";
            }
        ?>
    </select>
    <a href="index.php/Blog/add_catalog">添加分类</a>
    <br>
    内容: <textarea name="content" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="发表">
</form>
</body>