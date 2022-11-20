<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách giải thưởng</h1>
                </div>
                </div>
            </div><!-- /.container-fluid -->
            @php
                global $config;
                $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];
            @endphp
            @if (isset($sessionData['errors_reward']))
                @if (!isset($sessionData['errors_reward']['reward_name']) && !isset($sessionData['errors_reward']['amount']))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
                    @if (isset($sessionData['status']))
                        @if ('add' == $sessionData['status']) 
                            {{'Thêm giải thưởng thành công'}}
                        @else
                            {{'Sửa thông tin giải thưởng thành công'}}
                        @endif
                    @endif
                </div>
                @endif
            @endif
            @php
                Session::delete('errors_reward');
                Session::delete('old_data_reward');
                Session::delete('msg_reward');
                Session::delete('status');
            @endphp
        </section>

        <section class="content-header">
            <div class="card">
                <div class="card-header d-flex" style="height: 65px;">
                    <a href="{{ __WEB__ROOT . '/giai-thuong/them'}}" class="btn btn-block btn-info" style="position: absolute;width: 150px; right: 40px;">Thêm giải thưởng</a>
                </div>
                <!-- /.card-header -->
                <!-- /.card-body -->
                <div class="card-body">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Ghi chú</th>
                                <th>Tiền thưởng</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        @for ($i = 0; $i < count($rewards); $i++)
                        <tr>
                            <td>{{$rewards[$i]['reward_name']}}</td>
                            <td>{{$rewards[$i]['note']}}</td>
                            <td>{{$rewards[$i]['amount']}}</td>
                            <td>{{date('d/m/Y',strtotime($rewards[$i]['created_at']))}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-warning" href="{{ __WEB__ROOT . '/giai-thuong/sua/' . $rewards[$i]['id']}}">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="{{ __WEB__ROOT . '/giai-thuong/xoa/' . $rewards[$i]['id']}}">Xóa</a>
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