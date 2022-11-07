<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11">
            <h1>Thông tin cá nhân</h1>
          </div>
          <div class="col-sm-1 d-flex">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-lg">Sửa</button>         
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{__WEB__ROOT . __WEB__IMG . $user_info[0]['avatar']}}" alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{$user_info[0]["staff_fullname"]}}</h3>
                    <p class="text-muted text-center">PHP Developer</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Ngày sinh</b> <a class="float-right">{{date('d-m-Y', strtotime($user_info[0]["date_of_birth"]))}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tình trạng hôn nhân</b> <a class="float-right">{{$user_info[0]["marriage_status_name"]}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Thời gian làm việc</b> <a class="float-right">{{date('d/m/Y', strtotime($user_info[0]["date_start_work"]))}} <i>({{floor(abs(strtotime($user_info[0]["date_start_work"]) - strtotime(date('d-m-Y')))/(60*60*24))}} day)</i></a>
                        </li>
                        <li class="list-group-item">
                            <b>Giải thưởng</b> <a class="float-right">{{$user_info[0]["reward_name"]}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Trạng thái</b> <a class="float-right">{{$user_info[0]["staff_name"]}}</a>
                        </li>
                    </ul>
              </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Về tôi</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Học vấn</strong>
                    <p class="text-muted">{{$user_info[0]["diploma_name"]}}</p>
                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa chỉ</strong>
                    <p class="text-muted">{{$user_info[0]["domicile"]}}</p>
                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Kĩ năng</strong>
                    <p class="text-muted">
                      <span class="tag tag-danger">UI Design,</span>
                      <span class="tag tag-success"> CSS,</span>
                      <span class="tag tag-info"> Javascript,</span>
                      <span class="tag tag-warning"> PHP,</span>
                      <span class="tag tag-primary"> HTML</span>
                    </p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Vị trí</strong>
                    <p class="text-muted">{{$user_info[0]["position_name"]}}</p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Phòng Ban</strong>
                    <p class="text-muted">{{$user_info[0]["department_name"]}}</p>
                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Sở thích</strong>
                    <p class="text-muted">{{$user_info[0]["hobby"]}}.</p>
                    <hr>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal sua thong tin -->
    <div class="modal fade" id="modal-lg">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Thay đổi thông tin cá nhân</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label for="inputName">Họ và tên (*)</label>
                  <input type="text" class="form-control" value="" name="fullname" id="inputName" placeholder="Nhập vào tên sản phẩm">
                </div>

                <div class="form-group d-flex">
                  <div class="form-group col-sm-6 px-0">
                    <label for="inputEmail">Email (*)</label>
                    <input type="email" class="form-control" value="" name="email" id="inputEmail" placeholder="Nhập vào email đăng kí">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputPhone">Số điện thoại (*)</label>
                    <input type="text" class="form-control" value="" name="phone" id="inputPhone" placeholder="Nhập số điện thoại">
                  </div>
                </div>

                <div class="form-group d-flex">
                  <div class="form-group col-sm-6 px-0">
                    <label>Giới tính</label>
                    <select class="form-control" name="gender">
                      <option>-</option>
                      <option>Nam</option>
                      <option>Nữ</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Ngày sinh</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="text" name="birthday" value="" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                    </div>
                  </div>
                </div>
                
                <div class="form-group d-flex">
                  <div class="form-group col-sm-6 px-0">
                    <label for="exampleInputFile">Thay ảnh đại diện</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputFileImg">
                        <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Tình trạng hôn nhân</label>
                    <select class="form-control" name="marriage-status">
                      <option>-</option>
                      <option>Độc thân</option>
                      <option>Có gia đình</option>
                    </select>
                  </div>
                </div>

                <div class="form-group d-flex">
                  <div class="form-group col-sm-6 px-0">
                    <label>Chức vụ</label>
                    <select class="form-control" name="position">
                      <option>-</option>
                      <option>Nhân viên</option>
                      <option>Trưởng phòng</option>
                      <option>Phó phòng</option>
                      <option>Phó giám đốc</option>
                      <option>Giám đốc</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Phòng ban</label>
                    <select class="form-control" name="department">
                      <option>-</option>
                      <option>Phòng tổ chức - hành chính</option>
                      <option>Phòng kĩ thuật</option>
                      <option>Phòng tài chính - kế toán</option>
                      <option>Phòng IT</option>
                      <option>Phòng Marketing</option>
                    </select>
                  </div>
                </div>

                <div class="form-group d-flex">
                  <div class="form-group col-sm-6 px-0">
                    <label>Trạng thái</label>
                    <select class="form-control" name="status">
                      <option>-</option>
                      <option>Đang làm việc</option>
                      <option>Đã nghỉ việc</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label>Khen thưởng</label>
                    <select class="form-control" name="reward">
                      <option>-</option>
                      <option>Nhân viên xuất sắc</option>
                      <option>Nhân viên chuyên đi trễ</option>
                    </select>
                  </div>
                </div>

                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="check-out">
                  <label class="form-check-label" for="exampleCheck1">Xác nhận</label>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" name="submit" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Lưu thay đổi</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  $('[data-mask]').inputmask()
</script>
