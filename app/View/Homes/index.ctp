<!--Hero Image-->
<section class="hero-image search-filter-middle height-500">
    <div class="inner">
        <div class="container">
            <h1>Find Place For Fun and Eat</h1>
            <div class="search-bar horizontal">
                <form class="main-search border-less-inputs background-dark narrow" role="form" method="post" action="?">
                    <div class="input-row">
                        <div class="form-group">
                            <label for="keyword">Restaurent Name</label>
                            <input type="text" class="form-control" id="keyword" placeholder="<?php echo __('Enter Restaurent Name') ?>">
                        </div>
                        <!-- /.form-group -->
                      
                       
                        <div class="form-group">
                            <label for="location">Location</label>
                            <div class="input-group location">
                                <input type="text" class="form-control" id="location" placeholder="Enter Location">
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        <!-- /.form-group -->
                    </div>
                </form>
                <!-- /.main-search -->
            </div>
            <!-- /.search-bar -->
        </div>
    </div>
    <div class="background">
        <img src="img/restaurant-bg.jpg" alt="">
    </div>
</section>
<!--end Hero Image-->

<!--Featured-->
<?php if (!empty($restaurents)): ?>
    <section id="featured" class="block equal-height">
        <div class="container">
            <header><h2>Featured</h2></header>
            <div class="row">
                <?php foreach ($restaurents as $k => $r): ?>
                    <div class="col-md-3 col-sm-3">
                        <div class="item">
                            <div class="image">
                                <div class="quick-view" data-id="<?php echo $r['Restaurent']['id'] ?>"><i class="fa fa-eye"></i><span>Quick View</span></div>
                                <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $r['Restaurent']['id'])) ?>">
                                    <div class="overlay">
                                        <div class="inner">
                                            <div class="content">
                                                <h4>Description</h4>
                                                <p>
                                                    <?php
                                                    echo $this->Text->truncate(strip_tags($r['Restaurent']['descriptions']), 30, array('ellipsis' => '...', 'exact' => false));
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="item-specific">
                                        <span title="Bedrooms"><img src="img/bedrooms.png" alt="">2</span>
                                        <span title="Bathrooms"><img src="img/bathrooms.png" alt="">2</span>
                                        <span title="Area"><img src="img/area.png" alt="">240m<sup>2</sup></span>
                                        <span title="Garages"><img src="img/garages.png" alt="">1</span>
                                    </div>-->
                                    <div class="icon">
                                        <i class="fa fa-thumbs-up"></i>
                                    </div>
                                    <?php
                                    $image_path = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $r['Restaurent']['id'] . '/' . $r['Restaurent']['resturent_image'];
                                    echo $this->Html->image($image_path, array('alt' => $r['Restaurent']['name'], 'class' => 'img img-responsive restaurent_img'))
                                    ?>
                                </a>
                            </div>
                            <div class="wrapper">
                                <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $r['Restaurent']['id'])) ?>">
                                    <h3>
                                        <?php
                                        echo $this->Text->truncate($r['Restaurent']['name'], 30, array('ellipsis' => '...', 'exact' => false));
                                        ?>
                                    </h3>
                                </a>
                                <figure>
                                    <?php
                                    echo $this->Text->truncate($r['Restaurent']['address'], 30, array('ellipsis' => '...', 'exact' => false));
                                    ?>
                                </figure>
                                <div class="info">
                                    <div class="type">
                                        <i>
                                            <?php
                                            $image_path = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $r['Restaurent']['id'] . '/' . $r['Restaurent']['resturent_image'];
                                            echo $this->Html->image($image_path, array('alt' => $r['Restaurent']['name'], 'class' => 'img img-responsive'))
                                            ?>
                                        </i>
                                        <span>Restaurant</span>
                                    </div>
                                    <div class="rating" data-rating="<?php echo rand(1, 5); ?>"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.item-->
                    </div>
                <?php endforeach; ?>
            </div>
            <!--/.row-->
        </div>
        <!--/.container-->
        <div class="background opacity-5">
            <img src="/img/restaurants-bg2.jpg" alt="">
        </div>
    </section>
<?php endif; ?>
<!--end Featured-->

