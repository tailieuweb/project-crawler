<table style="width:100%" cellspacing="0">
    <thead>
        <tr>
            <td><b>STT</td>
            <td><b>Site name</td>
            <td><b>Name category</td> 
            <td><b>Works</td>
            <td><b>New Works</td>
            <td><b>Works non-Description</td>
            <td><b>Works non-Requirements</td>
            <td><b>Start time</td>
            <td><b>Duration</td>
        </tr>
    </thead>
    <?php foreach ($details as $key => $detail): ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $detail['site_name']; ?></td>
            <td><?php echo $detail['category_name']; ?></td> 
            <td><?php echo $detail['total_works']; ?></td>
            <td><?php echo $detail['valid_works']; ?></td>
            <td><b><?php echo ($detail['none_description']>0 ? "<a href=\"#\" data-display=\"noneDescription{$detail['id']}\">" : "") ?><?php echo $detail['none_description']; ?><?php echo $detail['none_description']>0 ? "</a>" : "" ?></a></b></td>
            <td><b><?php echo ($detail['none_requirement']>0 ? "<a href=\"#\" data-display=\"noneRequirement{$detail['id']}\">" : "") ?><?php echo $detail['none_requirement']; ?><?php echo $detail['none_description']>0 ? "</a>" : "" ?></b></td>
            <td><?php echo $detail['time_start']; ?></td>
            <td><?php echo $detail['time_count']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br>
<?php $this->load->view('admin/partials/pagination',array('pagination'=>$paginations['details'])) ?>
<br>
<br>
<?php //echo form_button(array('name'=>'btnTruncate', 'class'=>'btn blue', 'content'=>'Truncate')); ?>
<a href="<?php echo site_url('admin/contents/logs/truncate/details') ?>" title="truncate" class="btn blue">
    Truncate
</a>
<br>