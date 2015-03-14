<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/ProjectData.php";
include "core/modules/blog/model/PriorityData.php";
include "core/modules/blog/model/TaskData.php";

$project = ProjectData::getById($_POST["id"]);

?>
<div class="row">
<div class="col-md-7">

<?php
print "<h2>".$project->name."</h2>";
?>



</div>
<div class="col-md-5">
<form id="search">
	   <br><div class="input-group">
	   <input type="hidden" name="project_id" value="<?php echo $project->id; ?>">
      <input type="text" name="q" id="q" class="form-control" placeholder="Buscar Tareas ...">
      <span class="input-group-btn">
        <button class="btn btn-default" id="gosearch" type="button">&nbsp;<i class='glyphicon glyphicon-search'></i></button>
      </span>
    </div>
</form>
</div>
</div>


<script>
	$("#q").keyup(function(){
//		alert($("#search").serialize());
		loadtasksq($("#search").serialize());
	});
</script>

<div class="btn-toolbar">
<div class="btn-group">
<a href="#" class="btn btn-default btn-xs" id="shownewtask"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Tarea</a>
</div>
<div class="btn-group">
<a href="#" class="btn btn-default btn-xs" id="shownewtask"><i class="glyphicon glyphicon-user"></i> Usuarios</a>
</div>
<div class="btn-group">
<a href="#" class="btn btn-default btn-xs" id="shownewtask"><i class="glyphicon glyphicon-tags"></i> Etiquetas</a>
</div>
<div class="btn-group">
<a href="#" class="btn btn-default btn-xs" id="shownewtask"><i class="glyphicon glyphicon-bar-chart"></i> Analiticas</a>
</div>
<div class="btn-group">
<a href="#" class="btn btn-default btn-xs" id="shownewtask"><i class="glyphicon glyphicon-cog"></i> Administrar</a>
</div>

</div>

<br><br><div id="divnewtask">
	<div class="panel panel-default">
	<div class="panel-heading">Nueva Tarea</div>
	<div class="panel-body">
	<form role="form" id="newtask" action="#">
  <div class="form-group">
    <input type="text" class="form-control" required name="name" id="exampleInputEmail1" placeholder="Tarea">
  </div>
  <div class="form-group">
<select name="priority_id" class="form-control">
	<?php foreach(PriorityData::getAll() as $priority):?>
		<option value="<?php echo $priority->id; ?>"><?php echo $priority->name; ?></option>
	<?php endforeach; ?>
</select>
  </div>

<div class="row">
	<div class="col-md-6">
	<button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-ok-sign"></i></button>
	<input type="hidden" name="project_id" value="<?php echo $project->id; ?>">
	</div>
	<div class="col-md-6"><button type="button" id="closenewtask" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-remove-sign"></i></button></div>
</div>
  
</form>
</div>
</div>
</div>
<div id="task-list"></div>
<script>
	$("#divnewtask").hide();

$("#shownewtask").click(function(e){
	e.preventDefault();
	$("#divnewtask").show("fast");
});

$("#closenewtask").click(function(){
	$("#divnewtask").hide("fast");
});


function loadtasks(){
				$.post("loadtasks.php","project_id=<?php echo $project->id; ?>", function(data){
				//	console.log(data);
					$("div#task-list").html(data);
//					document.getElementById("task-list").innerHTML=data;
				});	
			}

function loadtasksq(q){
				$.post("loadtasks.php",q, function(data){
				//	console.log(data);
					$("div#task-list").html(data);
//					document.getElementById("task-list").innerHTML=data;
				});	
			}


	$("#newtask").submit(function(e){
		e.preventDefault();
				var formInput = $(this).serialize();
				console.log(formInput);
				$.post("newtask.php",formInput, function(data){
					$('#divnewtasks').fadeOut("fast");
					loadtasks();
					$("input[type=text]").each(function(){ $(this).val(""); });
					$("#divnewtask").hide();
				});		
	});

	loadtasks();
</script>