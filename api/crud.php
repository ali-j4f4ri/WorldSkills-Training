<?php
require_once "../core/config.php";
require "utils/sql.php";

header("Content-Type: application/json");

$method = $_SERVER["REQUEST_METHOD"];

try{
    if ($method == "GET"){
        $stmt = $pdo->query($crud_fetch_student);
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($students);
    }
    if($method == "POST"){
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data["name"];
        $family = $data["family"];
        $studentCode = $data["studentCode"];

        $stmt = $pdo->prepare($crud_make_student);
        $stmt->execute([
            ':name' => $name,
            ':family' => $family,
            ':studentCode' => $studentCode
        ]);

        echo json_encode([
            "success" => true,
            "message" => "Created Successfully"
        ]);
    }
    if($method == "DELETE"){
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data["id"];
        $stmt = $pdo->prepare($crud_delete_student);
        $stmt->execute([
            ':id' => $id
        ]);
        echo json_encode([
            "success" => true,
            "message" => "Student Deleted Successfully"
        ]);
    }
    if($method == "UPDATE" || $method == "PUT" || $method == "PATCH"){
        $data = json_decode(file_get_contents("php://input"), true);
        error_log(print_r($data, true));

        $id = isset($data["id"]) ? $data["id"] : null;
        $name = isset($data["name"]) ? $data["name"] : null;
        $family = isset($data["family"]) ? $data["family"] : null;
        $studentCode = isset($data["studentCode"]) ? $data["studentCode"] : null;
        
        $stmt = $pdo->prepare($crud_update_student);
        $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':family' => $family,
            ':studentCode' => $studentCode 
        ]);
        
        echo json_encode([
            "success" => true,
            "message" => "Student Updated Successfully"
        ]);
    }
} catch(PDOException $e){
    echo $e->getMessage();
}
?>
