<?php 
    $user = $this->Session->read('UserAuth.User');
    $login_user_group_id = $user['user_group_id']; 
    $pass2 = isset($this->request->params['pass'][2]) ? $this->request->params['pass'][2] : 'test';
?>
<div class="sidebar-collapse menu-scroll">
    <ul id="side-menu" class="nav">
        <?php
            $days = Configure::read('days');
            $days_fra = Configure::read('fr_days');            
            $lang = $this->Session->read('Config.language');
            $day = date('N');
            if ($lang == "fra"):
                $days = $days_fra;
            elseif ($lang == "ro"):
                $days = $days_ro;
            else:
                $days = $days;
            endif;            
        ?>
        <li class="clock"><strong class="get_day"><?php echo $days[$day-1]; ?>, </strong><strong id="get-date"></strong>
            <div class="digital-clock">
                <div id="getHours" class="get-time"></div>
                <span>:</span>

                <div id="getMinutes" class="get-time"></div>
                <span>:</span>

                <div id="getSeconds" class="get-time"></div>
            </div>
        </li>
       
            <li class="sidebar-heading"><h4><?php echo __('Restaurents'); ?></h4></li>           
            <li><?php echo $this->Html->link('<i class="fa fa-home fa-fw"></i><span class="menu-title">' . __('Home'), array('controller' => 'restaurents', 'action' => 'admin_home'), array('escape' => false)); ?></li>            
       
        <?php if($login_user_group_id == 1): ?>
            <li class="sidebar-heading"><h4><?php echo __('Enquiries'); ?></h4></li>    
            <li class="padding-left-25 <?php if ($this->request->controller == "enquiries" && $this->request->action == 'index' && $this->request->pass[0] == 'contact') {
                    echo "highlight-menu ";
                } ?>">
                <?php echo $this->Html->link('<i class="fa fa-phone-square"></i> ' . __('For contact'), array('controller' => 'enquiries', 'action' => 'admin_index', 'contact'), array('escape' => false)); ?>
            </li>               
        <?php endif; ?>
            
        <?php if($login_user_group_id == 1): ?>    
            <li class=""><?php echo $this->Html->link('<i class="fa fa-group fa-fw"></i><span class="menu-title">' . __('Customers(end user)'), array('controller' => 'customers', 'action' => 'admin_show_user', 'enduser'), array('escape' => false)); ?></li>            
      <?php endif; ?>
            
        <?php if($login_user_group_id == 1): ?>    
            <li class=""><?php echo $this->Html->link('<i class="fa fa-tags fa-fw"></i><span class="menu-title">' . __('Offers'), array('controller' => 'offers', 'action' => 'admin_index'), array('escape' => false)); ?></li>            
        <?php endif; ?>
         
        <?php if($login_user_group_id == 1): ?>    
            <li class="<?php if ($this->request->controller == "Categories" && in_array($this->request->action, array('index', 'add', 'edit'))) {
                    echo "active";
                } ?>">
                <?php echo $this->Html->link('<i class="fa fa-list-ul"></i> ' . __('Categories'), array('controller' => 'categories', 'action' => 'admin_index'), array('escape' => false)); ?>
            </li>
        <?php endif; ?>
            
        <?php if($login_user_group_id == 1): ?>    
            <li class="sidebar-heading"><h4><?php echo __('Settings'); ?></h4></li>   
            <li class="padding-left-25 <?php if ($this->request->controller == "page_settings") {
                    echo "active";
                } ?>">
                <?php echo $this->Html->link('<i class="fa fa-gear"></i><span class="menu-title"> ' . __('Terms and conditions') . '</span>', array('controller' => 'page_settings', 'action' => 'terms_edit'), array('escape' => false)); ?>
            </li> 
        <?php endif; ?>
            
        <?php if($login_user_group_id == 1): ?>    
            <li class="padding-left-25 <?php if ($this->request->controller == "application" && in_array($this->request->action, array('get_application'))) {
                    echo "active";
                } ?>">
                <?php echo $this->Html->link('<i class="fa fa-gear"></i><span class="menu-title"> ' . __('Settings') . '</span>', array('controller' => 'settings', 'action' => 'admin_index'), array('escape' => false)); ?>
            </li>
        <?php endif; ?>
    </ul>
</div>