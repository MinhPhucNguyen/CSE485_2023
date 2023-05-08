<?php
session_start();
require_once('../Controllers/StudentDAO.php');
$studentDAO = new StudentDAO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $student = new Student();
    $student->setId($id);
    $student->setName($name);
    $student->setAge($age);
    $student->setGrade($grade);

    $result = $studentDAO->create($student);
    if ($result) {
        $_SESSION['success'] = 'Create student successfully';
        header('Location: index.php');
        exit();
    } else {
        if (isset($_SESSION['checkID'])) {
            header('Location: form_create.php');
            exit();
        }
    }
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

    <div class="main">
        <div class="container-fluid">
            <div class="row justify-content-center mt-4">
                <div class="col-md-5">
                    <?php
                    if (isset($_SESSION['error'])) {
                    ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                    <?php
                        unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['checkID'])) {
                        ?>
                            <div class="alert alert-danger"><?= $_SESSION['checkID'] ?></div>
                        <?php
                            unset($_SESSION['error']);
                        }
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h2 class="d-inline-block">Create new student</h2>
                            <a href="index.php" class="btn btn-danger float-right">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="form_create.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="">ID</label>
                                    <input type="text" class="form-control" name="id" placeholder="Enter ID" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Age</label>
                                    <input type="text" class="form-control" name="age" placeholder="Enter Age" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Grade</label>
                                    <input type="text" class="form-control" name="grade" placeholder="Enter Grade" required>
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" name="create_btn" class="btn btn-success">Create student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>