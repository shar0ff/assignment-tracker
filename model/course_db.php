<?php
    function getCourses(){
        global $db;

        $query = 'SELECT * FROM courses ORDER BY courseID';

        $statment = $db->prepare($query);
        $statment->execute();
        $courses = $statment->fetchAll();
        $statment->closeCursor();
        return $courses;
    }

    function getCourseName($courseId){
        global $db;

        if (!$courseId){
            return "All courses";
        }

        $query = 'SELECT * FROM courses WHERE courseID = :courseId';
        $statment = $db->prepare($query);
        $statment->bindValue(':courseId', $courseId);
        $statment->execute();
        $course = $statment->fetch();
        $statment->closeCursor();
        $courseName = $course['courseName'];
        return $courseName;
    }
?>