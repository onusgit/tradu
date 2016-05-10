
<?php
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
                                            <?php echo $cat["Category"]["name"] ;?>
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
                                <th></th>
                                <th><?php echo __('Ref'); ?></th>
                                <th><?php echo __('Product'); ?></th>
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
                                        <td class="dd-handle1 dd3-handle1 bd_tp" style="cursor: move;">
                                            <input type="hidden" id = '<?php echo $product["Menu"]["id"]; ?>'/>
                                        </td>
                                        <td class="center"><?php echo $list["CatalogProduct"]["reference"]; ?></td> 
                                        <td class="center"><?php echo $list["CatalogProduct"]["product_name"]; ?></td>
                                        <?php
                                        //pr($list["CatalogProduct"]);
                                        ?>
                                        <td class="center"><?php echo implode(',', $list['category']); ?></td>
                                        <td class="text-right"><?php
                                            echo $list["CatalogProduct"]["price"] . ' ' . $curr;
                                            ?></td>
                                        <td class="text-center">
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'products', 'action' => 'admin_edit_product', $list["CatalogProduct"]['id'], $list["CatalogProduct"]['store_id'], $list["CatalogProduct"]['type']), array('escape' => FALSE, 'class' => 'btn btn-primary')); ?> &nbsp;
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'products', 'action' => 'admin_delete_product', $list["CatalogProduct"]['id'], $list["CatalogProduct"]['store_id'], $list["CatalogProduct"]['type']), array('escape' => false, 'confirm' => __('Are you sure you want to delete this product?'), 'class' => 'btn btn-default')); ?>
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

<script type="text/javascript">
$(document).ready(function () {
        <?php if (isset($_GET["success"])) { ?>
            success = '<?php echo $_GET['success'] ?>';
            if (success == "1")
            {
                $(".menu_bottom").append("<div class='message'>Product deleted Successfully</div>");
            }
        <?php } ?>
        $("#thecatID").change(function () {
            $("#category_filter").submit();
            $('#thecatID').checked = $(this).val();
        });


        jQuery('.delete_product').click(function () {

            $('input:checkbox.checkbox').each(function () {
                if (this.checked)
                {
                    if (jQuery.inArray(this.value, data) == -1)
                        data.push(this.value);
                } else {
                    data.remByVal(this.value);
                }
            });

            var arr_var = data.join();
            if (data != "")
            {

                var Confirm = confirm("<?php echo __('Are you sure you want to delete this product permanently ?'); ?>");
                if (Confirm == true) {
                    $.ajax({
                        url: '<?php echo SITE_URL; ?>/products/delete_product',
                        data: {product: arr_var},
                        type: 'POST',
                        success: function (response) {
                            window.location.href = '<?php echo SITE_URL; ?>products/index?success=1';
                        }
                    });

                }
                else
                {
                    return false;
                }
            }
            else
            {
                alert("Please Select Checkbox");
            }

        });

        jQuery('#productCheckAll').click(function () {
            if (jQuery("#productCheckAll").is(':checked')) {
                jQuery('.checkbox').attr('checked', true);
            } else {
                jQuery('.checkbox').attr('checked', false);
            }
        })

        jQuery(".checkbox").click(function () {

            if (jQuery(".checkbox").length == jQuery(".checkbox:checked").length) {

                jQuery("#productCheckAll").attr("checked", "checked");
            } else {
                jQuery("#productCheckAll").removeAttr("checked");
            }
        });
    });

</script>

