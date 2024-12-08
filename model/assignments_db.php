<?php 
    function getAssignmentsByCourse($courseId){
        global $db;

        if ($courseId){
            $query = 'SELECT A.ID, A.Dscription, C.courseName FROM assignments A LEFT JOIN 
            courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY A.ID';
        }else{
            $query = 'SELECT A.ID, A.Dscription, C.courseName FROM assignments A LEFT JOIN 
            courses C ON A.courseID = C.courseID ORDER BY C.courseID';
        }
        $statment = $db->prepare($query);
        $statment->bindValue(':course_id', $courseId);
        $statment->execute();
        $assignments = $statment->fetchAll();
        $statment->closeCursor();
        return $statment;
    }

    function deleteAssignment($assignmentId){
        global $db;
        
        $query = 'DELETE FROM assignments WHERE ID = :assignment_id';
        $statment = $db->prepare($query);
        $statment->bindValue(':assignment_id', $assignmentId);
        $statment->execute();
        $statment->closeCursor();
    }

    function addAssignment($courseId, $description){
        global $db;

        $query = 'INSERT INTO assignments (Description, courseID) VALUES (:description, :courseID)';

        $statment = $db->prepare($query);
        $statment->bindValue(':description', $description);
        $statment->bindValue(':courseID', $courseID);
        $statment->execute();
        $statment->closeCursor();
    }
?>