<div class="one_full">
    <section class="title">
        <h4>Graduated</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-graduated') ?>
            <?php echo form_open('admin/contents/graduated') ?>
            <div id="filter-stage">
                <?php echo $this->load->view('admin/tables/graduated') ?>
            </div>
            <?php echo form_close() ?>
        </div>

    </section>
</div>
