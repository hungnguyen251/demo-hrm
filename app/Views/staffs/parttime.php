<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách nhân viên thời vụ</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <div class="card">
        <div class="card-header d-flex" style="height: 65px;">
          <a href="{{ __WEB__ROOT . '/nhan-vien/them'}}" class="btn btn-block btn-info" style="position: absolute;width: 150px; right: 40px;">Thêm nhân viên</a>
        </div>
        <!-- /.card-header -->
        <!-- /.card-body -->
        <div class="card-body">
          <table class="table table-bordered" style="text-align: center;">
            <thead>
                <tr>
                    <th width="8%">Mã nhân viên</th>
                    <th width="8%">Tên</th>
                    <th width="6%">Ngày sinh</th>
                    <th>Địa chỉ</th>
                    <th width="8%">Phòng ban</th>
                    <th width="8%">Chức danh</th>
                    <th width="6%">Ngày bắt đầu</th>
                    <th width="8%">Bằng cấp</th>
                    <th width="9%">Trạng thái</th>
                    <th width="6%">Số CMND</th>
                    <th width="7%">Tình trạng hôn nhân</th>
                    <th width="7%">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($staffs); $i++)
                <tr>
                    <td>{{$staffs[$i]['staff_code']}}</td>
                    <td>{{$staffs[$i]['staff_fullname']}}</td>
                    <td>{{date('d/m/Y', strtotime($staffs[$i]['date_of_birth']))}}</td>
                    <td>{{$staffs[$i]['domicile']}}</td>
                    <td>{{$staffs[$i]['department_name']}}</td>
                    <td>{{$staffs[$i]['position_name']}}</td>
                    <td>{{date('d/m/Y', strtotime($staffs[$i]['date_start_work']))}}</td>
                    <td>{{$staffs[$i]['diploma_name']}}</td>
                    <td>
                        @if ($staffs[$i]['status'] == 'Active') 
                            <span style="background-color:#C6F6E4;color:#06C935;padding: 5px 10px;border-radius:15px;">Đang làm việc</span>
                        @else
                            <span style="background-color:#F8B9B1;color:#E72108;padding: 5px 10px;border-radius:15px;">Đã nghỉ việc</span>
                        @endif
                    </td>
                    <td>{{$staffs[$i]['id_number']}}</td>
                    <td>{{$staffs[$i]['marriage_status_name']}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-warning" href="{{ __WEB__ROOT . '/tai-khoan/sua/' . $staffs[$i]['id']}}">Sửa</a>
                            <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="{{ __WEB__ROOT . '/nhan-vien/xoa/' . $staffs[$i]['id']}}">Xóa</a>
                        </div>
                    </td>
                </tr>
                @endfor
            </tbody>
          </table>
        </div>
        <!-- /.card-footer -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item active"><a class="page-link" href="?page=1">1</a></li>
            </ul>
        </div>
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->