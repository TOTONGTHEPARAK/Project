<?php
ob_start(); // เริ่ม output buffering

include "connect.php";

$idemp = $_GET["emp_Id"];
$stmt = $pdo->prepare("SELECT * FROM employee");
$stmt->execute();
$i = 0;

while ($row = $stmt->fetch()) :
?>
    <?= $row["emp_Id"] ?><?= $row["emp_Name"] ?><br>
<?php
    $i++;
endwhile;

echo $i;
echo $idemp;

$found = false;
$stmt->execute();

while ($row = $stmt->fetch()) {
    if ($idemp == $row["emp_Id"]) {
        setcookie("empid", $idemp, time() + 3600 * 24);
        $found = true;
        break;
    }
}

if ($found) {
    header("Location: frist.php");
}

ob_end_flush(); // สิ้นสุด output buffering และส่งข้อมูลไปยังเบราวเซอร์
?>
