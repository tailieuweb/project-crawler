<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<section class="title">
    <h4><?php echo lang('contents:title_locations'); ?></h4>
</section>
<section class="item">
    <div class="content">
        <?php if (!empty($work_locations)) : ?>
            <?php echo form_open('admin/contents/locations') ?>
            <div id="filter-stage">
                <?php echo $this->load->view('admin/tables/locations') ?>
            </div>
            <?php echo form_close() ?>
        <?php else : ?>
            <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
        <?php endif ?>
    </div>
</section>
