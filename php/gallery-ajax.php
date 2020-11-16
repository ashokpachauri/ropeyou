<?php
    include('../fileuploader/src/php/class.fileuploader.php');
    include('../connection.php');
	// mysqli connection
	//$conn = mysqli_connect('localhost', 'ropeyou', 'ropeyou#2019', 'ropeyou');
	
	$uploadDir = 'uploads/';
	$realUploadDir = '../uploads/';
	$_action = isset($_GET['type']) ? $_GET['type'] : '';
	$gallery_type = isset($_GET['gallery_type']) ? $_GET['gallery_type'] : 'personal';
	function getRealFile($file) {
		global $uploadDir, $realUploadDir;
		
		return str_replace($uploadDir, $realUploadDir, $file);
	}
	$is_professional=0;
	if($gallery_type=="professional")
	{
		$is_professional=1;
	}

	// upload
	if ($_action == 'upload') {
		$id = false;
		$title = 'auto';

		// if after editing
		if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['_editorr'])) {
			$_id = $conn->real_escape_string($_POST['id']);
			
			$query = $conn->query("SELECT file FROM gallery WHERE id = '$_id'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$id = $_id;
				$pathinfo = pathinfo($row['file']);
				
				$realUploadDir = getRealFile($pathinfo['dirname'] . '/');
				$title = $pathinfo['filename'];
			} else {
				exit;
			}
		}

		// initialize FileUploader
		$FileUploader = new FileUploader('files', array(
			'limit' => 1,
			'fileMaxSize' => 100,
			'extensions' => array('image/*', 'video/*', 'audio/*'),
			'uploadDir' => $realUploadDir,

			'required' => true,
			'title' => $title,
			'replace' => $id,
			'editor' => array(
				'maxWidth' => 1980,
				'maxHeight' => 1980,
				'crop' => false,
				'quality' => 90
			)
		));

		$upload = $FileUploader->upload();
		
		if (count($upload['files']) == 1) {
			$item = $upload['files'][0];
			$title = $conn->real_escape_string($item['name']);
			$type = $conn->real_escape_string($item['type']);
			$size = $conn->real_escape_string($item['size']);
			$file = $conn->real_escape_string($uploadDir . $item['name']);
			
			if (!$id)
				$query = $conn->query("INSERT INTO gallery(`title`, `file`, `type`, `size`, `index`, `date`, `user_id`, `is_professional`) VALUES('$title', '$file', '$type', '$size', 1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g WHERE user_id='".$_COOKIE['uid']."'), -1)), NOW(),'".$_COOKIE['uid']."','$is_professional')");
			else
				$query = $conn->query("UPDATE gallery SET `size` = '$size',".$additional_condition." WHERE id = '$id'");
			
			if ($id || $query) {
				$upload['files'][0] = array(
					'title' => $item['title'],
					'name' => $item['name'],
					'size' => $item['size'],
					'size2' => $item['size2'],
					'url' => $file,
					'id' => $id ? $id : $conn->insert_id
				);
			} else {
				if (is_file($item['file']))
					@unlink($item['file']);
				unset($upload['files'][0]);
				$upload['hasWarnings'] = true;
				$upload['warnings'][] = 'An error occured.';
			}
		}
		
		echo json_encode($upload);
		exit;
	}
	
	// preload
	if ($_action == 'preload') {
		$preloadedFiles = array();
		
		$query = $conn->query("SELECT * FROM gallery WHERE user_id='".$_COOKIE['uid']."' AND is_professional='$is_professional' AND is_draft=0 ORDER BY `index` ASC");
		if ($query && $query->num_rows > 0) {
			while($row = $query->fetch_assoc()) {
				$preloadedFiles[] = array(
					'name' => $row['title'],
					'type' => $row['type'],
					'size' => $row['size'],
					'file' => $row['file'],
					'data' => array(
						'readerForce' => true,
						'url' => $row['file'],
						'date' => $row['date'],
						'isMain' => $row['is_main'],
						'isBanner' => $row['is_banner'],
						'listProps' => array(
							'id' => $row['id'],
						)
					),
				);
			}
		}

		echo json_encode($preloadedFiles);
		exit;
	}
	
	// resize
	if ($_action == 'resize') {
		if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['_editor'])) {
			$id = $conn->real_escape_string($_POST['id']);
			$editor = json_decode($_POST['_editor'], true);
			
			$query = $conn->query("SELECT file FROM gallery WHERE id = '$id'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$file = getRealFile($row['file']);
				
				if (is_file($file)) {
					$info = Fileuploader::resize($file, null, null, null, (isset($editor['crop']) ? $editor['crop'] : null), 100, (isset($editor['rotation']) ? $editor['rotation'] : null));
					$size = filesize($file);
					
					$conn->query("UPDATE gallery SET `size` = '$size' WHERE id = '$id'");
				}
				
			}
		}
		
		exit;
	}

	// sort
	if ($_action == 'sort') {
		if (isset($_POST['list'])) {
			$list = json_decode($_POST['list'], true);
			
			$index = 0;
			foreach($list as $val) {
				if (!isset($val['id']) || !isset($val['name']) || !isset($val['index']))
					break;
				
				$id = $conn->real_escape_string($val['id']);
				$conn->query("UPDATE gallery SET `index` = '$index' WHERE id = '$id'");
				$index++;
			}
		}
		exit;
	}

	// rename
	if ($_action == 'rename') {
		if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['title'])) {
			$id = $conn->real_escape_string($_POST['id']);
			$title = substr(FileUploader::filterFilename($_POST['title']), 0, 200);
			
			$query = $conn->query("SELECT file FROM gallery WHERE id = '$id'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$file = $row['file'];
				
				$pathinfo = pathinfo($file);
				$newName = $title . (isset($pathinfo['extension']) ? '.' . $pathinfo['extension'] : '');
				$newFile = $pathinfo['dirname'] . '/' . $newName;
				
				$realFile = str_replace($uploadDir, $realUploadDir, $file);
				$newRealFile = str_replace($uploadDir, $realUploadDir, $newFile);

				if (!file_exists($newRealFile) && rename($realFile, $newRealFile)) {
					$query = $conn->query("UPDATE gallery SET `title` = '".$conn->real_escape_string($newName)."', `file` = '".$conn->real_escape_string($newFile)."' WHERE id = '$id'");
					if ($query) {
						echo json_encode([
							'title' => $title,
							'file' => $newFile,
							'url' => $newFile
						]);
					}
				}

			}
		}
		exit;
	}

	// asmain
	if ($_action == 'asmain') {
		if (isset($_POST['id']) && isset($_POST['name'])) {
			$id = $conn->real_escape_string($_POST['id']);
			//$query = $conn->query("UPDATE gallery SET is_main = 0 WHERE user_id='".$_COOKIE['uid']."'");
			$query = $conn->query("UPDATE gallery SET is_main = 1 WHERE id = '$id'");
			$query=$conn->query("SELECT * FROM gallery WHERE id = '$id'");
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$query1=$conn->query("SELECT * FROM users_profile_pics WHERE user_id='".$_COOKIE['uid']."'");
				if ($query1 && $query1->num_rows == 1) {
					$caption_arr=explode("uploads/",$row['file']);
					$query1=$conn->query("UPDATE users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$caption_arr[1]."',added=NOW() WHERE user_id='".$_COOKIE['uid']."'");
				}
				else{
					$caption_arr=explode("uploads/",$row['file']);
					$query1=$conn->query("INSERT INTO users_profile_pics SET media_id='$id',type='".$row['type']."',caption='".$caption_arr[1]."',added=NOW(),user_id='".$_COOKIE['uid']."'");
				}
			}
			//$query = $conn->query("UPDATE users SET profile = '".$id."' WHERE id = '".$_COOKIE['uid']."'");
			
			//$query = $conn->query("INSERT INTO users_posts SET post_title='updated his profile picture.',is_profile_image=1,user_id='".$_COOKIE['uid']."',added=NOW()");
			//$post_id=mysqli_insert_id($conn);
			//$query = $conn->query("INSERT INTO users_posts_media SET user_id='".$_COOKIE['uid']."',added=NOW(),post_id='$post_id',media_file='$id'");
			
			//$query = $conn->query("INSERT INTO threats_to_user SET user_id='".$_COOKIE['uid']."',added=NOW(),message='Profile picture changed.Review your activities if you did not changed it.',heading='Profile picture changed.'");
		}
		exit;
	}
	if ($_action == 'asmainh') {
		/*if (isset($_POST['id']) && isset($_POST['name'])) {
			$id = $conn->real_escape_string($_POST['id']);
			$query = $conn->query("UPDATE gallery SET is_banner = 0 WHERE user_id='".$_COOKIE['uid']."'");
			$query = $conn->query("UPDATE gallery SET is_banner = 1 WHERE id = '$id'");
			$query = $conn->query("UPDATE users SET banner = '".$id."' WHERE id = '".$_COOKIE['uid']."'");
			
			$query = $conn->query("INSERT INTO users_posts SET post_title='updated his profile banner.',is_profile_banner=1,user_id='".$_COOKIE['uid']."',added=NOW()");
			$post_id=mysqli_insert_id($conn);
			$query = $conn->query("INSERT INTO users_posts_media SET user_id='".$_COOKIE['uid']."',added=NOW(),post_id='$post_id',media_file='$id'");
			
			$query = $conn->query("INSERT INTO threats_to_user SET user_id='".$_COOKIE['uid']."',added=NOW(),message='Profile banner changed.Review your activities if you did not changed it.',heading='Profile banner changed.'");
		}*/
		exit;
	}

	// remove
	if ($_action == 'remove') {
		if (isset($_POST['id']) && isset($_POST['name'])) {
			$id = $conn->real_escape_string($_POST['id']);
			
			$query = $conn->query("SELECT file FROM gallery WHERE id = '$id'");
			
			if ($query && $query->num_rows == 1) {
				$row = $query->fetch_assoc();
				$file = str_replace($uploadDir, $realUploadDir, $row['file']);
				
				$conn->query("DELETE FROM gallery WHERE id = '${id}'");
				if (is_file($file))
					unlink($file);
			}
		}
		exit;
	}