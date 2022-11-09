<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách tài khoản</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
      <div class="card">
        <div class="card-header d-flex" style="height: 65px;">
          <a href="?action=add"  class="btn btn-block btn-info" style="position: absolute;width: 150px; right: 40px;">Thêm tài khoản</a>
        </div>
        <!-- /.card-header -->
        <!-- /.card-body -->
        <div class="card-body">
          <table class="table table-bordered" style="text-align: center;">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Phòng ban</th>
                    <th>Trạng thái</th>
                    <th>Quyền</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < count($accounts); $i++)
                <tr>
                    <td>{{$accounts[$i]['first_name'] . ' ' .$accounts[$i]['last_name']}}</td>
                    <td>{{$accounts[$i]['email']}}</td>
                    <td>{{$accounts[$i]['phone']}}</td>
                    <td>{{$accounts[$i]['department']}}</td>
                    <td>
                        <!-- {{$accounts[$i]['status'] == 1 ? 'Đang làm việc' : 'Đã nghỉ việc'}} -->
                        @if ($accounts[$i]['status'] == 1) 
                            <span style="background-color:#C6F6E4;color:#06C935;padding: 5px 10px;border-radius:15px;">Đang làm việc</span>
                        @else
                            <span style="background-color:#F8B9B1;color:#E72108;padding: 5px 10px;border-radius:15px;">Đã nghỉ việc</span>
                        @endif
                    </td>
                    <td>{{$accounts[$i]['decentralization'] == 1 ? 'Quản trị viên' : 'Nhân viên'}}</td>
                    <td>{{date('d/m/Y',strtotime($accounts[$i]['created_at']))}}</td>
                    <td>
                        <div class="btn-group">
                            <!-- <a class="btn btn-warning" href="{{ __WEB__ROOT . '/app/views/accounts/edit.php?action=edit'}}">Sửa</a> -->
                            <a class="btn btn-warning" href="{{ __WEB__ROOT . '/account/edit?action=edit'}}">Sửa</a>
                            <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="?action=delete&id=">Xóa</a>
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