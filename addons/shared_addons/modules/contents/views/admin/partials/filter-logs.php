<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="id_category">Categories</label>
            <?php echo form_dropdown('id_category',array(0 => '-Any-')+$select_categories)?>
        </li>
        <li class="">
            <button type="submit" name="btnAction" value="publish" class="btn blue">
                <span>Filter</span>
            </button>
        </li>
    </ul>
    <?php echo form_close() ?>
</fieldset>