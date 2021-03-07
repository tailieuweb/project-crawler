<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open('', '', array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="keyword"><?php echo lang('global:keywords') ?></label>
            <?php echo form_input('keyword', isset($params['keyword'])?$params['keyword']:'', 'style="width: 55%;"') ?>
        </li>
        <li class="">
            <button type="submit" name="btnAction" value="publish" class="btn blue">
                <span>Filter</span>
            </button>
        </li>
    </ul>
    <?php echo form_close() ?>
</fieldset>