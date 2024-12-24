<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test5";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// เช็คการเชื่อมต่อ
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// ดึงข้อมูลคู่มือจากฐานข้อมูล
$sql = "SELECT * FROM Manuals WHERE ManualID = 1"; // สมมุติว่าเราเลือกคู่มือที่มี ManualID = 1
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ดึงข้อมูล
    $manual = $result->fetch_assoc();
    echo json_encode([
        "content" => $manual["Description"]
    ]);
} else {
    echo json_encode(["error" => "Manual not found"]);
}

$conn->close();
?>
