<?php
session_start();


include "./__DBconfig.php";

$Connector = new Configuration();
$Connection = $Connector->getConnection();

function getTaskId($Userid)
{
    global $Connection;

    $stmt = $Connection->prepare("SELECT tasks_id FROM tasks WHERE user_id = :user_id ORDER BY tasks_id DESC LIMIT 1");
    $stmt->bindParam(":user_id",$Userid);

    $stmt->execute();

    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 0)
    {
        return 0;
    }

    else
    {
        return $res['tasks_id'];
    }

}

function addTask($taskName,$taskDescription,$Logo,$Status)
{
    global $Connection;

    $Userid = substr($_COOKIE['id'],-1);
    $task_id = getTaskId($Userid);
    $task_id+=1;

    $stmt = $Connection->prepare('INSERT INTO tasks(task,description,icon,status,user_id,tasks_id) VALUES(:task,:description,:icon,:status,:user_id,:tasks_id)');

    $stmt->bindParam(':task',$taskName);
    $stmt->bindParam(':description',$taskDescription);
    $stmt->bindParam(':icon',$Logo);
    $stmt->bindParam(':status',$Status);
    $stmt->bindParam(':user_id',$Userid);
    $stmt->bindParam(':tasks_id',$task_id);

    $stmt->execute();

    header("Location: ./index.php");
    exit();
}

function deleteTask($taskId)
{
    global $Connection;

    $sql = 'DELETE FROM tasks WHERE tasks_id = :tasks_id';

    $stmt = $Connection->prepare($sql);

    $stmt->bindParam(":tasks_id",$taskId);

    $stmt->execute();

    header("Location: ./index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["newData"]))
{
    $title = $_POST['title-text'];
    $description = $_POST['desc_text'];
    $icon_switch = $_POST['icons_select'];
    $status_switch = $_POST['status_select'];

    $icon = "";
    $status = "";

    switch($icon_switch)
    {
        case 1:
            $icon = "briefcase-solid.svg";
            break;

        case 2:
            $icon = "comment-regular.svg";
            break;        
    
        case 3:
            $icon = "mug-hot-solid.svg";
            break;

        case 4:
            $icon = "dumbbell-solid.svg";
            break;

        case 5:
            $icon = "book-solid.svg";
            break; 

        case 6:
            $icon = "clock-solid.svg";
            break;
    }

    switch($status_switch)
    {
        case "s1":
            $status = "#e9a23b";
            break;

        case "s2":
            $status = "#32d657";
            break;

        case "s3":
            $status = "#dd524c";
            break;
    }

    addTask($title,$description,$icon,$status);
}

function editTask($task,$description,$icon,$status,$taskId)
{
    global $Connection;

    $sql = 'UPDATE tasks SET task = :task,description = :description,icon = :icon,status = :status WHERE tasks_id = :tasks_id';

    $stmt = $Connection->prepare($sql);

    $stmt->bindParam(':task',$task);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':icon',$icon);
    $stmt->bindParam(':status',$status);
    $stmt->bindParam(':tasks_id',$taskId);

    $stmt->execute();

    header("Location: ./index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edits']))
{
    $task_id = $_POST['editData'];
    $title = $_POST['title-text'];
    $description = $_POST['desc_text'];
    $icon_switch = $_POST['icons_select'];
    $status_switch = $_POST['status_select'];

    $icon = "";
    $status = "";

    switch($icon_switch)
    {
        case 1:
            $icon = "briefcase-solid.svg";
            break;

        case 2:
            $icon = "comment-regular.svg";
            break;        
    
        case 3:
            $icon = "mug-hot-solid.svg";
            break;

        case 4:
            $icon = "dumbbell-solid.svg";
            break;

        case 5:
            $icon = "book-solid.svg";
            break; 

        case 6:
            $icon = "clock-solid.svg";
            break;
    }

    switch($status_switch)
    {
        case "s1":
            $status = "#e9a23b";
            break;

        case "s2":
            $status = "#32d657";
            break;

        case "s3":
            $status = "#dd524c";
            break;
    }

    editTask($title,$description,$icon,$status,$task_id);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_edit']))
{
    $DataId = $_POST['editData'];

    deleteTask($DataId);
}