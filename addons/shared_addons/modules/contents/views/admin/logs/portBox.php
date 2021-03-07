
<!-- portBox number categories crawl-->
<?php foreach ($categories as $key => $category): ?>
    <?php if ($category['categories_count'] > 0) : ?>
        <div id="myBox<?php echo $category['id']; ?>" class="portBox">
            <table style="width:100%">
                <tr>
                    <th>Site</th>
                    <th>Category Name</th> 
                    <th>URL</th>
                </tr>
                <?php foreach ($work_all_categories[$category['id_site']] as $item): ?>
                    <tr>
                        <td><?php echo $category['site_name']; ?></td>
                        <td><?php echo $item['name']; ?></td> 
                        <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Your content here -->
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!--------------Mapped categories------------------------>
<?php foreach ($categories as $key => $category): ?>
    <?php if (count($category_mapped[$category['id_site']]) > 0) : ?>
        <div id="mappedCate<?php echo $category['id']; ?>" class="portBox">
            <table style="width:100%">
                <tr>
                    <th>Site</th>
                    <th>Category of Site</th> 
                    <th>Category Mapped</th> 
                    <th>URL</th>
                </tr>
                <?php foreach ($category_mapped[$category['id_site']] as $key => $item): ?>
                    <tr>
                        <td><?php echo $category['site_name']; ?></td>
                        <td><?php echo $item['name']; ?></td> 
                        <td><?php echo $item['category_name']; ?></td> 
                        <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Your content here -->
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- None description Popup content -->
<?php foreach ($details as $key => $detail): ?>
    <?php if (!empty($detail['none_description'])): ?>
        <div id="noneDescription<?php echo $detail['id']; ?>" class="portBox">
            <table boder="1" style="width:100%">
                <tr>
                    <th>STT</th>
                    <th>ID Work</th>
                    <th>Site</th>
                    <th>Work Name</th> 
                    <th>URL</th>
                </tr>
                <?php $j = 1;
                foreach ($work_non_description as $item): ?>
                <?php if ($item['id_site'] == $detail['id_site'] && $item['category_of_site'] == $detail['id_category']) : ?>
                    <tr>
                        <td><?php echo $j++; ?></td>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $detail['site_name'] ?></td>
                        <td><?php echo $item['title']; ?></td> 
                        <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<!-- None requrements Popup content -->
<?php foreach ($details as $key => $detail): ?>
    <?php if (!empty($detail['none_requirement'])): ?>
        <div id="noneRequirement<?php echo $detail['id']; ?>" class="portBox">
            <table border="1" style="width:100%">
                <tr>
                    <th>STT</th>
                    <th>ID Work</th>
                    <th>Site</th>
                    <th>Work Name</th> 
                    <th>URL</th>
                </tr>
                <?php
                $i = 1;
                foreach ($work_non_requirement as $item):
                    ?>
            <?php if ($item['id_site'] == $detail['id_site'] && $item['category_of_site'] == $detail['id_category']) : ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $item['id']; ?></td>
                            <td><?php echo $detail['site_name'] ?></td>
                            <td><?php echo $item['title']; ?></td> 
                            <td><a href="<?php echo $item['url']; ?>" target="_blank"><?php echo $item['url']; ?></a></td>
                        </tr>
            <?php endif; ?>
        <?php endforeach; ?>
            </table>
        </div>
    <?php endif; ?>
<?php endforeach; ?>