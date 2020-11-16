<?php
    include('../../../src/php/class.fileuploader.php');

	$configuration = [
		'limit' => 1,
		'fileMaxSize' => 10,
		'extensions' => ['image/*'],
		'title' => 'auto',
		'uploadDir' => '../uploads/',
		'replace' => false,
		'editor' => [
			'maxWidth' => 512,
			'maxHeight' => 512,
			'crop' => false,
			'quality' => 95
		]
	];
	
	if (isset($_POST['fileuploader']) && isset($_POST['name'])) {
		$name = str_replace(array('/', '\\'), '', $_POST['name']);
		$editing = isset($_POST['editing']) && $_POST['editing'] == true;
		
		if (is_file($configuration['uploadDir'] . $name)) {
			$configuration['title'] = $name;
			$configuration['replace'] = true;
		}
	}

	// initialize FileUploader
    $FileUploader = new FileUploader('files', $configuration);
	
	// call to upload the files
    $data = $FileUploader->upload();

	// export to js
	echo json_encode($data);
	exit;