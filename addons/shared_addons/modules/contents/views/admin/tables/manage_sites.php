<table cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_sites as $site) : ?>
            <tr class="category-child">
                <td><?php echo $site['name']; ?></td>
                <td>
                    <input type="radio" value="1" name="sites[<?php echo $site['id'] ?>]" class="enable" checked>Enable
                    <input type="radio" value="0" name="sites[<?php echo $site['id'] ?>]" class="disable" <?php if (!$site['status']) echo 'checked'; ?>>Disable
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