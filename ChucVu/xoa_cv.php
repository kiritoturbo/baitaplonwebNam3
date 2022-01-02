<?php
    $_ID = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
    if ($conn != true) {
        die("kết nối thất bại " . mysqli_connect_error());
    } else {
        $query = "DELETE FROM chucvu WHERE id = '$_ID'";
        $result = mysqli_query($conn, $query);
        if ($result >0) {
            header('location:index.php');
            } else {
            echo "Data is empty".mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>