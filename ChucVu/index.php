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
    <link rel="stylesheet" href="styleCV.css">
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
                <h3>Quản lý Chức Vụ</h3>
            </div>
            <ul class="list-unstyled components" style="margin-bottom: 0px; padding: 0px">
                <li><a href="../BangDieuKhien/index.php"><i class="fas fa-home"></i> Bảng Điều Khiển</a></li>
                <li><a href="../LoaiCongViec/index.php"><i class="fas fa-tasks"></i> Loại Công Việc</a></li>
                <li><a href="../LoaiDuAn/index.php"><i class="fas fa-project-diagram"></i> Loại Dự Án</a></li>
                <li><a href="../CongViecCaNhan/index.php"><i class="fas fa-calendar-alt"></i> Công Việc Cá Nhân</a></li>
                <li><a href="index.php"><i class="fas fa-calendar-check"></i> Chức Vụ</a></li>
                <li><a href="../ThanhVien/index.php"><i class="fas fa-users"></i> Thành Viên</a></li>
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
                            <h3 class="m-0">Quản lý Chức Vụ</h3>
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
                                <!-- form tìm kiếm  -->
                                <div class="row">
                                    <form method="post">
                                        <input type="text" name="txtSearch" style="width: 450px; margin-left:10px" placeholder="Tìm Kiếm Theo Tên Chức Vụ">
                                    </form>
                                    <!-- button thêm -->
                                    <div class="card-tools" style="margin-left:300px">
                                        <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="them_cv.php"><i class="fa fa-plus"></i> Thêm Chức Vụ</a>
                                    </div>
                                </div>
                            </div>
                            <table class="table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px; text-align: center">STT</th>
                                        <th scope="col" style="text-align: center">Tên Chức Vụ</th>
                                        <th scope="col" style="width: 120px; text-align: center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
                                    if ($conn != true) {
                                        die("connect error" . mysqli_connect_errno());
                                    } else {
                                        //----------------------------phân trang khi click--------------------------------
                                        $sql = mysqli_query($conn, "select * from `chucvu`");
                                        //b1:tính tổng các bản ghi
                                        $total = mysqli_num_rows($sql);
                                        $limit = 5;
                                        //tổng số trang
                                        $total_page = ceil($total / $limit);
                                        //lấy trang hiện tại
                                        $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                        $start = ($cr_page - 1) * $limit;
                                        $sql = "SELECT * FROM `chucvu` LIMIT $start,$limit";

                                        //----------------------------------Tìm Kiếm + Phân Trang -----------------------------
                                        if (isset($_POST['txtSearch']) && $_POST['txtSearch'] != '') {
                                            $KeyWord = $_POST['txtSearch'];
                                            $sql = mysqli_query($conn, "SELECT * FROM  chucvu WHERE TenChucVu LIKE N'%" . $KeyWord . "%' ");
                                            //b1:tính tổng các bản ghi
                                            $total = mysqli_num_rows($sql);
                                            $limit = 5;
                                            //tổng số trang
                                            $total_page = ceil($total / $limit);
                                            //lấy trang hiện tại
                                            $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start = ($cr_page - 1) * $limit;
                                            $sql = "SELECT * FROM chucvu WHERE TenChucVu LIKE N'%" . $KeyWord . "%' LIMIT $start,$limit";
                                        } else {
                                            //----------------------------phân trang khi click--------------------------------
                                            $sql = mysqli_query($conn, "select * from `chucvu`");
                                            //b1:tính tổng các bản ghi
                                            $total = mysqli_num_rows($sql);
                                            $limit = 5;
                                            //tổng số trang
                                            $total_page = ceil($total / $limit);
                                            //lấy trang hiện tại
                                            $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                            $start = ($cr_page - 1) * $limit;
                                            $sql = "SELECT * FROM `chucvu` LIMIT $start,$limit";
                                        }

                                        // thực hiện câu truy vấn
                                        $result = mysqli_query($conn, $sql);
                                        $idtang = 0;
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $idtang++;
                                                $id = $row['id'];
                                                $tencv = $row['TenChucVu'];
                                                echo '<tr>
                                                      <th scope="row" style="text-align: center">' . $idtang . '</th>
                                                      <td style="text-align: center">' . $tencv . '</td>
                                                      <td style="text-align: center">
                                                            <button class = "btn btn-primary"><a href="sua_cv.php?id=' . $row['id'] . '"><i class="fas fa-pencil-alt"></i></a></button>
                                                            <button class = "btn btn-danger"><a href="xoa_cv.php?id=' . $row['id'] . '" onclick="return Del();" ><i class="fas fa-trash-alt"></i></a></button>
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
    </script>
</body>

</html>