<?php
    include('../fileuploader/src/php/class.fileuploader.php');
	include_once '../connection.php';
	// initialize FileUploader
	$title = 'auto';
	$id = false;
	
	$uploadDir = 'uploads/';
	$realUploadDir = '../uploads/';
	$post_title="Posted Media";
	$post_text=$_REQUEST['post_text'];
    $FileUploader = new FileUploader('media_uploader', array(
        'limit' => null,
        'maxSize' => null,
		'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => '../uploads/',
        'title' => $title,
		'replace' => $id,
		'editor' => array(
			'maxWidth' => 1980,
			'maxHeight' => 1980,
			'quality' => 95
		),
        'listInput' => true,
        'files' => null
    ));
	$DB = mysqli_connect('localhost', 'ropeyou', 'ropeyou#2019', 'ropeyou');
	// unlink the files
	// !important only for preloaded files
	// you will need to give the array with appendend files in 'files' option of the fileUploader
	foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
		unlink('../uploads/' . $value['name']);
	}
	
	// call to upload the files
    $data = $FileUploader->upload();

    // if uploaded and success
    if($data['isSuccess'] && count($data['files']) > 0) {
        // get uploaded files
        $uploadedFiles = $data['files'];
		//print_r($uploadedFiles);
		$post_query="INSERT INTO users_posts SET user_id='".$_COOKIE['uid']."',post_title='$post_title',post_text='$post_text',status=1,added=NOW()";
		$query=$DB->query($post_query);
		$post_id=mysqli_insert_id($DB);
		foreach($data['files'] as $item)
		{
			$title = $DB->real_escape_string($item['name']);
			$type = $DB->real_escape_string($item['type']);
			$size = $DB->real_escape_string($item['size']);
			$file = $DB->real_escape_string($uploadDir . $item['name']);
			
			$query = $DB->query("INSERT INTO gallery(`post_id`,`title`, `file`, `type`, `size`, `index`, `date`, `user_id`, `is_main`) VALUES('$post_id','$title', '$file', '$type', '$size', 1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g WHERE user_id='".$_COOKIE['uid']."'), -1)), NOW(),'".$_COOKIE['uid']."',0)");
			
			$media_id=mysqli_insert_id($DB);
			
			$query = $DB->query("INSERT INTO users_posts_media SET user_id='".$_COOKIE['uid']."',added=NOW(),post_id='$post_id',media_file='$media_id'");
		}
		?>
			<script>
				/*swal({
				  title: "Great!",
				  text: "Media broadcasted successfully.",
				  icon: "success",
				  buttons: {
					cancel: false,
					confirm: "Close",
				  },
				  dangerMode: false,
				});*/
				location.href="<?php echo base_url; ?>broadcasts";
			</script>
		<?php
    }
    // if warnings
	if($data['hasWarnings']) {
       /* $warnings = $data['warnings'];
        
   		echo '<pre>';
        print_r($warnings);
		echo '</pre>';*/
		?>
			<script>
				/*swal({
				  title: "Oh! Snap.",
				  text: "Somethig went wrong please try again.",
				  icon: "error",
				  buttons: {
					cancel: false,
					confirm: "Close",
				  },
				  dangerMode: false,
				});*/
				location.href="<?php echo base_url; ?>broadcasts";
			</script>
		<?php
    }
	
	// get the fileList
	//$fileList = $FileUploader->getFileList();
	
	// show
	//echo '<pre>';
	//print_r($fileList);
	//echo '</pre>';
	?>
	<!--<script src="<?php echo base_url; ?>landing_page/js/sweetalert.min.js"></script>-->