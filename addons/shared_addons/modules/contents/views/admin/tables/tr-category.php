<td class="category-name">
    <?php echo $category['name'] ?>
</td>
    
<td>
    <input type="radio" value="1" name="categories[<?php echo $category['id'] ?>]" class="enable" checked>Enable
    <input type="radio" value="0" name="categories[<?php echo $category['id'] ?>]" class="disable" <?php if(!$category['status']) echo 'checked';?>>Disable
</td>

<td style="padding-top:10px;">
    <a href="<?php echo site_url('admin/contents/categories/edit/' . $category['id']) ?>" title="<?php echo lang('global:edit') ?>" class="button">
        <?php echo lang('global:edit') ?>
    </a>
    <a href="<?php echo site_url('admin/contents/categories/delete/' . $category['id']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
        <?php echo lang('global:delete') ?>
    </a>
</td>