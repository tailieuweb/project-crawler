<table cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Level</th>
            <th>Category</th>
            <th>Status</th>
            <th>Description</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_candidates as $post) : ?>
            <tr>
                <td><?php echo $post['name'] ?></td>
                <td><?php echo $post['level'] ?></td>
                <td><?php echo $post['id_category'] ?></td>
                <td><?php echo $post['status'] ?></td>
                <td><?php echo $post['description'] ?></td>
                <td style="padding-top:10px;">
                    <a href="<?php echo site_url('admin/contents/candidates/edit/' . $post['id']) ?>" title="<?php echo lang('global:edit') ?>" class="button">
                        <?php echo lang('global:edit') ?>
                    </a>
                    <a href="<?php echo site_url('admin/contents/candidates/delete/' . $post['id']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
                        <?php echo lang('global:delete') ?>
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>
<?php $this->load->view('admin/partials/pagination') ?>