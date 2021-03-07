<?php echo form_open('admin/contents/crawler'); ?>
<?php foreach ($fields as $index => $field) : ?>
    <li class="crawler-settings">
        <label for="<?php echo $index; ?>">
            <?php echo $field; ?>
        </label>

        <div class="input">
            <?php echo form_input($index,$setting[$index],'placeholder="Please input ' . $index . '.."'); ?>
        </div>
        <input type="hidden" name="id" value="<?php echo $setting['id'] ?>" />
        <span class="move-handle"></span>
    </li>
<?php endforeach; ?>
<div class="buttons padding-top">
    <input type="submit" name="btnCrawlerSetting" value="Save" class="btn blue"/>
</div>
<?php echo form_close(); ?>


