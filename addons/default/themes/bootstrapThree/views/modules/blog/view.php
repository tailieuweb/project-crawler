<?php $post = !empty($post[0])?$post[0]:array()?>
<?php if (!empty($post)): ?>
    <div class="row block-main-title" style="position: relative;">
        <div class="col-md-12 title img-responsive">Thông tin tuyển dụng
            <label class="pull-right text-right create-date">
                <span><?php echo date('d-m-Y', time()) ?></span>
            </label>
        </div>
    </div>
    <div class="item-index">
        <div class="row">
            <div class="col-md-12">
                <h3 class="work-title"><?php echo $post['title']; ?></h3>
            </div>    
        </div>
        <div class="row work-relative">
            <div class="col-md-12" style="padding: 0px;">
                <div class="col-md-4 work-expire"><label>Ngày hết hạn:&nbsp;</label><?php echo date('d-m-Y', $post['created']); ?></div>
                <?php 
                    $locations = array();
                    if (!empty($post['location'])) {
                        foreach ($post['location'] as $location) {
                            $locations[] = $location['value'];
                        }
                    }
                ?>
                <div class="col-md-4 work-location"><label>Nơi làm việc:</label><?php echo implode('-',$locations); ?></div>
                <div class="col-md-4 work-category"><label>Ngành Nghề:</label><?php echo implode('-', $post['work_categories']); ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Mô tả công việc</h4>
                <?php echo $post['description']; ?>
            </div>    
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <h4>Yêu cầu công việc</h4>
                <?php echo $post['description']; ?>
            </div>        
        </div>
        <div class="row"> 
            <div class="col-md-12">
                <h4>Thông tin liên lạc</h4>
                <?php echo $post['contact']; ?>
            </div>        
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Công ty</h4> 
                <h3 class="work-title">Officience</h3>
                <div class="company-description">
                    <h5>Thông tin liên lạc</h5>
                    <div class="email"></div>
                    <div class="phone">Website: www.officience.com</div>
                    <div class="address">Address: 117B Nguyễn Đình Chính, Phường 15, Quận Phú Nhuận</div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function printContent () {
        var url = window.location.href;
        console.log(url);
        url = url.replace(/\/(viec-lam)\//, '/pages/ciprint/works/');
        window.open(url, '_blank', 'left=300,top=0,width=550,height=600,toolbar=0,scrollbars=1,status=0');
    }
</script>
<?php else:?>
<?php endif;?>