<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Add New Language'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">    
                <?php echo $this->Form->create('Language', array('id' => 'add_language', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Name'); ?><span class="require">*</span></label>
                            <div class="col-lg-9">
                                <?php echo $this->Form->input('name', array('class' => 'form-control required', 'label' => FALSE, 'div' => FALSE, 'placeholder' => '')); ?>
                            </div>
                        </div>                              

                        <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Language Image'); ?></label>
                            <div class="col-lg-9">
                                <?php echo $this->Form->file('image', array('class' => 'form-control', 'label' => FALSE, 'id' => 'image', 'div' => FALSE, 'placeholder' => '')); ?>
                                <label class="require control-label"><?php echo __('40 * 40 size is preffered'); ?></label>
                            </div>
                        </div>
                        <div class="form-actions cr">
                            <div class="col-lg-12 text-right">
                                <?php echo $this->Html->link(__('Cancel'), array('controller' => 'languages', 'action' => 'admin_index'), array('id' => 'btn_cancel', 'class' => 'btn btn-default')); ?>                                            
                                <input type="Submit" class="btn btn-primary" id="add_btn" value="<?php echo __('Save'); ?>">
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>