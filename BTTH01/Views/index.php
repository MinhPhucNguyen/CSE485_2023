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
<<<<<<< HEAD
<<<<<<< HEAD
// if(isset($_POST['search'])){
//     $idStudent = $_POST['search'];
//     $search = $studentDAO->search($idStudent);
//     if($search){
//         $_SESSION['success']='Successful search';
//         header('Location: index.php');
//         exit();
//     }
//     else{
//         $_SESSION['error'] = 'Search failed';
//         header('Location: index.php');
//         exit();
//     }
// }

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
                            <a href="form_create.php" class="btn btn-success float-right">Create New Student</a>
                        </div>
                        <nav class="navbar bg-body-tertiary">
                        <div class="container-fluid">
                            <form class="d-flex" role="search" action="index.php" method="post">
                            <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        </nav>
                        <div class="card-body">
=======
?>

<?php include('layouts/assets/header.php') ?>

=======
?>

<?php include('layouts/assets/header.php') ?>

>>>>>>> 71c3981be0b51ba0597c09f5802d014e787e38fb
<div class="main">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['success'])) {
                ?>
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h2 class="d-inline-block">Student Management</h2>
                        <a href="form_create.php" class="btn btn-success float-end"><i class="fa-solid fa-plus" style="font-size: 14px;"></i> Create New Student </a>
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
<<<<<<< HEAD
>>>>>>> 71c3981be0b51ba0597c09f5802d014e787e38fb
=======
>>>>>>> 71c3981be0b51ba0597c09f5802d014e787e38fb
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
                                    if(isset($_POST['search'])){
                                        $studentDAO->search();
                                    
                                    }                                    
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