<table border="0" width="90%" cellspacing="0" cellpadding="0">
    <tbody>
        <tr class="title">
            <td width="33.333%" colspan="2">Website</td>
            <td width="33.333%">Jobs</td>
            <td width="33.333%">Status</td>
        </tr>
        <?php
        $total = 0;
        foreach ($all_sites as $site):
            ?>
            <tr>
                <td>
                    <a href="<?php echo $site['url'] ?>" target="_blank"><img src="uploads/default/files/<?php echo $site['image'] ?>" align="middle"></a>
                </td>
                <td class="left">
                    <a href="<?php echo $site['url'] ?>" target="_blank"><?php echo $site['name'] ?></a>
                </td>
                <td class="right">
                    <?php
                    foreach ($count_work as $count):
                        echo '';
                        if ($count['id'] == $site['id']) {
                            echo $count['count'];
                            $total += (int) $count['count'];
                            break;
                        }
                    endforeach;
                    ?></td>
                <td>
                    <input type="radio" value="1" name="statistic[<?php echo $site['id'] ?>]" class="enable" checked>Enable
                    <input type="radio" value="0" name="statistic[<?php echo $site['id'] ?>]" class="disable" <?php if (!$site['status']) echo 'checked'; ?>>Disable
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td class="title" colspan="2">Total</td>
            <td class="right"><?php echo $total ?></td>
            <td class="right"></td>
        </tr>
    </tbody>
</table>   
<div class="buttons">
    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))) ?>
</div>