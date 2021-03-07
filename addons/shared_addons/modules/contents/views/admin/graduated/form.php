<section class="title">
    <h4><?php echo lang('contents:' . $this->method); ?></h4>
</section>
<section class="item">
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
    <fieldset>
        <div class="form_inputs">
            <ul>
                <li class="">
                    <label for="name">Name</label>
                    <div class="input">
                        <?php echo form_input('name', isset($course->name) ? $course->name : '', 'style="width: 300px"') ?>
                    </div>
                </li>
                <li>
                    <label for="Status">Status</label>
                    <input type="radio" value="1" name="course[<?php echo isset($course->id) ? $course->id : '0' ?>]" class="enable" checked>Enable
                    <input type="radio" value="0" name="course[<?php echo isset($course->id) ? $course->id : '0' ?>]" class="disable" <?php if (!(isset($course->status) ? $course->status : '1')) echo 'checked'; ?>>Disable
                </li>
            </ul>
        </div>
        <div class="buttons">
            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
        </div>
    </fieldset>
    <?php echo form_close(); ?>
</section>