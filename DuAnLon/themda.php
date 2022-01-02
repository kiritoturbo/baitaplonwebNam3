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
    <link rel="stylesheet" href="style_DAL.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['btnluu'])) {
        // $ID = $_POST['txtID'];
        InsertData();
    }
    function InsertData()
    {
        $tenda = $_POST['txtName'];
        $loaida = $_POST['loaida'];
        $tinhtrang = $_POST['tinhtrang'];
        $ngaybd = $_POST['txtNgayBD'];
        $ngaykt = $_POST['txtNgayKT'];
        //step 1 : connect db
        $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
        if ($conn != true) {
            die("connect error" . mysqli_connect_errno());
        } else {
            if ($ngaybd >  $ngaykt) {
                echo "<script type ='text/javascript'>";
                echo "alert('Ngày Kết Thúc Phải > Ngày Bắt Đầu');";
                echo "</script>";
            } else {
                $query = "INSERT INTO `duanlon`(`TenDuAn`, `LoaiDuAn`, `TinhTrang`, `NgayBatDau`, `NgayKetThuc`) 
                    VALUES ('" . $tenda . "','" . $loaida . "','" . $tinhtrang . "','" . $ngaybd . "','" . $ngaykt . "')";
                //step 3. excute
                $result = mysqli_query($conn, $query);

                //step 4. check data
                if ($result == true) {
                    // echo "Thêm thành công";
                    header('location:index.php');
                } else {
                    echo "Insert data error" . mysqli_errno($conn);
                }
            }
        }
        mysqli_close($conn);
    }
    ?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 style="text-align: center">Quản Lý Công Việc Cá Nhân</h3>
            </div>
            <ul class="list-unstyled components" style="margin-bottom: 0px; padding: 0px">
                <li><a href="../BangDieuKhien/index.php"><i class="fas fa-home"></i> Bảng Điều Khiển</a></li>
                <li><a href="../DuAnLon/index.php"><i class="fas fa-tasks"></i> Loại Công Việc</a></li>
                <li><a href="../LoaiDuAn/index.php"><i class="fas fa-project-diagram"></i> Loại Dự Án</a></li>
                <li><a href="../CongViecCaNhan/index.php"><i class="fas fa-calendar-alt"></i> Công Việc Cá Nhân</a></li>
                <li><a href="../ChucVu/index.php"><i class="fas fa-calendar-check"></i> Chức Vụ</a></li>
                <li><a href="../ThanhVien/index.php"><i class="fas fa-users"></i> Thành Viên</a></li>
                <li><a href="index.php"><i class="fas fa-handshake"></i> Dự Án Lớn</a></li>
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
                            <h2 class="m-0">Quản Lý Dự Án</h2>
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
                                                <label>Tên Dự Án :</label>
                                                <input type="text" class="form-control form-control-sm" required name="txtName">
                                            </div>
                                            <label>Loại Dự Án :</label>
                                            <div>
                                                <select id="loaida" name="loaida" class="custom-select mb-3" style="margin: 0px;">
                                                    <?php
                                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                                    if ($conn != true) {
                                                        die("connect error" . mysqli_connect_errno());
                                                    } else {
                                                        $sql = "select * from `loaida`";
                                                        $result = mysqli_query($conn, $sql);
                                                        if ($result) {
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                echo "<option >" . $row['TenDuAn'] . "</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <label>Tình Trạng :</label>
                                            <div>
                                                <select id="tinhtrang" name="tinhtrang" class="custom-select mb-3">
                                                    <option>Đang Tiến Hành</option>
                                                    <option>Hoàn Thành</option>
                                                    <option>Dời</option>
                                                    <option>Hủy</option>
                                                    <option>Bắt Đầu</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Ngày Bắt Đầu</label>
                                                <input type="date" class="form-control form-control-sm" autocomplete="off" required name="txtNgayBD" value="<?php $today= date("Y-m-d"); echo $today?>">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 0rem;">
                                                <label>Ngày Kết Thúc</label>
                                                <input type="date" class="form-control form-control-sm" autocomplete="off" required name="txtNgayKT" value="<?php $today= date("Y-m-d"); echo $today?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="card-footer border-top border-info">
                                        <div class="d-flex w-100 justify-content-center align-items-center">
                                            <!-- <button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-project" id="btnluu" name="btnluu">Save</button> -->
                                            <button type="submit" id="btnluu" name="btnluu" class="btn btn-flat  bg-gradient-primary mx-2" style="border-radius: 9px;border:2px solid #ff1e004d">Save</button>
                                            <a href="index.php" class="btn btn-flat  bg-gradient-primary mx-2" style="border-radius: 9px;border:2px solid #ff1e004d">Cancel</a>
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