<section class="title">
    <h4><?php echo lang('contents:'.$this->method); ?></h4>
</section>
<section class="item">
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
            <fieldset>
		<div class="form_inputs">
		<ul>
                    <!--Name-->
                    <li class="">
                        <label for="name">Name</label>
                        <div class="input">
                            <?php echo form_input('name', isset($recruitments->name)?$recruitments->name:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="id_categories">Categories</label>
                        <div class="input">
                            <?php echo form_input('id_categories', isset($recruitments->id_categories)?$recruitments->id_categories:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="work_name">Work Name</label>
                        <div class="input">
                            <?php echo form_input('work_name', isset($recruitments->work_name)?$recruitments->work_name:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="work_description">Work description</label>
                        <div class="input">
                            <?php echo form_textarea(array('id' => 'work_description', 'name' => 'work_description', 'value' => isset($recruitments->work_description)?$recruitments->work_description:'' , 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="work_count">Work count</label>
                        <div class="input">
                            <?php echo form_input('work_count', isset($recruitments->work_count)?$recruitments->work_count:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="work_end">Work end</label>
                        <div class="input">
                            <?php echo form_input('work_end', isset($recruitments->work_end)?$recruitments->work_end:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="status">Status</label>
                        <div class="input">
                            <?php echo form_dropdown('status', array(
                                0 => lang('global:select-all'),
                                '40' => 'New',
                                '30' => 'Resolved',
                                '20' => 'Spam',
                                '10' => 'Waiting',
                            ),isset($recruitments->status)?$recruitments->status:'','style="width: 300px"')?>
                        </div>
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <div class="edit-content">
                            <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => isset($recruitments->description)?$recruitments->description:'' , 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                        </div>
                    </li>
		</ul>
		</div>
		<div class="buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
            </fieldset>
	<?php echo form_close(); ?>
</section>