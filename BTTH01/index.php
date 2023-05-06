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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Student Management</title>
</head>

<body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>