<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>

        <div class="modal-window fade_in">
            <div class="modal-wrapper">
                <h2>
                    <?php
                    echo $restaurent['Restaurent']['name'];
                    ?>
                </h2>
                <figure>
                    <?php echo $restaurent['Restaurent']['address']; ?>
                </figure>
                <div class="modal-body">
                    <div class="gallery">
                        <div class="image">
                            <?php
                            $image_path = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $restaurent['Restaurent']['id'] . '/' . $restaurent['Restaurent']['resturent_image'];
                            echo $this->Html->image($image_path, array('alt' => $restaurent['Restaurent']['name'], 'class' => 'img img-responsive'))
                            ?>
                        </div>
                        <?php if (!empty($restaurent['Category'])): ?>
                            <div class="features">
                                <h3>Categories</h3>

                                <ul class="bullets">
                                    <?php foreach ($restaurent['Category'] as $k => $cat): ?>
                                        <li><?php echo $cat['name'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-content">
                        <section><h3>Description</h3>
                            <p>
                                <?php echo $restaurent['Restaurent']['descriptions'] ?>
                            </p>
                        </section>
                        <?php if (!empty($restaurent['Category'])): ?>
                            <section>
                                <h3>Categories<span class="pull-right">Items</span></h3>
                                <dl>
                                    <?php foreach ($restaurent['Category'] as $k => $cat) : ?>
                                        <dt><?php echo $cat['name'] ?></dt>
                                        <dd><?php echo count($cat['Menu']); ?></dd>
                                    <?php endforeach; ?>                            
                                </dl>
                            </section>
                        <?php endif; ?>

                        <a href="<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'menu', $restaurent['Restaurent']['id'])) ?>" class="btn btn-default btn-large">Show Detail</a></div>
                </div>
                <div class="modal-close"><?php echo $this->Html->image('close.png') ?></div>
            </div>
            <div class="modal-background fade_in"></div>
        </div>

        <script>
            // Render Rating stars
            rating('.modal-window');

            // Remove modal element form DOM
            $('.modal-window .modal-background, .modal-close').live('click', function (e) {
                $('.modal-window').addClass('fade_out');
                setTimeout(function () {
                    $('.modal-window').remove();
                }, 300);
            });
        </script>
    </body>

</html>
