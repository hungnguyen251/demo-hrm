<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách phòng ban</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content-header">
        <div class="card">
            <div class="card-header d-flex" style="height: 85px;">
                <a href="#" class="btn btn-block btn-info" style="position: absolute;width: 150px; right: 40px;">Thêm phòng ban <i style="font-size: 10px;">(Chức năng khóa)</i></a>
            </div>
            <!-- /.card-header -->
            <!-- /.card-body -->
            <div class="card-body">
                <table class="table table-bordered" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Thành viên</th>
                            <th>Trưởng phòng</th>
                            <!-- <th>Thao tác</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($departments); $i++)
                        <tr>
                            <td>{{$departments[$i]['department_name']}}</td>
                            <td>
                                @php $count = $departments[$i]['department_code']; @endphp
                            {{ isset($countStaff[0][$count]) ? $countStaff[0][$count] : 'Đang cập nhật ...'}}
                            </td>
                            <td>
                                @for ($j = 0; $j < count($leader); $j++)
                                    @if ($leader[$j]['department_id'] == $departments[$i]['id'])
                                        {{ isset($leader[$j]['staff_fullname']) || $leader[$j]['staff_fullname'] != '' ? $leader[$j]['staff_fullname'] : 'Đang cập nhật ...'}}
                                        @php break; @endphp
                                    @endif
                                @endfor
                            </td>
                            <!-- <td>
                                <div class="btn-group">
                                    <a class="btn btn-warning" href="{{ __WEB__ROOT . '/tai-khoan/sua/' . $departments[$i]['id']}}">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="{{ __WEB__ROOT . '/tai-khoan/xoa/' . $departments[$i]['id']}}">Xóa</a>
                                </div>
                            </td> -->
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