<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "config.php";

$students = [];

$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error){
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
}else{
    $stmt = $conn->prepare('SELECT * FROM students');
    if($stmt->execute()){
        $result = $stmt->get_result();
        $rows = $result->num_rows;
        if($rows >= 1){
            foreach($result as $student){
                $id = $student["studentID"];
                $stmt = $conn->prepare("SELECT * FROM registrations WHERE studentID = $id");
                if($stmt->execute()){
                    $result = $stmt->get_result();
                    $rows = $result->num_rows;
                    $registrations = [];
                    if($rows >= 1){
                        foreach($result as $registration){
                            $registrations[] = $registration;
                        }
                        $student["registrations"] = $registrations;
                        
                    }else{
                        $student["registrations"] = [];
                        $res["status"] = "error";
                        $res["status_message"] = "no registrations found";
                    }
                    $students[] = $student;
                    $res["status"] = "success";
                    $res["students"] = $students;
                }else{
                    $res["status"] = "error";
                    $res["status_message"] = $stmt->error;
                }
            }
        }else{
            $res["status"] = "error";
            $res["status_message"] = "No students found";
        }
    }else{
        $res["status"] = "error";
        $res["status_message"] = $stmt->error;
    }
    
}
$stmt->close();
$conn->close();
echo json_encode($res);

?>