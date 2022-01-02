<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quản Lý Công Việc Cá Nhân</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->

    <link rel="stylesheet" href="style2.css">
    <!-- Scrollbar Custom CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->

    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- lấy dữ liệu khi ấn -->
    <?php
    $_ID = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
    if ($conn != true) {
        die("connect error" . mysqli_connect_errno());
    } else {
        $query = "SELECT * FROM  tt_thanhvien WHERE id = '$_ID'";
        $result = mysqli_query($conn, $query);
        if ($result != null && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ID = $row['id'];
                $Name = $row['HoTen'];
                $NgaySinh = $row['NgaySinh'];
                $GioiTinh = $row['GioiTinh'];
                $Email = $row['Email'];
                $quequan = $row['QueQuan'];
            }
        } else {
            echo "Data is empty";
        }
    }
    ?>

    <!-- thục hiện UpdateData -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btnluu'])) {
        UpdateData();
    }
    function UpdateData()
    {
        $Name = $_POST['txtName'];
        $NgaySinh = $_POST['txtNgaySinh'];
        $GioiTinh = $_POST['gioitinh'];
        $Email = $_POST['txtEmail'];
        $chucvu = $_POST['chucvu'];
        $quequan = $_POST['txtquequan'];
        //step 1 : connect db
        $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
        if ($conn != true) {
            die("connect error" . mysqli_connect_errno());
        } else {
            //step 2 . wrrite query
            $query = "UPDATE tt_thanhvien SET HoTen='" . $Name . "', NgaySinh='" . $NgaySinh . "', GioiTinh='" . $GioiTinh . "', Email='" . $Email . "', TenChucVu='" . $chucvu . "', QueQuan='" . $quequan . "' WHERE id='" . $_GET['id'] . "'";
            //step 3. excute
            $result = mysqli_query($conn, $query);

            //step 4. check data
            if ($result == true) {
                // echo "sửa thành công";
                header('location:index.php');
            } else {
                echo "Insert data error" . mysqli_errno($conn);
            }
        }
        mysqli_close($conn);
    }
    ?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Quản Lý Loại Dự Án</h3>
            </div>
            <ul class="list-unstyled components" style="margin-bottom: 0px; padding: 0px">
                <li><a href="../BangDieuKhien/index.php"><i class="fas fa-home"></i> Bảng Điều Khiển</a></li>
                <li><a href="../DuAnLon/index.php"><i class="fas fa-tasks"></i> Loại Công Việc</a></li>
                <li><a href="../LoaiDuAn/index.php"><i class="fas fa-project-diagram"></i> Loại Dự Án</a></li>
                <li><a href="../CongViecCaNhan/index.php"><i class="fas fa-calendar-alt"></i> Công Việc Cá Nhân</a></li>
                <li><a href="../ChucVu/index.php"><i class="fas fa-calendar-check"></i> Chức Vụ</a></li>
                <li><a href="index.php"><i class="fas fa-users"></i> Thành Viên</a></li>
                <li><a href="../DuAnLon/index.php"><i class="fas fa-handshake"></i> Dự Án Lớn</a></li>
            </ul>
            <ul style="padding-left: 0px;">
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-user-tie"></i> Tài Khoản</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="../login/index.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>
            </nav>
            
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h2 class="m-0">Thêm Thành Viên</h2>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                    <hr class="border-primary">
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card card-outline card-primary" style="border-top: 3px solid rgb(48, 162, 48); border-radius: 5px;">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-6 border-right">
                                            <div class="form-group">
                                                <label>Họ Tên</label>
                                                <input type="text" class="form-control form-control-sm" required name="txtName" value="<?php echo $Name ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày Sinh</label>
                                                <input type="date" class="form-control form-control-sm" autocomplete="off" required name="txtNgaySinh" value="<?php echo $NgaySinh ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control form-control-sm" required name="txtEmail" value="<?php echo $Email ?>">
                                            </div>
                                            <label>Giới Tính:</label>
                                            <div class="form-group">
                                                <?php
                                                if ($GioiTinh == "Nam") {
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="gioitinh" name="gioitinh" value="Nam" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">Nam </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="gioitinh" name="gioitinh" value="Nữ">
                                                        <label class="form-check-label" for="flexRadioDefault1">Nữ</label>
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="gioitinh" name="gioitinh" value="Nam">
                                                        <label class="form-check-label" for="flexRadioDefault1">Nam </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="gioitinh" name="gioitinh" value="Nữ" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">Nữ</label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Chức Vụ :</label>
                                            <div>
                                                <select id="chucvu" name="chucvu" class="custom-select mb-3">
                                                    <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                                    if ($conn != true) {
                                                        die("connect error" . mysqli_connect_errno());
                                                    } else {
                                                        $sql = "select * from `chucvu`";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option >" . $row['TenChucVu'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Quê Quán </label>
                                                <textarea class="form-control" style="height: 100px" placeholder="Nhập tại đây" required name="txtquequan"><?php echo $quequan ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer border-top border-info">
                                        <div class="d-flex w-100 justify-content-center align-items-center">
                                            <!-- <button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project" id="btnluu" name="btnluu">Save</button> -->
                                            <button type="submit" id="btnluu" name="btnluu" class="btn btn-flat  bg-gradient-primary mx-2" style="background: #17a2b8;">Save</button>
                                            <a href="index.php" class="btn btn-flat  bg-gradient-primary mx-2" style="background: #17a2b8;">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/. container-fluid -->
            </section>

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
</body>

</html>