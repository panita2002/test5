<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test5";

// รับข้อมูลที่ส่งมาจาก JavaScript
$data = json_decode(file_get_contents("php://input"));

if (isset($data->content)) {
    $content = $data->content;

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // เช็คการเชื่อมต่อ
    if ($conn->connect_error) {
        die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
    }

    // อัปเดตข้อมูลคู่มือในฐานข้อมูล
    $sql = "UPDATE Manuals SET Description = ? WHERE ManualID = 1"; // อัปเดตคู่มือที่มี ManualID = 1
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $content); // binding content parameter

    if ($stmt->execute()) {
        echo json_encode(["message" => "Content saved successfully"]);
    } else {
        echo json_encode(["error" => "Error saving content"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "No content provided"]);
}
?>
