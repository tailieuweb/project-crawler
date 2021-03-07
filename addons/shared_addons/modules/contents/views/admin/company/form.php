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
                            <?php echo form_input('name', isset($company->name)?$company->name:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    
                    <!--Website-->
                    <li class="">
                        <label for="website">Website</label>
                        <div class="input">
                            <?php echo form_input('website', isset($company->website)?$company->website:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    
                    <li class="">
                        <label for="email">Email</label>
                        <div class="input">
                            <?php echo form_input('email', isset($company->email)?$company->email:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    
                    <li class="">
                        <label for="address">Address</label>
                        <div class="input">
                            <?php echo form_input('address', isset($company->address)?$company->address:'', 'style="width: 300px"') ?>
                        </div>
                    </li>
                    
                    <li class="">
                        <label for="other">Other</label>
                        <div class="input">
                            <?php echo form_input('other', isset($company->other)?$company->other:'', 'style="width: 300px"') ?>
                        </div>
                    </li>                    
                    <li>
                        <label for="description">Description</label>
                        <div class="edit-content">
                            <?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => isset($company->description)?$company->description:'', 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
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