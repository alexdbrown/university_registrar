<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Student.php";
    // require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_framework_testCase
    {
        // protected function tearDown()
        // {
        //     Student::deleteAll();
        //     Course::deleteAll();
        // }

        function test_setName()
        {
            //Arrange
            $name = "Tom Jackson";
            $test_student = new Student($name);

            //Act
            $test_student->setName("Jim Jackson");
            $result = $test_student->setName();

            //Assert
            $this->assertEquals("Jim Jackson", $result);
        }

        function test_setEnrollmentDate()
        {
            //Arrange
            $name = "Tom Jackson";
            $enrollment_date = "2016-08-18"
            $test_student = new Student($name, $enrollment_date);

            //Act
            $test_student->setEnrollmentDate("2017-01-04");
            $result = $test_student->getEnrollmentDate();

            //Assert
            $this->assertEquals("2017-01-04", $result);
        }

        function test_getName()
        {
            //Arrange
            $name = "Sandra O'Maley";
            $test_student = new Student($name);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function test_getEnrollmentDate()
        {
            //Arrange
            $name = "Sandra O'Maley";
            $enrollment_date = "2015-06-21";
            $test_student = new Student($name);

            //Act
            $result = $test_student->getEnrollmentDate();

            //Assert
            $this->assertEquals($enrollment_date, $result);
        }

        function test_getId()
        {
            
        }
    }
 ?>