<!--Popular-->
<?php if (!empty($popular_restaurents)): ?>
    <section id="popular" class="block background-color-white">
        <div class="container">
            <header><h2>Popular</h2></header>
            <div class="owl-carousel wide carousel">
                <?php foreach ($popular_restaurents as $k => $popular_r): ?>
                    <div class="slide">
                        <div class="inner">
                            <div class="image">
                                <div class="item-specific">
                                    <div class="inner">
                                        <div class="content">
                                            <?php if (!empty($popular_r['Category'])): ?>
                                                <dl>
                                                    <?php foreach ($popular_r['Category'] as $key => $cat) : ?>
                                                        <dt><?php echo $cat['name']; ?></dt>
                                                        <dd><?php echo count($cat['Menu']); ?></dd>
                                                    <?php endforeach; ?>
                                                </dl>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $image_path = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $popular_r['Restaurent']['id'] . '/' . $popular_r['Restaurent']['resturent_image'];
                                echo $this->Html->image($image_path, array('alt' => $popular_r['Restaurent']['name'], 'class' => 'img img-responsive'))
                                ?>
                            </div>
                            <div class="wrapper">
                                <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $popular_r['Restaurent']['id'])) ?>">
                                    <h3>
                                        <?php
                                        echo $this->Text->truncate($popular_r['Restaurent']['name'], 30, array('ellipsis' => '...', 'exact' => false));
                                        ?>
                                    </h3>
                                </a>
                                <figure>
                                    <i class="fa fa-map-marker"></i>
                                    <span>
                                        <?php echo $popular_r['Restaurent']['address'] ?>
                                    </span>
                                </figure>
                                <div class="info">
                                    <div class="rating" data-rating="<?php echo rand(1, 5) ?>">
                                        <aside class="reviews"><?php echo rand(1, 10) ?> reviews</aside>
                                    </div>
                                    <div class="type">
                                        <i><img src="/img/icons/restaurant/restaurant.png"></i>
                                        <span>Restaurant</span>
                                    </div>
                                </div>
                                <!--/.info-->
                                <p>
                                    <?php echo $this->Text->truncate($popular_r['Restaurent']['descriptions'], 300, array('ellipsis' => '...', 'exact' => false)); ?>
                                </p>
                                <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $popular_r['Restaurent']['id'])) ?>" class="read-more icon">Read More</a>
                            </div>
                            <!--/.wrapper-->
                        </div>
                        <!--/.inner-->
                    </div>
                <?php endforeach; ?>
                <!--/.slide-->                               
            </div>
            <!--/.owl-carousel-->
        </div>
        <!--/.container-->
    </section>
<?php endif; ?>
<!--end Popular-->

<!--Why Us-->
<section id="why-us" class="block">
    <div class="container">
        <header><h2>Why Us?</h2></header>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <i class="fa fa-thumbs-up"></i>
                    <div class="description">
                        <h3>Lorem ipsum dolor </h3>
                        <p>
                            Praesent tempor a erat in iaculis. Phasellus vitae libero libero. Vestibulum ante
                            ipsum primis in faucibus orci luctus et ultrices posuere cubilia
                        </p>
                    </div>
                </div>
                <!--/.feature-box-->
            </div>
            <!--/.col-md-4-->
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <i class="fa fa-folder"></i>
                    <div class="description">
                        <h3>Etiam vehicula felis a ipsum</h3>
                        <p>
                            Pellentesque nisl quam, aliquet sed velit eu, varius condimentum nunc.
                            Nunc vulputate turpis ut erat egestas, vitae rutrum sapien varius.
                        </p>
                    </div>
                </div>
                <!--/.feature-box-->
            </div>
            <!--/.col-md-4-->
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <i class="fa fa-money"></i>
                    <div class="description">
                        <h3>Donec dolor justo, volutpat </h3>
                        <p>
                            Maecenas quis ipsum lectus. Fusce molestie, metus ut consequat pulvinar,
                            ipsum quam condimentum leo, sit amet auctor lacus nulla at felis.
                        </p>
                    </div>
                </div>
                <!--/.feature-box-->
            </div>
            <!--/.col-md-4-->
        </div>
    </div>
</section>
<!--end Why Us-->

<hr>              

<!--Partners-->
<section id="partners" class="block">
    <div class="container">
        <header><h2>Partners</h2></header>
        <div class="logos">
            <div class="logo"><a href="#"><img src="img/logo-partner-01.png" alt=""></a></div>
            <div class="logo"><a href="#"><img src="img/logo-partner-02.png" alt=""></a></div>
            <div class="logo"><a href="#"><img src="img/logo-partner-03.png" alt=""></a></div>
            <div class="logo"><a href="#"><img src="img/logo-partner-04.png" alt=""></a></div>
            <div class="logo"><a href="#"><img src="img/logo-partner-05.png" alt=""></a></div>
        </div>
    </div>
    <!--/.container-->
</section>
<!--end Partners-->
<?php echo $this->start('footer_js') ?>
<script>
    $(document).ready(function () {
		autoComplete();
        $('.quick-view').live('click', function () {
            var id = $(this).attr('data-id');
            quickView(id);
            return false;
        });
        
        function quickView(id){
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'quick_view' )) ?>',
                data: {id: id},
                success: function (data) {
                    // Create HTML element with loaded data
                    $('body').append(data);
                }
            });
        }
    });
</script>
<?php
echo $this->end('footer_js')?>