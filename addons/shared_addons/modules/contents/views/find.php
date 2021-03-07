<div class="content">
    <div class="row block-main-title" style="position: relative;">
        <div class="col-md-12 title img-responsive">Đăng ký tuyển dụng<label class="pull-right text-right create-date">
                <span><?php echo date('d-m-Y', time()); ?></span></label>
        </div>
    </div>
    <div class="item-index">
        <div class="row">
            <div class="col-md-12">
                <form method="post" accept-charset="utf-8">            <div style="margin:0px 50px">
                        <div class="form-group">
                            <label for="name">
                                <span>Tên công ty: <span class="requirement">*</span></span>
                                <span class="message_error_form"></span>
                            </label>
                            <?php echo form_input('name', isset($recruitments['name']) ? $recruitments['name'] : '', 'class="form-control"') ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Mô rả công ty <span class="requirement">*</span><span class="message_error_form"></span></label>
                            <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => isset($recruitments['description']) ? $recruitments['description'] : '', 'rows' => 6, 'class' => 'form-control')) ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="work_name">
                                <span>Tên công việc: <span class="requirement">*</span></span>
                                <span class="message_error_form"></span>
                            </label>
                            <?php echo form_input('work_name', isset($recruitments['work_name']) ? $recruitments['work_name'] : '', 'class="form-control"') ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="work_description">Mô tả<span class="requirement">*</span><span class="message_error_form"></span></label>
                            <?php echo form_textarea(array('id' => 'work_description', 'name' => 'work_description', 'value' => isset($recruitments['work_description']) ? $recruitments['work_description'] : '', 'rows' => 6, 'class' => 'form-control')) ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="requirements">Yêu cầu<span class="requirement">*</span><span class="message_error_form"></span></label>
                            <?php echo form_textarea(array('id' => 'requirements', 'name' => 'requirements', 'value' => isset($recruitments['requirements']) ? $recruitments['requirements'] : '', 'rows' => 6, 'class' => 'form-control')) ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="id_categories">
                                <span>Ngành nghề<span class="requirement">*</span></span>
                                <span class="message_error_form"></span>
                            </label>
                            <?php echo form_dropdown('id_categories', $work_categories, '','class="form-control"') ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="work_count">
                                <span>Số lượng tuyển<span class="requirement">*</span></span>
                                <span class="message_error_form"></span>
                            </label>
                            <?php echo form_input('work_count', isset($recruitments['work_count']) ? $recruitments['work_count'] : '', 'class="form-control"') ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="work_end">
                                <span>Hạn nộp hồ sơ<span class="requirement">*</span></span>
                                <span class="message_error_form"></span>
                            </label>
                            <?php echo form_input('work_end', isset($recruitments['work_end']) ? $recruitments['work_end'] : '', 'class="form-control"') ?>
                        </div>

                        <div class="form-group">
                            <label for="level">Captcha <span class="requirement">*</span><span class="message_error_form"></span></label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-8 input-captcha">
                                        <?php echo form_input('captcha', '', 'class="form-control"') ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group captcha">
                                            <?php echo $data['image'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <button type="submit" name="submit" id="submit" class="btn btn-default">Gửi</button>
                        </div>
                    </div></form>
            </div>
        </div>
    </div>
</div>