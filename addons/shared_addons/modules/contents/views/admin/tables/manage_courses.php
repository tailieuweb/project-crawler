<table cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_courses as $course) : ?>

            <tr>
                <td><?php echo $course['name'] ?></td>
                <td>
                    <input type="radio" value="1" name="courses[<?php echo $course['id'] ?>]" class="enable" checked>Enable
                    <input type="radio" value="0" name="courses[<?php echo $course['id'] ?>]" class="disable" <?php if (!$course['status']) echo 'checked'; ?>>Disable
                </td>

                <td style="padding-top:10px;">
                    <a href="<?php echo site_url('admin/contents/graduated/edit/' . $course['id']) ?>" title="<?php echo lang('global:edit') ?>" class="button">
                        <?php echo lang('global:edit') ?>
                    </a>
                    <a href="<?php echo site_url('admin/contents/graduated/delete/' . $course['id']) ?>" title="<?php echo lang('global:delete') ?>" class="button confirm">
                        <?php echo lang('global:delete') ?>
                    </a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>

</table>
<br>
<?php $this->load->view('admin/partials/pagination') ?>
<br>
<button type="submit" name="btnAction" value="publish" class="btn blue">
                <span>Save</span>
</button>