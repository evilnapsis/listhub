<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/PriorityData.php";
include "core/modules/blog/model/TaskData.php";
include "core/modules/blog/model/TagData.php";
include "core/modules/blog/model/TaskTagData.php";


$project = TaskData::getById($_POST["task_id"]);
?>
<?php if($_POST["open"]==1):?>
	<div class="panel panel-default">
	<div class="panel-heading">Editar Tarea</div>
	<div class="panel-body">
	<form role="form" id="edittask-<?php echo $project->id;?>" action="#">
  <div class="form-group">
    <input type="text" class="form-control" required name="name" id="exampleInputEmail1" placeholder="Tarea" value="<?php echo $project->name; ?>">
  </div>
  <div class="form-group">
    <textarea name="description" class="form-control" id="exampleInputEmail1" placeholder="Descripcion"><?php echo $project->description; ?></textarea>
  </div>
<!-- - - - - -->
  <div class="form-group">
<div class="row">
<div class="col-md-6">
<div class="input-group">
  <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
  <input type="text" name="start_at" class="form-control" placeholder="Fecha inicio" value="<?php echo $project->start_at; ?>">
</div>
</div>

<div class="col-md-6">
<div class="input-group">
  <span class="input-group-addon"><i class='glyphicon glyphicon-calendar'></i></span>
  <input type="text" name="finish_at" class="form-control" placeholder="Fecha inicio" value="<?php echo $project->finish_at; ?>">
</div>
</div>

</div>
</div>
<!-- - - - - -->

  <div class="form-group">
<div class="row">
<div class="col-md-10">
<div class="input-group">
  <span class="input-group-addon"><i class='glyphicon glyphicon-tags'></i></span>
  <input type="text" name="tags" class="form-control" placeholder="Etiquetas (separadas por comas)">
</div>
</div>
<div class="col-md-2">
<select name="priority_id" class="form-control">
	<?php foreach(PriorityData::getAll() as $priority):?>
		<option value="<?php echo $priority->id; ?>"><?php echo $priority->name; ?></option>
	<?php endforeach; ?>
</select>
</div>
</div>
  </div>
<div class="row">
	<div class="col-md-6">
	<button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-ok-sign"></i></button>
	<input type="hidden" name="task_id" value="<?php echo $project->id; ?>">
	</div>
	<div class="col-md-6"><button type="button" id="closeedittask" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-remove-sign"></i></button></div>
</div>
  
</form>
</div>
</div>
<script>

$("#edittask-<?php echo $project->id; ?>").submit(function(e){
	e.preventDefault();
			var formInput = $(this).serialize();
			console.log(formInput);
			$.post("updatetask.php",formInput, function(data){
				loadtasks();
			});		
});


$("#closeedittask").click(function(){
	$.post("edittask.php","task_id=<?php echo $project->id;?>&open=0", function(data){
		console.log(data);
		$("#edittaskform-<?php echo $project->id; ?>").html(data);
	});
});
</script>
<?php endif;?>