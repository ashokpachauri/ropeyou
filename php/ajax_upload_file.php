<?php
    include('../fileuploader/src/php/class.fileuploader.php');
	$DB = mysqli_connect('localhost', 'ropeyou_master', 'ropeyou#2019', 'ropeyou_master');
	define('base_url','https://ropeyou.com/ropeyou/');
	$uploadDir = 'uploads/';
	$realUploadDir = '../uploads/';
	
	function getRealFile($file) {
		global $uploadDir, $realUploadDir;
		
		return str_replace($uploadDir, $realUploadDir, $file);
	}
	if (isset($_POST['fileuploader']) && isset($_POST['name'])) {
		$name = str_replace(array('/', '\\'), '', $_POST['name']);
		$editing = isset($_POST['editing']) && $_POST['editing'] == true;
		
		if (is_file($configuration['uploadDir'] . $name)) {
			$configuration['title'] = $name;
			$configuration['replace'] = true;
		}
	}
	
	$title = 'auto';
	$id = false;
	
	$FileUploader = new FileUploader('profiles', array(
			'limit' => 1,
			'fileMaxSize' => 20,
			'extensions' => array('image/*'),
			'uploadDir' => $realUploadDir,

			'required' => true,
			'title' => $title,
			'replace' => $id,
			'editor' => array(
				'maxWidth' => 1980,
				'maxHeight' => 1980,
				'crop' => false,
				'quality' => 95
			)
		));
	
	// call to upload the files
    $data = $FileUploader->upload();
	if (count($data['files']) == 1) {
		$item = $data['files'][0];
		$title = $DB->real_escape_string($item['name']);
		$type = $DB->real_escape_string($item['type']);
		$size = $DB->real_escape_string($item['size']);
		$file = $DB->real_escape_string($uploadDir . $item['name']);
		$image_file_name=$file;
		$data=array();
		if (!$id)
		{
			$query = $DB->query("INSERT INTO gallery SET title='$title',file='$file',size='$size',type='$type',is_main=1,user_id='".$_COOKIE['uid']."',date=NOW()");
			if($query)
			{
				$media_id=$id=mysqli_insert_id($DB);
				$user_id=$_COOKIE['uid'];
				
				//----------------------------------------------------------------//
						$query="SELECT id FROM users_profile_pics WHERE user_id='$user_id'";
						$query=$DB->query($query);
						if($query->num_rows>0)
						{
							$row=$query->fetch_assoc();
							$m_id=$row['id'];
							$q=$query="UPDATE users_profile_pics SET status=1,media_id='$media_id',user_id='$user_id',added=NOW(),type='$type',caption='$title' WHERE id='$m_id'";
							$query=$DB->query($query);
							
							if($query)
							{
								$data['files'][0] = array(
									'title' => $item['title'],
									'name' => $item['name'],
									'size' => $item['size'],
									'size2' => $item['size2'],
									'url' => $file,
									'id' => $id ? $id : $media_id
								);
							}
							else{
								if (is_file($item['file']))
									@unlink($item['file']);
								unset($data['files'][0]);
								$data['hasWarnings'] = true;
								$data['warnings'][] = $q;//'An error occured.';
							}
						}
						else
						{
							$q=$query="INSERT INTO users_profile_pics SET status=1,media_id='$media_id',user_id='$user_id',added=NOW(),type='$type',caption='$title'";
							$query=$DB->query($query);
							
							if($query)
							{
								$data['files'][0] = array(
									'title' => $item['title'],
									'name' => $item['name'],
									'size' => $item['size'],
									'size2' => $item['size2'],
									'url' => $file,
									'id' => $id ? $id : $media_id
								);
							}
							else{
								if (is_file($item['file']))
									@unlink($item['file']);
								unset($data['files'][0]);
								$data['hasWarnings'] = true;
								$data['warnings'][] = $q;//'An error occured.';
							}
						}
			}
		}
		else
		{
			$query = $DB->query("UPDATE gallery SET `size` = '$size',is_main='1' WHERE id = '$id'");
			if($query)
			{
				$user_id=$_COOKIE['uid'];
				$query="SELECT id FROM users_profile_pics WHERE user_id='$user_id'";
				$query=$DB->query($query);
				if($query->num_rows>0)
				{
					$row=$query->fetch_assoc();
					$m_id=$row['id'];
					$q=$query="UPDATE users_profile_pics SET status=1,media_id='$media_id',user_id='$user_id',added=NOW(),type='$type',caption='$title' WHERE id='$m_id'";
					$query=$DB->query($query);
					
					if($query)
					{
						$data['files'][0] = array(
							'title' => $item['title'],
							'name' => $item['name'],
							'size' => $item['size'],
							'size2' => $item['size2'],
							'url' => $file,
							'id' => $id ? $id : $media_id
						);
					}
					else{
						if (is_file($item['file']))
							@unlink($item['file']);
						unset($data['files'][0]);
						$data['hasWarnings'] = true;
						$data['warnings'][] = $q;//'An error occured.';
					}
				}
				else
				{
					$q=$query="INSERT INTO users_profile_pics SET status=1,media_id='$media_id',user_id='$user_id',added=NOW(),type='$type',caption='$title'";
					$query=$DB->query($query);
					
					if($query)
					{
						$data['files'][0] = array(
							'title' => $item['title'],
							'name' => $item['name'],
							'size' => $item['size'],
							'size2' => $item['size2'],
							'url' => $file,
							'id' => $id ? $id : $media_id
						);
						//echo json_encode($response);die();
					}
					else{
						if (is_file($item['file']))
							@unlink($item['file']);
						unset($data['files'][0]);
						$data['hasWarnings'] = true;
						$data['warnings'][] = $q;//'An error occured.';
					}
				}
			}
		}
	}
	else{
		$data=array();
		$data['hasWarnings'] = true;
		$data['warnings'][] = 'An error occured.';
	}
	// export to js
	echo json_encode($data);
	exit;