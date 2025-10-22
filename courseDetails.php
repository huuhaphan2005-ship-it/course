<?php
require_once "config.php";

$course = null;
$error_message = ""; 

if (isset($_GET['code']) && !empty(trim($_GET['code']))) {
    
    $ccode = trim($_GET['code']);

    $sql = "SELECT ccode, cname, credits, duration, instructors, outline FROM courses WHERE ccode = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $ccode);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows == 1) {
                $course = $result->fetch_assoc();
            } else {
                $error_message = "Không tìm thấy môn học với mã này.";
            }
        } else {
            $error_message = "Lỗi khi thực thi truy vấn.";
        }
        
        $stmt->close();
    } else {
        $error_message = "Lỗi khi chuẩn bị truy vấn.";
    }
} else {
    $error_message = "Yêu cầu không hợp lệ. Không có mã môn học nào được cung cấp.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Course Details</title>
</head>
<body>

    <h2>Course Detail</h2>

    <?php if ($course): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <td><strong>Code</strong></td>
                <td><?php echo htmlspecialchars($course['ccode']); ?></td>
            </tr>
            <tr>
                <td><strong>Name</strong></td>
                <td><?php echo htmlspecialchars($course['cname']); ?></td>
            </tr>
            <tr>
                <td><strong>Credits</strong></td>
                <td><?php echo htmlspecialchars($course['credits']); ?></td>
            </tr>
            <tr>
                <td><strong>Duration</strong></td>
                <td><?php echo htmlspecialchars($course['duration']); ?> giờ</td>
            </tr>
            <tr>
                <td><strong>Instructors</strong></td>
                <td><?php echo htmlspecialchars($course['instructors']); ?></td>
            </tr>
            <tr>
                <td><strong>Outline</strong></td>
                <td><?php echo nl2br(htmlspecialchars($course['outline'])); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <br>
    <a href="courses.php">Back to Courses List</a>

</body>
</html>

