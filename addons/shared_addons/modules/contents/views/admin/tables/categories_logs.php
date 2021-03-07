<table style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <td><b>Site Name</b></td>
            <td><b>Categories</b></td> 
            <td><b>New Categories</b></td>
            <td><b>Mapped Categories </b></td>
            <td><b>Start time</b></td>
            <td><b>Duration</b></td>
        </tr>
    </thead>
    <?php foreach ($categories as $key => $category): ?>
        <tr>
            <td><?php echo $category['site_name']; ?></td>
            <td><b>
                    <?php echo ($category['categories_count'] > 0 ? "<a href=\"#\" data-display=\"myBox{$category['id']}\">" : "") ?>
                    <?php echo $category['categories_count']; ?>
                    <?php echo ($category['categories_count'] > 0 ? "</a>" : "") ?> </b>
            </td>
            <td><?php echo $category['new_categories']; ?></td>
            <td><b>
                    <?php echo ( count($category_mapped[$category['id_site']]) > 0 ? "<a href=\"#\" data-display=\"mappedCate{$category['id']}\">" : "") ?>
                    <?php echo count($category_mapped[$category['id_site']]); ?>
                    <?php echo ( count($category_mapped[$category['id_site']]) > 0 ? "</a>" : "") ?></b>
            </td>
            <td><?php echo $category['time_start']; ?></td>
            <td><?php echo $category['time_count']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>
<br>
<?php $this->load->view('admin/partials/pagination', array('pagination' => $paginations['categories'])) ?>
<br>
<br>
<a href="<?php echo site_url('admin/contents/logs/truncate/categories') ?>" title="truncate" class="btn blue">
    Truncate
</a>
<br>