¿Seguro que deseas borrar el proyecto?
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="idproject" value="<?=isset($project['idproject'])?$_GET['idproject']:'';?>"/>

<ul>
<li>
Alias: <?=isset($project['alias'])?$project['alias']:'';?>
</li>
<li>
Nombre: <?=isset($project['name'])?$project['name']:'';?>
</li>


<li>
Si: <input type="submit" name="borrar" value="Si"/>
</li>
<li>
No: <input type="submit" name="borrar" value="No"/>
</li>


</ul>
</form>