<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sinh viên</title>
</head>

<body>
    <h1>Danh sách sinh viên</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Grade</th>
        </tr>

        <?php
        $filename = 'students.csv';
        $file = fopen($filename, 'r');

        while (($line = fgetcsv($file)) !== FALSE) {
            echo "<tr>";

            foreach ($line as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }

            echo "</tr>";
        }

        fclose($file);
        ?>
    </table>
</body>

</html>

<h2>Thêm sinh viên mới</h2>

<form method="post">
    ID: <input type="text" name="id"><br>
    Name: <input type="text" name="name"><br>
    Age: <input type="text" name="age"><br>
    Grade: <input type="text" name="grade"><br>
    <input type="submit" name="submit" value="Thêm">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $data = array($id, $name, $age, $grade);
    $filename = 'students.csv';

    $file = fopen($filename, 'a');
    fputcsv($file, $data);
    fclose($file);

    header('Location: index.php');
    exit;
}
?>