<div class="rows" style="margin: 20px 0px; ">
    <div class="thumb-work-item-child work-form">
        <?php echo form_open('thong-tin-tuyen-dung', array('method' => 'get', 'class' => 'form-horizontal', 'role' => 'form')); ?>
            <div class="form-group">
                <div class="col-sm-3 item"><label class="control-label">Chọn ngành nghề </label></div>
                    <div class="col-sm-5 item select-professions" >
                        <?php echo form_multiselect('id_categories[]', $work_categories, isset($params['id_categories'])?$params['id_categories']:null, 'class="form-control" placeholder="Chọn nghành nghề" id="professions-categories"') ?>
                        <?php
                            $flag = TRUE;
                            if (isset($params['type']) && $params['type'] == 'Work') {
                            } else {
                                $flag = FALSE;
                            }
                        ?>
                    </div>
                    <div class="col-sm-3 item">
                        <label><?php echo form_radio('type', 'Work', $flag, ''); ?>Việc làm</label>
                        <label><?php echo form_radio('type', 'Internship', !$flag, ''); ?>Thực tập</label>
                    </div>
                    <div class="col-md-12 col-sm-12 text-center">
                        <input type="submit"  class="btn btn-default" name="submit" value="Tìm kiếm">
                    </div>
            </div>
                
        <?php echo form_close(); ?>
    </div>
</div>