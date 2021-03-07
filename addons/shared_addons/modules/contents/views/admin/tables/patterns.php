<?php
$i = 1;
?>
<table cellspacing="0">
    <tbody>

    <input  type="hidden" name="id_site" value="<?php echo isset($params['id_site']) ? $params['id_site'] : ''; ?>" />
    <?php foreach ($value_patterns as $key => $item) : ?>
        <!--Input save value id pattern-->
        <input  type="hidden" name="<?php echo $item['machine_name']; ?>[]" value="<?php echo $item['id_pattern']; ?>" />
        <!--Button Edit and Delete-->
        <tr class="drag-disable">
            <td><b><?php echo ($key + 1) . ' -- ' . $item['pattern_name']; ?></b>&nbsp; <button class="add_field_button" data="<?php echo $item['machine_name']; ?>">+</button></td>
            <td>
                <a href="<?php echo site_url('admin/contents/patterns/edit/' . $item['id_pattern']) . '/' . $params['id_site'] ?>" title="<?php echo lang('global:edit') ?>" class="button">
                    <?php echo lang('global:edit') ?>
                </a>
                <a href="<?php echo site_url('admin/contents/patterns/delete/' . $item['id_pattern']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
                    <?php echo lang('global:delete') ?>
                </a>
            </td>
        </tr>
        <?php if (!empty($item['child'])) : ?>
            <tbody id="sortable<?php echo $item['id']; ?>">
                <?php $i = 1;
                foreach ($item['child'] as $child) : ?>
                    <tr class="<?php echo $item['machine_name']; ?>">
                        <td colspan="2">
                            <img class="drag-handle"alt="Drag Handle" src="<?php echo site_url('addons/shared_addons/modules/contents/img/drag_handle.gif') ?>">
                            <input class="drag-disable" type="text" name="<?php echo $item['machine_name']; ?>[<?php echo $i ?>][value_pattern]" value="<?php echo htmlspecialchars($child['value_pattern']); ?>" style="width: 500px;"/>
                            <button class="remove-pattern">-</button>
                            <input  type="hidden" name="<?php echo $item['machine_name']; ?>[<?php echo $i++ ?>][status]" value="<?php echo $child['status']; ?>" style="width: 500px;"/>
                            <?php if ($child['status']) : ?>
                                <img src="<?php echo site_url('addons/shared_addons/modules/contents/img/check_success.gif') ?>" width="24px" height="16px">
                            <?php else : ?>
                                <img src="<?php echo site_url('addons/shared_addons/modules/contents/img/check_fail.gif') ?>" width="24px" height="16px">
            <?php endif; ?>
                        </td>
                    </tr>
            <?php endforeach; ?>
            </tbody>
        <?php endif; ?>
<?php endforeach ?>
</tbody>
</table>
<br>
<div class="buttons">
<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
</div>
<script type="text/javascript">

    $(".add_field_button").click(function (e) {
        e.preventDefault();
        var machine_name = $(this).attr('data');
        console.log(machine_name);
        var tab_pattern = $(this).parent().parent();
        if ($('.' + machine_name).length) {
            $('.' + machine_name).last().after('<tr class="' + machine_name + '"><td colspan="2">' +
                    '<img class="drag-handle" alt="Drag Handle" src="addons/shared_addons/modules/contents/img/drag_handle.gif">' +
                    '<input class="drag-disable" style="width: 500px;" type="text" name="' + machine_name + '[<?php echo $i++ ?>][value_pattern]"/><button class="remove-pattern">-</button></td></tr>'); //add input box        
        } else {
            $(tab_pattern).after('<tr class="' + machine_name + '"><td colspan="2">' +
                    '<img class="drag-handle" alt="Drag Handle" src="addons/shared_addons/modules/contents/img/drag_handle.gif">' +
                    '<input style="width: 500px;" type="text" name="' + machine_name + '[<?php echo $i ?>][value_pattern]"/><button class="remove-pattern">-</button></td></tr>'); //add input box        
        }
        $(".remove-pattern").click(function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        });

    });

    $(".remove-pattern").click(function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

    $(function () {
        $('tbody[id*=sortable]').each(function () {
            var id = $(this).attr('id');
            $("#" + id).sortable({
                cancel: ".drag-disable",
//                handle: 'td',
                scroll: true,
                scrollSpeed: 1,
                delay: 100,
                cursorAt: {left: 0, top: -200},
                distance: 1,
                connectWith : "#" + id,
                grid: [1, 1],
                placeholder: "ui-sortable-placeholder",
                scrollSensitivity: 0,
                start: function (event, ui) {
                    ui.placeholder.height(ui.helper.outerHeight());
                },
                
            });
            $("#" + id).disableSelection();
        });
    });

</script>   