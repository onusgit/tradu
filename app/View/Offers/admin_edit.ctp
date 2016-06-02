<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Update Offer'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">
                <?php echo $this->Form->create('Offer', array('id' => 'update_offer', 'class' => "form-horizontal")); ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo __('Offer Name'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('name', array('class' => 'form-control required', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo __('Features'); ?><span class="require">*</span></label>
                    <div class="col-lg-6 features_container">
                        <?php
                        $feature = unserialize($offer['Offer']['features']);
                        foreach ($feature as $k => $f):
                            ?>
                            <span class="feature_container_box">
                                <input name="data[Offer][features][]" class="form-control required features" required="required" type="text" id="OfferFeatures" value="<?php echo $f ?>">
                                <?php if($k > 0): ?>
                                <span class="close_icon">
                                    <i class="fa fa-times"></i>
                                </span>
                                <?php endif; ?>
                            </span>
                        <?php endforeach; ?>                        
                    </div>
                    <div class="col-lg-3">
                        <div class='add_feature_block' id="add_feature_btn">
                            <i class='fa fa-plus'></i>
                        </div>
                    </div>
                </div>              

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo __('Monthly Price'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('monthly_price', array('type' => 'text', 'class' => 'form-control required number', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                    </div>
                </div>

                <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Annual Price'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('yearly_price', array('type' => 'text', 'class' => 'form-control required number', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                    </div>
                </div>


                <div  class="form-actions">
                    <div class="col-lg-12 text-center">
                        <input type="button" class="btn btn-default" id="btn_cancel" value="<?php echo __('Cancel'); ?>" onclick='history.back();'>
                        <input type="Submit" class="btn btn-primary" id="update_offer_btn" value="<?php echo __('Save'); ?>">
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
</div>
<?php
$this->start('footer_js');
echo $this->Html->script('admin/vendors/jquery-validation/dist/jquery.validate.js');
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#add_feature_btn').live('click', function () {
            $('.features_container').append('<span class="feature_container_box"><input name="data[Offer][features][]" class="form-control required features" required="required" type="text" id="OfferFeatures"><span class="close_icon"><i class="fa fa-times"></i></span></span>');
        });
        $('.close_icon').live('click', function () {
            $(this).parent().remove();
        });
        $('#update_offer_btn').live('click', function(){
            $('#update_offer').validate();            
        });

    });
</script>
<?php $this->end('footer_js'); ?>