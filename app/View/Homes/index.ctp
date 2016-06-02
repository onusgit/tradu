<!--Hero Image-->
<section class="hero-image search-filter-middle height-500">
    <div class="inner">
        <div class="container">
            <h1><?php echo __('Find Place For Fun and Eat') ?></h1>
            <div class="search-bar horizontal">
                <?php 
                    echo $this->Form->create('Rest', array( 'type' => 'post', 'url' => Router::url(array('controller' => 'restaurents', 'action' => 'index')), 'class' => 'main-search border-less-inputs background-dark narrow', 'role' => 'form'));
                ?>
                    <div class="input-row">
                        <div class="form-group">
                            <label for="keyword"><?php echo __('Restaurent Name') ?></label>
                            <?php 
                                echo $this->Form->input('name', array('class' => 'form-control', 'name' => 'Rest[name]', 'id' => 'keyword',  'placeholder' => __("Enter Restaurent Name"), 'label' => false));
                            ?>
                        </div>
                        <!-- /.form-group -->
                      
                          <!-- /.form-group -->
                            <div class="form-group">
                                <label for="model"><?php echo __('Place Type') ?></label>
                                <?php
                                    //echo $this->Form->input('type', array('id' => 'model','name' => 'Rest[type][]', 'multiple' => 'multiple', 'title' => __('Any'), 'data-live-search' => 'true', 'type' => 'select', 'options' => $restaurent_types, 'label' => false, 'value' => $restaurent_types));
                                ?> 
                                <select name="Rest[type][]" id="model" multiple title="Any" data-live-search="true">
                                    <?php foreach($restaurent_types as $k => $r_type): ?>
                                        <option value="<?php echo $r_type['RestaurentType']['id'] ?>"><?php echo $r_type['RestaurentType']['name'] ?></option>
                                    <?php endforeach; ?>                                    
                                </select>

                            </div>
                            <!-- /.form-group -->
                       
                        <div class="form-group">
                            <label for="location"><?php echo __('Location') ?></label>
                            <div class="input-group location">
                                <?php 
                                    echo $this->Form->input('address', array('class' => 'form-control',  'name' => 'Rest[address]', 'id' => 'location',  'placeholder' => __("Enter Location"), 'label' => false));
                                    echo $this->Form->input('lat', array('type' => 'hidden', 'class' => 'form-control',  'name' => 'Rest[lat]', 'id' => 'lat'));
                                    echo $this->Form->input('lng', array('type' => 'hidden', 'class' => 'form-control',  'name' => 'Rest[lng]', 'id' => 'lng'));
                                ?>
                            </div>
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                        <!-- /.form-group -->
                    </div>
                <?php 
                    echo $this->Form->end();
                ?>
                <!-- /.main-search -->
            </div>
            <!-- /.search-bar -->
        </div>
    </div>
    <div class="background">
        <?php 
        if(!empty($main_image)):
            $image_path = FULL_BASE_URL . '/app/uploads/settings/' . $main_image['Setting']['key_value'];
        else:
            $image_path = 'restaurant-bg.jpg';
        endif;
        echo $this->Html->image($image_path);        
        ?>
    </div>
</section>
<!--end Hero Image-->

<!--Featured-->
<?php if (!empty($restaurents)): ?>
    <section id="featured" class="block equal-height">
        <div class="container">
            <header><h2><?php echo __('Featured') ?></h2></header>
            <div class="row">
                <?php foreach ($restaurents as $k => $r): ?>
                    <div class="col-md-3 col-sm-3">
                        <div class="item">
                            <div class="image">
                                <div class="quick-view" data-id="<?php echo $r['Restaurent']['id'] ?>"><i class="fa fa-eye"></i><span><?php echo __('Quick View') ?></span></div>
                                <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $r['Restaurent']['id'])) ?>">
                                    <div class="overlay">
                                        <div class="inner">
                                            <div class="content">
                                                <h4><?php echo __('Description') ?></h4>
                                                <p>
                                                    <?php
                                                    echo $this->Text->truncate(strip_tags($r['Restaurent']['descriptions']), 30, array('ellipsis' => '...', 'exact' => false));
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
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
                                        <span><?php echo __('Restaurant') ?></span>
                                    </div>
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
            <?php 
             if(!empty($featured_image)):
            $image_path = FULL_BASE_URL . '/app/uploads/settings/' . $featured_image['Setting']['key_value'];
            else:
                $image_path = 'restaurants-bg2.jpg';
            endif;
            echo $this->Html->image($image_path);       
            ?>
        </div>
    </section>
<?php endif; ?>
<!--end Featured-->

<!--Popular-->
<?php if (!empty($popular_restaurents)): ?>
    <section id="popular" class="block background-color-white">
        <div class="container">
            <header><h2><?php echo __('Popular') ?></h2></header>
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
                                    
                                    <div class="type">
                                        <i><img src="/img/icons/restaurant/restaurant.png"></i>
                                        <span><?php echo __('Restaurant') ?></span>
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
        <header><h2><?php echo __('Why Us?') ?></h2></header>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="feature-box">
                    <i class="fa fa-globe"></i>
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
        <header><h2><?php echo __('Partners') ?></h2></header>
        <div class="logos">
            <div class="logo"><a href="#"><?php echo $this->Html->image('logo-partner-01.png'); ?></a></div>
            <div class="logo"><a href="#"><?php echo $this->Html->image('logo-partner-02.png'); ?></a></div>
            <div class="logo"><a href="#"><?php echo $this->Html->image('logo-partner-03.png'); ?></a></div>
            <div class="logo"><a href="#"><?php echo $this->Html->image('logo-partner-04.png'); ?></a></div>
            <div class="logo"><a href="#"><?php echo $this->Html->image('logo-partner-05.png'); ?></a></div>
        </div>
    </div>
    <!--/.container-->
</section>
<!--end Partners-->
<?php echo $this->start('footer_js') ?>
<script>
    $(document).ready(function () {
	$('#location').geocomplete()
        .bind("geocode:result", function(event, result){
                $('#lat').val(result.geometry.location.lat());
                $('#lng').val(result.geometry.location.lng());
          });
  
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