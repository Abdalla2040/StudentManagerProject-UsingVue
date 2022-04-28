<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "config.php";

$id = null;
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$graduationYear = $_POST["graduationYear"];
$gpa = $_POST["gpa"];
$registrations = json_decode($_POST["registrations"], true);

$conn = new mysqli($hn,$un,$pw,$db);
if($conn->connect_error){
    $res["status"] = "error";
    $res["status_message"] = "MySQL connection error";
}else{
    $stmt = $conn->prepare('INSERT INTO students VALUES(?,?,?,?,?)');
    $stmt->bind_param('issss',$id, $firstName, $lastName, $graduationYear, $gpa);
   
    if($stmt->execute()){
        $studentId = $conn->insert_id;

        foreach($registrations as $register){
            $id = null;
            $courseNumber = $register["courseNumber"];
            $attendanceType = $register["attendanceType"];
            $numOfCredits = $register["numOfCredits"];
            $bookFormat = $register["bookFormat"];

            $stmt = $conn->prepare("INSERT INTO registrations VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("iisiss", $id,$studentId,$courseNumber,$numOfCredits,$attendanceType,$bookFormat);
            if($stmt->execute()){
                $res["status"] = "success";
            }else{
                $res["status"] = "error";
                $res["status_message"] = $stmt->error;
            }
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