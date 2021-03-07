<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">
        <?php echo $post['type']; ?>
        <label class="view-all pull-right text-right">
            [+] <span><a href="{{ url:site }}<?php echo $post['slug']; ?>">xem tất cả </a></span>»
        </label>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?php if (!empty($post['items'][0])): ?>
            <div class="col-md-8 top-3">
                <div class="row thumb-work-item">
                    <div class="col-md-12 thumb-work-item-child">
                        <div class="col-md-5 img">
                            <img class="img-thumbnail img-responsive" src="<?php echo $post['items'][0]['path'] ?>">
                        </div>
                        <div class="col-md-7 thumb-info">
                            <div class="thumb-title">
                                <a href="<?php echo $post['slug'].'/'.$post['items'][0]['slug']; ?>"><?php echo $post['items'][0]['title']; ?></a>
                            </div>
                            <div class="thumb-overview">
                                <p>
                                    <span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif">
                                            <?php echo $post['items'][0]['overview']; ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($post['items'][1])): ?>
            <div class="col-md-4 top-7">
                <div class="row other-items">
                    <div class="col-md-12 other-items-child">
                        <div class="top-7-title">
                            <div class="new-other">Tin khác:</div>
                        </div>
                        <ol>
                            <?php for ($i = 1; $i < count($post['items']); $i++): ?>
                            <li>
                                <a href="<?php echo $post['slug'].'/'.$post['items'][$i]['slug'] ?>"><?php echo $post['items'][$i]['title']; ?></a>
                            </li>
                            <?php endfor; ?>
                        </ol>
                    </div>
                </div>        
            </div>
        <?php endif; ?>
    </div>
</div>