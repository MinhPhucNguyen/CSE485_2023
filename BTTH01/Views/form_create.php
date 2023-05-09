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
        } else {
            $_SESSION['error'] = 'Create student failed';
            header('Location: form_create.php');
            exit();
        }
    }
}

?>

<?php include('layouts/assets/header.php') ?>

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
                    unset($_SESSION['checkID']);
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
                                <input type="text" class="form-control" name="id" placeholder="Enter ID">
                                
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Age</label>
                                <input type="text" class="form-control" name="age" placeholder="Enter Age">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Grade</label>
                                <input type="text" class="form-control" name="grade" placeholder="Enter Grade">
                            </div>
                            <div class="form-group mb-3 mt-3 d-inline-block">
                                <button type="submit" name="create_btn" class="btn btn-success">Create student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('layouts/assets/footer.php') ?>