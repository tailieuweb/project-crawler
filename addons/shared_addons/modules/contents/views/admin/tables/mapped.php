<table cellspacing="0">
    <thead>
        <tr>
            <th>Title</th>
            <th>Mapped</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_categories as $item) : ?>
            <tr>
                <!--From-->
                <td><?php echo $item['name'] ?></td>
                <!--Map to-->
                <td>
                    <?php echo form_multiselect("mapped[{$item['id']}][]", $categories, explode(',',$item['id_categories'])); ?>
                </td>
                <td>
                    <img src="<?php echo site_url('addons/shared_addons/modules/contents/img/'. ($item['status'] ? 'check_success.gif' : 'check_fail.gif')) ?>" width="24px" height="16px">
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<?php if (isset($id_site)) echo form_hidden('id_site', $id_site); ?>
<div class="table_action_buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('publish'))) ?>
</div>