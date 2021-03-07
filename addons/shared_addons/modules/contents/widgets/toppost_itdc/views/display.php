<div class="sidebar-module sidebar-module-inset block-sidebar">
    <div class="bs-example bs-example-tabs " id="tag-popular">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Việc làm</a></li>
            <li class=""><a href="#profile" data-toggle="tab">Đọc nhiều nhất</a></li>

        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="home">
                <div class="content-sidebar">
                    <ol class="list-unstyled">
                        <?php foreach ($works as $work): ?>
                        <li><a href="<?php echo 'blog/' .date('Y/m', $work['created_on']) .'/'. $work['slug'] ?>"><?php echo $work['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
            <div class="tab-pane fade" id="profile">
                <div class="content-sidebar">
                    <ol class="list-unstyled">
                        <?php foreach ($news as $item): ?>
                        <li><a href="<?php echo $item['uri'] ?>"><?php echo $item['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ext-label {
        margin-top: -10px;
        margin-bottom: 5px;
        font-size: 13px;
    }
    .ext-select {
        max-width: 270px;
        min-width: 100px;
        margin: 0 auto;
    }
</style>