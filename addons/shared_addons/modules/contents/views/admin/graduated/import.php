<div class="one_full">
    <section class="title">
        <h4>Graduated</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-import') ?>
            <?php if (!empty($graduated)) : ?>
                <?php echo form_open('admin/contents/graduated/import') ?>
                <div id="filter-stage">
                    <?php echo $this->load->view('admin/tables/import') ?>
                </div>
                <?php echo form_close() ?>
            <?php else : ?>
                <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
            <?php endif ?>
        </div>

    </section>
</div>