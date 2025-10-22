<?php
require_once "config.php";

$sql = "SELECT ccode, cname, credits, duration, instructors, outline FROM courses";

$result = $conn->query($sql);

if ($result) {
    $courses = $result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Lỗi: " . $conn->error;
    $courses = [];
}
$conn->close();

echo "<h2>Danh sách khóa học từ CSDL</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Credits</th>
                <th>Instructors</th>
                <th>Outlines</th>
            </tr>
        </thead>
        <tbody>";

foreach ($courses as $row) {
    echo "<tr>
            <td><a href='courseDetails.php?code=" . htmlspecialchars($row['ccode']) . "'>" . htmlspecialchars($row['ccode']) . "</a></td>
            <td>" . htmlspecialchars($row['cname']) . "</td>
            <td>" . htmlspecialchars($row['duration']) . "</td>
            <td>" . htmlspecialchars($row['credits']) . "</td>
            <td>" . htmlspecialchars($row['instructors']) . "</td>
            <td>" . htmlspecialchars($row['outline']) . "</td>
          </tr>";
}

echo "</tbody></table>";

echo "<br>";
echo "<a href='add_courses.php'>Add new course</a>";
?>

