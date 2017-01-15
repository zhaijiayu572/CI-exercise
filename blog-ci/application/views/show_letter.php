<head>
    <meta charset="utf-8">
    <base href="<?php echo site_url()?>">
</head>
<body>
    <?php
        foreach ($result as $value){
            ?>
            <p>发件人:<?php echo $value->uname?></p>
            <p><?php echo $value->scontent?></p>
    <?php
        }
    ?>
</body>