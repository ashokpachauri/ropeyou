<?php
    include('../../../src/php/class.fileuploader.php');
	$page_refer=false;
	define("base_url","https://ropeyou.com/cut/");
	if(isset($_POST['page_refer']))
	{
		$page_refer=$_POST['page_refer'];
	}
	$id=false;
	if($page_refer===false)
	{
		?>
		<script>
			location.href="<?php echo base_url; ?>404";
		</script>
		<?php
		die();
	}
	$DB = mysqli_connect('localhost', 'ropeyou', 'ropeyou#2019', 'ropeyou');
    $FileUploader = new FileUploader('files', array(
        'limit' => null,
        'maxSize' => null,
		'fileMaxSize' => null,
        'extensions' => null,
        'required' => false,
        'uploadDir' => '../../../../uploads/',
        'title' => 'name',
		'replace' => false,
		'editor' => array(
			'maxWidth' => 640,
			'maxHeight' => 480,
			'quality' => 90
		),
        'listInput' => true,
        'files' => null
    ));
	
	foreach($FileUploader->getRemovedFiles('file') as $key=>$value) {
		unlink('../uploads/' . $value['name']);
	}
	
    $upload = $FileUploader->upload();
	if (count($upload['files']) == 1) {
		$item = $upload['files'][0];
		$title = $DB->real_escape_string($item['name']);
		$type = $DB->real_escape_string($item['type']);
		$size = $DB->real_escape_string($item['size']);
		$file = $DB->real_escape_string($uploadDir . $item['name']);
		$cv_description="Profile CV";
		
		if (!$id)
			$query = $DB->query("INSERT INTO users_video_cv SET user_id='".$_COOKIE['uid']."',cv_title='title',cv_description='$cv_description',cv_file='uploads/".$file."',status=1,added=NOW()");
		else
			$query = $DB->query("INSERT INTO users_video_cv SET cv_title='title',cv_description='$cv_description',cv_file='uploads/".$file."',status=1,added=NOW() WHERE user_id='".$_COOKIE['uid']."'");
		
		if ($id || $query) {
			 ?>
				<script>
					location.href="<?php echo base_url.$page_refer; ?>?success";
				</script>
			<?php
			die();
		} else {
			?>
				<script>
					location.href="<?php echo base_url.$page_refer; ?>?error";
				</script>
			<?php
			die();
		}
	}
	else{
		?>
			<script>
				location.href="<?php echo base_url.$page_refer; ?>?error";
			</script>
		<?php
		die();
	}
?>