<?php /* Smarty version Smarty-3.1.10, created on 2012-11-16 15:09:51
         compiled from "../application/cms/mvc/view/templates/application.html" */ ?>
<?php /*%%SmartyHeaderCode:104243751250a6735f9b4dd3-65444714%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e06a3f267ac8f0af35ff315044f13c37fa368613' => 
    array (
      0 => '../application/cms/mvc/view/templates/application.html',
      1 => 1341966091,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104243751250a6735f9b4dd3-65444714',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    '__profilePhoto' => 0,
    'userLoggedName' => 0,
    'resourceTitle' => 0,
    'resourceDescription' => 0,
    'contentPage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_50a6735fa26280_22149525',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a6735fa26280_22149525')) {function content_50a6735fa26280_22149525($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/CMS_Clear/application/smarty/plugins/modifier.truncate.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
	
	<!-- File Uploader  -->
	<!-- Bootstrap CSS Toolkit styles -->
	<link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap.min.css">
	<!-- Bootstrap styles for responsive website layout, supporting different screen sizes -->
	<link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-responsive.min.css">
	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]><link rel="stylesheet" href="http://blueimp.github.com/cdn/css/bootstrap-ie6.min.css"><![endif]-->
	<!-- Bootstrap Image Gallery styles -->
	<link rel="stylesheet" href="http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css">
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="style/jquery.fileupload-ui.css">
	<!-- Shim to make HTML5 elements usable in older Internet Explorer versions -->
	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
    <link rel="stylesheet" type="text/css" href="style/reset.css" /> 
    <link rel="stylesheet" type="text/css" href="style/root.css" /> 
    <link rel="stylesheet" type="text/css" href="style/grid.css" /> 
    <link rel="stylesheet" type="text/css" href="style/typography.css" /> 
    <link rel="stylesheet" type="text/css" href="style/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="style/jquery-plugin-base.css" />
    <link rel="stylesheet" type="text/css" href="style/jquery.validate.css" />
    
    
    <!--[if IE 7]>	  <link rel="stylesheet" type="text/css" href="style/ie7-style.css" />	<![endif]-->
    
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
	<!--  <script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
	<script type="text/javascript" src="js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/jquery.datetimepicker.js"></script>
	<script type="text/javascript" charset="utf-8" src="js/jquery.maskMoney.js"></script>
    
</head>
<body>
<div class="wrapper">
	<!-- START HEADER -->
    <div id="header">
    	<!-- logo -->
    	<div class="logo">	<a href="?"><img src="img/martinhagocreative-thumb.png" alt="Martinhago Creative"/></a>	</div>

        <!-- notifications -->
        <div id="notifications">
<!--        	<a href="index.html" class="qbutton-left"><img src="img/icons/header/dashboard.png" width="16" height="15" alt="dashboard" /></a>
        	<a href="#" class="qbutton-normal tips"><img src="img/icons/header/message.png" width="19" height="13" alt="message" /> <span class="qballon">23</span> </a>
        	<a href="#" class="qbutton-right"><img src="img/icons/header/support.png" width="19" height="13" alt="support" /> <span class="qballon">8</span> </a>
-->
          <div class="clear"></div>
        </div>
        
        
        <!-- profile box -->
        <div id="profilebox">
        	<a href="#" class="display">
            	<img src="<?php echo $_smarty_tpl->tpl_vars['__profilePhoto']->value;?>
" width="33" height="33" alt="profile"/>	<b>Logado como</b>	<span><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['userLoggedName']->value,13,'...',true);?>
</span>
            </a>
            
            <div class="profilemenu">
            	<ul>
                	<li><a href="?c=configs">Configurações</a></li>
                	<li><a href="?c=profile">Meu perfil</a></li>
                	<li><a href="?c=logout">Sair</a></li>
                </ul>
            </div>
            
        </div>
        
        
        <div class="clear"></div>
    </div>
    <!-- END HEADER -->
    
    <!-- START MAIN -->
    <div id="main">
        
        <!-- START SIDEBAR -->
        <div id="sidebar">
        	
            <!-- start sidemenu -->
            <div id="sidemenu">
            	<?php echo $_smarty_tpl->getSubTemplate ("view/templates/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

            </div>
            <!-- end sidemenu -->
            
        </div>
        <!-- END SIDEBAR -->

        
        <!-- START PAGE -->
        <div id="page">
        	    
                <!-- start page title -->
                <div class="page-title">
                	<div class="in">
                    		<div class="titlebar">	<h2><?php echo $_smarty_tpl->tpl_vars['resourceTitle']->value;?>
</h2>	<p><?php echo $_smarty_tpl->tpl_vars['resourceDescription']->value;?>
</p></div>
                            
                            <div class="clear"></div>
                    </div>
                </div>
                <!-- end page title -->
                
                	<!-- START CONTENT -->
                    <div class="content">
                    <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['contentPage']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

                    </div>
                    <!-- END CONTENT -->
            
        </div>
        <!-- END PAGE -->

    <div class="clear"></div>
    </div>
    <!-- END MAIN -->

    
    <!-- START FOOTER -->
    <div id="footer">
    	<div class="left-column">\A9 Copyright 2012 - All rights reserved.</div>
        <div class="right-column"><a href="#" target="_blank">Martinhago</a></div>
    </div>
    <!-- END FOOTER -->

</div>
</body>
</html><?php }} ?>