<?php

class model_projects_projects implements model_projects_projectsInterface
{
	public function __construct($config)
	{
		$prj = 'model_projects_mappers_'.$config['mapper'].'_projects';
		$this->mapper = new $prj($config);
	}
	
	public function getProjects()
	{
		return $this->mapper->getProjects();				
	}
	
	public function getProject($idproject)
	{
		return $this->mapper->getProject($idproject);
	}
	
	public function insertProject($data, $idproject)
	{
		/*
 		$photo_name = model_uploadFiles::renameFile($_FILES['photo']['name'],
				$_SERVER['DOCUMENT_ROOT']."/uploads");
		$destino = $_SERVER['DOCUMENT_ROOT']."/uploads";
		if(isset($photo_name)&&$photo_name!=='')
			$data['photo']= $photo_name;
		
		model_uploadFiles::uploadFile($photo_name, $destino, $_FILES['photo']);
		*/	

		if(isset($data['password']))
			$data['password']=sha1($data['password']);
		
		return $this->mapper->insert('projects', $data, $idproject);
	}
	
	public function updateProject($data, $idproject)
	{
		if(isset($data['password']))
			$data['password']=sha1($data['password']);
		
		return $this->mapper->update('projects', $data, $idproject);
	}

	public function deleteProject($idproject)
	{
		return $this->mapper->deleteProject($idproject);
	}
}