<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config.php";

$error_message = '';
$success_message = '';
$ccode = $cname = $duration = $credits = $instructors = $outline = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {     
    $ccode = trim($_POST['ccode'] ?? '');
    $cname = trim($_POST['cname'] ?? '');
    $duration = trim($_POST['duration'] ?? '');
    $credits = trim($_POST['credits'] ?? '');
    $instructors = trim($_POST['instructors'] ?? '');
    $outline = trim($_POST['outline'] ?? '');
    
    error_log("Form data received: " . print_r($_POST, true));
    
    if (empty($ccode) || empty($cname) || empty($duration) || empty($credits)) {
        $error_message = "Vui lòng điền đầy đủ các trường bắt buộc.";
    } elseif (!is_numeric($duration) || !is_numeric($credits)) {
        $error_message = "Thời lượng và số tín chỉ phải là số.";
    } else {
        try {
            $sql = "INSERT INTO courses (ccode, cname, duration, credits, instructors, outline) VALUES (?, ?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssiiss", $ccode, $cname, $duration, $credits, $instructors, $outline);
                
                if ($stmt->execute()) {
                    $success_message = "Thêm khóa học thành công! Đang chuyển hướng...";
                    $ccode = $cname = $duration = $credits = $instructors = $outline = '';
                    header("refresh:2;url=courses.php");
                    exit();
                } else {
                    throw new Exception("Lỗi khi thực thi truy vấn: " . $stmt->error);
                }
                
                $stmt->close();
            } else {
                throw new Exception("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            error_log($error_message);
        }
    }
    
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Add New Course</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .form-group textarea { height: 100px; resize: vertical; }
        .form-group .submit-btn { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        .form-group .submit-btn:hover { background-color: #45a049; }
        .error-message { color: red; margin-bottom: 15px; padding: 10px; background-color: #ffebee; border-radius: 4px; }
        .back-link { display: inline-block; margin-top: 15px; color: #2196F3; text-decoration: none; }
        .back-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add a New Course</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <?php if (!empty($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="ccode">Course Code:</label>
                <input type="text" id="ccode" name="ccode" value="<?php echo htmlspecialchars($ccode); ?>" required>
            </div>
            <div class="form-group">
                <label for="cname">Course Name:</label>
                <input type="text" id="cname" name="cname" value="<?php echo htmlspecialchars($cname); ?>" required>
            </div>
            <div class="form-group">
                <label for="duration">Duration (hours):</label>
                <input type="number" id="duration" name="duration" value="<?php echo htmlspecialchars($duration); ?>" required>
            </div>
            <div class="form-group">
                <label for="credits">Credits:</label>
                <input type="number" id="credits" name="credits" value="<?php echo htmlspecialchars($credits); ?>" required>
            </div>
            <div class="form-group">
                <label for="instructors">Instructors:</label>
                <input type="text" id="instructors" name="instructors" value="<?php echo htmlspecialchars($instructors); ?>">
            </div>
            <div class="form-group">
                <label for="outline">Outline:</label>
                <textarea id="outline" name="outline"><?php echo htmlspecialchars($outline); ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Course" class="submit-btn">
                <a href="courses.php" class="back-link">← Back to Courses List</a>
            </div>
        </form>
    </div>

</body>
</html>
