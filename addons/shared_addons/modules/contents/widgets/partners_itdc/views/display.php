<h4 class="block-sidebar-title">Đối tác</h4>
<div class="content-sidebar">
    <div class="block-sidebar-doitac">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($partners as $item): ?>
                <div class="col-md-6 col-sm-3 col-xs-6 item-1">
                    <a href="<?php echo $item['url']; ?>" target="blank">
                        <img src="<?php echo $item['path']; ?>" width="100%" class="img-thumbnail img-responsive">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>