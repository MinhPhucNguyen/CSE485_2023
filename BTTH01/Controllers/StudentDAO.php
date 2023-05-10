<?php
require_once '../Models/Student.php';




class StudentDAO
{
    private $studentsList = array();
    private $filename = '../students.csv';

    public function search(){
        $searchTerm = $_POST['search'];
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            fgetcsv($file);
            while (($row = fgetcsv($file)) !== false) {
                if(strpos($row[0],$searchTerm) !== false){
                    echo "<p>" . $row[0] . " - " . $row[1] . "</p>";
                }
            }fclose($file);
    }
    }

    public function checkID($id)
    {
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            while (($row = fgetcsv($file)) !== false) {
                if ($row[0] == $id) {
                    return true;
                }
            }
        }
        return false;
    }



    public function create(Student $student)
    {
        if ($this->checkID($student->getId())) {
            $_SESSION['checkID'] = "ID already exists, Please enter a different ID";
            return false;
        }
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'a');
            if ($file !== false) {
                $array = array($student->getId(), $student->getName(), $student->getAge(), $student->getGrade(), $student->getImg());
                fputcsv($file, $array);
                fclose($file);
                return true;
            }
        } else {
            echo 'File not found';
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

    public function update(Student $student)
    {
        $data = array();
        $updated = false;

        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            if ($file !== false) {
                while (($row = fgetcsv($file)) !== false) {
                    if ($row[0] == $student->getId()) {
                        $data[] = array($student->getId(), $student->getName(), $student->getAge(), $student->getGrade());
                        $updated = true;
                    } else {
                        $data[] = $row;
                    }
                }
            }

            if ($updated && ($file_update = fopen($this->filename, 'w')) !== false) {
                foreach ($data as $line) {
                    fputcsv($file_update, $line);
                }
                fclose($file_update);
                return true;
            }
        } else {
            echo 'File not found';
        }
        return false;
    }

    public function delete($id)
    {
        $data = array();
        $deleted = false;

        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            if ($file !== false) {
                while (($row = fgetcsv($file))) {
                    if ($row[0] == $id) {
                        $deleted = true;
                        continue;
                    } else {
                        $data[] = $row;
                    }
                }
            }

            if ($deleted && ($file = fopen($this->filename, 'w')) !== false) {
                foreach ($data as $line) {
                    fputcsv($file, $line);
                }
                fclose($file);
                return true;
            }
        } else {
            echo 'File not found';
        }
        return false;
    }

    public function getAll()
    {
        if (file_exists($this->filename)) {
            $file = fopen($this->filename, 'r');
            if ($file) {
                fgetcsv($file); 
                while (($row = fgetcsv($file)) !== false) {
                    $student = new Student();
                    $student->setId($row[0]);
                    $student->setName($row[1]);
                    $student->setAge($row[2]);
                    $student->setGrade($row[3]);
                    $student->setImg($row[4]);
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
