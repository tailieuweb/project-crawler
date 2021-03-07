<table cellspacing="0">
    <thead>
        <tr>
            <th width="20">
                <?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')) ?>
            </th>
            <th><?php echo lang('contact:subject') ?></th>
            <th class="collapse"><?php echo lang('contact:message') ?></th>
            <th class="collapse"><?php echo lang('contact:date') ?></th>
            <th><?php echo lang('contact:email') ?></th>
            <th><?php echo lang('contact:status') ?></th>
            <th><?php echo lang('contact:category') ?></th>
            <th width="180"><?php echo lang('global:actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contact as $post) : ?>
            <tr>
                <td><?php echo form_checkbox('action_to[]', $post->id) ?></td>
                
                <td><?php echo $post->subject ?></td>
                
                <td class="collapse"><?php echo $post->message ?></td>
                
                <td class="collapse"><?php echo format_date($post->sent_at) ?></td>
                
                <td class="collapse"><?php echo $post->email ?></td>
                
                <td class="collapse"><?php echo $post->status ?></td>
                
                <td class="collapse"><?php echo $post->category ?></td>
                
                <td style="padding-top:10px;">
                    <a href="<?php echo site_url('admin/contact/view/' . $post->id) ?>" title="<?php echo lang('global:edit') ?>" class="button">
                        <?php echo lang('global:view') ?>
                    </a>
                    <a href="<?php echo site_url('admin/contact/delete/' . $post->id) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
                        <?php echo lang('global:delete') ?>
                    </a>
                </td>
                
            </tr>
        <?php endforeach ?>
    </tbody>
        
</table>

<?php $this->load->view('admin/partials/pagination') ?>

<br>

<div class="table_action_buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))) ?>
</div>