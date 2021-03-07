<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="id_site">Sites</label>
            <?php echo form_dropdown('id_site',$sites)?>
        </li>
        <li class="">
            <label for="status">Status</label>
            <?php echo form_dropdown('status', array(
                'all'   => '--All--',
                'checked' => "Checked", 
                'unchecked' => "Un-checked",
            ),'checked')?>
        </li>
    </ul>
    <?php echo form_close() ?>
</fieldset>