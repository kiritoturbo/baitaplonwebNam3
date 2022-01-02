<?php
    $_ID = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
    if ($conn != true) {
        die("kết nối thất bại " . mysqli_connect_error());
    } else {
        $query = "DELETE FROM congviec_cn WHERE id = '$_ID'";
        $result = mysqli_query($conn, $query);
        if ($result >0) {
             echo "<script type ='text/javascript'>";
             echo "alert('xóa thành công');";
             echo "window.location.href='index.php'";
             echo "</script>";
            } else {
            echo "Data is empty".mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>