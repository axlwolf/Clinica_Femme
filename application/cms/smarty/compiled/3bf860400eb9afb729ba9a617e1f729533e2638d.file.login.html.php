<?php /* Smarty version Smarty-3.1.10, created on 2012-11-16 15:00:55
         compiled from "../application/cms/mvc/view/templates/login.html" */ ?>
<?php /*%%SmartyHeaderCode:177856590350a67147838582-03927517%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3bf860400eb9afb729ba9a617e1f729533e2638d' => 
    array (
      0 => '../application/cms/mvc/view/templates/login.html',
      1 => 1341334466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177856590350a67147838582-03927517',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'authError' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_50a671478953b1_59212594',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a671478953b1_59212594')) {function content_50a671478953b1_59212594($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	
    <link rel="stylesheet" type="text/css" href="style/reset.css" /> 
    <link rel="stylesheet" type="text/css" href="style/root.css" /> 
    <link rel="stylesheet" type="text/css" href="style/grid.css" /> 
    <link rel="stylesheet" type="text/css" href="style/typography.css" /> 
    <link rel="stylesheet" type="text/css" href="style/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="style/jquery-plugin-base.css" />
    
    <!--[if IE 7]>	<link rel="stylesheet" type="text/css" href="style/ie7-style.css" />	<![endif]-->
    
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.11.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery-settings.js"></script>
	<script type="text/javascript" src="js/toogle.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
	<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/raphael.js"></script>
	<script type="text/javascript" src="js/analytics.js"></script>
	<script type="text/javascript" src="js/popup.js"></script>
	<script type="text/javascript" src="js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="js/jquery.ui.core.js"></script>
	<script type="text/javascript" src="js/jquery.ui.mouse.js"></script>
	<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="js/jquery.ui.slider.js"></script>
	<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="js/jquery.ui.tabs.js"></script>
	<script type="text/javascript" src="js/jquery.ui.accordion.js"></script>
</head>
<body>
    <div class="loginform">
    	<div class="title"> <img src="img/martinhagocreative-thumb.png" /></div>
        <div class="body">

        	<?php if ($_smarty_tpl->tpl_vars['authError']->value){?><div style="z-index: 670;" class="albox errorbox">
                                	<b>Login/E-mail ou senha incorretos.</b> 
                                	<a original-title="fechar" href="#" class="close tips">fechar</a>
                                </div><?php }?>
        
       	  <form id="form1" name="form1" method="post" action="?c=login">
          	<label class="log-lab">Login / E-mail</label>
            <input name="login" type="text" class="login-input-user" id="textfield" value="Admin"/>
          	<label class="log-lab">Senha</label>
            <input name="password" type="password" class="login-input-pass" id="textfield" value="Password"/>
            <input type="submit" name="submit-login" id="button" value="Login" class="button"/>
       	  </form>
        </div>
    </div>
</body>
</html><?php }} ?>