<?php
//thục hiện xóa
$_ID = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "bt_qlcv");
if ($conn != true) {
    die("kết nối thất bại " . mysqli_connect_error());
} else {
    $sql = "SELECT * FROM pc_congviec_dal WHERE id='" . $_GET['id'] . "' ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idtrave = $row['idDuAn'];
                // echo $idtrave;
            }
        }else {
            echo "Data is empty".mysqli_error($conn);
        }
    $query = "DELETE FROM pc_congviec_dal WHERE id = '$_ID'";
    $result = mysqli_query($conn, $query);
    if ($result >0) {
        // echo "<script type ='text/javascript'>";
        // echo "alert('xóa thành công');";
        // echo "window.location.href='index.php'";
        // echo "</script>";
        header('location:index.php?id='.$idtrave.'');
       } else {
       echo "Data is empty".mysqli_error($conn);
   }
}
mysqli_close($conn);
