<?php
    $this->start('header_css');
        echo $this->Html->css('jquery.mCustomScrollbar.css');
    $this->end('header_css');
?>
<div id="page-content">
    <!-- Map Canvas-->
    <div class="map-canvas list-width-30">
        <!-- Map -->
        <div class="map">
            <div class="toggle-navigation">
                <div class="icon">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
            <!--/.toggle-navigation-->
            <div id="map" class="has-parallax"></div>
            <!--/#map-->
            
        </div>
        <!-- end Map -->
        <!--Items List-->
        <div class="items-list">
            <div class="inner">
                <header>
                    <h3>Results</h3>
                </header>
                <ul class="results list">

                </ul>
            </div>
            <!--results-->
        </div>
        <!--end Items List-->
    </div>
    <!-- end Map Canvas-->
</div>
<?php 
    echo $this->start('footer_js');
    echo $this->Html->script('views/restaurent_maps.js');
    
    echo $this->Html->script('infobox.js');
    echo $this->Html->script('markerclusterer.js');
    echo $this->Html->script('richmarker-compiled.js');
    echo $this->Html->script('smoothscroll.js');
    echo $this->Html->script('jquery.mCustomScrollbar.concat.min.js');
    echo $this->Html->script('jquery.geocomplete.js');    

?>
<script>
    var _latitude = 51.541216;
    var _longitude = -0.095678;
    var jsonPath = "<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'index')) . '.json'; ?>";

    // Load JSON data and create Google Maps

    $.getJSON(jsonPath)
        .done(function(json) {
            createHomepageGoogleMap(_latitude,_longitude,json);
        })
        .fail(function( jqxhr, textStatus, error ) {
            console.log(error);
        })
    ;
   
    //autoComplete();

</script>
<?php echo $this->end('footer_js'); ?>