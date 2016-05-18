<?php
$curr = '&euro;';
$this->start('header_css');
echo $this->Html->css(array('admin/vendors/bootstrap-switch/css/bootstrap-switch.css'));
echo $this->Html->css(array('admin/vendors/jquery-nestable/nestable.css'));
echo $this->Html->css(array('admin/token-input-facebook.css'));
$this->end();
?>

<div class="row mbxl">
    <div class="col-lg-12">
        <div class="portlet">

            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('New Product'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>

            <div class="portlet-body">
                <?php echo $this->Form->create('Menu', array('type' => 'file', 'id' => 'add_product', 'enctype' => 'multipart/form-data', 'class' => "form-horizontal")); ?>
                <h3 class="block-heading"><?php echo __('Product'); ?></h3>
                <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Product Name'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('name', array('type' => 'text', 'label' => FALSE, 'class' => 'form-control required eCheckExist', 'id' => 'productname')); ?>
                        <?php echo $this->Form->input('restaurent_id', array('label' => FALSE, 'class' => 'form-control required eCheckExist', 'type' => 'hidden', 'value' => $restaurent_id)); ?>
                    </div>
                </div>
                
                <?php foreach ($menu_languages as $k => $lang): ?>
                    <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('Product') . '  ' . $lang['Language']['name'] . '  ' . __('Name'); ?><span class="require">*</span></label>
                        <div class="col-lg-9">
                            <?php echo $this->Form->input('name', array('type' => 'text', 'label' => FALSE, 'class' => 'form-control required eCheckExist', 'id' => 'productname', 'name' => "product_name[{$lang['Language']['id']}]")); ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="form-group menu_category_container"><label class="col-lg-3 control-label"><?php echo __('Category'); ?><span class="require">*</span></label>
                    <div class="col-lg-9">
                        <div class="form-control">
                            <?php echo $this->Form->input('category_id', array('type' => 'select', 'label' => FALSE, 'id' => 'product_category', 'class' => 'form-control required', 'div' => false, 'options' => $restaurent_categories)); ?>
                        </div>
                    </div>
                </div>          


                <div class="form-group"><label class="col-lg-3 control-label"><?php echo __('price'); ?></label>
                    <div class="col-lg-9 input-group flo_right" id="parent_div">
                        <?php
                        echo '<span class="input-group-addon">' . $curr . '</span>';

                        echo $this->Form->input('price', array('label' => FALSE, 'class' => 'form-control required number currency_text_width', 'id' => 'price', 'div' => false, 'type' => 'number'));
                        ?>

                    </div>
                </div>                      

                <div class="form-actions">
                    <div class="col-lg-9 col-lg-offset-3">
                        <input type="button" class="btn btn-default" id="btn_cancel" value="<?php echo __('Cancel'); ?>" onclick='history.back();'>
                        <input type="submit" class="btn btn-primary" value="<?php echo __('Save'); ?>">
                    </div>
                </div>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<style>
    .menu_category_container .form-control {
        padding: 0;
    }
</style>