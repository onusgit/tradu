<?php
$curr = '&euro;';
$this->start('header_css');
echo $this->Html->css(array('admin/vendors/bootstrap-switch/css/bootstrap-switch.css'));
$this->end();
?>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Menu') ?>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Categories'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">                               
                <div class="flo_right">
                    <?php
                    echo $this->Html->link(__('Create New Category'), array('controller' => 'products', 'action' => 'admin_add_category', $restaurent_id), array('class' => 'btn btn-primary'));
                    ?>
                </div>
                <div class="cr"></div>
                <div class="table-responsive mtl">
                    <table id="category_lists" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('No.'); ?></th>
                                <th><?php echo __('Name'); ?></th>
                                <th class="text-center"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="Categories">
                            <?php
                            if (!empty($restaurent_categories)) {
                                $cnt = 1;
                                foreach ($restaurent_categories as $k => $cat) {
                                    ?>

                                    <tr class="<?php echo ($k + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?>" id="<?php echo $cat["Category"]["id"]; ?>">
                                        <td>
                                            <?php echo $cnt ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $cat["Category"]["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'admin_edit_category', $cat["Category"]["id"], $cat["Category"]["restaurent_id"]), array('escape' => FALSE, 'class' => 'btn btn-default')); ?>
                                            &nbsp;&nbsp;
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'admin_delete_category', $cat["Category"]["id"], $cat["Category"]["restaurent_id"]), array('escape' => false, 'confirm' => __('Are you sure you want to delete this Category?'), 'class' => 'btn btn-primary')); ?>
                                        </td>
                                    </tr>                   
                                    <?php
                                    $cnt++;
                                }
                            } else {
                                ?>

                            <?php }
                            ?> 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Products'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">
                <div class="flo_right"><?php echo $this->Html->link(__('Create New Product'), array('controller' => 'products', 'action' => 'admin_add_product', $restaurent_id), array('class' => 'btn btn-primary')); ?>
                </div>
                <div class="cr"></div>
                <div class="table-responsive mtl">
                    <table id="product_lists" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('No'); ?></th>
                                <th><?php echo __('Product Name'); ?></th>
                                <th><?php echo __('Category'); ?></th>
                                <th><?php echo __('Price'); ?></th>
                                <th class="text-center"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($restaurent_products)) {
                                $cnt = 1;
                                foreach ($restaurent_products as $k => $product) {
                                    ?>
                                    <tr class="<?php echo ($k + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?> Products" id = '<?php echo $product["Menu"]["id"]; ?>'>
                                        <td>
                                            <?php echo $cnt; ?>
                                        </td>
                                        <td class="center"><?php echo $product["Menu"]["name"]; ?></td> 
                                        <td class="center">
                                            <?php echo $product["Category"]['name']; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo $product["Menu"]["price"] . ' ' . $curr; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'admin_edit_product', $product["Menu"]['id'], $product["Menu"]['restaurent_id']), array('escape' => FALSE, 'class' => 'btn btn-primary')); ?> &nbsp;
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'admin_delete_product', $product["Menu"]['id'], $product["Menu"]['restaurent_id']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this product?'), 'class' => 'btn btn-default')); ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                }
                            }
                            ?>                                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->start('footer_js');
echo $this->Html->script(array('admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js'));
?>
<script>
    $(document).ready(function () {
        $('#product_lists,#category_lists').dataTable({
            /* Disable initial sort */
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ],
            "aaSorting": []
        });
    });
</script>

<?php $this->end('footer_js'); ?>