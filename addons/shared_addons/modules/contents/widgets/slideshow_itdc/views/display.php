<div id="myCarousel" class="carousel slide item-index" data-ride="carousel">
    <?php if (!empty($slideshow[0]['path'])): ?>
    <!-- Indicators -->
    <div class="carousel-inner">
        <div class="item active">
                <img src="<?php echo $slideshow[0]['path'] ?>"  class="img-responsive">
                <div class="slide-more-infor">
                    <div class="">
                        <p class="title">
                            <a href="<?php echo base_url("tin-tuc-noi-bat/".$slideshow[0]['slug']); ?>">
                            <?php echo $slideshow[0]['title'] ?>
                            </a>
                        </p>
                        <p class="right slide-read-more"><a href="#" role="button">Xem thêm &raquo;</a></p>
                    </div>
                </div>
        </div>
        <?php for ($i = 1; $i < count($slideshow); $i++):?>
        <div class="item">
            <img src="<?php echo $slideshow[$i]['path'] ?>"  class="img-responsive">
            <div class="slide-more-infor">
                <div class="">
                    <p class="title">
                        <a href="<?php echo base_url("tin-tuc-noi-bat/".$slideshow[$i]['slug']); ?>">
                            <?php echo $slideshow[$i]['title'] ?>
                        </a>
                    </p>
                    <p class="right slide-read-more"><a href="#" role="button">Xem thêm &raquo;</a></p>
                </div>
            </div>
        </div>
        <?php endfor; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <?php for ($i = 1; $i < count($slideshow); $i++): ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" class=""></li>
        <?php endfor; ?>
    </ol>
    <?php endif; ?>
</div>