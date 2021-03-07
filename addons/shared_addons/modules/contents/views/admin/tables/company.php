<table cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Website</th>
            <th>Email</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_companies as $post) : ?>
            <tr>
                <td><?php echo $post['name'] ?></td>
                <td><?php echo $post['website'] ?></td>
                <td><?php echo $post['email'] ?></td>
                <td style="padding-top:10px;">
                    <a href="<?php echo site_url('admin/contents/company/edit/' . $post['id']) ?>" title="<?php echo lang('global:edit') ?>" class="button">
                        <?php echo lang('global:edit') ?>
                    </a>
                    <a href="<?php echo site_url('admin/contents/company/delete/' . $post['id']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
                        <?php echo lang('global:delete') ?>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<?php $this->load->view('admin/partials/pagination') ?>