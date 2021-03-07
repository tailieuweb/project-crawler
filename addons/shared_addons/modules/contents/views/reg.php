<div class="row block-main-title" style="position: relative;">
    <div class="col-md-12 title img-responsive">Đăng ký tìm việc<label class="pull-right text-right create-date">
            <span><?php echo date('d-m-Y', time()); ?></span></label>
    </div>
</div>
<div class="item-index">
    <div class="row">
        <div class="col-md-12">
            <form method="post" accept-charset="utf-8">            <div style="margin:0px 50px">
                    <div class="form-group">
                        <label for="name">
                            <span>Họ và tên <span class="requirement">*</span></span>
                            <span class="message_error_form"></span>
                        </label>
                        <?php echo form_input('name', isset($candidates['name']) ? $candidates['name'] : '', 'class="form-control"') ?>

                    </div>

                    <div class="form-group">
                        <label for="level">Email <span class="requirement">*</span><span class="message_error_form"></span></label>
                        <?php echo form_input('email', isset($candidates['email']) ? $candidates['email'] : '', 'class="form-control"') ?>
                    </div>

                    <div class="form-group">
                        <label for="level">Số điện thoại <span class="requirement">*</span><span class="message_error_form"></span></label>
                        <?php echo form_input('phone_number', isset($candidates['phone_number']) ? $candidates['phone_number'] : '', 'class="form-control"') ?>
                    </div>

                    <div class="form-group">
                        <label for="level">Trình độ <span class="requirement">*</span><span class="message_error_form"></span></label>
                        <?php echo form_input('level', isset($candidates['level']) ? $candidates['level'] : '', 'class="form-control"') ?>
                    </div>

                    <div class="form-group">
                        <label for="id_category">Ngành nghề <span class="requirement">*</span><span class="message_error_form"></span></label>
                        <?php echo form_dropdown('id_category', $work_categories, '','class="form-control"') ?>
                    </div>

                    <div class="form-group">
                        <label for="description">Giới thiệu bản thân <span class="requirement">*</span><span class="message_error_form"></span></label>
                        <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => isset($candidates['description']) ? $candidates['description'] : '', 'rows' => 8, 'class' => 'form-control')) ?>
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