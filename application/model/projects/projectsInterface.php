<?php

interface model_projects_projectsInterface
{
	public function getProjects();
	
	public function getProject($idproject);
	public function insertProject($data, $idproject);
	public function updateProject($data, $idproject);
	public function deleteProject($idproject);
		
}