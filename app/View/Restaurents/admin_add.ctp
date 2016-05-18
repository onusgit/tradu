<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Add New Restaurent'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">    
                <?php echo $this->Form->create('Restaurent', array('id' => 'add_store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-sm-4">
                            <div id="push-down"></div>
                        </div>
                        <div class="col-sm-4 padding-0">
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Name'); ?><span class="require">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('name', array('class' => 'form-control required', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>		                                
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Geolocation'); ?><span class="require">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('address', array('type' => 'text', 'class' => 'form-control required controls', 'label' => FALSE, 'id' => 'addr_id', 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>			   
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Zip Code'); ?><span class="require">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('zipcode', array('class' => 'form-control number required', 'label' => FALSE, 'id' => 'postal_code', 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('City'); ?><span class="require">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('city', array('class' => 'form-control required', 'id' => 'locality', 'div' => FALSE, 'placeholder' => '', 'label' => false, 'div' => false)); ?>
                                </div>
                            </div>                        
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Country'); ?><span class="require">*</span></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('country', array('class' => 'form-control required', 'label' => FALSE, 'id' => 'country', 'div' => FALSE, 'placeholder' => '', 'options' => $countries)); ?>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Resturent Image'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->file('image', array('class' => 'form-control', 'label' => FALSE, 'id' => 'image', 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4"> 
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Email'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Phone Number'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('phone', array('class' => 'form-control', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '1234567890')); ?>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Website'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('website', array('class' => 'form-control', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>
                            </div>			    			    
                        </div>

                        <div class="col-sm-8"> 
                            <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Descriptions'); ?></label>
                                <div class="col-lg-9">
                                    <?php echo $this->Form->input('descriptions', array('class' => 'form-control', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '', 'rows' => 3)); ?>
                                </div>
                            </div>
                        </div>
                    </div>		
                    <div id="latlng">
                        <?php echo $this->Form->input('latitude', array('type' => 'hidden', 'class' => 'search01', 'label' => FALSE, 'id' => 'latitude', 'default' => '45.764043', 'div' => FALSE)); ?>
                        <?php echo $this->Form->input('longitude', array('type' => 'hidden', 'class' => 'search01', 'label' => FALSE, 'id' => 'longitude', 'default' => '4.835658999999964', 'div' => FALSE)); ?>
                    </div>
                    <div class="form-actions cr">
                        <div class="col-lg-12 text-right">
                            <?php echo $this->Html->link(__('Cancel'), array('controller' => 'restaurents', 'action' => 'admin_index'), array('id' => 'btn_cancel', 'class' => 'btn btn-default')); ?>                                            
                            <input type="Submit" class="btn btn-primary" id="add_folder_btn" value="<?php echo __('Save'); ?>">
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->start('footer_js');
echo $this->Html->script('admin/vendors/ckeditor/ckeditor.js');
?>
<script>
    var stockholm = new google.maps.LatLng(45.764043, 4.835658999999964);
    var parliament = new google.maps.LatLng(45.764043, 4.835658999999964);
    var componentForm = {
        //addr_id: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        postal_code: 'short_name',
        country: 'long_name',
    };

    function general() {
        var mapOptions = {
            zoom: 15,
            center: stockholm,
        };
        var marker;

        map = new google.maps.Map(document.getElementById('push-down'), mapOptions);
        //var searchBox = new google.maps.places.SearchBox((input),{ types: ['geocode'] });
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('addr_id')), {types: ['geocode']});
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            // For each place, get the icon, place name, and location.
            var bounds = new google.maps.LatLngBounds();
            var marker = new google.maps.Marker({
                map: map,
                zoom: 15,
                draggable: true,
                position: place.geometry.location
            });
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lng;
            bounds.extend(place.geometry.location);
            google.maps.event.addListener(marker, 'dragend', function (marker) {
                document.getElementById("latitude").value = marker.latLng.lat();
                document.getElementById("longitude").value = marker.latLng.lng();
            });

//	    for (var component in componentForm) {
//		document.getElementById(component).value = '';
//		document.getElementById(component).disabled = false;
//	    }

            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (addressType == 'street_number') {
                    var v2 = place.address_components[i]['long_name'];
                    document.getElementById('route').value = v2;
                }
                if (addressType == 'locality') {
                    var v2 = place.address_components[i]['long_name'];
                    $('#locality').attr('value', v2);
                }
                else if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = $.trim(document.getElementById(addressType).value + ' ' + val);
                }

            }
            map.fitBounds(bounds);
            zoomChangeBoundsListener =
                    google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                        if (this.getZoom()) {
                            this.setZoom(15);
                        }
                    });

        });
    }
    google.maps.event.addDomListener(window, 'load', general);
</script>
<script type="text/javascript">
    $(document).ready(function () {
        CKEDITOR.editorConfig = function (config)
        {
            config.toolbar = 'MyToolbar';

            config.toolbar_MyToolbar =
                    [
                        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                        {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
                        {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'
                                        , 'Iframe']},
                        '/',
                        {name: 'styles', items: ['Styles', 'Format']},
                        {name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']},
                        {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']},
                        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
                        {name: 'tools', items: ['Maximize', '-', 'About']}
                    ];
        };

        CKEDITOR.replace('data[Restaurent][descriptions]',
                {
                    toolbar: 'MyToolbar'
                });
    });
</script>
<?php $this->end('footer_js'); ?>