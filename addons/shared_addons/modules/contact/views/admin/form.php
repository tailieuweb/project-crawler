<section class="title">
    <h4><?php echo lang('contact:'.$this->method); ?></h4>
</section>
<section class="item">
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
            <fieldset>
		<div class="form_inputs">
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
                            <label for="email">
                                <?php echo lang('contact:email'); ?>
                                <small><?php echo $contact->subject ?></small>
                            </label>
			</li>
                        
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="date">
                                <?php echo lang('contact:date'); ?>
                                <small><?php echo date('d-m-Y H:i:s', $contact->sent_at); ?></small>
                            </label>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
                            <label for="subject">
                                <?php echo lang('contact:subject'); ?>
                                <small><?php echo $contact->subject ?></small>
                            </label>
                            
			</li>
                        
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="message">
                                <?php echo lang('contact:message'); ?>
                                <small><?php echo $contact->message ?></small>
                            </label>
			</li>
                        
                        <li>
                            <label for="status"><?php echo lang('contact:status') ?></label>
                            <div class="input"><?php echo form_dropdown('status', $statuses, $contact->status) ?></div>
                        </li>
                        
                        <li>
                            <label for="category"><?php echo lang('contact:category') ?></label>
                            <div class="input"><?php echo form_dropdown('category', $categories, $contact->category) ?></div>
                        </li>
                        <li>
                            <label for="notes"><?php echo lang('contact:notes') ?></label>
                            <div class="edit-content">
                                <?php echo form_textarea(array('id' => 'notes', 'name' => 'notes', 'value' => $contact->notes, 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
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
