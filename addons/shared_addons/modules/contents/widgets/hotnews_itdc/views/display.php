<?php for($index = 0; $index < 3; $index++): ?>
    <div class="col-md-4">
        <div class="top_news_block">
                <div class="top_news_block_thumb">
                <img src="<?php echo base_url('uploads/default/files/'.$news[$index]['filename'])?>">
            </div>
            <div class="top_news_block_desc">
                <div class="row">
                    <div class="col-md-4 col-xs-3 topnewstime">
                        <?php $newstime = $this->my_utilities->parse_date(strtotime($news[$index]['created']));?>
                        <span class="topnewsdate"><?php echo $newstime['day']?></span><br>
                        <span class="topnewsmonth">Tháng <?php echo $newstime['month']?></span><br>
                    </div>
                    <div class="col-md-8 col-xs-9 shortdesc">
                        <h4>
                            <?php echo anchor($news[$index]['uri'], $news[$index]['news_title']); ?>
                        </h4>
                        <p><?php echo $news[$index]['news_description'] ?><?php echo anchor($news[$index]['uri'], '[...]'); ?></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php endfor; ?>