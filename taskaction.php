<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/TaskData.php";

if(count($_POST)>0){

if($_POST["action"]=="finish"){
$task = TaskData::getById($_POST["task_id"]);
$task->finish();
}
else if($_POST["action"]=="start"){
$task = TaskData::getById($_POST["task_id"]);
$task->start();
}
else if($_POST["action"]=="delete"){
$task = TaskData::getById($_POST["task_id"]);
$task->del();
}

}
// print_r($_GET);



?>