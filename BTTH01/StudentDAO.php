<?php
require_once '../CSE485_2023/BTTH01/Student.php';

class StudentDAO
{
    private $studentsList = array();
    public function create(Student $student)
    {
        $filename = '../students.csv';
        $file = fopen($filename, 'a');
        if ($file !== false) {
            $array = array($student->getId(), $student->getName(), $student->getAge(), $student->getGrade());
            fputcsv($file, $array);
            fclose($file);
            return true;
        }
        return false;
    }

    public function read()
    {
        $filename = '../students.csv';
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            if ($file) {
                fgetcsv($file); //bỏ qua hàng tiêu đề
                while (($row = fgetcsv($file)) !== false) {
                    $student = new Student();
                    $student->setId($row[0]);
                    $student->setName($row[1]);
                    $student->setAge($row[2]);
                    $student->setGrade($row[3]);
                    $this->studentsList[] = $student;
                }
            } else {
                echo "Unable to open file";
            }
            fclose($file);
        } else {
            echo "File not found";
        }
    }

    public function update(){
        $filename = '../students.csv';
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            if ($file) {
                fgetcsv($file); //bỏ qua hàng tiêu đề
            }}
    }

    public function delete(){

    }

    public function getAll()
    {
        $filename = '../students.csv';
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            if ($file) {
                fgetcsv($file); //bỏ qua hàng tiêu đề
                while (($row = fgetcsv($file)) !== false) {
                    $student = new Student();
                    $student->setId($row[0]);
                    $student->setName($row[1]);
                    $student->setAge($row[2]);
                    $student->setGrade($row[3]);
                    $this->studentsList[] = $student;
                }
            } else {
                echo "Unable to open file";
            }
            fclose($file);
        } else {
            echo "File not found";
        }
        return $this->studentsList;
    }
}
?>