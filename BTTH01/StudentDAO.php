<?php
class StudentDAO {
    private $studentList = array();

    public function create(Student $student){
        $this->studentList[] = $student;
    }
    public function read(string $path){
        $file = fopen($path , 'r');

        if(!$file){
            echo 'File not found';
            die;
        }else{
            global $studentList;
            while (($data = fgetcsv($file)) !== false){
                $student = new Student();
                $student->setId($data[0]);
                $student->setName($data[1]);
                $student->setAge($data[2]);
                $student->setGrade($data[3]);
                $studentList = $student;
            }
            fclose($file);
        }
      
    }
    public function update(int $index ,Student $student){
        $this->studentList[$index] = $student;
    }
    public function delete(int $index){
        unset($this->studentList[$index]);
    }

    public function getAll(){
        
        for($i = 0 ; $i < count($this->studentList) - 1 ; $i++){
            echo $this->studentList[$i].'<br>';
        } 
    }
}
