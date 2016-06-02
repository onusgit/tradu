<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Restaurent Types'); ?>
                </div>
            </div>
            <div class="portlet-body">                               
                <div class="flo_right">
                    <?php
                    echo $this->Html->link(__('Add New Restuarent Type'), array('controller' => 'restaurent_types', 'action' => 'admin_add'), array('class' => 'btn btn-primary'));
                    ?>
                </div>
                <div class="cr"></div>
                <div class="table-responsive mtl">
                    <table id="restaurent_type_lists" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('No.'); ?></th>
                                <th><?php echo __('Name'); ?></th>
                                <th class="text-center"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="Categories">
                            <?php
                            if (!empty($restaurent_types)) {
                                $cnt = 1;
                                foreach ($restaurent_types as $k => $type) {
                                    ?>

                                    <tr class="<?php echo ($k + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?>" id="<?php echo $type["RestaurentType"]["id"]; ?>">
                                        <td>
                                            <?php echo $cnt ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $type["RestaurentType"]["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'restaurent_types', 'action' => 'admin_edit', $type["RestaurentType"]["id"]), array('escape' => FALSE, 'class' => 'btn btn-default')); ?>
                                            &nbsp;&nbsp;
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'restaurent_types', 'action' => 'admin_delete', $type["RestaurentType"]["id"]), array('escape' => false, 'confirm' => __('Are you sure you want to delete this Restaurent Type?'), 'class' => 'btn btn-primary')); ?>
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

<?php
$this->start('footer_js');
?>
<script>
    $(document).ready(function () {
        $('#restaurent_type_lists').dataTable({
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