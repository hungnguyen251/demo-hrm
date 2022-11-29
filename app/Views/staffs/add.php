<div class="wrapper">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm nhân viên</h1>
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
                        <h3 class="card-title">Thêm nhân viên</h3>
                    </div>

                    <form method="post" action="{{ __WEB__ROOT . '/staff/check/create'}}">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputEmail">Họ và tên (*)</label>
                                <input type="text" class="form-control" value="{{oldData('staff_fullname')}}" name="staff_fullname" placeholder="Nhập họ và tên của nhân viên">
                                @php echo formError('staff_fullname', '<span style="color:red;">','</span>') @endphp                    
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Biệt danh </label>
                                <input type="text" class="form-control" value="{{oldData('nickname')}}" name="nickname"  placeholder="Nhập biệt danh của nhân viên">
                            </div>

                            <div class="form-group">
                                <label for="inputDecentralization">Giới tính (*)</label>
                                <select class="form-control" name="gender">
                                    <option>--Chọn--</option>
                                    <option>Nam</option>
                                    <option>Nữ</option>
                                </select>
                                @php echo formError('gender', '<span style="color:red;">','</span>') @endphp                    
                            </div>

                            <div class="form-group d-flex" style="height: 70px;">
                                <div class="form-group col-sm-6 px-0">
                                    <label for="inputAvatar">Ảnh đại diện </label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputAvatar" value="'{{oldData('avatar')}}'" name="avatar" accept=".jpg, .png, .jpeg">
                                            <label class="custom-file-label" for="inputFile">Chọn hình ảnh</label>
                                            @php echo formError('avatar', '<span style="color:red;">','</span>') @endphp                    
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputDOB">Ngày sinh (*)</label>
                                    <div class="form-group d-flex">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="date_of_birth" id="date_of_birth"  value="{{oldData('date_of_birth')}}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                    </div>
                                    @php echo formError('date_of_birth', '<span style="color:red;">','</span>') @endphp                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">Địa chỉ </label>
                                <input type="text" class="form-control" value="{{oldData('domicile')}}" name="domicile" id="inputAddress" placeholder="Nhập địa chỉ">
                            </div>

                            <div class="form-group">
                                <label for="inputIdNumber">Số CMND (CCCD) (*) </label>
                                <input type="text" class="form-control" value="{{oldData('id_number')}}" name="id_number" id="inputIdNumber" placeholder="Nhập số CMND hoặc CCCD">
                                @php echo formError('id_number', '<span style="color:red;">','</span>') @endphp
                            </div>
                            
                            <div class="form-group d-flex" style="height: 70px;">
                                <div class="form-group col-sm-6 px-0">
                                    <label for="inputPlaceIssueId">Nơi cấp (*)</label>
                                    <select class="form-control" name="place_issue_id">
                                        <option>--Chọn--</option>
                                        <option>Hồ Chí Minh</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="inputDateIssueId">Ngày cấp (*)</label>
                                    <div class="form-group d-flex">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text form-control"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="date_issue_id" id="date_issue_id"  value="{{oldData('date_issue_id')}}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputMarriage">Tình trạng hôn nhân (*)</label>
                                <select class="form-control" name="marriage_code">
                                    <option>--Chọn--</option>
                                    <option>Độc thân</option>
                                    <option>Đính hôn</option>
                                    <option>Có gia đình</option>
                                    <option>Ly thân</option>
                                    <option>Ly hôn</option>
                                </select>
                                @php echo formError('marriage_code', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputDiploma">Bằng cấp (*)</label>
                                <select class="form-control" name="diploma_id">
                                    <option>--Chọn--</option>
                                    <option>Bằng tốt nghiệp THPT</option>
                                    <option>Bằng cử nhân</option>
                                    <option>Bằng kĩ sư</option>
                                    <option>Bằng thạc sĩ</option>
                                    <option>Bằng tiến sĩ</option>
                                </select>
                                @php echo formError('diploma_id', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputStaffType">Loại nhân viên (*)</label>
                                <select class="form-control" name="staff_type_id">
                                    <option>--Chọn--</option>
                                    <option>Nhân viên chính thức</option>
                                    <option>Nhân viên thời vụ</option>
                                    <option>Thực tập sinh</option>
                                </select>
                                @php echo formError('staff_type_id', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputPosition">Chức danh (*)</label>
                                <select class="form-control" name="position_id">
                                    <option>--Chọn--</option>
                                    <option>Nhân viên</option>
                                    <option>Phó phòng</option>
                                    <option>Trưởng phòng</option>
                                    <option>Phó giám đốc</option>
                                    <option>Giám đốc</option>
                                </select>
                                @php echo formError('position_id', '<span style="color:red;">','</span>') @endphp
                            </div>
                            
                            <div class="form-group">
                                <label>Phòng ban (*)</label>
                                <select class="form-control" name="department_id" id="department_id" value="test">
                                    <option>--Chọn--</option>
                                    <option>Phòng tổ chức - hành chính</option>
                                    <option>Phòng kĩ thuật</option>
                                    <option>Phòng tài chính - kế toán</option>
                                    <option>Phòng IT</option>
                                    <option>Phòng Marketing</option>
                                </select>
                                @php echo formError('department_id', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputStartWork">Ngày bắt đầu hợp đồng (*)</label>
                                <div class="form-group d-flex">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text form-control"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="date_start_work" id="date_start_work"  value="{{oldData('date_start_work')}}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                </div>
                                @php echo formError('date_start_work', '<span style="color:red;">','</span>') @endphp
                            </div>

                            <div class="form-group">
                                <label for="inputPhone">Sở thích </label>
                                <input type="text" class="form-control" value="{{oldData('hobby')}}" name="hobby"  placeholder="Nhập sở thích của nhân viên">
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

    $(function () {
        bsCustomFileInput.init();
    });
</script>