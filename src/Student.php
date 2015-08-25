<?php
    class Student
    {
        private $name;
        private $enrollment_date;
        private $id;

        function __construct($name, $enrollment_date, $id = null)
        {
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setEnrollmentDate($new_enrollment_date)
        {
            $this->enrollment_date = $new_enrollment_date;
        }

        function getName()
        {
            return $this->name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date)
            VALUES ('{$this->getName()}', '{$this->getEnrollmentDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO enrollment (student_id, course_id) VALUES ({$this->getId()}, {$course->getId()});");
        }

        function getCourses()
        {
            $query = $GLOBALS['DB']->query("SELECT course_id FROM enrollment WHERE student_id = {$this->getId()};");
            $course_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $courses = array();
            foreach($course_ids as $id) {
                $course_id = $id['course_id'];
                $course_query = $GLOBALS['DB']->query("SELECT * FROM courses WHERE id = {$course_id};");
                $returned_course = $course_query->fetchAll(PDO::FETCH_ASSOC);

                $course_name = $returned_course[0]['name'];
                $course_number = $returned_course[0]['course_number'];
                $id = $returned_course[0]['id'];
                $new_course = new Course($course_name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach ($returned_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach ($students as $student) {
                $student_id = $student->getId();
                if($student_id == $search_id) {
                    $found_student = $student;
                }
                return $found_student;
            }
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        // function delete()
        // {
        //     $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        //     $GLOBALS['DB']->exec("DELETE FROM enrollment WHERE student_id = {$this->getId()};");
        // }

    }



 ?>
