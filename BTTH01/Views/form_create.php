<?php
session_start();
require_once('../Controllers/StudentDAO.php');
$studentDAO = new StudentDAO();

$student = array('id' => '', 'name' => '', 'age' => '', 'grade' => '');
$errors  = array('id' => '', 'name' => '', 'age' => '', 'grade' => '');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $grade = $_POST['grade'];

    $validate_input['id']['filter']                = FILTER_VALIDATE_INT;
    $validate_input['name']['filter']              = FILTER_VALIDATE_REGEXP;
    $validate_input['name']['options']['regexp']   = '/^[A-z]{2,10}$/';
    $validate_input['age']['filter']               = FILTER_VALIDATE_INT;
    $validate_input['age']['options']['min_range'] = 1;
    $validate_input['age']['options']['max_range'] = 50;
    $validate_input['grade']['filter']               = FILTER_VALIDATE_INT;
    $validate_input['grade']['options']['min_range'] = 1;
    $validate_input['grade']['options']['max_range'] = 50;

    $student = filter_input_array(INPUT_POST, $validate_input);

    // echo '<pre>';
    // var_dump(filter_input_array(INPUT_POST, $validate_inputs));
    // echo '</pre>';

    $errors['id'] = empty(trim($id)) ? '*ID is required' : ($student['id'] ? '' : '*ID must be a number');
    $errors['name'] =  empty(trim($name)) ? '*Name is required' : ($student['name'] ? '' : '*Name is invalid');
    $errors['age'] =  empty(trim($age)) ? '*Age is required' : ($student['age'] ? '' : '*Age is invalid');
    $errors['grade'] =  empty(trim($grade)) ? '*Grade is required' : ($student['grade'] ? '' : '*Grade is invalid');

    if (implode($errors)) { //nối trong mảng thành các chuỗi duy nhất
        $_SESSION['error'] = 'The information you entered is invalid. Please check and enter again.';
    }
    else {
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
                                <small class="text-danger"><?= $errors['id'] ?></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                <small class="text-danger"><?= $errors['name'] ?></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Age</label>
                                <input type="text" class="form-control" name="age" placeholder="Enter Age">
                                <small class="text-danger"><?= $errors['age'] ?></small>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Grade</label>
                                <input type="text" class="form-control" name="grade" placeholder="Enter Grade">
                                <small class="text-danger"><?= $errors['grade'] ?></small>
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