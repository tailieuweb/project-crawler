<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">Hoạt động<label class="pull-right text-right create-date"><span><?php echo date('d-m-Y', time()) ?></span></label></div>
</div>
<div class="item-index">
    <div class="row">
        <?php foreach ($datas as $data): ?>
            <div class="showroom-item blog-item col-sm-6">
                <div class="image">
                    <img src="<?php echo $data['path']?>" class="img-responsive img-thumbnail" alt="Blog Thumbnail">
                    <a href="<?php echo $data['uri'] ?>" class="overlay">
                        <i class="glyphicons search"></i>
                    </a>
                </div>
                <div class="content blog-hssv">
                    <h3><a href="<?php echo $data['uri'] ?>"><?php echo $data['title'] ?></a></h3>
                    <span class="meta">Posted by Admin on <?php echo $data['created']?></span>
                    <div class="preview"><?php echo $data['news_overview'] ?></div>
                    <a class="more" href="<?php echo $data['uri'] ?>">Xem thêm</a>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
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