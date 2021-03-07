<table cellspacing="0">
    <thead>
        <tr>
            <th>MSSV</th>
            <th>Họ và tên</th>
            <th></th>
            <th>Điểm TB</th>
            <th>Xếp Loại</th>
            <th>Khoa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($all_graduated as $post) : ?>
            <tr>
                <td><?php echo $post['masv'] ?></td>
                <td><?php echo $post['ho_lot'] ?></td>
                <td><?php echo $post['ten'] ?></td>
                <td><?php echo $post['diem_tb'] ?></td>
                <td><?php echo $post['xep_loai'] ?></td>
                <td><?php echo $post['khoa'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<br>