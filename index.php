<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    require('model/database.php');
    require('model/assignments_db.php');
    require('model/course_db.php');

    $assignmentId = filter_input(INPUT_POST, 'assignment_id', FILTER_VALIDATE_INT);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $courseName = filter_input(INPUT_POST, 'course_name', FILTER_SANITIZE_SPECIAL_CHARS);

    $courseId = filter_input(INPUT_POST, 'course_id', FILTER_VALIDATE_INT);
    if (!$courseId) {
        $courseId = filter_input(INPUT_GET, 'course_id', FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$action) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$action) {
            $action = 'list_assignments';
        }
    }

    switch($action){
        default:
            $courseName = getCourseName($courseId);
            $courses = getCourses();
            $assignments = getAssignmentsByCourse($courseId);
            include('view/assignment_list.php');
    }
?>