<script>
    $(document).ready(function () {

        $('#product_lists,#category_lists').dataTable({
            /* Disable initial sort */
            "oLanguage": {
                "sUrl": "/<?php
                                if ($this->Session->check('Config.language')):
                                    echo $this->Session->read('Config.language') . ".txt";
                                elseif (isset($this->request->params["named"]["lang"])):
                                    echo $this->request->params["named"]["lang"] . ".txt";
                                else:
                                    echo 'eng.txt';
                                endif;
                            ?>"
            },
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ],
            "aaSorting": []
        });
        
        <?php if (isset($_GET["success"])) { ?>
            success = '<?php echo $_GET['success'] ?>';
            if (success == "1")
            {
                $(".menu_bottom").append("<div class='message'>Category deleted Successfully</div>");
            }
        <?php } ?>


        var data = [];
        jQuery('.delete_category').click(function () {
            $('input:checkbox.checkbox').each(function () {
                if (this.checked)
                {
                    if (jQuery.inArray(this.value, data) == -1)
                        data.push(this.value);
                } else {
                    data.remByVal(this.value);
                }
            });
            arr_var = data.join();

            if (data != "")
            {
                var Confirm = confirm("<?php echo __('Are you sure you want to delete this category?'); ?> ");
                if (Confirm == true) {
                    $.ajax({
                        url: '<?php echo SITE_URL; ?>/categories/delete_category',
                        data: {category: arr_var},
                        type: 'POST',
                        success: function (response) {
                            // alert(response);
                            window.location.href = '<?php echo SITE_URL; ?>Categories/index?success=1';
                            //location.reload();
                        }
                    });

                }
                else
                {
                    return false;
                }
            }
            else
            {
                alert("Please Select Checkbox");
            }


        });

        jQuery('#categoryCheckAll').click(function () {
            if (jQuery("#categoryCheckAll").is(':checked')) {
                jQuery('.checkbox').attr('checked', true);
            } else {
                jQuery('.checkbox').attr('checked', false);
            }
        })

        jQuery(".checkbox").click(function () {

            if (jQuery(".checkbox").length == jQuery(".checkbox:checked").length) {

                jQuery("#categoryCheckAll").attr("checked", "checked");
            } else {
                jQuery("#categoryCheckAll").removeAttr("checked");
            }
        });

        $('.categarySwitch').on('switch-change', function (e, data) {
            var $el = $(data.el)
                    , value = data.value;
            pk = $(this).attr('data-id');
            if (value == false) {
                val = 0;
            } else {
                val = 1;
            }
            $.ajax({
                url: '<?php echo Router::url(array('controller' => 'products', 'action' => 'admin_change_category_status')); ?>' + '.json',
                data: 'pk=' + pk + '&name=status&value=' + val,
                type: 'POST',
                success: function (data) {

                }
            });

        });        
       

        if (jQuery('#IsToggleCategory1').is(":checked")) {
            $('#IsToggleCategory1').addClass('toggle_on');
            $('#IsToggleCategory0').removeClass('toggle_off');
        } else if (jQuery('#IsToggleCategory0').is(":checked")) {
            $('#IsToggleCategory0').addClass('toggle_off');
            $('#IsToggleCategory1').removeClass('toggle_on');
        }
        jQuery('[name="data[is_toggle_category]"]').change(function () {
            var is_toggle_category_on = parseInt($(this).val());
            if (is_toggle_category_on) {
                $('#IsToggleCategory1').addClass('toggle_on');
                $('#IsToggleCategory0').removeClass('toggle_off');
                $.ajax({
                    url: '<?php echo SITE_URL; ?>Application/chnage_category_status',
                    data: {category_change: $(this).val()},
                    type: 'POST',
                    cache: false,
                    success: function () {
                        $('.manage_main').show();
                        $("#menu_product").attr('href', '<?php echo SITE_URL; ?>products/index/' + id);
                    }
                });
            } else {
                $('#IsToggleCategory0').addClass('toggle_off');
                $('#IsToggleCategory1').removeClass('toggle_on');
                $('[name="data[is_toggle_category]"]').removeClass('toggle_active');
                $.ajax({
                    url: '<?php echo SITE_URL; ?>Application/chnage_category_status',
                    data: {category_change: $(this).val()},
                    type: 'POST',
                    cache: false,
                    success: function () {
                        $('.manage_main').hide();
                        $("#menu_product").attr('href', '#');
                        //$("#menu_product").addClass('inactive_pro');
                        // $("#menu_product").bind('Click');
                    }
                });
            }
        });

        var start;
        var end;


        $("#category_lists tbody,#product_lists tbody").sortable({
            cursor: "move",
            start: function (event, ui) {
                // 0 based array, add one
                start = ui.item.prevAll().length + 1;
            },
            update: function (event, ui) {
                // 0 based array, add one
                end = ui.item.prevAll().length + 1;
                var state = '';
                if (start > end) {
                    state = 'up';
                } else {
                    state = 'down';
                }
                var type = 'Products';
                if ($(this).hasClass('Categories')) {
                    type = "Categories";
                }
                // var newOrder = $(this).sortable('toArray').toString();
                var newOrder = $(this).sortable('toArray');
                $.get('./', {order: newOrder, type: type});
                var id = ui.item.context.children[0].innerHTML;
            }
            // end of drag
        });     
    });
</script>

<?php $this->end('footer_js'); ?>