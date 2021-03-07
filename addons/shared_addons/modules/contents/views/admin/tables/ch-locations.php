<td class="child" style="width: 50px">
    <?php echo isset($id) ? $id : ''; ?>
</td>
<td class="child">
    <?php echo $location['name']; ?>
</td>
<td>
    <?php echo $location['id_alias'] ?>
</td>
<td>
    <input type="radio" value="1" name="location[<?php echo $location['id'] ?>]" class="enable" checked>Enable
    <input type="radio" value="0" name="location[<?php echo $location['id'] ?>]" class="disable" <?php if(!$location['status']) echo 'checked';?>>Disable
</td>
<td style="padding-top:10px;">
    <a href="<?php echo site_url('admin/contents/locations/edit/' . $location['id']) ?>" title="<?php echo lang('global:edit') ?>" class="button">
        <?php echo lang('global:edit') ?>
    </a>
    <a href="<?php echo site_url('admin/contents/locations/delete/' . $location['id']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
        <?php echo lang('global:delete') ?>
    </a>
</td>