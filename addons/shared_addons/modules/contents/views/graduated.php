<div class="content">
    <div class="row block-main-title" style="position: relative;">
        <div class="col-md-12 title img-responsive">Danh sách sinh viên tốt nghiệp<label class="pull-right text-right create-date"><span><?php echo date('d-m-Y',time())?></span></label></div>
    </div>
    <div class="item-index">
        <div class="form-search">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="col-sm-3 control-label item">Đợt tốt nghiệp</label>
                    <div class="col-sm-6">
                        <select name="course[id]" class="form-control item">
                            <option value="8">2013-2014 Tháng 04</option>
                        </select>                </div>
                    <div class="col-sm-3 item">
                        <input type="submit" class="btn btn-default" name="sm-list" value="Search">
                    </div>
                </div>
            </form>
        </div>

        <div>
            <div>Tìm thấy: <?php echo count($datas)?></div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped  table-hover">
                    <colgroup>
                        <col class="col-xs-2">
                        <col class="col-xs-2">
                        <col class="col-xs-1">
                        <col class="col-xs-3">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>MASV</th>
                            <th colspan="2">Họ và tên</th>
                            <th>Điểm TB</th>
                            <th>Xếp Lọai</th>
                            <th>Khoa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data['masv']?></td>
                            <td style="text-align: left;"><?php echo $data['ho_lot']?></td>
                            <td style="text-align: left;"><?php echo $data['ten']?></td>
                            <td><?php echo $data['diem_tb']?></td>
                            <td><?php echo $data['xep_loai']?></td>
                            <td style="text-align: left"><?php echo $data['khoa']?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>