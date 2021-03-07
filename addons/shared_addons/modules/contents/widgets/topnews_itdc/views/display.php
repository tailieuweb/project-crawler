<div class="row block-sidebar-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">Tin tức</div>
</div>
<div class="content-sidebar">
    <div class="top-news block-sidebar_banner">
        <ol>
            <?php foreach ($news as $item): ?>
                <li>
                    <a href="<?php echo $item['uri'] ?>">
                        <?php echo $item['title'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>   
</div>
