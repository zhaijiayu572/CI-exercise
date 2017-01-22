<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="zh-CN" xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="Content-Language" content="zh-CN">
    <base href="<?php echo site_url()?>"/>
  <title>已发送留言 Johnny的博客 - SYSIT个人博客</title>
      <link rel="stylesheet" href="assets/css/space2011.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.css" media="screen">
  <script type="text/javascript" src="assets/js/jquery-1.js"></script>
  <script type="text/javascript" src="assets/js/jquery.js"></script>
  <script type="text/javascript" src="assets/js/jquery_002.js"></script>
  <script type="text/javascript" src="assets/js/oschina.js"></script>
  <style type="text/css">
    body,table,input,textarea,select {font-family:Verdana,sans-serif,宋体;}	
  </style>
</head>
<body>
<!--[if IE 8]>
<style>ul.tabnav {padding: 3px 10px 3px 10px;}</style>
<![endif]-->
<!--[if IE 9]>
<style>ul.tabnav {padding: 3px 10px 4px 10px;}</style>
<![endif]-->
<div id="OSC_Screen"><!-- #BeginLibraryItem "/Library/OSC_Banner.lbi" -->
<div id="OSC_Banner">
    <div id="OSC_Slogon">Johnny's Blog</div>
    <div id="OSC_Channels">
        <ul>
        <li><a href="#" class="project">心情 here...</a></li>
        </ul>
    </div>
    <div class="clear"></div>
</div><!-- #EndLibraryItem --><div id="OSC_Topbar">
	  <div id="VisitorInfo">
		当前访客身份：
				<?php echo $this->session->uname?>[ <a href="Blog/index">退出</a> ]
				<span id="OSC_Notification">
			<a href="Mesaage/inbox" class="msgbox" title="进入我的留言箱">你有<em>0</em>新留言</a>
																				</span>
</div>
    <div id="SearchBar">
    		<form action="#">
								<input name="user" value="154693" type="hidden">
                <input id="txt_q" name="q" class="SERACH" value="在此空间的博客中搜索" onblur="(this.value=='')?this.value='在此空间的博客中搜索':this.value" onfocus="if(this.value=='在此空间的博客中搜索'){this.value='';};this.select();" type="text">
				<input class="SUBMIT" value="搜索" type="submit">
    		</form>
    </div>
    <div class="clear"></div>
</div>
<div id="OSC_Content">
    <div id="AdminScreen">
        <div id="AdminPath">
            <a href="index_logined.htm">返回我的首页</a>&nbsp;»
    	    <span id="AdminTitle">我的留言箱</span>
        </div>
        <div id="AdminMenu">
    <ul>
        <li class="caption">个人信息管理
            <ol>
                <li class="current"><a href="inbox.htm">站内留言(0/1)</a></li>
                <li><a href="profile.htm">编辑个人资料</a></li>
                <li><a href="chpwd.htm">修改登录密码</a></li>
                <li><a href="userSettings.htm">网页个性设置</a></li>
            </ol>
        </li>
    </ul>
    <ul>
        <li class="caption">博客管理
            <ul class="LinkLine">
                <li><a href="Blog/addblog">发表博客</a></li>
                <li><a href="Catalog/add_catalog">博客分类管理</a></li>
                <li><a href="Blog/blogs">文章管理</a></li>
                <li><a href="blogComments.htm">网友评论管理</a></li>
            </ul>
        </li>
    </ul>
</div>
    <div id="AdminContent">


<ul class="tabnav"> 
	<li class="tab1"><a href="Message/inbox">所有留言<em>(<?php echo $rnum?>)</em></a></li>
	<li class="tab4 current"><a href="Message/outbox">已发送留言<em>(<?php echo $snum?>)</em></a></li>
</ul>
<div class="MsgList">
    <ul>
        <?php foreach ($smsg as $value){?>
      <li id="msg_186774">
        <span class="sender"><a href="#" target="user"><img src="images/portrait.gif" alt="mytesting" title="mytesting" class="SmallPortrait" user="154741" align="absmiddle"></a></span>
        <span class="msg">
            <div class="outline">
                <a href="#" target="user"><?php echo $this->session->uname?></a>
                发送于 (<?php echo $value->ADD_TIME?>)
                <a href="Message/del_msg/<?php echo $value->MSG_ID?>">删除</a>
            </div>
            <div class="content"><div class="c"><?php echo $value->CONTENT?></div></div>
        </span>
        <div class="clear"></div>
      </li>
        <?php }?>
    </ul>
</div>

<script type="text/javascript">
<!--
function delete_in_msg(mid){
  if(confirm("您确认要删除此条留言吗？")){
  	ajax_post("/action/msg/delete","msg="+mid,function(html){
	  if(html.length > 0) alert(html);
	  else
	    $('#msg_'+mid).fadeOut();	  
	});
  }
}
function cleanup_in_msg(){
  if(confirm("您确认要清空所有的留言吗？")){
  if(confirm("请再次确认是否要清空所有的留言")){
  	ajax_post("/action/msg/cleanup?type=0","",function(html){
	  if(html.length > 0) alert(html);
	  else
	    location.reload();  
	});
  }
  }
}
function read_msg(mid){jQuery.get('/action/msg/read?id='+mid);}
-->
</script></div>
	<div class="clear"></div>
</div>
</div>
	<div class="clear"></div>
	<div id="OSC_Footer">© 赛斯特(WWW.SYSIT.ORG)</div>
</div>
</body></html>