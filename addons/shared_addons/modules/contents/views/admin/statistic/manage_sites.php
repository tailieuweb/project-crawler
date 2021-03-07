<div class="one_full">
    <section class="title">
        <h4>Manage sites</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-manage_sites') ?>
            <?php if (!empty($all_sites)) : ?>
                <?php echo form_open('admin/contents/statistic/manage_sites') ?>
                <div id="filter-stage">
                    <?php echo $this->load->view('admin/tables/manage_sites') ?>
                </div>
                <?php echo form_close() ?>
            <?php else : ?>
                <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
            <?php endif ?>
        </div>
    </section>           
</div>
