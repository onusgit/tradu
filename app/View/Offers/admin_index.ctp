<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Manage Offers'); ?>
                </div>
                <div class="tools"><i class="fa fa-chevron-up"></i></div>
            </div>
            <div class="portlet-body">
                <div class="text-right">
                    <?php
                    echo $this->Html->link(__('Add New Offers'), array('controller' => 'offers', 'action' => 'admin_add'), array('class' => 'btn btn-primary', 'id' => 'add_subscription'));
                    ?>
                </div>                                                               
                <div class="table-responsive mtl">
                    <table id="traducmeal_offer" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('Offer Name'); ?></th>
                                <th><?php echo __('Features'); ?></th>
                                <th><?php echo __('Monthly Price'); ?></th>
                                <th><?php echo __('Annual Price'); ?></th>
                                <th><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($offers)) {
                                foreach ($offers as $key_app => $o) {
                                    ?>
                                    <tr class="<?php echo ($key_app + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?>" class=" sorting_1">
                                        <td class="center"><?php echo $o['Offer']['name']; ?></td>
                                        <td class="center">
                                            <?php
                                            $service_type = unserialize($o['Offer']['features']);
                                            foreach ($service_type as $f):
                                                echo '<div class="features">' . __($f) . '</div>';
                                            endforeach;
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php $default_currency_symbol = Configure::read("app_settings.default_currency_symbol"); ?>
                                            <?php echo $o['Offer']['monthly_price'] . $default_currency_symbol; ?></td> 
                                        <td class="center"><?php echo $o['Offer']['yearly_price'] . $default_currency_symbol; ?></td>
                                        <td class="center">
                                            <?php
                                            echo $this->Html->link(__('Edit'), array('controller' => 'offers', 'action' => 'admin_edit', $o['Offer']['id']), array('escape' => false, 'class' => 'btn btn-default'));
                                            echo '&nbsp;' . $this->Html->link(__('Delete'), array('controller' => 'offers', 'action' => 'admin_delete', $o['Offer']['id']), array('class' => 'btn btn-primary', 'escape' => false, 'confirm' => __('Are you sure you want to delete this offer?')));
                                            ?>
                                        </td> 
                                    </tr>
                                    <?php
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
<?php $this->start('footer_js'); ?>
<script>
    $(document).ready(function () {
        $('#traducmeal_offer').dataTable({
            aoColumnDefs: [
                {
                    bSortable: false,
                    aTargets: [-1]
                }
            ],
            "aaSorting": []
        });
    })
</script>
<?php $this->end('footer_js'); ?>