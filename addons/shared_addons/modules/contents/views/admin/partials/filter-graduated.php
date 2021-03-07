<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="id_graduated">Graduated</label>
            <?php echo form_dropdown('id_course',array(0 => '-Any-')+$select_courses)?>
        </li>
        <li>
            <a href="admin/contents/graduated/manage_courses">Manage courses</a>
        </li>
        <li>-</li>
        <li>
            <a href="admin/contents/graduated/import">Import</a>
        </li>
    </ul>
    <?php echo form_close() ?>
</fieldset>