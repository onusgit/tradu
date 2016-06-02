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
            <div id="map" class="has-parallax"></div><!--/#map-->
            
                   <div class="search-bar horizontal">
                <?php 
                    echo $this->Form->create('Rest', array( 'type' => 'post', 'url' => Router::url(array('controller' => 'restaurents', 'action' => 'index')), 'class' => 'main-search border-less-inputs background-dark narrow restaurent_filter', 'role' => 'form'));
                ?>
                    <div class="input-row">
                        <div class="form-group">
                            <label for="keyword"><?php echo __('Restaurent Name') ?></label>
                            <?php 
                                echo $this->Form->input('name', array('class' => 'form-control', 'name' => 'Rest[name]', 'id' => 'keyword',  'placeholder' => __("Enter Restaurent Name"), 'label' => false, 'value' => $rest_name));
                            ?>
                        </div>
                        <!-- /.form-group -->
                      
                          <!-- /.form-group -->
                            <div class="form-group">
                                <label for="model"><?php echo __('Place Type') ?></label>
                                <?php
                                    //echo $this->Form->input('type', array('id' => 'model','name' => 'Rest[type][]', 'multiple' => 'multiple', 'title' => __('Any'), 'data-live-search' => 'true', 'type' => 'select', 'options' => $restaurent_types, 'label' => false, 'value' => $restaurent_types));
                                    $types = explode(',', $rest_type);
                                ?> 
                                <select name="Rest[type][]" id="model" multiple title="Any" data-live-search="true">
                                    <?php foreach($restaurent_types as $k => $r_type): ?>
                                        <?php
                                            $selected = '';
                                            if(in_array($r_type['RestaurentType']['id'], $types)):
                                                $selected = 'selected';
                                            else:
                                                $selected = '';
                                            endif;
                                        ?>
                                        <option <?php echo $selected ?> value="<?php echo $r_type['RestaurentType']['id'] ?>"><?php echo $r_type['RestaurentType']['name'] ?></option>
                                    <?php endforeach; ?>                                    
                                </select>

                            </div>
                            <!-- /.form-group -->
                       
                        <div class="form-group">
                            <label for="location"><?php echo __('Location') ?></label>
                            <div class="input-group location">
                                <?php 
                                    echo $this->Form->input('address', array('class' => 'form-control',  'name' => 'Rest[address]', 'id' => 'location',  'placeholder' => __("Enter Location"), 'label' => false, 'value' => $rest_address));
                                    echo $this->Form->input('lat', array('type' => 'hidden', 'class' => 'form-control',  'name' => 'Rest[lat]', 'id' => 'lat', 'value' => $latitude));
                                    echo $this->Form->input('lng', array('type' => 'hidden', 'class' => 'form-control',  'name' => 'Rest[lng]', 'id' => 'lng', 'value' => $longitude));
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
<?php 
    echo $this->start('footer_js');
    echo $this->Html->script('views/restaurent_maps.js');    
    echo $this->Html->script('infobox.js');
    echo $this->Html->script('markerclusterer.js');
    echo $this->Html->script('richmarker-compiled.js');

?>
<script>        
    var _latitude = '<?php echo $latitude ?>';
    var _longitude = '<?php echo $longitude ?>';    
   
    var jsonPath = "<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'index')) . '.json'; ?>";
        $.ajax({
            url : jsonPath,
            type : 'POST',
            data : {
                    Rest:
                        {
                            name:'<?php echo $rest_name ?>',
                            address:'<?php echo $rest_address ?>',
                            lat:'<?php echo $latitude ?>',
                            lng:'<?php echo $longitude ?>',
                            rest_type:'<?php echo $rest_type ?>',
                        }
                    },
            success : function(json) {
               createHomepageGoogleMap(_latitude,_longitude,json);
            }
        });
        
   
    $('.quick-view').live('click', function () {
            var id = $(this).attr('id');
            quickView(id);
            return false;
        });
        
        function quickView(id){
            $.ajax({
                type: 'POST',
                url: '<?php echo Router::url(array('controller' => 'restaurents', 'action' => 'quick_view' )) ?>',
                data: {id: id},
                success: function (data) {
                    $('body').append(data);
                }
            });
        }
        $('#location').geocomplete()
        .bind("geocode:result", function(event, result){
                $('#lat').val(result.geometry.location.lat());
                $('#lng').val(result.geometry.location.lng());
          });
    //autoComplete();

</script>
<?php echo $this->end('footer_js'); ?>