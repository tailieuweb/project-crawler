<div class="prof_articles">
    <div class="panel-heading">
        <h2>Bài viết <br><span>chuyên đề</span></h2>
    </div>
    <div class="crossedbg"></div>

    <div class="row">
        <?php foreach ($technologies as $item): ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="top_news_block">
                <div class="top_news_block_thumb">
                    <img src="<?php echo base_url('uploads/default/files/'.$item['filename'])?>">
                </div>
                <div class="top_news_block_desc">
                    <div class="row">
                        <div class="col-md-4 col-xs-3 topnewstime">
                            <?php $newstime = $this->my_utilities->parse_date(strtotime($item['created']));?>
                            <span class="topnewsdate"><?php echo $newstime['day']?></span><br>
                            <span class="topnewsmonth">Tháng <?php echo $newstime['month']?></span><br>
                        </div>
                        <div class="col-md-8 col-xs-9 shortdesc">
                            <h4><?php echo anchor('blog/' .date('Y/m', $item['created_on']) .'/'. $item['slug'], $item['title']); ?></h4>
                            <p><?php echo $item['blog_overview']; ?>
                            <?php echo anchor('blog/' .date('Y/m', $item['created_on']) .'/'. $item['slug'], '[...]'); ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="pagination-centered">
        <?php 
            $pagination['links'] = preg_replace('/<\/?div.*?>/', '', $pagination['links']);
            $pagination['links'] = preg_replace('/<ul>/', '<ul class="pagination">', $pagination['links']);
            echo $pagination['links']; 
        ?>
    </div>
</div>