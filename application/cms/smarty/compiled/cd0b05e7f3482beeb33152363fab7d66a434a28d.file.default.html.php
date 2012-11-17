<?php /* Smarty version Smarty-3.1.10, created on 2012-11-16 15:10:13
         compiled from "../application/cms/mvc/user/view/templates/default.html" */ ?>
<?php /*%%SmartyHeaderCode:151644289250a67375c0a8d2-74751082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd0b05e7f3482beeb33152363fab7d66a434a28d' => 
    array (
      0 => '../application/cms/mvc/user/view/templates/default.html',
      1 => 1341550764,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151644289250a67375c0a8d2-74751082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'dataTable' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.10',
  'unifunc' => 'content_50a67375c892f4_81397156',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50a67375c892f4_81397156')) {function content_50a67375c892f4_81397156($_smarty_tpl) {?><!-- START TABLE -->
                        <div class="simplebox grid740">
                        
                        	<div class="titleh">
                        	  <h3>Listagem de usuários</h3>
                            <div class="shortcuts-icons">
                                <a class="shortcut tips" href="?c=<?php echo $_GET['c'];?>
&a=create" title="Adicionar novo item"><img src="img/icons/shortcut/plus.png" width="25" height="25" alt="icon" /></a>
                            </div>
                            </div>
                            
                            
                            
                            
                            <!-- Start Data Tables Initialisation code -->
							<script type="text/javascript" charset="utf-8">
								$(document).ready(function() {
									oTable = $('#example').dataTable({
										"bJQueryUI": true,
										"sPaginationType": "full_numbers"
									});
								});
							</script>
                            <!-- End Data Tables Initialisation code -->


							<table cellpadding="0" cellspacing="0" border="0" class="display data-table" id="example">
                            
								<thead>
									<tr>
                                    	<th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Login</th>
                                        <th>Tipo de usuário</th>
                                        <th>Ações</th>
                                    </tr>
                               	</thead>
                                
                                <tbody>
                                
                                <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['user']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dataTable']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
$_smarty_tpl->tpl_vars['user']->_loop = true;
?>
                                	<tr class="gradeA">
                                    	<td><?php echo $_smarty_tpl->tpl_vars['user']->value->getUserName();?>
</td>
                                    	<td><?php echo $_smarty_tpl->tpl_vars['user']->value->getUserEmail();?>
</td>
                                    	<td><?php echo $_smarty_tpl->tpl_vars['user']->value->getUserLogin();?>
</td>
                                    	<td><?php echo $_smarty_tpl->tpl_vars['user']->value->getGroupName();?>
</td>
                                    	<td class="center"> 
                                    		<a href="?c=<?php echo $_GET['c'];?>
&a=edit&id=<?php echo $_smarty_tpl->tpl_vars['user']->value->getIdUser();?>
"><img src="img/icons/sidemenu/file_edit.png" /></a>
                                    		<a class="delete-row" href="?c=<?php echo $_GET['c'];?>
&del=<?php echo $_smarty_tpl->tpl_vars['user']->value->getIdUser();?>
"><img src="img/icons/sidemenu/trash.png" /></a>
                                    	</td>
                                    </tr>
                                  <?php } ?>  
                                    
								</tbody>
							</table>

                            
                            
                            
                        </div>
                        <!-- END TABLE --><?php }} ?>