<?php /* Smarty version Smarty-3.1.10, created on 2012-11-16 15:10:00
         compiled from "../application/cms/mvc/configs/view/templates/default.html" */ ?>
<?php /*%%SmartyHeaderCode:205399534450a673685bad97-57071293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf7450caa3eb2b8976fb35f75ac54e3f7439255d' => 
    array (
      0 => '../application/cms/mvc/configs/view/templates/default.html',
      1 => 1352253844,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205399534450a673685bad97-57071293',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'formTitle' => 0,
    'configTitle' => 0,
    'configDescription' => 0,
    'configEmail' => 0,
    'configKeyWords' => 0,
    'configScriptGA' => 0,
    'configGAId' => 0,
    'configGAAcc' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_50a67368641871_72259123',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a67368641871_72259123')) {function content_50a67368641871_72259123($_smarty_tpl) {?>							<!-- START SIMPLE FORM -->
                        	<div class="simplebox grid740">
                        	
                            	<!--  <div class="titleh">
                                	<h3><?php echo (($tmp = @$_smarty_tpl->tpl_vars['formTitle']->value)===null||$tmp==='' ? "Utilize o formulário abaixo:" : $tmp);?>
</h3>
                                </div>-->
                                <div class="body">
                                                                
                                  <form id="form2" name="form2" method="post" action="?c=<?php echo $_GET['c'];?>
" enctype="multipart/form-data">
                                  
                                  	<div class="st-form-line">	
                                    	<span class="st-labeltext">Título do site:</span>	
                                        <input name="title" type="text" id="title" style="width:510px" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['configTitle']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">Breve descrição do site:</span>	
                                        <textarea name="description" id="description" style="width:510px" rows="3" cols="47"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['configDescription']->value)===null||$tmp==='' ? '' : $tmp);?>
</textarea> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">E-mail de contato:</span>	
                                        <input name="email" type="text" id="email" style="width:510px" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['configEmail']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">Palavras-chaves:</span>	
                                        <input name="keywords" type="text" id="keywords" style="width:510px" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['configKeyWords']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">Script Google Analytics:</span>	
                                        <textarea name="script" id="script" style="width:510px" rows="3" cols="47"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['configScriptGA']->value)===null||$tmp==='' ? '' : $tmp);?>
</textarea> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                   <!--  <div class="st-form-line">	
                                    	<span class="st-labeltext">Report ID do Google Analytics:</span>	
                                        <input name="GAId" type="text" id="GAId" style="width:510px" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['configGAId']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">Conta do Google Analytics:</span>	
                                        <input name="GAAcc" type="text" id="GAAcc" style="width:510px" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['configGAAcc']->value)===null||$tmp==='' ? '' : $tmp);?>
" /> 
                                    <div class="clear"></div>
                                    </div>
                                    
                                    <div class="st-form-line">	
                                    	<span class="st-labeltext">Senha da conta do Google Analytics:</span>	
                                        <input name="GAPassword" type="password" id="GAPassword" style="width:510px" value="" /> 
                                    <div class="clear"></div>
                                    </div> -->
                                    
                                    <div class="button-box">
                                   	  <input type="submit" name="save" id="button" value="Salvar" class="st-button"/>
                                   	  <input type="button" name="button" id="button2" value="Cancelar" class="st-clear cancel-form"/>
                                    </div>
                                    
                                  </form>
                                  
                                </div>
                            </div>
                        <!-- END SIMPLE FORM --><?php }} ?>