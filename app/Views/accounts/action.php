<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa thông tin tài khoản</h1>
          </div>
          <div class="col-sm-6" style="text-align:right;">
            <form action="" method="post">
              <a href="{{ __WEB__ROOT . '/account/index/'}}" type="submit" name="back" class="btn btn-info">Quay lại danh sách tài khoản</a>
            </form>
          </div>
        </div>
      </div>
    </section>
      <!-- Notification success/failed -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin</h3>
                    </div>

                    <form method="post" action="{{ __WEB__ROOT . '/account/checkEditAccount/'. $accounts[0]['id'] }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail">Họ </label>
                                <input type="text" class="form-control" value="{{$accounts[0]['first_name']}}" name="first_name" placeholder="Nhập vào họ của nhân viên">
                                @php echo formError('first_name', '<span style="color:red;">','</span>') @endphp                    
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Tên đệm và tên </label>
                                <input type="text" class="form-control" value="{{$accounts[0]['last_name']}}" name="last_name"  placeholder="Nhập tên đệm và tên của nhân viên">
                                @php echo formError('last_name', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputEmail">Email </label>
                                <input type="email" class="form-control" value="{{$accounts[0]['email']}}" name="email" id="inputEmail" placeholder="Nhập vào email">
                                @php echo formError('email', '<span style="color:red;">','</span>')@endphp
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Số điện thoại </label>
                                <input type="text" class="form-control" value="{{$accounts[0]['phone']}}" name="phone" id="inputPhone" placeholder="Nhập số điện thoại">
                                @php echo formError('phone', '<span style="color:red;">','</span>') @endphp
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPasswd">Mật khẩu (*)</label>
                                <input type="password" class="form-control" value="{{$accounts[0]['password']}}" name="password" id="inputEmail" placeholder="Nhập vào mật khẩu">
                                @php echo formError('password', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputDecentralization">Phân quyền </label>
                                <select class="form-control" name="decentralization">
                                  <option {{ $accounts[0]['decentralization'] == '1' ? 'selected' : ''}}>Quản trị viên</option>
                                  <option {{ $accounts[0]['decentralization'] == '2' ? 'selected' : ''}}>Nhân viên</option>
                                  <option {{ $accounts[0]['decentralization'] == '3' ? 'selected' : ''}}>Kế toán</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Mã nhân viên</label>
                                <select class="form-control" name="position">
                                    <option>{{$accounts[0]['staff_id']}}</option>
                                </select>
                            </div> -->
                            
                            <div class="form-group">
                                <label>Phòng ban</label>
                                <select class="form-control" name="department" value="test">
                                    <option {{ $accounts[0]['department'] == 'Phòng tổ chức - hành chính' ? 'selected' : ''}}>Phòng tổ chức - hành chính</option>
                                    <option {{ $accounts[0]['department'] == 'Phòng kĩ thuật' ? 'selected' : ''}}>Phòng kĩ thuật</option>
                                    <option {{ $accounts[0]['department'] == 'Phòng tài chính - kế toán' ? 'selected' : ''}}>Phòng tài chính - kế toán</option>
                                    <option {{ $accounts[0]['department'] == 'Phòng IT' ? 'selected' : ''}}>Phòng IT</option>
                                    <option {{ $accounts[0]['department'] == 'Phòng Marketing' ? 'selected' : ''}}>Phòng Marketing</option>
                                </select>
                            </div>

                            <div class="form-group d-flex flex-column">
                                <label>Trạng thái</label>
                                <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-on" style="width: 86px;">
                                    <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">
                                        <input type="checkbox" name="status" {{ $accounts[0]['status'] == '0' ? '' : 'checked' }} data-bootstrap-switch="">
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