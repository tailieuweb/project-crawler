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
                            <?php echo form_input('name', isset($candidate->name)?$candidate->name:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="level">Level</label>
                        <div class="input">
                            <?php echo form_input('level', isset($candidate->level)?$candidate->level:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="id_category">Category</label>
                        <div class="input">
                            <?php echo form_dropdown('id_category', $category, isset($candidate->id_category)?$candidate->id_category:'','class="form-control"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="email">Email</label>
                        <div class="input">
                            <?php echo form_input('email', isset($candidate->email)?$candidate->email:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li class="">
                        <label for="phone">Phone</label>
                        <div class="input">
                            <?php echo form_input('phone', isset($candidate->phone)?$candidate->phone:'', 'style="width: 300px"') ?>
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
                            ),isset($candidate->status)?$candidate->status:'','style="width: 300px"')?>
                        </div>
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <div class="edit-content">
                            <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => isset($candidate->description)?$candidate->description:'', 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
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