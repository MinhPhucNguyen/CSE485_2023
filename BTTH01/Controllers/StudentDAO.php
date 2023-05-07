<?php
require_once '../Models/Student.php';

class StudentDAO
{
    private $studentsList = array();
    private $filename = '../students.csv';

    public function create(Student $student)
    {
        $file = fopen($this->filename, 'a');
        if ($file !== false) {
            $array = array($student->getId(), $student->getName(), $student->getAge(), $student->getGrade());
            fputcsv($file, $array);
            fclose($file);
            return true;
        }
        return false;
    }

    public function read($id)
    {
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            if ($file) {
                fgetcsv($file); //bỏ qua hàng tiêu đề
                while (($row = fgetcsv($file)) !== false) {
                    if ($row[0] == $id) {
                        $student = new Student();
                        $student->setId($row[0]);
                        $student->setName($row[1]);
                        $student->setAge($row[2]);
                        $student->setGrade($row[3]);
                    }
                }
            } else {
                echo "Unable to open file";
            }
            fclose($file);
        } else {
            echo "File not found";
        }
        return $student;
    }

    // public function update(Student $student){
    //     $data = [];
    //     $updated = false;
    //     if(file_exists($this->filename)){
    //         if(($file = fopen($this->filename, 'r')) !== false){
    //             while(($row = fgetcsv($file)) !== false){
    //                 if($row[0] == $student->getId()){
    //                     $data = array($student->getName(), $student->getAge(), $student->getGrade());
    //                     $update_into_file = fopen($this->filename, 'w');
    //                     foreach($data as $line){
    //                         fputcsv($update_into_file, $line);
    //                         $updated = true;
    //                     }
    //                     return true;
    //                 }
    //                 return false;
    //             }
    //         }
    //         else
    //         {
    //             echo 'Unable to open file';
    //         }
    //     }
    //     else
    //     {
    //         echo 'File not found';
    //     }
    // }

    public function delete($id){
        $deleted = false;

        if(file_exists($this->filename)){
            $file = fopen($this->filename, 'r');
            if($file !== false){
                fgetcsv($file);
                while(($row = fgetcsv($file))){
                    if($row[0] == $id){
                        $deleted = true;
                    }
                }
            }
        }
        else{
            echo 'File not found';
        }
    }

    public function getAll()
    {
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
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
