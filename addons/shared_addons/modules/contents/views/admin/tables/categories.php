<table cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) :?>
            <tr>
                <?php $this->load->view('admin/tables/tr-category', array('category' => $category)); ?>
            </tr>
            <?php if (!empty($category['child'])):?>
                <?php foreach ($category['child'] as $child) :?>
                <tr class="category-child">
                    <?php $this->load->view('admin/tables/tr-category', array('category' => $child)); ?>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </tbody>
        
</table>
<br>
<?php $this->load->view('admin/partials/pagination') ?>
<br>
<div class="table_action_buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
</div>