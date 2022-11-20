<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bảng thông báo</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      @php
      global $config;
        $sessionData = isset($_SESSION[$config['session']['session_key']]) ? $_SESSION[$config['session']['session_key']] : [];
      @endphp

      @if (isset($sessionData['errors_noti']))
        @if (isset($sessionData['change_status'])) 
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Thông báo!</h5>
                Tạo thông báo thất bại
            </div>
        @else
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Thông báo!</h5>
                Tạo thông báo thành công
            </div>
        @endif
      @endif
      @php
        Session::delete('errors_noti');
        Session::delete('msg_noti');
        Session::delete('old_data_noti');
        Session::delete('change_status');
      @endphp
    </section>

    <section class="content-header">
      <div class="card">
        <div class="card-header d-flex" style="height: 65px;">
          <button type="submit"  class="btn btn-block btn-info" style="position: absolute;width: 150px; right: 40px;" data-toggle="modal" data-target="#modal-lg">Tạo thông báo</button>
        </div>
        <!-- /.card-header -->
        <!-- /.card-body -->
        <div class="card-body">
          <table class="table table-bordered" style="text-align: center;">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Tên người tạo</th>
                    <th>Phòng ban</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php $u = 7;?>
                @for ($i = 0; $i < count($notifications); $i++)
                <tr>
                    <td>{{$notifications[$i]['title']}}</td>
                    <td>{{$notifications[$i]['content']}}</td>
                    <td>{{$notifications[$i]['author']}} . {{$notifications[$i]['id']}}</td>
                    <td>{{$notifications[$i]['department']}}</td>
                    <td>
                        @if ('waiting' == $notifications[$i]['status']) 
                            <span style="background-color:#F1EE9A;color:#A27400;padding: 5px 10px;border-radius:15px;">Chờ phê duyệt</span>
                        @endif
                        @if ('approve' == $notifications[$i]['status'])
                            <span style="background-color:#C6F6E4;color:#06C935;padding: 5px 10px;border-radius:15px;">Đã phê duyệt</span>
                        @endif
                        @if ('cancel' == $notifications[$i]['status'])
                            <span style="background-color:#F8B9B1;color:#E72108;padding: 5px 10px;border-radius:15px;">Hủy bỏ</span>
                        @endif
                    </td>
                    <td>{{date('d/m/Y',strtotime($notifications[$i]['created_at']))}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#change-{{$notifications[$i]['id']}}" type="submit" class="btn btn-ligh" data-toggle="modal" ><i class="fa fa-cogs" aria-hidden="true"  style="font-size:20px;color:#E72108;"></i></a>
                            
                            <!-- modal thao tác -->
                            <div class="modal fade" id="change-{{$notifications[$i]['id']}}">
                                <div class="modal-dialog modal-lg" style="width:200px;">
                                    <div class="modal-content">
                                        <div class="modal-body" style="text-align: center;">
                                            <a class="btn btn-primary" href="{{ __WEB__ROOT . '/thong-bao/thao-tac/' . $notifications[$i]['id'] . '/approve'}}" style="width:100px;">Phê duyệt</a>
                                            <a class="btn btn-warning" href="{{ __WEB__ROOT . '/thong-bao/thao-tac/' . $notifications[$i]['id'] . '/cancel'}}" style="width:100px;">Từ chối</a></br>
                                            <a class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa ?')" href="{{ __WEB__ROOT . '/thong-bao/xoa/' . $notifications[$i]['id']}}" style="width:100px;">Xóa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal thao tác -->

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
	<!-- Modal them moi -->
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tạo đơn xin nghỉ phép</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body">
                <form action="{{ __WEB__ROOT . '/thong-bao/them'}}" method="post">
                    <div class="card-body">
                        <div class="form-group d-flex">
                            <div class="form-group col-sm-12 px-0">
                                <label for="inputTitle">Tiêu đề (*)</label></br>
                                <input type="text" class="form-control" name="title" value="Đơn xin nghỉ phép" placeholder="Nhập vào tiêu đề" list="title">
                                <datalist id="title">
                                    <option value="Đơn xin nghỉ phép">
                                    <option value="Đơn xin nghỉ việc">
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group d-flex">
                            <div class="form-group col-sm-12 px-0">
                                <label for="inputNumber">Số ngày nghỉ (*)</label>
                                <input type="text" class="form-control" value="" name="number_leave" id="inputNumber" placeholder="Nhập vào số ngày nghỉ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputStartTime">Nghỉ từ ngày (*)</label>
                            <div class="form-group px-0 d-flex">
                                <div class="form-group col-sm-5 px-0 px-0">
                                    <select class="form-control" name="start_time">
                                        <option>Sáng</option>
                                        <option>Chiều</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-5 d-flex">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="start_date" id="start_date" value="" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEndTime">Đến ngày (*)</label>
                            <div class="form-group px-0 d-flex">
                                <div class="form-group col-sm-5 px-0 px-0">
                                    <select class="form-control" name="end_time">
                                        <option>Chiều</option>
                                        <option>Sáng</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-5 d-flex">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="end_date" id="end_date"  value="" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                </div>
                            </div>
                        </div>

                        <div class="form-group d-flex">
                            <div class="form-group col-sm-12 px-0">
                                <label>Chế độ nghỉ (*)</label>
                                <select class="form-control" name="reason">
                                    <option>Nghỉ phép năm</option>
                                    <option>Nghỉ ốm đau</option>
                                    <option>Nghỉ thai</option>
                                    <option>Nghỉ do tai nạn lao động hoặc bệnh nghề nghiệp</option>
                                    <option>Nghỉ kết hôn hoặc con kết hôn</option>
                                    <option>Bố mẹ vợ chồng hoặc con chết</option>
                                    <option>Nghỉ việc riêng không hưởng lương</option>
                                    <option>Nguyên nhân khác</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group d-flex">
                            <div class="form-group col-sm-12 px-0">
                                <label>Đề nghị bàn giao công việc đang làm cho (Tên + Phòng ban) (*)</label>
                                <input type="text" class="form-control" id="note" name="note" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" name="" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button name="submit" onclick="myFunction()" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  $('[data-mask]').inputmask()

function myFunction() {
  $("#inputNumber").prop('required',true);
  $("#note").prop('required',true);
  $("#end_date").prop('required',true);
  $("#start_date").prop('required',true);
}
</script>
