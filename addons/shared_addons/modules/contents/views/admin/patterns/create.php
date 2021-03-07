<section class="title">
    <h4><?php echo lang('contents:'.$this->method); ?></h4>
</section>
<section class="item">
	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
            <fieldset>
		<div class="form_inputs">
		<ul>
                    <li class="">
                        <label for="id_site">Id site</label>
                        <div class="input">
                            <?php echo form_dropdown('id_site', $select_site, isset($id_site) ? $id_site : 0)?>
                        </div>
                    </li>
                    <li class="">
                        <label for="pattern_name">Pattern Name</label>
                        <div class="input">
                            <?php echo form_input('pattern_name', isset($allias_pattern) ? $allias_pattern->pattern_name : '', 'list="pattern_name" style="width: 300px"') ?>
                            <datalist id="pattern_name">
                                <?php foreach ($select_patterns as $key => $pattern) : ?>
                                <option value="<?php echo $pattern['pattern_name']; ?>"><?php echo $pattern['pattern_name']; ?></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>
                    </li>
                    <li>
                        <label for="machine_name">Machine Name</label>
                        <div class="input">
                            <?php echo form_input('machine_name', isset($allias_pattern) ? $allias_pattern->machine_name : '', 'list="machine_name" style="width: 300px"') ?>
                            <datalist id="machine_name">
                                <?php foreach ($select_patterns as $key => $pattern) : ?>
                                <option value="<?php echo $pattern['machine_name']; ?>"><?php echo $pattern['machine_name']; ?></option>
                                <?php endforeach; ?>
                            </datalist>
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