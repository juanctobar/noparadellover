<?php

class model_projects_mappers_db_projects extends model_mappers_db
{
	public $link;
	public $config;
	
	public function __construct($config)
	{
		$this->config = $config;
		$this->link = parent::__construct($config);		
	}
	
	public function getProjects()
	{
		$sql = "SELECT p.idproject, p.alias, p.name, p.tweet, p.budget, p.date_ini, p.date_fini,
			       pt.type,
			       c.name as company
			FROM projects p, project_types pt, companies c
			WHERE p.project_types_idproject_type = pt.idproject_type AND
			 	  p.companies_idcompany = c.idcompany
			ORDER BY idproject";
			
		$result=mysqli_query($this->link, $sql);
		while ($row=mysqli_fetch_assoc($result))
		{
			$rows[]=$row;
		}
		return $rows;
	}
	
	public function getProject($idproject)
	{
		$sql = "SELECT p.*,
			       pt.type,
			       c.name as company
			FROM projects p, project_types pt, companies c
			WHERE p.project_types_idproject_type = pt.idproject_type AND
			      p.companies_idcompany = c.idcompany AND
				  p.idproject = ".$idproject;
	
		$result=mysqli_query($this->link, $sql);
		while ($row=mysqli_fetch_assoc($result))
		{
			$rows[]=$row;
		}
		return $rows[0];
	}
	
	public function insertProject($idproject, $data)
	{
		return $this->insert('projects', $data, $idproject);
	}
	
	public function updateProject($idproject, $data)
	{
		return $this->update('projects', $data, $idproject);
	}
	
	public function deleteProject($idproject)
	{
		$this->deleteProjectTeams($idproject);
		return $this->delete('projects', $idproject);
	}
	
	private function deleteProjectTeams($idproject)
	{
		$sql = "DELETE FROM teams WHERE projects_idproject = ".$idproject;
	
		$result=mysqli_query($this->link, $sql);
		return $result;
	}
}