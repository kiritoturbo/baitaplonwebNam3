<?php
$connect = new PDO('mysql:host=localhost;dbname=bt_qlcv', 'root', '');
$data = array();
$query = "SELECT * FROM congviec_cn ORDER BY id";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["TenCongViec"],
  'start'   => $row["NgayBatDau"],
  'end'   => $row["NgayKetThuc"],
  'backgroundColor'  => $row["MaMau"]
 );
}
echo json_encode($data);
?>

