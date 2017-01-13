<base href="<?php echo site_url()?>/">
<meta charset="utf-8">
<link rel="stylesheet" href="../resource/css/reg.css">
<script src="../resource/js/jquery-1.9.1.min.js"></script>
<script>
    $(function () {
        $('#user').on('blur',function () {


            var name = $(this).val();
            $.post("<?php echo site_url('User/checkname')?>",{name:name},function (data) {
                if(data=='success'){
                    $('#user').after($('<span>用户名已存在</span>'));
                }

            })
        })
    })
</script>
<form action="User/do_reg" method="post" id="reg">
    用户名: <input type="text" name="user" id="user"><br>
    密码: <input type="password" name="pass">
    <input type="submit" name="sub">
</form>