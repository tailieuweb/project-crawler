<h4 class="block-sidebar-title">Liên kết</h4>
<div class="content-sidebar">
    <div class="block-sidebar_banner">
        <div class="row text-center">
            <?php foreach ($links as $item): ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <a href="<?php echo $item['url'] ?>" target="blank">
                    <img src="<?php echo $item['path']; ?>" width="100%" class="img-responsive img-thumbnail ">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>