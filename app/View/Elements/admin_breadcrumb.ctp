<?php 
 $controller = $this->request->controller;
 $action = $this->request->action;
 $page_title = '';
?>

<ol class="breadcrumb page-breadcrumb">
    <li><i class="fa fa-home"></i>&nbsp;<a href="/admin"><?php echo __('Home');?></a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>    
    <?php
    if($controller == 'customers' && $action =='admin_store_owner'):
        echo  '<li class="active">'.__('Store Owners').'</li>';
        $page_title = __('Store Owners');
    elseif($controller == 'customers' && $action =='admin_customer_add'):
        echo  '<li>'.$this->html->link(__('store owners'), array('controller' => 'customers', 'action' => 'admin_store_owner')).'&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>';
        echo  '<li class="active">'.__('Add Customer').'</li>';
        $page_title = __('Add store owner');
    elseif($controller == 'customers' && $action =='admin_customer_update'):
        echo  '<li>'.$this->html->link(__('store owners'), array('controller' => 'customers', 'action' => 'admin_store_owner')).'&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>';
        echo  '<li class="active">'.__('Customer presentation').'</li>';
        $page_title = __('Customer presentation');
    elseif($controller == 'stores' && $action =='admin_index'):
        echo  '<li class="active">'.__('Store list').'</li>';
        $page_title = __('All stores');    
    elseif($controller == 'posts' && $action =='admin_index'):
        echo  '<li class="active">'.__('News').'</li>';
        $page_title = __('News');
    elseif($controller == 'posts' && $action =='admin_add'):
        echo  '<li>'.$this->html->link(__('News'), array('controller' => 'posts', 'action' => 'admin_index')).'&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>';
        echo  '<li class="active">'.__('Add news').'</li>';
        $page_title = __('News');
    elseif($controller == 'posts' && $action =='admin_edit'):
        echo  '<li>'.$this->html->link(__('News'), array('controller' => 'posts', 'action' => 'admin_index')).'&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>';
        echo  '<li class="active">'.__('Edit news').'</li>';
        $page_title = __('News');
    endif;
    ?>
   
</ol>
<div class="page-heading hidden-xs">
    <h1 class="page-title"><?php echo $page_title; ?></h1>
</div>