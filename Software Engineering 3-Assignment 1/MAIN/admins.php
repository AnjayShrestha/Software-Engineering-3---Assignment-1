<?php 

require '../db/database.php';
require '../db/runTemplates.php';

if(!isset($_GET['admin'])){
		$_GET['admin'] = 'adminIndex';//getting the name of file.
	}

	require ('../admins/'.$_GET['admin'].'.php');
	$templatesVar = [
		'title' => $title,//title of page.
		'content' => $content//content of page.
	];
	echo runTemplate('../admins-template/adminFrame.php', $templatesVar);//using function runTemplate to load template.

 ?>