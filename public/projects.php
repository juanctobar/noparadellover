<?php

$config = parse_ini_file('../application/configs/settings.ini', TRUE);
include ('../application/autoload.php');

// echo "<pre>";
// print_r($config);
// echo "</pre>";

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

switch ($action)
{
	case 'select':
		$obj = new model_projects_projects($config['database']);
		$filas = $obj->getProjects();
		ob_start();
		include ('../application/views/projects/select.phtml');
		$content=ob_get_contents();
		ob_end_clean();
		break;
	
	case 'insert':
		if ($_POST)
		{
			$obj = new model_projects_projects($config['database']);
			$obj->insertProject($_POST);
			header('Location: /projects.php');
		}
		else
		{
			ob_start();
			include('../application/views/projects/insert.php');
			$content=ob_get_contents();
			ob_end_clean();
		}
		break;
	
	case 'update':
		$obj = new model_projects_projects($config['database']);
		if ($_POST)
		{
			$obj->updateProject($_POST, $_POST['idproject']);
			header('Location: /projects.php');
		}
		else
		{
			$project = $obj->getProject($_GET['idproject']);
			// Pasarla al formulario
			ob_start();
				include('../application/views/projects/insert.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
		break;
	
	case 'delete':
		if($_POST)
		{
			if($_POST['borrar']=="Si")
			{
				$obj = new model_projects_projects($config['database']);
				$obj->deleteProject($_POST['idproject']);
			}
			header('Location: /projects.php');
		}
		else
		{
			$obj = new model_projects_projects($config['database']);
			$project = $obj->getProject($_GET['idproject']);
			ob_start();
				include('../application/views/projects/delete.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
		break;

	default:
		break;
}

// Include Layuout
include('../application/views/layouts/layout.phtml');
