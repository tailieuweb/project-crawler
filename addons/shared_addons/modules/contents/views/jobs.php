<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">Việc làm - Thực tập
        <label class="pull-right text-right create-date">
            <span><?php echo date('d-m-Y', time()); ?></span>
        </label></div>
</div>
<?php $this->load->view('partials/job-filter'); ?>
<?php if (!empty($jobs)): ?>
    <?php foreach ($jobs as $job): ?>
        <div class="row thumb-work-item"> 
        <div class="col-md-12 thumb-work-item-child">
            <div class="thumb-info" style="padding: 0px;">
                    <div class="thumb-title" style="margin: 3px 0px;">
                        <a href="<?php echo 'blog/' .date('Y/m', $job['created_on']) .'/'. $job['slug']; ?>">
                            <span style="font-size: 16px;"><?php echo $job['title']; ?></span>
                        </a>
                    </div>
                    <div class="thumb-overview">
                        <?php echo $job['body']; ?>
                        <div class="row" style="padding: 0px;">
                            <div class="col-md-12" style="padding: 0px;  margin: 5px 0px;">
                                <div class="col-md-4">Nơi làm việc:
                                    <span style="font-size: 13px; font-style: italic; color: #666;">
                                        <?php echo $job['location']; ?>
                                    </span>
                                </div>
                                <div class="col-md-4">Ngành nghề: 
                                    <span style="font-size: 13px; font-style: italic; color: #666;">
                                        <?php echo implode(' - ', $job['work_categories']) ?>
                                    </span>
                                </div>
                                <div class="col-md-4">Hết hạn: 
                                    <span style="font-size: 13px; font-style: italic;color: #666;">
                                        <?php echo date('d-m-Y', time()) ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>
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