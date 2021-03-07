<section class="title">
    <h4><?php echo lang('contents:'.$this->method); ?></h4>
</section>
<section class="item">
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
            <fieldset>
		<div class="form_inputs">
		<ul>
                    <li class="">
                        <label for="name">Name</label>
                        <div class="input">
                            <?php echo form_input('name', isset($category->name)?$category->name:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    <li>
                        <label for="Parent">Parent</label>
                        <div class="input">
                            <?php $val = isset($category)?$category->path:0;?>
                            <?php echo form_dropdown('parent_category',array(0 => '--Not set--') + $select_categories, $val)?>
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