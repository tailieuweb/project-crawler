<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">
        <?php echo $heading; ?>
        <label class="pull-right text-right create-date">
            <span><?php echo date('d-m-Y', $page->created); ?></span>
        </label>
    </div>
</div>
<div class="item-index">
    <div class="row">
        <div class="col-md-12">
            <h3 class="work-title"><?php echo $page->title; ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-justify">
            <?php echo $page->slideshow_description; ?>
        </div>
    </div>
</div>
