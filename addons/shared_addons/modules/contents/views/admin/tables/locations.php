<table cellspacing="0">
    <thead>
        <tr>
            <th><?php echo lang('contents:id') ?></th>
            <th><?php echo lang('contents:name') ?></th>
            <th><?php echo lang('contents:id_alias') ?></th>
            <th><?php echo lang('contents:status') ?></th>
            <th><?php echo lang('contents:actions') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($work_locations as $key => $location) :?>
            <tr>
                <?php $this->load->view('admin/tables/ch-locations', array('location' => $location, 'id' => $key)); ?>
            </tr>
            <?php if (!empty($location['child'])) : ?>
                <?php foreach ($location['child'] as $child) : ?>
                    <tr class="item-child">
                        <?php $this->load->view('admin/tables/ch-locations', array('location' => $child, 'id' => '')); ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
        
</table>
<div class="buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
</div>