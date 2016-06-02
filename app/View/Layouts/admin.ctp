<?php
$cakeDescription = __d('cake_dev', 'Traducmeal');
$user = $this->Session->read('UserAuth.User');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php echo $this->Html->charset(); ?>               
        <title>
            <?php echo $cakeDescription ?> :
            <?php echo $title_for_layout; ?>
        </title>    
        <?php
        echo $this->Html->meta('icon');

        echo $this->fetch('meta');
        ?>
        <!--Loading bootstrap css-->
        <link type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">
        <?php
        echo $this->Html->css(
                array(
                    'admin/vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css',
                    'admin/vendors/font-awesome/css/font-awesome.min.css',
                    'admin/vendors/bootstrap/css/bootstrap.min.css',
                    'admin/vendors/datatables/css/dataTables.bootstrap.css',
                    'admin/vendors/animate.css/animate.css',
                    'admin/vendors/jquery-pace/pace.css',
                    'admin/style.css',
                    'admin/custom.css',
                    'admin/style-mango.css',
                    'admin/vendors.css',
//		    'admin/themes/default.css',
                    'admin/themes/grey.css',
                    //'admin/themes/white-pink.css',
                    'admin/style-responsive.css'
                )
        );
        echo $this->fetch('header_css');
        ?>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
    </head>

    <style id="holderjs-style" type="text/css"></style></head>
<body>
    <div>   
        <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
        <div id="wrapper">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" class="navbar navbar-default navbar-static-top">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
                            class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span></button>
                        <?php
                        $admin_url = '/';
                        if ($user['user_group_id'] == 1):
                            $admin_url = '/admin';
                        endif;
                        ?>
                    <a id="logo" href="<?php echo $admin_url ?>"><span class="fa fa-rocket"></span><span class="logo-text"><?php echo 'Traducmeal';?></span>               
                    </a>

                </div>
                <div class="topbar-main">
                    <a id="menu-toggle" href="#" class="btn hidden-xs">
                        <i class="fa fa-bars"></i>
                    </a>                                
                    <ul class="nav navbar-top-links navbar-right">                        
                        <li>
                            <a target="_blank" href="/" class="btn btn-default admin-menu-btn"><?php echo __('Go to website'); ?>&nbsp;&nbsp;<i class="fa fa-mail-forward text-orange"></i></a>
                        </li>
                        <li class="flag_011">
                            <?php //echo $this->I18n->flagSwitcher(array('class' => 'languages', 'id' => 'language-switcher')); ?>
                        </li>
                        <li class="dropdown">                       
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <?php
                                if (!empty($user['user_profile'])):
                                    $user_image = FULL_BASE_URL . '/uploads/users/' . $user['user_profile'];
                                else:
                                    $user_image = FULL_BASE_URL . '/img/default-avatar.png';
                                endif;
                                ?>
                                <img src="<?php echo $user_image ?>" alt="<?php $user['first_name']; ?>" class="img-responsive img-circle"/>
                                &nbsp;<?php echo $user['first_name']; ?>&nbsp;
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-alerts animated bounceInDown">
                                <li>
                                    <a href="<?php echo Router::url(array('controller' => 'user_dashboard', 'action' => 'admin_user_edit')) ?>">
                                        <span class="label label-blue"><i class="fa fa-user fa-fw"></i></span>
                                        <span style="font-weight: bold;">
                                            <?php echo $user['first_name']; ?>
                                        </span>
                                    </a>
                                </li>
                                <?php if ($user['user_group_id'] == 1) : ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('controller' => 'user_dashboard', 'action' => 'admin_user_edit')) ?>">
                                            <span class="label label-pink"><i class="fa fa-folder-open-o fa-fw"></i></span>
                                            <?php echo __('View Account'); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>                            
                                <li><a href="/logout" class="text-right">Sign Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
                <?php echo $this->element('admin_sidebar'); ?>            
            </nav>        
            <div id="page-wrapper"><!--BEGIN PAGE HEADER & BREADCRUMB-->
                <div class="page-header-breadcrumb">
                    <?php echo $this->element('admin_breadcrumb'); ?>                    
                </div>
                <!--END PAGE HEADER & BREADCRUMB--><!--BEGIN CONTENT-->
                <?php echo $this->Session->flash(); ?>
                <div class="page-content">
                    <?php echo $this->fetch('content'); ?>
                </div>            
            </div>
        </div>
    </div>
    <?php
    echo $this->Html->script(
            array(
                'admin/jquery-1.9.1.js',
                'admin/jquery-migrate-1.2.1.min.js',
                'admin/jquery-ui.js',
                'admin/vendors/bootstrap/js/bootstrap.min.js',
                'admin/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
                'admin/html5shiv.js',
                'admin/respond.min.js',
                'admin/vendors/metisMenu/jquery.metisMenu.js',
                'admin/vendors/slimScroll/jquery.slimscroll.js',
                'admin/vendors/jquery-cookie/jquery.cookie.js',
                'admin/jquery.menu.js',
                'admin/vendors/jquery-pace/pace.min.js',
                'admin/main.js',
                'admin/holder.js',
                'admin/vendors/datatables/js/jquery.dataTables.js',
                'admin/vendors/datatables/js/dataTables.bootstrap.js',
    ));
    echo $this->Html->script('jquery.geocomplete.js');
    echo $this->Html->script('admin/polygon.min.js');
    echo $this->fetch('footer_js');
    ?>
</body>
</html>