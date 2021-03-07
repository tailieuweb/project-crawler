<table border="0" width="90%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr class="title">
            <td>ID </td>
            <td>Name</td>
            <td>Number works</td>
            <td>Active</td>
            <td>Full infomation</td>
        </tr>
        <?php 
        $total_count_work = 0;
        $total_active = 0;
        $total_full_info = 0;
        foreach ($categories as $key => $item) : ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['count_works']; $total_count_work += $item['count_works']; ?></td>
                <td><?php echo $item['Active']; $total_active += $item['Active']; ?></td>
                <td><?php echo $item['Full info']; $total_full_info += $item['Full info']; ?></td>
            </tr>
            <?php if (!empty($item['child'])) : ?>
                <?php foreach ($item['child'] as $key_child => $child) : ?>
                    <tr class="item-child">
                        <td><?php echo ($key+1) . '.' . ($key_child+1) ?></td>
                        <td class="child"><?php echo $child['name']; ?></td>
                        <td><?php echo $child['count_works']; $total_count_work += $child['count_works']; ?></td>
                        <td><?php echo $child['Active']; $total_active += $child['Active']; ?></td>
                        <td><?php echo $child['Full info']; $total_full_info += $child['Full info']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td class="title" colspan="2">Total</td>
            <td class="right"><?php echo $total_count_work ?></td>
            <td class="right"><?php echo $total_active ?></td>
            <td class="right"><?php echo $total_full_info ?></td>
        </tr>
    </tbody>
</table>   