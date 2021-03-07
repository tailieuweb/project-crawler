<div class="one_full">
    <section class="title">
        <h4>Graduated</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-manage_courses') ?>
            <?php if (!empty($all_courses)) : ?>
                <?php echo form_open('admin/contents/graduated/manage_courses') ?>
                <div id="filter-stage">
                    <?php echo $this->load->view('admin/tables/manage_courses') ?>
                </div>
                <?php echo form_close() ?>
            <?php else : ?>
                <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
            <?php endif ?>
        </div>

    </section>
</div>