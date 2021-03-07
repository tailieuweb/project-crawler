<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">Viêc làm - Thực tập<label class="view-all pull-right text-right">[+] <span><a href="{{ url:site }}thong-tin-tuyen-dung">xem tất cả </a></span>»</label></div>
</div>
<?php $MAX_TOP = 5; ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8 top-3">
            <?php $COUNTER = 0; ?>
            <?php foreach ($works['items'] as $item): ?>
                <?php  $COUNTER++; if ($COUNTER > $MAX_TOP) break; ?>
            <div class="row thumb-work-item"> 
                <div class="col-md-12 thumb-work-item-child">
                    <div class="col-md-5 img"> 
                        <img class="img-thumbnail img-responsive" src="<?php echo $item['path']; ?>">
                    </div>
                    <div class="col-md-7 thumb-info">
                        <div class="thumb-title">
                           <?php echo anchor('blog/' .date('Y/m', $item['created_on']) .'/'. $item['slug'], $item['title']); ?>
                        </div>
                        <div class="thumb-overview"><?php echo $item['body']; ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($works['items']) > $MAX_TOP): ?>
            <div class="col-md-4 top-7">
                <div class="row other-items">
                    <div class="col-md-12 other-items-child">
                        <div class="top-7-title">
                            <div class="new-other">
                                Tin khác:
                            </div>
                        </div>
                        <ol>
                            <?php for($i = $MAX_TOP; $i < count($works['items']); $i++): ?>
                                <li>
                                    <?php echo anchor('blog/' .date('Y/m', $works['items'][$i]['created_on']) .'/'. $works['items'][$i]['slug'], $works['items'][$i]['title']); ?>
                                </li>
                            <?php endfor; ?>
                        </ol>
                    </div>
                </div>        
            </div>
        <?php endif; ?>
    </div>
</div>