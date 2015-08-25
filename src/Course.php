<?php
    class Course
    {
        private $name;
        private $course_number;
        private $id;

        function __construct($name, $course_number, $id = null)

        {
            $this->name = $name;
            $this->course_number = $course_number;
            $this->id = $id;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function setCourseNumber($new_course_number)
        {
            $this->course_number = $new_course_number;
        }

        function getName()
        {
            return $this->name;
        }

        function getCourseNumber()
        {
            return $this->course_number;
        }

        function getId()
        {
            return $this->id;
        }

        function addStudent($new_student)
        {
            $GLOBALS['DB']->exec("INSERT INTO enrollment (student_id, course_id) VALUES ({$new_student->getId()}, {$this->getId()});");
        }

        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT student_id FROM enrollment
            WHERE course_id = {$this->getId()};");
            $student_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $students = array();
            foreach($student_ids as $id) {
                $student_id = $id['student_id'];
                $student_query = $GLOBALS['DB']->query("SELECT * FROM students WHERE id = {$student_id};");
                $returned_student = $student_query->fetchAll(PDO::FETCH_ASSOC);

                $name = $returned_student[0]['name'];
                $enrollment_date = $returned_student[0]['enrollment_date'];
                $id = $returned_student[0]['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }

            return $students;
        }
        function save()
        {
            $GLOBALS['DB']->EXEC("INSERT INTO courses (name, course_number) VALUES ('{$this->getName()}', '{$this->getCourseNumber()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach ($returned_courses as $course) {
                $name = $course['name'];
                $course_number = $course['course_number'];
                $id = $course['id'];
                $new_course = new Course($name, $course_number, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach ($courses as $course) {
                $course_id = $course->getId();
                if($course_id == $search_id) {
                    $found_course = $course;
                }
                return $found_course;
            }
        }






    }

 ?>
