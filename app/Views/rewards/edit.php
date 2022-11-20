<div class="wrapper">
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sửa thông tin giải thưởng</h1>
                    </div>
                    <div class="col-sm-6" style="text-align:right;">
                        <form action="" method="post">
                            <a href="{{ __WEB__ROOT . '/giai-thuong'}}" type="submit" name="back" class="btn btn-info">Quay lại danh sách giải thưởng</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa thông tin</h3>
                        </div>

                        <form method="post" action="{{ __WEB__ROOT . '/reward/check/'. $reward[0]['id'] . '/edit' }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Tên giải thưởng </label>
                                    <input type="text" class="form-control" value="{{$reward[0]['reward_name']}}" name="reward_name" placeholder="Nhập vào tên giải thưởng">
                                    @php echo formError('reward_name', '<span style="color:red;">','</span>') @endphp                    
                                </div>

                                <div class="form-group">
                                    <label for="inputAmount">Tiền thưởng </label>
                                    <input type="text" class="form-control" value="{{$reward[0]['amount']}}" name="amount"  placeholder="Nhập số tiền thưởng">
                                    @php echo formError('amount', '<span style="color:red;">','</span>') @endphp
                                </div>

                                <div class="form-group">
                                    <label for="inputNote">Ghi chú </label>
                                    <input type="note" class="form-control" value="{{$reward[0]['note']}}" name="note" id="inputNote" placeholder="Nhập vào ghi chú">
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