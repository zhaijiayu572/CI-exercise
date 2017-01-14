<base href="<?php echo site_url()?>">
<meta charset="utf-8">
<link rel="stylesheet" href="resource/css/reg.css">
<script src="resource/js/jquery-1.9.1.min.js"></script>
<script>
    $(function () {
        $('#user').on('blur',function () {
            var name = $(this).val().trim();
            alert(name);
            $.post("<?php echo site_url('User/checkname')?>",{name:name},function (data) {
                if(data=='success'){
                    $('#user').after($('<span id="s0">用户名已存在</span>'));
                }

            },'text')
        }).on('focus',function () {
            $('#s0').remove();
        });
        $pass = $('#reg input').eq(1);
        $repass = $('#reg input').eq(2);
        $repass.on('blur',function () {
            if($pass.val()!=$repass.val()){
                $repass.after($('<span id="s1">两次密码不一致</span>'));
            }
        });
        $repass.on('focus',function () {
            $('#s1').remove();
        })
    })
</script>
<form action="index.php/User/do_reg" method="post" id="reg">
    用户名: <input type="text" name="user" id="user"><br>
    密码: <input type="password" name="pass"><br>
    重复密码: <input type="password" name="repass">
    <input type="submit" name="sub">
</form>