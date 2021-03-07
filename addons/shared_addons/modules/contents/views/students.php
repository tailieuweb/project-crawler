<div class="row">
    <?php foreach ($head_items as $item): ?>
        <div class="col-md-6">
            <div class="top_news_block">
                <div class="top_news_block_thumb">
                    <img src="<?php echo $item['path'] ?>">
                </div>
                <div class="top_news_block_desc">
                    <div class="row">
                        <div class="col-md-4 col-xs-3 topnewstime">
                            <?php $newstime = $this->my_utilities->parse_date($item['created_on']); ?>
                            <span class="topnewsdate"><?php echo $newstime['day'] ?></span><br>
                            <span class="topnewsmonth">Tháng <?php echo $newstime['month'] ?></span><br>
                        </div>
                        <div class="col-md-8 col-xs-9 shortdesc">
                            <h4><?php echo anchor('blog/' . date('Y/m', $item['created_on']) . '/' . $item['slug'], $item['title']); ?></h4>
                            <p><?php echo $item['blog_overview'] ?><?php echo anchor('blog/' . date('Y/m', $item['created_on']) . '/' . $item['slug'], '[...]'); ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="list_news">
    <?php foreach ($tail_items as $item): ?>
        <div class="list_new_view">
            <div class="row">
                <div class="col-md-5">
                    <div class="top_news_block_thumb">
                        <img src="<?php echo $item['path'] ?>">
                    </div>
                </div>
                <div class="col-md-7 top_news_block_desc">
                    <div class="row">
                        <div class="col-md-3 col-xs-3 topnewstime">
                            <?php $newstime = $this->my_utilities->parse_date($item['created_on']); ?>
                            <span class="topnewsdate"><?php echo $newstime['day'] ?></span><br>
                            <span class="topnewsmonth">Tháng <?php echo $newstime['month'] ?></span><br>
                        </div>
                        <div class="col-md-9 col-xs-9 shortdesc">
                            <h4><?php echo anchor('blog/' . date('Y/m', $item['created_on']) . '/' . $item['slug'], $item['title']); ?></h4>
                            <p><?php echo $item['blog_overview'] ?><?php echo anchor('blog/' . date('Y/m', $item['created_on']) . '/' . $item['slug'], '[...]'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (!empty($list_items)):?>
    <div class="headlines">
        <ul>
            <?php foreach ($list_items as $item): ?>
            <li>
                <div class="headlinesdate">
                    <div class="headlinesdm">
                        <?php $newstime = $this->my_utilities->parse_date($item['created_on']); ?>
                        <div class="headlinesday"><?php echo $newstime['day'] ?></div>
                        <div class="headlinesmonth"><?php echo $newstime['month'] ?></div>
                    </div>
                    <div class="headlinesyear"><?php echo $newstime['year'] ?></div>
                </div>
                <div class="headlinestitle">
                    <?php echo anchor('blog/' . date('Y/m', $item['created_on']) . '/' . $item['slug'], $item['title']); ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif;?>
    <div class="pagination-centered">
        <ul class="pagination">
           <?php 
                    $pagination['links'] = preg_replace('/<\/?div.*?>/', '', $pagination['links']);
                    $pagination['links'] = preg_replace('/<ul>/', '<ul class="pagination">', $pagination['links']);
                    echo $pagination['links']; 
            ?>
        </ul>
    </div>
</div>