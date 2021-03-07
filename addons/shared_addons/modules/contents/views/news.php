<div class="content">
    <div class="row block-main-title" style="position: relative;">
        <div class="col-md-12 title img-responsive"><?php echo $heading; ?><label class="pull-right text-right create-date "><span><?php echo date('d-m-Y', time()); ?></span></label></div>
    </div>
    <?php foreach ($news as $item): ?>
        <div class="row thumb-work-item"> 
            <div class="col-md-12 thumb-work-item-child">
                <div class="col-md-4 img">
                    <img src="<?php echo $item['path']; ?>" class="img-thumbnail">
                </div>
                <div class="col-md-8 thumb-info">
                    <div class="thumb-title">
                        <?php echo anchor($item['uri'], $item['title']); ?>
                    </div>
                    <div class="thumb-overview">
                        <p><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif">
                                    <?php echo $item['news_overview']; ?>   
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;; ?>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-8">
            <div class="pagination-centered">
                <?php 
                    $pagination['links'] = preg_replace('/<\/?div.*?>/', '', $pagination['links']);
                    $pagination['links'] = preg_replace('/<ul>/', '<ul class="pagination">', $pagination['links']);
                    echo $pagination['links']; 
                ?>
            </div>
        </div>
    </div>
</div>