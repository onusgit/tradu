<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Update Language'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">    
                <?php echo $this->Form->create('Language', array('id' => 'update_language', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Name'); ?><span class="require">*</span></label>
                            <div class="col-lg-9">
                                <?php echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'form-control required', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                                <?php echo $this->Form->input('name', array('class' => 'form-control required', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                            </div>
                        </div>		                                

                        <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Language Image'); ?></label>
                            <?php if (!empty($language['Language']['language_image'])): ?>
                                <div class="col-lg-3">
                                    <?php
                                    $image_path = FULL_BASE_URL . '/app/webroot/uploads/languages/' . $language['Language']['id'] . '/' . $language['Language']['language_image'];
                                    echo $this->Html->image($image_path, array('alt' => $language['Language']['name'], 'class' => 'img img-responsive'))
                                    ?>
                                </div>
                            <?php endif; ?>

                            <div class="col-lg-6">
                                <?php echo $this->Form->file('image', array('class' => 'form-control', 'label' => FALSE, 'id' => 'image', 'div' => FALSE, 'placeholder' => '')); ?>
                            </div>                            
                        </div>                   

                        <div class="form-actions cr">
                            <div class="col-lg-12 text-right">
                                <?php echo $this->Html->link(__('Cancel'), array('controller' => 'languages'
                                    . '', 'action' => 'admin_index'), array('id' => 'btn_cancel', 'class' => 'btn btn-default')); ?>                                            
                                <input type="Submit" class="btn btn-primary" id="add_folder_btn" value="<?php echo __('Save'); ?>">
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>