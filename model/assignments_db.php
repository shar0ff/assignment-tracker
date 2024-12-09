<?php 
    function getAssignmentsByCourse($courseId){
        global $db;

        if ($courseId){
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN 
            courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY A.ID';
            $statement = $db->prepare($query);
            $statement->bindValue(':course_id', $courseId);
        }else{
            $query = 'SELECT A.ID, A.Description, C.courseName FROM assignments A LEFT JOIN 
            courses C ON A.courseID = C.courseID ORDER BY C.courseID';
            $statement = $db->prepare($query);
        }
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }

    function deleteAssignment($assignmentId){
        global $db;
        
        $query = 'DELETE FROM assignments WHERE ID = :assignment_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':assignment_id', $assignmentId);
        $statement->execute();
        $statement->closeCursor();
    }

    function addAssignment($courseId, $description){
        global $db;

        $query = 'INSERT INTO assignments (Description, courseID) VALUES (:description, :courseID)';

        $statement = $db->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':courseID', $courseId);
        $statement->execute();
        $statement->closeCursor();
    }
?>