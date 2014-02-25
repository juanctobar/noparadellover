
<form method="post" enctype="multipart/form-data">
	<ul>
		<li>
			<input type="hidden" name="idproject" value="<?=isset($project['idproject'])?$_GET['idproject']:'';?>"/>
		</li>
		<li>
			Alias: <input type="text" name="alias" value="<?=isset($project['alias'])?$project['alias']:'';?>"/>
		</li>
		<li>
			Nombre: <input type="text" name="name" value="<?=isset($project['name'])?$project['name']:'';?>" size='100'/>
		</li>
		<li>
			Tweet: <textarea rows="5" cols="100" name="tweet"><?=isset($project['tweet'])?$project['tweet']:'';?></textarea>
		</li>
		
		<li>
			Presupuesto: <input type="text" name="budget" value="<?=isset($project['budget'])?$project['budget']:'';?>"/>
		</li>
		<li>
			Fecha de inicio: <input type="text" name="date_ini" id="date_ini" value="<?=isset($project['date_ini'])?$project['date_ini']:'';?>"/>
		</li>
		<li>
			Fecha de finalizaci&oacute;n: <input type="text" name="date_fini" id="date_fini" value="<?=isset($project['date_fini'])?$project['date_fini']:'';?>"/>
		</li>
		
		<li>
			Descripci&oacute;n: <textarea rows="5" cols="100" name="description"><?=isset($project['description'])?$project['description']:'';?></textarea>
		</li>
		<li>
			Tipo de proyecto: 
			<select name="project_types_idproject_type">
				<?php
				$obj = new model_mappers_db($config['database']);
				$arrOptions = $obj->findPkDesc("project_types", "idproject_type", "type");
				foreach ($arrOptions as $opt): ?>
					<option value='<?=$opt[0];?>' <?=(isset($project['project_types_idproject_type']) && $project['project_types_idproject_type']==$opt[0])? 'selected':'';?>><?=$opt[1];?></option>
				<?php endforeach; ?>
			</select>
		</li>
		
		<li>
			Compa&ntilde;&iacute;a:
			<select name="companies_idcompany">
				<?php
				$obj = new model_mappers_db($config['database']);
				$arrOptions = $obj->findPkDesc("companies", "idcompany", "name");
				foreach ($arrOptions as $opt): ?>
					<option value='<?=$opt[0];?>' <?=(isset($project['companies_idcompany']) && $project['companies_idcompany']==$opt[0])? 'selected':'';?>><?=$opt[1];?></option>
				<?php endforeach; ?>
			</select>
		</li>
		
		<li>
			Submit: <input type="submit" name="submit"/>
		</li>
		<li>
			Reset: <input type="reset" name="reset"/>
		</li>
		
	</ul>
</form>