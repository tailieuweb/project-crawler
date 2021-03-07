<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</html>
<div class="one_full">
    <section class="title">
        <h4>Categories</h4>
    </section>
    <section class="item">
        <div class="content">
            <?php echo $this->load->view('admin/partials/filter-categories') ?>
            <?php echo form_open('admin/contents/categories') ?>
            <div id="filter-stage">
                <?php echo $this->load->view('admin/tables/categories') ?>
            </div>
            <?php echo form_close() ?>
        </div>

    </section>
</div>
