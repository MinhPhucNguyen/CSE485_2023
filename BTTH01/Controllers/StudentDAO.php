<?php class StudentDAO
{
    public function getAll()
    {
        $studentsList = array();

        $filename = 'students.csv';
        if (file_exists($filename)) {
            $file = fopen($filename, 'r');
            while (($row = fgetcsv($file)) !== false) {
                $student = new Student();
                $student->setId($row[0]);
                $student->setName($row[1]);
                $student->setAge($row[2]);
                $student->setGrade($row[3]);

                $studentsList[] = $student;
            }
            fclose($file);
        } else {
            echo "File does not exists!";
        }

        return $studentsList;
    }
}
