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
    <link rel="stylesheet" href="style_PCCV.css">
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
        $query = "SELECT * FROM  pc_congviec_dal WHERE id = '$_ID'";
        $result = mysqli_query($conn, $query);
        if ($result != null && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idDuAn = $row['idDuAn'];
                $tencv = $row['TenCongViec'];
                $mucgia = $row['MucGia'];
                $nguoilam = $row['NguoiLam'];
                $loaicv = $row['LoaiCongViec'];
                $ngaybd = $row['NgayBatDau'];
                $ngaykt = $row['NgayKetThuc'];
                $tinhtrang = $row['TinhTrang'];
                $mamau = $row['MaMau'];
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
        $tencv = $_POST['txtName'];
        $mucgia = $_POST['txtgiatien'];
        $nguoilam = $_POST['nguoilam'];
        $loaicv = $_POST['loaicv'];
        $ngaybd = $_POST['txtNgayBD'];
        $ngaykt = $_POST['txtNgayKT'];
        $tinhtrang = $_POST['tinhtrang'];
        $mamau = $_POST['mamau'];
        //step 1 : connect db
        $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
        if ($conn != true) {
            die("connect error" . mysqli_connect_errno());
        } else {
            // lấy idDuAn Của id cần sửa
            $sql = "SELECT * FROM  pc_congviec_dal WHERE id = '" . $_GET['id'] . "'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $idDUAN = $row['idDuAn'];
                }
            }
            // lấy dữ liệu ngày bắt đầu ngày kết thức để so sánh của idDuaAn
            $sql = "SELECT * FROM  duanlon WHERE id = '" . $idDUAN . "'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $ngaybdda = $row['NgayBatDau'];
                    $ngayktda = $row['NgayKetThuc'];
                }
            }
            //thực hiện insert có điều kiện
            if ($ngaybd < $ngaybdda or $ngaybd >  $ngayktda) {
                echo "<script type ='text/javascript'>";
                echo "alert('Ngày Kết Thúc DA >= Ngày Bắt Đầu >= Ngày Bắt Đầu DA');";
                echo "</script>";
            } else if ($ngaykt < $ngaybdda or $ngaykt >  $ngayktda or $ngaybd > $ngaykt) {
                echo "<script type ='text/javascript'>";
                echo "alert('Ngày Kết Thúc DA >= Ngày Kết Thúc >= Ngày Bắt Đầu DA');";
                echo "</script>";
            } else {
                if ($tinhtrang == "Hoàn Thành") {
                    $query = "UPDATE pc_congviec_dal SET TenCongViec='" . $tencv . "',
                     MucGia='" . $mucgia . "', 
                     NguoiLam='" . $nguoilam . "', 
                     LoaiCongViec='" . $loaicv . "', 
                     NgayBatDau='" . $ngaybd . "', 
                     NgayKetThuc='" . $ngaykt . "', 
                     TinhTrang='" . $tinhtrang . "', 
                     MaMau= '#999999' WHERE id='" . $_GET['id'] . "'";
                } else {
                    $query = "UPDATE pc_congviec_dal SET TenCongViec='" . $tencv . "', 
                    MucGia='" . $mucgia . "', 
                    NguoiLam='" . $nguoilam . "', 
                    LoaiCongViec='" . $loaicv . "', 
                    NgayBatDau='" . $ngaybd . "', 
                    NgayKetThuc='" . $ngaykt . "', 
                    TinhTrang='" . $tinhtrang . "', 
                    MaMau='" . $mamau . "' WHERE id='" . $_GET['id'] . "'";
                }
                //thực hiện câu truy vấn
                $result = mysqli_query($conn, $query);
    
                //step 4. check data và trả về trang index sau khi thực hiện câu truy vấm
                if ($result == true) {
                    // echo "sửa thành công";
                    $sql = "SELECT * FROM pc_congviec_dal WHERE id='" . $_GET['id'] . "' ";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            header('location:index.php?id=' . $row['idDuAn'] . '');
                        }
                    }
                } else {
                    echo "Insert data error" . mysqli_errno($conn);
                }
                mysqli_close($conn);
            }
        }
    }
    ?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 style="text-align: center">Quản Lý Công Việc Cá Nhân</h3>
            </div>
            <ul class="list-unstyled components" style="margin-bottom: 0px; padding: 0px">
                <li><a href="/baitaplonweb/BangDieuKhien/index.php"><i class="fas fa-home"></i> Bảng Điều Khiển</a></li>
                <li><a href="/baitaplonweb/LoaiCongViec/index.php"><i class="fas fa-tasks"></i> Loại Công Việc</a></li>
                <li><a href="/baitaplonweb/LoaiDuAn/index.php"><i class="fas fa-project-diagram"></i> Loại Dự Án</a></li>
                <li><a href="/baitaplonweb/CongViecCaNhan/index.php"><i class="fas fa-calendar-alt"></i> Công Việc Cá Nhân</a></li>
                <li><a href="/baitaplonweb/ChucVu/index.php"><i class="fas fa-calendar-check"></i> Chức Vụ</a></li>
                <li><a href="/baitaplonweb/ThanhVien/index.php"><i class="fas fa-users"></i> Thành Viên</a></li>
                <li><a href="/baitaplonweb/DuAnLon/index.php"><i class="fas fa-handshake"></i> Dự Án Lớn</a></li>
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
                            <h2 class="m-0">Công Việc Cá Nhân</h2>
                        </div>
                    </div>
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
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Tên Công Việc :</label>
                                                <input type="text" class="form-control form-control-sm" required name="txtName" value="<?php echo $tencv ?>">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Mức Giá :</label>
                                                <input type="text" class="form-control form-control-sm" required name="txtgiatien" value="<?php echo $mucgia ?>">
                                            </div>
                                            <label>Người Làm :</label>
                                            <div>
                                                <select id="nguoilam" name="nguoilam" class="custom-select mb-3">
                                                    <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                                    if ($conn != true) {
                                                        die("connect error" . mysqli_connect_errno());
                                                    } else {
                                                        $sql = "select * from `tt_thanhvien`";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option >" . $row['HoTen'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Loại Công Việc :</label>
                                            <div>
                                                <select id="loaicv" name="loaicv" class="custom-select mb-3">
                                                    <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                                    if ($conn != true) {
                                                        die("connect error" . mysqli_connect_errno());
                                                    } else {
                                                        $sql = "select * from `loaicv`";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option >" . $row['TenLoaiCongViec'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Ngày Bắt Đầu</label>
                                                <input type="date" class="form-control form-control-sm" autocomplete="off" required name="txtNgayBD" value="<?php echo $ngaybd ?>">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Ngày Kết Thúc</label>
                                                <input type="date" class="form-control form-control-sm" autocomplete="off" required name="txtNgayKT" value="<?php echo $ngaykt ?>">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Tình Trạng :</label>
                                                <div>
                                                    <select id="tinhtrang" name="tinhtrang" class="custom-select mb-3" style="margin: 0px;">
                                                        <option <?php if ($tinhtrang == "Đang Tiến Hành") echo "selected"; ?>>Đang Tiến Hành</option>
                                                        <option <?php if ($tinhtrang == "Hoàn Thành") echo "selected"; ?>>Hoàn Thành</option>
                                                        <option <?php if ($tinhtrang == "Dời") echo "selected"; ?>>Dời</option>
                                                        <option <?php if ($tinhtrang == "Hủy") echo "selected"; ?>>Hủy</option>
                                                        <option <?php if ($tinhtrang == "Bắt Đầu") echo "selected"; ?>>Bắt Đầu</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleColorInput" class="form-label">Chọn Mã Màu</label>
                                                <input type="color" name="mamau" class="form-control form-control-color" id="exampleColorInput" title="Choose your color" style="height: 35px; width: 100px" value="<?php echo $mamau ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card-footer border-top border-info">
                                        <div class="d-flex w-100 justify-content-center align-items-center">
                                            <button type="submit" id="btnluu" name="btnluu" class="btn btn-flat  bg-gradient-primary mx-2" style="border-radius: 9px;border:2px solid #ff1e004d">Save</button>
                                            <?php
                                            $sql = "SELECT * FROM pc_congviec_dal WHERE id='" . $_GET['id'] . "' ";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr>
                                                            <a href="index.php?id=' . $row['idDuAn'] . '" class="btn btn-flat  bg-gradient-primary mx-2" style="border-radius: 9px;border:2px solid #ff1e004d">Cancel</a>
                                                        </tr>';
                                                }
                                            }
                                            ?>
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
    </script>
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