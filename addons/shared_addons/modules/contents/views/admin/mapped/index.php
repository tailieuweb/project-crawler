<div class="one_full">
    <section class="title">
        <h4>Mapped</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-mapped') ?>
            <?php echo form_open('admin/contents/mapped') ?>
            <div id="filter-stage">
                <?php echo $this->load->view('admin/tables/mapped') ?>
            </div>
            <?php echo form_close() ?>
        </div>
    </section>
</div>
