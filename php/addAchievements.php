<?php
    include('../fileuploader/src/php/class.fileuploader.php');
	include_once '../connection.php';
	// initialize FileUploader
	$_SESSION['as']=0;
	
	
	
	if(isset($_REQUEST['Escape']) && $_REQUEST['Escape']!="")
	{
		$_SESSION['as']=1;
		$page_refer="resume/".$_REQUEST['Escape'];
		?>
			<script>
				location.href="<?php echo base_url.$page_refer; ?>";
			</script>
		<?php
		die();
	}
	else
	{
		$title = 'auto';
		$id = false;
		$award=addslashes($_POST['award']);
		$award_id=$_POST['award_id'];
		$page_refer=$_POST['page_refer'];
		$description=addslashes($_POST['description']);
		$uploadDir = 'uploads/';
		$realUploadDir = '../uploads/';
		$post_title="Updated awards";
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
			$award_query="INSERT INTO users_awards SET title='$award',user_id='".$_COOKIE['uid']."',description='$description',status=1,added=NOW()";
			if($award_id!="")
			{
				$award_query="UPDATE users_awards SET title='$award',user_id='".$_COOKIE['uid']."',description='$description',status=1,added=NOW() WHERE id='$award_id'";
			}
			
			$query=$DB->query($award_query);
			if($award_id=="")
			{
				$award_id=mysqli_insert_id($DB);
			}
			foreach($data['files'] as $item)
			{
				$title = $DB->real_escape_string($item['name']);
				$type = $DB->real_escape_string($item['type']);
				$size = $DB->real_escape_string($item['size']);
				$file = $DB->real_escape_string($uploadDir . $item['name']);
				
				$query = $DB->query("INSERT INTO gallery(`award_id`,`title`, `file`, `type`, `size`, `index`, `date`, `user_id`, `is_main`) VALUES('$award_id','$title', '$file', '$type', '$size', 1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g WHERE user_id='".$_COOKIE['uid']."'), -1)), NOW(),'".$_COOKIE['uid']."',0)");
				
				$media_id=mysqli_insert_id($DB);
				
				$query = $DB->query("INSERT INTO users_award_media SET user_id='".$_COOKIE['uid']."',added=NOW(),award_id='$award_id',media_file='$media_id'");
			}
			?>
				<script>
					location.href="<?php echo base_url.$page_refer; ?>";
				</script>
			<?php
		}
		if($data['hasWarnings']) {
		   
				$_SESSION['as']=1;
			
			?>
				<script>
					location.href="<?php echo base_url.$page_refer; ?>";
				</script>
			<?php
		}
	}