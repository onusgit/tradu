<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Update Main image'); ?>
                </div>
            </div>
            <div class="portlet-body">          
                <?php echo $this->Form->create('Setting', array('id' => 'add_main_image', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Main Image'); ?></label>
                            <div class="col-lg-3">
                                <?php echo $this->Form->file('main_image', array('class' => 'form-control', 'label' => FALSE, 'id' => 'image', 'div' => FALSE, 'placeholder' => '')); ?>
                            </div>
                            <div class="col-lg-6">
                                <?php 
                                $img_path = FULL_BASE_URL .  '/app/uploads/settings/' . $main_image['Setting']['key_value'];
                                echo $this->Html->image($img_path, array('class' => 'img img-responsive')); 
                                ?>
                            </div>
                        </div>
                    </div>
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
