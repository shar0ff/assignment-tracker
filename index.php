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
        case "list_courses":
            $courses = getCourses();
            include('view/course_list.php');
            break;
        case "add_course":
            addCourse($courseName);
            header("Location: .?action=list_courses");
            break;
        case "add_assignment":
            if ($courseId && $description) {
                addAssignment($courseId, $description);
                header("Location: .?course_id=$courseId");
            } else {
                $error = "Invalid ssignment data. Check off fields and try again.";
                include('view/error.php');
                exit();
            }
            break;
        case "delete_course":
            if ($courseId) {
                try {
                    deleteCourse($courseId);
                } catch (PDOException $e){
                    $error = "You can not delete a course if assignents exist in the course.";
                    include('view/error.php');
                    exit();
                }
                header("Location: .?action=list_courses");
            }
            break;
        case "delete_assignment" :
            if ($assignmentId) {
                deleteAssignment($assignmentId);
                header("Location: .?course_id=$courseId");
            } else {
                $error = "Missing or incorrect assignment id.";
                include('view/error.php');
            }
            break;
        default:
            $courseName = getCourseName($courseId);
            $courses = getCourses();
            $assignments = getAssignmentsByCourse($courseId);
            include('view/assignment_list.php');
    }
?>