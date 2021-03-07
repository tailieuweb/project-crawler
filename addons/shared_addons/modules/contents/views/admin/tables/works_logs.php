<table style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <td><b>STT</b></td>
            <td><b>Site name</b></td>
            <td><b>Category name</b></td> 
            <td><b>New works</b></td>
            <td><b>Works</b></td>
            <td><b>Start time</b></td>
            <td><b>Duration</b></td>
        </tr>
    </thead>
    <?php foreach ($works as $key => $work): ?>
        <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $work['site_name']; ?></td>
            <td><?php echo $work['category_name']; ?></td> 
            <td><?php echo $work['new_works']; ?></td>
            <td><?php echo $work['works_count']; ?></td>
            <td><?php echo $work['time_start']; ?></td>
            <td><?php echo $work['time_count']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<?php $this->load->view('admin/partials/pagination', array('pagination'=>$paginations['works'])) ?>
<br>
<br>
<?php //echo form_button(array('name'=>'btnTruncate', 'class'=>'btn blue', 'content'=>'Truncate')); ?>
<a href="<?php echo site_url('admin/contents/logs/truncate/works') ?>" title="truncate" class="btn blue">
    Truncate
</a>
<br>