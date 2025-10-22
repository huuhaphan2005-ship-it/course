<?php
require_once "config.php";

$ccode = $cname = $duration = $credits = $instructors = $outline = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ccode = trim($_POST["ccode"]);
    $cname = trim($_POST["cname"]);
    $duration = trim($_POST["duration"]);
    $credits = trim($_POST["credits"]);
    $instructors = trim($_POST["instructors"] ?? '');
    $outline = trim($_POST["outline"] ?? '');

    if (empty($ccode) || empty($cname) || empty($duration) || empty($credits)) {
        $error_message = "Vui lòng điền đầy đủ các trường bắt buộc.";
    } else {
        $sql = "INSERT INTO courses (ccode, cname, duration, credits, instructors, outline) VALUES (?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {      
            $stmt->bind_param("ssiiss", $ccode, $cname, $duration, $credits, $instructors, $outline);
            
            if ($stmt->execute()) {
                header("location: courses.php");
                exit();
            } else {
                $error_message = "Đã xảy ra lỗi. Vui lòng thử lại sau.";
            }
            
            $stmt->close();
        } else {
            $error_message = "Lỗi khi chuẩn bị câu lệnh SQL.";
        }
    }
    
    $conn->close();
    
    if (!empty($error_message)) {
        header("location: add_courses.php?error=" . urlencode($error_message));
        exit();
    }
} else {
    header("location: add_courses.php");
    exit();
}
?>
