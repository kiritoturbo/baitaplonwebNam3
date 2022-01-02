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
    <style type="text/css">
        .ckeck {
            display: none;
        }
    </style>
</head>

<body>
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
                            <h3 class="m-0">Thêm Thành Viên</h3>
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
                        <div class="card card-outline card-success" style="border-top: 3px solid rgb(48, 162, 48); border-radius: 5px;">
                            <div class="card-header">
                                <div class="row">
                                    <form method="post">
                                        <input type="text" name="txtSearch" style="width: 450px; margin-left:10px" placeholder="Tìm kiếm theo tên hoặc quê quán">
                                        <!-- <button type="submit" class="btnSearch" style="border-radius: 9px; margin-left:10px;border:2px solid #0159b2">Tìm Kiếm</button> -->
                                    </form>
                                    <div class="card-tools" style="margin-left:290px">
                                        <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="themtv.php"><i class="fa fa-plus"></i> Thêm Thành Viên</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px; text-align: center">STT</th>
                                        <th scope="col" style="text-align: center">Họ Tên</th>
                                        <th scope="col" style="text-align: center">Ngày Sinh</th>
                                        <th scope="col" style="text-align: center">Giới Tính</th>
                                        <th scope="col" style="text-align: center">Email</th>
                                        <th scope="col" style="text-align: center">Chức Vụ</th>
                                        <th scope="col" style="text-align: center">Quê Quán</th>
                                        <th scope="col" style="width: 100px; text-align: center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                    if ($conn != true) {
                                        die("connect error" . mysqli_connect_errno());
                                    } else {
                                        //----------------------------phân trang khi click--------------------------------
                                        $sql = mysqli_query($conn, "select * from `tt_thanhvien`");
                                        //b1:tính tổng các bản ghi
                                        $total = mysqli_num_rows($sql);
                                        $limit = 5;
                                        //tổng số trang
                                        $total_page = ceil($total / $limit);
                                        //lấy trang hiện tại
                                        $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $start = ($cr_page - 1) * $limit;
                                        $sql = "SELECT * FROM `tt_thanhvien` LIMIT $start,$limit";

                                        //----------------------------------Tìm Kiếm + Phân Trang -----------------------------
                                        if (isset($_POST['txtSearch']) && $_POST['txtSearch'] != '') {
                                            $KeyWord = $_POST['txtSearch'];
                                            $sql = mysqli_query($conn, "SELECT * FROM  tt_thanhvien WHERE HoTen LIKE N'%" . $KeyWord . "%' or QueQuan LIKE N'%" . $KeyWord . "%'");
                                            //b1:tính tổng các bản ghi
                                            $total = mysqli_num_rows($sql);
                                            $limit = 5;
                                            //tổng số trang
                                            $total_page = ceil($total / $limit);
                                            //lấy trang hiện tại
                                            $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start = ($cr_page - 1) * $limit;
                                            $sql = "SELECT * FROM tt_thanhvien WHERE HoTen LIKE N'%" . $KeyWord . "%' or QueQuan LIKE N'%" . $KeyWord . "%' LIMIT $start,$limit";
                                        } else {
                                            //----------------------------phân trang khi click--------------------------------
                                            $sql = mysqli_query($conn, "select * from `tt_thanhvien`");
                                            //b1:tính tổng các bản ghi
                                            $total = mysqli_num_rows($sql);
                                            $limit = 5;
                                            //tổng số trang
                                            $total_page = ceil($total / $limit);
                                            //lấy trang hiện tại
                                            $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start = ($cr_page - 1) * $limit;
                                            $sql = "SELECT * FROM `tt_thanhvien` LIMIT $start,$limit";
                                        }

                                        $result = mysqli_query($conn, $sql);
                                        if ($result) {
                                            $idtang = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $idtang++;
                                                $name = $row['HoTen'];
                                                //chuyển định dạnh ngày
                                                $ngaysinh = $row['NgaySinh'];
                                                $chuyenns = date('d-m-Y', strtotime($ngaysinh));
                                                $gioitinh = $row['GioiTinh'];
                                                $tenchucvu = $row['TenChucVu'];
                                                $email = $row['Email'];
                                                $quequan = $row['QueQuan'];
                                                echo '<tr>
                                                      <th scope="row" style="text-align: center">' . $idtang . '</th>
                                                      <td style="text-align: center">' . $name . '</td>
                                                      <td style="text-align: center">' . $chuyenns . '</td>
                                                      <td style="text-align: center">' . $gioitinh . '</td>
                                                      <td style="text-align: center">' . $email . '</td>
                                                      <td style="text-align: center">' . $tenchucvu . '</td>
                                                      <td style="text-align: center">' . $quequan . '</td>
                                                      <td style="text-align: center">
                                                            <button class = "btn btn-primary"><a href="suatv.php?id=' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></a></button>
						                                    <button class = "btn btn-danger" onclick="return Del();"><a href="xoatv.php?id=' . $row['id'] . '" ><i class="fas fa-trash-alt"></i></a></button>                                                      
                                                        </td>
                                                    </tr>';
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- trang  -->
                            <ul class="pagination justify-content-end" style="margin: 10px 20px;">
                                <li class="<?php echo (($cr_page - 1 == 0) ? 'ckeck' : '') ?>">
                                    <a class="page-link" href="index.php?page=<?php echo $cr_page - 1 ?>" aria-label="Previous">
                                        &laquo;
                                    </a>
                                </li>
                                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                                    <li class="<?php echo (($cr_page == $i) ? 'page-item active' : '') ?>" aria-current="page"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <li class="<?php echo (($cr_page == $total_page) ? 'ckeck' : '') ?>">
                                    <a class="page-link" href="index.php?page=<?php echo $cr_page + 1 ?>" aria-label="Next">
                                        &raquo;
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- hiển thị thông báo xóa -->
    <script>
        function Del() {
            return confirm("Bạn Có Muốn Xóa Không!");
        }
    </script>
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

        function deleteStudent() {
            option = confirm('Bạn có muốn xoá sinh viên này không')
            if (!option) {
                return;
            }

        }
    </script>

</body>

</html>