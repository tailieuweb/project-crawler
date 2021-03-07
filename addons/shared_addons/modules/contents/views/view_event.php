<div class="row title">
    <div class="col-md-10 col-xs-9">
        <h1><?php echo $page->title ?></h1>
    </div>
    <div class="col-md-2 col-xs-3">
        <div class="headlinesdate">
            <?php $newstime = $this->my_utilities->parse_date($page->created);?>
            <div class="headlinesdm">
                <div class="headlinesday"><?php echo $newstime['day']?></div>
                <div class="headlinesmonth"><?php echo $newstime['month']?></div>
            </div>
            <div class="headlinesyear">'<?php echo $newstime['year']?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12"><div class="overviewline"></div></div>
</div>
<div class="row overview">
    <div class="col-md-12">
        <p><?php //echo $page->slideshow_overview ?></p>

    </div>
</div>
<div class="row overview_thumb">
    <div class="col-md-12">
    </div>
</div>
<div class="row maincontent">
    <div class="col-md-12">
        <p>
            <?php echo $page->event_description ?>
        </p>
    </div>
</div>
<div class="list_news">
    <div class="headlines">
        <ul>
            <?php foreach ($similar_items as $item): ?>
                <li>
                    <div class="headlinesdate">
                        <?php $newstime = $this->my_utilities->parse_date($item['created_on']);?>
                        <div class="headlinesdm">
                            <div class="headlinesday"><?php echo $newstime['day'] ?></div>
                            <div class="headlinesmonth"><?php echo $newstime['month'] ?></div>
                        </div>
                        <div class="headlinesyear"><?php echo $newstime['year']?></div>
                    </div>
                    <div class="headlinestitle">
                        <a href="<?php echo $item['uri']?>"><?php echo $item['title'] ?></a>
                    </div>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>