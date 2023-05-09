<?php
session_start();
require_once('../Controllers/StudentDAO.php');
$studentDAO = new StudentDAO();

if (isset($_POST['edit_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $student = new Student();
    $student->setId($id);
    $student->setName($name);
    $student->setAge($age);
    $student->setGrade($grade);

    $update = $studentDAO->update($student);

    if ($update) {
        $_SESSION['success'] = 'Update student successfully';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Update student failed';
        header('Location: form_edit.php');
        exit();
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
                ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="d-inline-block">Edit student</h2>
                        <a href="index.php" class="btn btn-danger float-right">Back</a>
                    </div>
                    <div class="card-body">
                        <?php

                        $studentByID = new Student();
                        if (isset($_GET['id'])) {
                            $idStudent = $_GET['id'];
                            $studentByID = $studentDAO->read($idStudent);
                        }

                        ?>
                        <form action="form_edit.php" method="POST">
                            <input type="hidden" name="id" value="<?= $studentByID->getId() ?>">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?= $studentByID->getName() ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Age</label>
                                <input type="text" class="form-control" name="age" placeholder="Enter Age" value="<?= $studentByID->getAge() ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Grade</label>
                                <input type="text" class="form-control" name="grade" placeholder="Enter Grade" value="<?= $studentByID->getGrade() ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="edit_btn" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('layouts/assets/footer.php') ?>