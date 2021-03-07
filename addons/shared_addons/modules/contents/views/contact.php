<!-- GOOGLE FONT-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700italic,700,500&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<!-- /GOOGLE FONT-->

<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
<style>
    .panel {
        background-color: #fff;
        border: 1px solid #ddd;
    }
    .panel-heading {
        padding: 10px 15px;
        background-color: #f5f5f5;
        border-bottom: 1px solid #ddd;
        border-top-right-radius: 3px;
        border-top-left-radius: 3px;
    }
    .main-color {
        color: #358cce;
    }
    ::-webkit-input-placeholder { color:#aaa !important;}
    ::-moz-placeholder { color:#aaa !important; } /* firefox 19+ */
    :-ms-input-placeholder { color:#aaa !important; } /* ie */
    input:-moz-placeholder { color:#aaa !important; }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h3><i class="icon-pushpin main-color"></i></span>&nbsp; Địa chỉ</h3>
                </div>
                <div class="panel-body">
                    <address>
                        <strong>Trung Tâm Đào Tạo Nguồn Nhân Lực & Hợp Tác Doanh Nghiệp</strong><br>
                        Trường Cao Đẳng Công Nghệ Thủ Đức<br>
                        <i class="icon-phone-sign"></i> ĐT/Fax - +08491234567<br>
                    </address>
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h3><i class="icon-time main-color"></i>Giờ làm việc</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>Thứ Hai</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="success">
                                <td>Thứ Ba</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="success">
                                <td>Thứ Tư</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="success">
                                <td>Thứ Năm</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="success">
                                <td>Thứ Sáu</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="warning">
                                <td>Thứ Bảy</td>
                                <td>8:00 to 18:00</td>
                            </tr>
                            <tr class="danger">
                                <td>Chủ Nhật</td>
                                <td>Nghỉ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="panel">
                <div class="panel-heading">	
                    <h3 class="">
                        <i class="icon-envelope main-color"></i>
                        Liên hệ với chúng tôi
                    </h3>
                </div>
                <div class="panel-body">
                    <?php if (!empty($data['message'])): ?>
                    <?php if ($data['message']['status']): ?>
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Success!</strong> Your message has been sent successfully.
                    </div>
                    <?php else:?>
                    <div class="alert alert-danger alert-error">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> A problem has been occurred while submitting your data.
                    </div>
                    <?php endif;?>
                    <?php endif;?>
                    <form role="form" id="feedbackForm" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                            <span class="help-block" style="display: none;">Please enter your subject.</span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                            <span class="help-block" style="display: none;">Please enter a valid e-mail address.</span>
                        </div>
                        <div class="form-group">
                            <?php echo form_dropdown('category', $categories, '', 'class="form-control"')?>
                        </div>
                        <div class="form-group">
                            <textarea rows="10" cols="100" class="form-control" id="message" name="message" placeholder="Message"></textarea>
                            <span class="help-block" style="display: none;">Please enter a message.</span>
                        </div>
                        <?php echo $data['image'] ?>
                        <br>
                        <div class="form-group" style="margin-top: 10px;">
                            <input type="text" class="form-control" name="captcha_code" id="captcha_code" placeholder="For security, please enter the code displayed in the box.">
                            <span class="help-block" style="display: none;">Please enter the code displayed within the image.</span>
                        </div>
                        <span class="help-block" style="display: none;">Please enter a the security code.</span>
                        <button type="submit" id="feedbackSubmit" name="feedbackSubmit" class="btn btn-primary btn-lg" style="display: block; margin-top: 10px;">Gửi</button>
                    </form>
                    <!-- END CONTACT FORM -->
                </div>
            </div>			
        </div>
    </div>
</div>
     <script src="http://localhost/tdc/trunk/public/js/contact-form.js"></script>
