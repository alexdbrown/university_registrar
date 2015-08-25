<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    //require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=university_registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            //Student::deleteAll();
            Course::deleteAll();
        }

        function test_setName()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $test_course = new Course($name, $course_number);

            //Act
            $test_course->setName("English");
            $result = $test_course->getName();

            //Assert
            $this->assertEquals("English", $result);
        }

        function test_setCourseNumber()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $test_course = new Course($name, $course_number);

            //Act
            $test_course->setCourseNumber("ENG500");
            $result = $test_course->getCourseNumber();

            //Assert
            $this->assertEquals("ENG500", $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $test_course = new Course($name, $course_number);

            //Act
            $result = $test_course->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getCourseNumber()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $test_course = new Course($name, $course_number);

            //Act
            $result = $test_course->getCourseNumber();

            //Assert
            $this->assertEquals($course_number, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $id = 1;
            $test_course = new Course($name, $course_number, $id);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function save()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $test_course = new Course($name, $course_number);

            //Act
            $test_course->save();

            //Assert
            $result = Course::getAll();
            $this->assertEquals($test_course, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $name2 = "English";
            $course_number2 = "ENG500";
            $test_course = new Course($name, $course_number);
            $test_course->save();
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "History";
            $course_number = "HIST101";
            $name2 = "English";
            $course_number2 = "ENG500";
            $test_course = new Course($name, $course_number);
            $test_course->save();
            $test_course2 = new Course($name2, $course_number2);
            $test_course2->save();

            //Act
            Course::deleteAll();

            //Assert
            $result = Course::getAll();
            $this->assertEquals([], $result);
        }


    }



 ?>
