<?php
//
//$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
//$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
//   
?>    

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <?php //echo $this->Html->charset(); ?>
        <meta charset="UTF-8"/>     
        <meta name="apple-itunes-app" content="app-id=830236051">
        <meta name="google-play-app" content="app-id=com.showup.makemevip">	             
        <meta name="viewport" content="width=device-width, initial-scale=1.0">	
        <!-- Favicon -->
        <link href="/favicon.ico" type="image/x-icon" rel="icon">
        <link href="/favicon.ico" rel="shortcut icon">

        <!-- CSS Global Compulsory -->
        <?php
        echo $this->Html->css('fonts/font-awesome.css');
        echo $this->Html->css('bootstrap/css/bootstrap.css');
        echo $this->Html->css('bootstrap-select.min.css');
        echo $this->Html->css('owl.carousel.css');
        echo $this->Html->css('jquery.nouislider.min.css');
        echo $this->Html->css('colors/green.css');
        echo $this->Html->css('user.style.css');        
        echo $this->fetch('header_css');
        ?>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>   
        <title>Traducmeal - Universal Restaurent</title>
    </head>	
    <!-- Outer Wrapper-->
    <div id="outer-wrapper">       
        <div id="inner-wrapper">            
            <div class="header">
                <div class="wrapper">
                    <div class="container-fluid">
                        <div class="row verticle-center">
                            <div class="col-md-3">
                                <div class="brand">
                                    <a href="<?php echo FULL_BASE_URL; ?>"><img class="img img-responsive" src="img/logo-restaurants.jpg" alt="logo"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-centered"> 
                                <div class="language_selector">
                                    <ul class="nav">
                                        <li class="hm">
                                            <img class="icon" src="img/flag_icon/en.png" alt="">
                                            <span>English</span>
                                        </li>
                                        <li class="fb">
                                            <img class="icon" src="img/flag_icon/es.png" alt="">
                                            <span>Spanish</span>
                                        </li>
                                        <li class="gp">
                                            <img class="icon" src="img/flag_icon/fr.png" alt="">
                                            <span>French</span>
                                        </li>
                                        <li class="tw">
                                            <img class="icon" src="img/flag_icon/ru.png" alt="">
                                            <span>Russian</span>
                                        </li>                                    
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <nav class="navigation-items">
                                    <div class="wrapper">
                                        <ul class="main-navigation navigation-top-header"></ul>
                                        <ul class="user-area">
                                            <li><a href="/login">Sign In</a></li>
                                            <li><a href="/register"><strong>Register</strong></a></li>
                                        </ul>
                                        <a href="#" class="submit-item">
                                            <div class="content"><span>Submit Your Item</span></div>
                                            <div class="icon">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </a>
                                        <div class="toggle-navigation">
                                            <div class="icon">
                                                <div class="line"></div>
                                                <div class="line"></div>
                                                <div class="line"></div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Navigation-->
            <!-- Page Canvas-->
            <div id="page-canvas">
                <!--Off Canvas Navigation-->
                <nav class="off-canvas-navigation">
                    <header>Navigation</header>
                    <div class="main-navigation navigation-off-canvas"></div>
                </nav>
                <!--end Off Canvas Navigation-->
                <!--Page Content-->
                <div id="page-content">
                    <?php echo $this->fetch('content'); ?>	
                </div>
                <!-- end Page Content-->
            </div>
            <!-- end Page Canvas-->
            <!--Page Footer-->
            <footer id="page-footer">
                <div class="inner">
                    <div class="footer-top">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                   
                                </div>
                                <div class="col-md-4 col-sm-4">
                                   
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <section>
                                        <h2>About Us</h2>
                                        <address>
                                            <div>Max Five Lounge</div>
                                            <div>63 Birch Street</div>
                                            <div>Granada Hills, CA 91344</div>
                                            <figure>
                                                <div class="info">
                                                    <i class="fa fa-mobile"></i>
                                                    <span>818-832-5258</span>
                                                </div>
                                                <div class="info">
                                                    <i class="fa fa-phone"></i>
                                                    <span>+1 123 456 789</span>
                                                </div>
                                                <div class="info">
                                                    <i class="fa fa-globe"></i>
                                                    <a href="#">www.maxfivelounge.com</a>
                                                </div>
                                            </figure>
                                        </address>
                                        <div class="social">
                                            <a href="#" class="social-button"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="social-button"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="social-button"><i class="fa fa-pinterest"></i></a>
                                        </div>

                                        <a href="contact.html" class="btn framed icon">Contact Us<i class="fa fa-angle-right"></i></a>
                                    </section>
                                </div>
                                <!--/.col-md-4-->
                            </div>
                            <!--/.row-->
                        </div>
                        <!--/.container-->
                    </div>
                    <!--/.footer-top-->
                    <div class="footer-bottom">
                        <div class="container">
                            <span class="left">(C) Traducmeal, All rights reserved</span>
                            <span class="right">
                                <a href="#page-top" class="to-top roll"><i class="fa fa-angle-up"></i></a>
                            </span>
                        </div>
                    </div>
                    <!--/.footer-bottom-->
                </div>
            </footer>
            <!--end Page Footer-->
        </div>
        <!-- end Inner Wrapper -->
    </div>
    <!-- end Outer Wrapper-->


    <?php
    echo $this->Html->script('jquery-2.1.0.min.js');
    echo $this->Html->script('before.load.js');
    ?>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <?php
    echo $this->Html->script('jquery-2.1.0.min.js');
    echo $this->Html->script('before.load.js');
    echo $this->Html->script('bootstrap.min.js');
    echo $this->Html->script('jquery-migrate-1.2.1.min.js');
    echo $this->Html->script('smoothscroll.js');
    echo $this->Html->script('bootstrap-select.min.js');
    echo $this->Html->script('jquery.hotkeys.js');
    echo $this->Html->script('jquery.nouislider.all.min.js');
    echo $this->Html->script('custom.js');
    echo $this->Html->script('maps.js');
    echo $this->fetch('footer_js');
    ?>            
    <script>
        $(window).load(function () {
            var rtl = false; // Use RTL
            initializeOwl(rtl);
        });

        autoComplete();
    </script>

    <!--[if lte IE 9]>
    <script type="text/javascript" src="img/js/ie-scripts.js"></script>
    <![endif]-->
</body>
</html>