<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách nhân viên chính thức</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @php
      global $config;
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];
      @endphp

      @if (isset($sessionData['errors_staff']))
        @if (!isset($sessionData['errors_staff']['staff_fullname']) && !isset($sessionData['errors_staff']['avatar']) && !isset($sessionData['errors_staff']['gender']) && !isset($sessionData['errors_staff']['date_of_birth']) && !isset($sessionData['errors_staff']['date_start_work']) && !isset($sessionData['errors_staff']['marriage_code']) && !isset($sessionData['errors_staff']['id_number']) && !isset($sessionData['errors_staff']['staff_type_id']) && !isset($sessionData['errors_staff']['diploma_id']) && !isset($sessionData['errors_staff']['department_id']) && !isset($sessionData['errors_staff']['position_id'])) 
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
            @if (isset($sessionData['status']))
              @if ('add' == $sessionData['status']) 
                  {{'Thêm nhân viên thành công'}}
              @else
                  {{'Sửa thông tin nhân viên thành công'}}
              @endif
            @endif
          </div>
        @endif
      @endif
      @php
        Session::delete('errors_staff');
        Session::delete('msg_staff');
        Session::delete('old_data_staff');
        Session::delete('status');
        Session::delete('inputImage');
      @endphp
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
                            <p style="background-color:#C6F6E4;color:#06C935;padding: 5px 10px;border-radius:15px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 8px;"></i>Đang làm việc</p>
                        @else
                            <p style="background-color:#F8B9B1;color:#E72108;padding: 5px 10px;border-radius:15px;"><i class="fa fa-circle" aria-hidden="true" style="font-size: 8px;"></i>Đã nghỉ việc</p>
                        @endif
                    </td>
                    <td>{{$staffs[$i]['id_number']}}</td>
                    <td>{{$staffs[$i]['marriage_status_name']}}</td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-warning" href="{{ __WEB__ROOT . '/nhan-vien/sua/' . $staffs[$i]['id']}}">Sửa</a>
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