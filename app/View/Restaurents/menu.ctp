<?php $curr = '&euro;'; ?>
<div class="container main_container">
    <div class="col-md-3 sidebar">
        <div class="col-md-12">
            <div class="row category_row simplefilter" id="filters">
                <li class="category_filter active" data-filter="*"><?php echo 'All'; ?></li>
                <?php foreach ($restaurent_categories as $k => $category): ?>
                    <li class="category_filter" data-filter=".cat_<?php echo $category['Category']['id'] ?>"><?php echo $category['Category']['name']; ?></li>
                <?php endforeach; ?> 
            </div>
        </div>
    </div>

    <div class="col-md-9 main-container">
        <div class="row">
            <div class="col-md-12 menu_language_container">
                <?php foreach ($languages as $k => $lang): ?>
                    <div class="lang_container">
                        <?php
                        if ($default_lang == $lang['Language']['id']):
                            $selected = 'active';
                        else:
                            $selected = '';
                        endif;
                        ?>
                        <a href="#" class="lang_selector <?php echo $selected; ?>" data-id="<?php echo $lang['Language']['id'] ?>" >
                            <?php //echo $lang['Language']['name'] ?>
                            <?php echo $this->Html->image('flags/' . $lang['Language']['id'] . '.png', array()); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div id="portfolio_container" class="col-md-8 resturent_menu_container filtr-container">
                <?php foreach ($data as $k => $d): ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 menu_row filtr-item item cat_<?php echo $d['product_categry']['Category']['id'] ?>" data-category="cat_<?php echo $d['product_categry']['Category']['id'] ?>">
                        <h2 class="category_title">
                            <?php echo $d['product_categry']['Category']['name'] ?>
                        </h2>

                        <?php
                        if (!empty($d['products'])):
                            foreach ($d['products'] as $k => $p):
                                ?>
                                <div class="col-md-12">
                                    <div class="product_row row">
                                        <div class="col-md-9 menu_name"><?php //echo $p['Menu']['name'];     ?></div>
                                        <?php
                                        if (!empty($p['MenuLanguage'])):
                                            foreach ($p['MenuLanguage'] as $key => $l):
                                                ?>
                                                <div class="col-md-9 menu_name menu_language" data-id="<?php echo $l['language_id'] ?>"><?php echo $l['name']; ?></div>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                        <div class="col-md-3 menu_price text-right"><?php echo $p['Menu']['price'] . ' ' . $curr; ?></div>
                                    </div>                            
                                </div>                            
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>      

<style>
    .menu_row {
        padding-bottom: 20px;
        background-color: transparent;
        position: relative !important;
        top: 0 !important;
        margin-bottom: 20px;
    }
    .menu_row:hover{
        color: #fff;
    }

    .category_title {
        margin: 0;
        padding-bottom: 10px;
        border-bottom: 2px dashed#0DCDBD;
        margin-bottom: 20px;
        color: #0DCDBD;
        font-size: 20px;
    }
    .product_row {
        margin-bottom: 20px;
    }
    .menu_name{
        text-transform: uppercase;
        //font-weight: bold;
        font-family: Verdana;
    }
    .menu_price {
        color: #ccc;
        font-family: cursive;
        font-weight: bold;
    }
    #page-content {
        //background-image: url("http://www.papannis.com/img/restaurant.jpg");
        background-image: url("https://www.pritikin.com/wp/wp-content/uploads/2014/02/pritikin-diet.jpg.pagespeed.ce.xgiAzjRY2G.jpg");
        background-position: left center;
        background-size: cover;
        box-shadow: 0 0 0 20000px rgba(0, 0, 0, 0.6) inset;
        color: #fff;
        transition: all 0.5s ease-in-out;
        background-attachment: fixed;
        padding: 60px 0;
    }
    .category_filter{
        font-weight: bold;
        cursor: pointer;
    }
    .category_row {
        list-style: none;
        background-color: rgba(0, 0, 0, 0.3);
    }
    .category_row .category_filter {
        font-size: 20px;
        font-weight: bold;
        padding: 10px 20px;
        text-transform: uppercase;
    }
    .category_row .category_filter.active{
        background-color: rgba(0,0,0,0.5);
    }
    .menu_language{
        display: none;
    }
    .resturent_menu_container {
        height: auto !important;
    }
    .menu_language_container .lang_container {
        display: inline-block;
        color: #fff;
    }
    .menu_language_container{
        margin-bottom: 20px;
    }
    .menu_language_container .lang_selector{
        display: block;
        transition: all 0.4s ease-in-out;
    }
    .menu_language_container .lang_selector.active{
        background-color: rgba(255,255,255,0.3);
    }
    .menu_language_container .lang_selector {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 5px;
        border-radius: 100%;
        box-shadow: 0px 0px 30px #fff;
        transition: all 0.5s linear;
    }
    .menu_language_container .lang_selector:hover {
        background-color: rgba(13, 205, 189, 1);
        box-shadow: 0px 0px 0px #fff;
    }
    .menu_language_container .lang_selector.active {
        background-color: rgba(13, 205, 189, 1);
        box-shadow: 0px 0px 0px #fff;
    }
    .lang_container {
        margin: 0 10px;
    }
</style>
<?php
echo $this->start('footer_js');
echo $this->Html->script('isotope.pkgd.js');
?>
<script>
    $(document).ready(function () {
        var $container = $('#portfolio_container').isotope({
            itemSelector: '.item',
            isFitWidth: true,
            resizable: false,
            //position: 'relative',
            animationEngine: 'best-available',
            animationOptions: {
                duration: 100,
                queue: false
            }
        });

        $container.isotope({filter: '*'});

        $('.category_filter').click(function () {
            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue,
                animationOptions: {
                    duration: 100,
                    queue: false
                }
            });
        });

        $('.simplefilter li').click(function () {
            $('.simplefilter li').removeClass('active');
            $(this).addClass('active');
        });

        $('.lang_selector').click(function () {
            var lang_id = $(this).attr('data-id');
            $('.menu_name').hide();
            $('.lang_selector').removeClass('active');
            $('.menu_name.menu_language[data-id = ' + lang_id + ' ]').fadeToggle();
            $(this).closest('.lang_selector').addClass('active');
        });

        $('.menu_name.menu_language[data-id = "<?php echo $default_lang; ?>"]').fadeToggle();
    });
</script>
<?php
echo $this->end('footer_js');
?>