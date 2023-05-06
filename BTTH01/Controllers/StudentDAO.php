<?php 
    class StudentDAO{

        public function create(Student $student){
            
        }
        public function getAll(){
            $studentsList = array(); //Tạo mảng chứa sinh viên
            $file_path =  __DIR__ . '\students.csv';
            if(($file = fopen($file_path, 'r')) !== false){
                while(($row = fgetcsv($file)) !== false){
                    $student = new Student();
                    $student->setId($row[0]);  
                    $student->setName($row[1]);
                    $student->setAge($row[2]);  
                    $student->setGrade($row[3]);    
                
                    $studentsList[]  = $student;
                }
                fclose($file);
            }
            else{
                echo "File does not exists!";
            }
            
            return $studentsList;
        }
    }
?>