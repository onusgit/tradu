<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Featured Image'); ?>
                </div>
            </div>
            <div class="portlet-body">
                <?php if (empty($featured_image)): ?>
                    <div class="flo_right">
                        <?php
                        echo $this->Html->link(__('Add Featured Image'), array('controller' => 'settings', 'action' => 'admin_add_featured_picture'), array('class' => 'btn btn-primary'));
                        ?>
                    </div>
                <?php endif; ?>
                <div class="cr"></div>
                <?php if (!empty($featured_image)): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 text-center">
                                <div class="main_img_container">
                                    <?php
                                    $img_path = FULL_BASE_URL . '/app/uploads/settings/' . $featured_image['Setting']['key_value'];
                                    echo $this->Html->image($img_path, array('class' => 'img img-responsive'));
                                    $close_btn = $this->Html->image('close_img.png', array('class' => 'img img-responsive'));
                                    echo $this->Html->link($close_btn, array('controller' => 'settings', 'action' => 'admin_delete_featured_picture'), array('escape' => false, 'confirm' => __('Are you sure you want to delete main image?'), 'class' => 'close_btn'));
                                    ?>
                                </div>
                            </div>
                            <?php echo $this->Form->create('Setting', array('id' => 'add_main_image', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <?php echo $this->Form->file('featured_image', array('class' => 'form-control', 'label' => FALSE, 'id' => 'image', 'div' => FALSE, 'placeholder' => '')); ?>
                                </div>                            
                            </div>
                            <div class="form-actions cr">
                                <div class="col-lg-12 text-right">
                                    <input type="Submit" class="btn btn-primary" id="add_folder_btn" value="<?php echo __('Save'); ?>">
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

