<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open_multipart('', '', array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="courses">Select course</label>
            <?php echo form_dropdown('id_course', $select_courses)?>
        </li>
        <li>
            <label for="image">File excel</label>
            <input type="file" name="userfile" value="" id="userfile">
	</li>
        <li class="">
            <button type="submit" name="btnAction" value="publish" class="btn blue">
                <span>Import</span>
            </button>
        </li>
        
    </ul>
    <?php echo form_close() ?>
</fieldset>