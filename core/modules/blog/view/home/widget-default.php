<?php
$user = UserData::getById(Session::getUID());
?>
<div class="row">
	<div class="col-md-3">
	<h4><?php echo $user->name; ?> <?php echo $user->lastname; ?></h4>
	<ul type="none">
		<li><a id="showdesktopbtn">Escritorio</a> </li>
			<li><a id="shownewproject"><i class="glyphicon glyphicon-plus-sign"></i> Nuevo Proyecto</a> </li>
<br><div id="divnewproject">
	<div class="panel panel-primary">
	<div class="panel-heading">Nuevo Proyecto</div>
	<div class="panel-body">
	<form role="form" id="newproject" action="newproject.php">
  <div class="form-group">
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Nombre del Proyecto">
  </div>


<div class="row">
	<div class="col-md-6"><button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-ok-sign"></i></button></div>
	<div class="col-md-6"><button type="button" id="closenewproject" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-remove-sign"></i></button></div>
</div>
  
</form>
</div>
</div>

</div>
	</ul>
<hr>
		<div id="project-list"></div>

		<ul type="none">

		</ul>



<script>
	$("#divnewproject").hide();

$("#shownewproject").click(function(){
	$("#divnewproject").show("fast");
});

$("#closenewproject").click(function(){
	$("#divnewproject").hide("fast");
});

function loadprojects(){
				$.post("loadprojects.php",null, function(data){
					// console.log(data);
					$("div#project-list").html(data);
				});	
			}

	$("#newproject").submit(function(e){
		e.preventDefault();
				var formInput = $(this).serialize();
				// console.log(formInput);
				$.post($(this).attr('action'),formInput, function(data){
					$('#divnewproject').fadeOut("fast");
					loadprojects();
				});		
	});
$("#showdesktopbtn").click(function(){
				$.post("loaddesktop.php",null, function(data){
					console.log(data);
					$("div#task-container").html(data);
				});	

});


	loadprojects();



</script>
	</div>
	<div class="col-md-9">
		<div id="task-container"></div>
	</div>
</div>