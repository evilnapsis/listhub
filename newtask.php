<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/TaskData.php";
include "core/modules/blog/model/TagData.php";
include "core/modules/blog/model/TaskTagData.php";

$project_id = $_POST["project_id"];
$tags_str = $_POST["tags"];
$tags = explode(",", trim($tags_str));
$tp = null;


//print_r($tags);

$project = new TaskData();
$project->name = $_POST["name"];
$project->priority_id = $_POST["priority_id"];
$project->project_id = $project_id;
$newtask =  $project->add();


/// procesando etiquetas
foreach ($tags as $tag) {
$tp = TagData::existTP($tag,$project_id);
	if($tp==null){
		$t = new TagData();
		$t->name = $tag;
		$t->project_id = $project_id;
		$t->add();
		$tp = TagData::existTP($tag,$project_id);
	}

	if($tp!=null){
		$tdx = TaskTagData::getByTT($newtask[1],$tp->id);
		if($tdx==null){
			$td = new TaskTagData();
			$td->tag_id = $tp->id;
			$td->task_id = $newtask[1];
			$td->add();
		}
	}

}



// print_r($_GET);



?>