<div class="row">
    <div class="col-lg-12">
        <div class="panel">
            <div class="panel-body"><h4 class="block-heading"><?php echo __('Add Category'); ?></h4>
                
                <?php 
                    echo $this->Form->create('Category', array('type' => 'file', 'enctype' => 'multipart/form-data', 'class' => "form-horizontal"));
                    echo $this->Form->input('restaurent_id', array('type' => 'hidden', 'value' => $restaurent_id));
                ?>                
                <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Name'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('name', array('label' => FALSE, 'class' => 'search01_small form-control')); ?>
                    </div>
                </div>          

            </div>

            <div class="form-actions">
                <div class="col-lg-9 col-lg-offset-3">
                    <?php echo $this->Html->link(__('Cancel'), array('action' => 'index', ), array('class' => 'btn btn-default')); ?>
                    <input type="Submit" class="btn btn-primary" id="add_category_btn" value="<?php echo __('Save'); ?>">
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>


