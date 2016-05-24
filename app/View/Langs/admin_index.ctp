<div class="row">
    <div class="col-lg-12">
        <div class="portlet">
            <div class="portlet-header">
                <div class="caption">
                    <?php echo __('Language'); ?>
                </div>
                <div class="flo_right">
                    <?php
                    echo $this->Html->link(__('Create New Language'), array('controller' => 'langs', 'action' => 'admin_add'), array('class' => 'btn btn-primary'));
                    ?>
                </div>
            </div>
            <div class="portlet-body">                        
                <div class="cr"></div>
                <div class="table-responsive mtl">
                    <table id="category_lists" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo __('No.'); ?></th>
                                <th><?php echo __('Icon'); ?></th>
                                <th><?php echo __('Name'); ?></th>
                                <th class="text-center"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="Categories">
                            <?php
                            if (!empty($languages)) {
                                $cnt = 1;
                                foreach ($languages as $k => $l) {
                                    ?>

                                    <tr class="<?php echo ($k + 1) % 2 ? 'odd gradeA' : 'even gradeA'; ?>" id="<?php echo $l["Language"]["id"]; ?>">
                                        <td>
                                            <?php echo $cnt ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (!empty($l['Language']['language_image'])):
                                                $path_to_image = FULL_BASE_URL . '/uploads/languages/' . $l["Language"]["id"] . '/' . $l['Language']['language_image'];
                                                echo $this->Html->image($path_to_image, array('alt' => $l['Language']['language_image'], 'class' => 'img img-responsive language_flag'));
                                            endif;
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php echo $l["Language"]["name"]; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'langs', 'action' => 'admin_edit', $l["Language"]["id"]), array('escape' => FALSE, 'class' => 'btn btn-default')); ?>
                                            &nbsp;&nbsp;
                                            <?php echo $this->Html->link(__('Delete'), array('controller' => 'langs', 'action' => 'admin_delete', $l["Language"]["id"]), array('escape' => false, 'confirm' => __('Are you sure you want to delete this language?'), 'class' => 'btn btn-primary')); ?>
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