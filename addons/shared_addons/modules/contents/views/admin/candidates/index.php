<div class="one_full">
    <section class="title">
        <h4>Candidates</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-candidates') ?>
            <?php if (!empty($all_candidates)) : ?>
                <?php echo form_open('admin/candidates/delete') ?>
                <div id="filter-stage">
                    <?php echo $this->load->view('admin/tables/candidates') ?>
                </div>
                <?php echo form_close() ?>
            <?php else : ?>
                <div class="no_data"><?php echo lang('contact:no-contact') ?></div>
            <?php endif ?>
        </div>
    </section>
</div>
