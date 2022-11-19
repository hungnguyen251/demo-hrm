<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm tài khoản</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <form action="" method="post">
              <a href="{{ __WEB__ROOT . '/tai-khoan'}}" type="submit" name="back" class="btn btn-info">Quay lại danh sách tài khoản</a>
            </form>
          </div>
        </div>
      </div>
        @if (isset($exception))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Thông báo!</h5>
                Đã xảy ra lỗi thêm bản ghi, vui lòng kiểm tra lại các thông tin đã nhập (Chú ý lỗi từ ID nhân viên phải có trên hệ thống)
            </div>
        @endif
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm tài khoản</h3>
                    </div>

                    <form method="post" action="{{ __WEB__ROOT . '/account/check/create'}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail">Họ </label>
                                <input type="text" class="form-control" value="{{oldData('first_name')}}" name="first_name" placeholder="Nhập vào họ của nhân viên">
                                @php echo formError('first_name', '<span style="color:red;">','</span>') @endphp                    
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Tên đệm và tên </label>
                                <input type="text" class="form-control" value="{{oldData('last_name')}}" name="last_name"  placeholder="Nhập tên đệm và tên của nhân viên">
                                @php echo formError('last_name', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputEmail">Email </label>
                                <input type="email" class="form-control" value="{{oldData('email')}}" name="email" id="inputEmail" placeholder="Nhập vào email">
                                @php echo formError('email', '<span style="color:red;">','</span>')@endphp
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Số điện thoại </label>
                                <input type="text" class="form-control" value="{{oldData('phone')}}" name="phone" id="inputPhone" placeholder="Nhập số điện thoại">
                                @php echo formError('phone', '<span style="color:red;">','</span>') @endphp
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPasswd">Mật khẩu (*)</label>
                                <input type="password" class="form-control" value="" name="password" id="inputPassword" placeholder="Nhập vào mật khẩu">
                                @php echo formError('password', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputConfirmPassword">Nhập lại mật khẩu (*)</label>
                                <input type="password" class="form-control" value="" name="confirm_password" id="inputConfirmPassword" placeholder="Nhập lại mật khẩu">
                                @php echo formError('confirm_password', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label>ID nhân viên</label>
                                <input type="text" class="form-control" value="" name="staff_id" id="inputStaffId" placeholder="Nhập vào ID nhân viên">
                            </div>

                            <div class="form-group">
                                <label for="inputDecentralization">Phân quyền </label>
                                <select class="form-control" name="decentralization">
                                    <option>-</option>
                                    <option>Nhân viên</option>
                                    <option>Quản trị viên</option>
                                    <option>Kế toán</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Phòng ban</label>
                                <select class="form-control" name="department" value="test">
                                    <option>-</option>
                                    <option>Phòng tổ chức - hành chính</option>
                                    <option>Phòng kĩ thuật</option>
                                    <option>Phòng tài chính - kế toán</option>
                                    <option>Phòng IT</option>
                                    <option>Phòng Marketing</option>
                                </select>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label>Trạng thái</label>
                                <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on" style="width: 86px;">
                                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                        <input type="checkbox" name="status" checked data-bootstrap-switch="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
</body>
</html>

<script>
  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  }) 

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  $('[data-mask]').inputmask()
</script>