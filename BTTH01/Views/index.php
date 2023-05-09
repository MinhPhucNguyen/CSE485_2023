<?php
session_start();
require_once('../Controllers/StudentDAO.php');
$studentDAO = new StudentDAO();

if (isset($_POST['delete_btn'])) {
    $idStudent = $_POST['delete_btn'];
    $deleted = $studentDAO->delete($idStudent);
    if ($deleted) {
        $_SESSION['success'] = 'Delete student successfully';
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error'] = 'Delete student failed';
        header('Location: index.php');
        exit();
    }
}
?>

<?php include('layouts/assets/header.php') ?>

<div class="main">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['success'])) {
                ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success'] ?>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="d-inline-block">Student Management</h2>
                        <a href="form_create.php" class="btn btn-success float-right"><i class="fa-solid fa-plus" style="font-size: 14px;"></i> Create new Student </a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (filesize('../students.csv') == 18) {
                        ?>
                            <div class="text-center">
                                <h4 class="text-warning">No Student Found</h4>
                            </div>
                        <?php
                        } else {
                        ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Grade</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $students = $studentDAO->getAll();
                                    foreach ($students as $student) :
                                    ?>
                                        <tr>
                                            <td><?= $student->getId() ?></td>
                                            <td><?= $student->getName() ?></td>
                                            <td><?= $student->getAge() ?></td>
                                            <td><?= $student->getGrade() ?></td>
                                            <td>
                                                <a href="form_edit.php?id=<?= $student->getId() ?>" class="btn btn-primary">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i> Edit</a>
                                                <form action="index.php" class="d-inline-block" method="POST">
                                                    <button type="submit" value="<?= $student->getId() ?>" name="delete_btn" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="font-size: 14px;"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('layouts/assets/footer.php') ?>