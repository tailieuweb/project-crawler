<?php echo form_open('admin/contents/crawler#tab2'); ?>
<?php foreach ($runs as $index => $run) : ?>
    <li class="crawler-settings">
        <label for="<?php echo $index; ?>">
            <?php echo $run; ?>
        </label>

        <div class="">
            <?php echo form_input($index, '', ' style="width: 550px"'); ?>
            <input type="submit" name="btn_crawl_<?php echo $index; ?>" value="Run" class="btn blue btn_run"/>
        </div>
        <span class="move-handle"></span>
    </li>
<?php endforeach; ?>
<?php echo form_close(); ?>


