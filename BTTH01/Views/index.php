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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['success']);
                }
                ?>
                <div class="card">
                    <div class="card-header">
                        <a href="index.php" class="text-dark"><h2 class="d-inline-block">Student Management</h2></a>
                        <a href="form_create.php" class="btn btn-success float-end"><i class="fa-solid fa-plus" style="font-size: 14px;"></i> Create New Student </a>
                        <nav class="navbar bg-body-tertiary float-end">
                            <div class="container-fluid">
                                <form class="d-flex" role="search" action="index.php" method="post">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            </div>
                        </nav>
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
                                        <th>Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($_POST['search'])){
                                        $resulsearch = $studentDAO->search();
                                        ?>
                                        <tr>
                                            <td><?= $resulsearch[0] ?></td>
                                            <td><?= $resulsearch[1] ?></td>
                                            <td><?= $resulsearch[2] ?></td>
                                            <td><?= $resulsearch[3] ?></td>
                                            <td><img src="img/<?= $resulsearch[4]?>" alt="Image" height= '60px' width="60px"></td>
                                            <td>
                                                <a href="form_edit.php?id=<?= $resulsearch[0] ?>" class="btn btn-primary text-white">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i> Edit</a>
                                                <form action="index.php" class="d-inline-block" method="POST">
                                                    <button type="submit" value="<?= $resulsearch[0] ?>" name="delete_btn" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="font-size: 14px;"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    else{
                                    $students = $studentDAO->getAll();
                                    foreach ($students as $student) :
                                    ?>
                                        <tr>
                                            <td><?= $student->getId() ?></td>
                                            <td><?= $student->getName() ?></td>
                                            <td><?= $student->getAge() ?></td>
                                            <td><?= $student->getGrade() ?></td>
                                            <td><img src="img/<?= $student->getImg() ?>" alt="Image" height= '60px' width="60px"></td>
                                            <td>
                                                <a href="form_edit.php?id=<?= $student->getId() ?>" class="btn btn-primary text-white">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 14px;"></i> Edit</a>
                                                <form action="index.php" class="d-inline-block" method="POST">
                                                    <button type="submit" value="<?= $student->getId() ?>" name="delete_btn" class="btn btn-danger"><i class="fa-solid fa-trash-can" style="font-size: 14px;"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                        }
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