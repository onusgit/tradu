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
                    <?php echo __('Restaurents'); ?>
                </div>
                <div class="tools">
                    <?php
                    echo $this->Html->link('Add Restaurent', array('controller' => 'restaurents', 'action' => 'admin_add'), array('class' => 'btn btn-primary', 'title' => __('Create New Restaurent'), 'escape' => false));
                    ?>                    
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive mtl">
                    <table id="stores_list" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('Image'); ?></th>      				                                 
                                <th><?php echo __('Name'); ?></th>      				                                 
                                <th><?php echo __('City'); ?></th>      				                                 
                                <th><?php echo __('Phone'); ?></th>                                
                                <th><?php echo __('Status'); ?></th>
                                <th class="text-center"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($restaurents)) {
                                foreach ($restaurents as $k => $r) {
                                    ?>
                                    <tr class="<?php echo ($k + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?>" class=" sorting_1">
                                        <td class="center">
                                            <?php
                                            if (!empty($r["Restaurent"]["resturent_image"])):
                                                $image_path = FULL_BASE_URL . '/app/webroot/uploads/restaurents/' . $r['Restaurent']['id'] . '/' . $r['Restaurent']['resturent_image'];
                                                echo $this->Html->image($image_path, array('alt' => $r['Restaurent']['name'], 'class' => 'img img-responsive', 'width' => 100, 'height' => 100));
                                            endif;
                                            ?>
                                        </td>
                                        <td class="center"><?php echo $this->Text->truncate($r["Restaurent"]["name"], 25, array('exact' => true)); ?></td>
                                        <td class="center"><?php echo $r["Restaurent"]["name"]; ?></td>
                                        <td class="center"><?php echo $r["Restaurent"]["city"]; ?></td>
                                        <td class="center"><?php echo $r["Restaurent"]["phone"]; ?></td>                                                                               
                                        <td class="center">					    										 
                                            <div class="make-switch storeSwitch" data-id="<?php echo $r["Restaurent"]['id']; ?>" data-on-label="<?php echo __('Active'); ?>" data-off-label="<?php echo __('Inactive'); ?>" id="categorySwitch"><?php echo $this->Form->checkbox('status', array('class' => '', 'name' => 'data[status][' . $r["Restaurent"]['id'] . ']', $r["Restaurent"]['status'] ? 'checked' : '')); ?></div>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            $url = "/restaurents/menu/".$r["Restaurent"]["id"];
                                            echo $this->Html->link('View Menu Page', '#', array('escape' => FALSE, 'class' => 'btn btn-primary', 'onclick' => "window.open('$url' , '_blank')"));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Menu', array('controller' => 'products', 'action' => 'admin_index', $r['Restaurent']['id']), array('escape' => FALSE, 'class' => 'btn btn-primary'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('<i class = "fa fa-trash-o"></i>', array('controller' => 'restaurents', 'action' => 'delete', $r["Restaurent"]["id"]), array('class' => 'btn btn-default', 'escape' => false, 'confirm' => __('Are you sure you want to delete this category?')));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('<i class = "fa fa-pencil"></i>', array('controller' => 'restaurents', 'action' => 'admin_edit', $r["Restaurent"]["id"]), array('class' => 'btn btn-info', 'escape' => false));
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
<?php
$this->start('footer_js');
echo $this->Html->script(array('admin/vendors/bootstrap-switch/js/bootstrap-switch.min.js'));
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#stores_list').dataTable({
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

        $('.storeSwitch').on('switch-change', function (e, data) {
            var $el = $(data.el)
                    , value = data.value;
            var pk = $(this).attr('data-id');
            var url = '<?php echo SITE_URL; ?>admin/restaurents/restaurent_status_change';
            if (value == false) {
                val = 0;
            } else {
                val = 1;
            }
            $.ajax({
                url: url,
                data: 'pk=' + pk + '&name=status&value=' + val,
                type: 'POST',
                cache: false,
                success: function (resp) {
                }
            });

        });
    });
</script>
<?php $this->end(); ?>