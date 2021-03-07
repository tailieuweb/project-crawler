<fieldset id="filters">
    <legend><?php echo lang('global:filters') ?></legend>

    <?php echo form_open('',  array('id' => 'filter_job'), array('f_module' => $module_details['slug'])) ?>
    <ul>
        <li class="">
            <label for="id_work_category">TDC Categories <span>*</span></label>
            <?php echo form_dropdown('id_work_category', array(0 => lang('global:select-all')) + $work_categories) ?>
        </li>

        <li class="">
            <label for="f_category"><?php echo lang('blog:category_label') ?></label>
            <?php echo form_dropdown('f_category', array(0 => lang('global:select-all')) + $categories) ?>
        </li>

        <li class="">
            <label for="f_company">Company</label>
            <?php echo form_dropdown('f_company', array(0 => lang('global:select-all')) + $companies) ?>
        </li>

        <li class="f_status">
            <label for="f_status"><?php echo lang('blog:status_label') ?></label>
            <?php echo form_dropdown('f_status', array(0 => lang('global:select-all'), 'draft' => lang('blog:draft_label'), 'live' => lang('blog:live_label'))) ?>
        </li>

        <li class="">
            <label for="f_category"><?php echo lang('global:keywords') ?></label>
            <?php echo form_input('f_keywords', '', 'style="width: 55%;"') ?>
        </li>
        <li class="">
<!--            <a href="<?php //echo site_url('admin/blog/export') ?>" title="<?php //echo lang('global:edit') ?>" class="btn blue">
                Export to Excel
            </a>-->
            <button type="submit" name="btnAction" value="Export" class="export btn blue">
                <span>Export</span>
            </button>
        </li>
    </ul>
    <?php echo form_close() ?>
</fieldset>
<script type="text/javascript">
    $('.export').click(function() {
           $('#filter_job').unbind('submit').submit()

    });
</script>    

