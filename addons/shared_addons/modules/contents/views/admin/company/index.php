<div class="one_full">
    <section class="title">
        <h4>Companies</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-company') ?>
            <?php if (!empty($all_companies)) : ?>
                <?php echo form_open('admin/company/delete') ?>
                <div id="filter-stage">
                    <?php echo $this->load->view('admin/tables/company') ?>
                </div>
                <?php echo form_close() ?>
            <?php else : ?>
                <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
            <?php endif ?>
        </div>
    </section>
</div>
