<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Student.php";
    // require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=university_registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            //Course::deleteAll();
        }

        function test_setName()
        {
            //Arrange
            $name = "Tom Jackson";
            $enrollment_date = "2016-08-18";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $test_student->setName("Jim Jackson");
            $result = $test_student->getName();

            //Assert
            $this->assertEquals("Jim Jackson", $result);
        }

        function test_setEnrollmentDate()
        {
            //Arrange
            $name = "Tom Jackson";
            $enrollment_date = "2016-08-18";
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
            $name = "Sandra Maley";
            $enrollment_date = "2015-06-21";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);

        }

        function test_getEnrollmentDate()
        {
            //Arrange
            $name = "Sandra Maley";
            $enrollment_date = "2015-06-21";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $result = $test_student->getEnrollmentDate();

            //Assert
            $this->assertEquals($enrollment_date, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Sandra Maley";
            $enrollment_date = "2015-06-21";
            $id = 1;
            $test_student = new Student($name, $enrollment_date, $id);

            //Act
            $result = $test_student->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $name = "Jim Jackson";
            $enrollment_date = "2015-06-21";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $test_student->save();

            //Assert
            $result = Student::getAll();
            $this->assertEquals($test_student, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Sandra Maley";
            $enrollment_date = "2016-04-29";
            $name2 = "Margaret Sinclair";
            $enrollment_date2 = "2017-11-30";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student, $test_student2], $result);

        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Sandra Maley";
            $enrollment_date = "2016-04-29";
            $name2 = "Margaret Sinclair";
            $enrollment_date2 = "2017-11-30";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            //Act
            Student::deleteAll();

            //Assert
            $result = Student::getAll();
            $this->assertEquals([], $result);
        }

        function testFind()
        {
            //Arrange
            $name = "Sandra Maley";
            $enrollment_date = "2016-04-29";
            $name2 = "Margaret Sinclair";
            $enrollment_date2 = "2017-11-30";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            //Act
            $result = Student::find($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);

        }


    }
 ?>
