<?php
    include('../fileuploader/src/php/class.fileuploader.php');
	include_once '../connection.php';
	// initialize FileUploader
	$title = 'auto';
	$id = false;
	$client=addslashes($_POST['client']);
	$client_id=$_POST['client_id'];
	$page_refer=$_POST['page_refer'];
	$description=addslashes($_POST['description']);
	$uploadDir = 'uploads/';
	$realUploadDir = '../uploads/';
	$post_title="Updated clients";
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
		$client_query="INSERT INTO users_clients SET title='$client',user_id='".$_COOKIE['uid']."',description='$description',status=1,added=NOW()";
		if($client_id!="")
		{
			$client_query="UPDATE users_clients SET title='$client',user_id='".$_COOKIE['uid']."',description='$description',status=1,added=NOW() WHERE id='$client_id'";
		}
		
		$query=$DB->query($client_query);
		if($client_id=="")
		{
			$client_id=mysqli_insert_id($DB);
		}
		foreach($data['files'] as $item)
		{
			$title = $DB->real_escape_string($item['name']);
			$type = $DB->real_escape_string($item['type']);
			$size = $DB->real_escape_string($item['size']);
			$file = $DB->real_escape_string($uploadDir . $item['name']);
			
			$query = $DB->query("INSERT INTO gallery(`client_id`,`title`, `file`, `type`, `size`, `index`, `date`, `user_id`, `is_main`) VALUES('$client_id','$title', '$file', '$type', '$size', 1 + (SELECT IFNULL((SELECT MAX(`index`) FROM gallery g WHERE user_id='".$_COOKIE['uid']."'), -1)), NOW(),'".$_COOKIE['uid']."',0)");
			
			$media_id=mysqli_insert_id($DB);
			
			$query = $DB->query("INSERT INTO users_client_media SET user_id='".$_COOKIE['uid']."',added=NOW(),client_id='$client_id',media_file='$media_id'");
		}
		?>
			<script>
				location.href="<?php echo base_url.$page_refer; ?>";
			</script>
		<?php
    }
	if($data['hasWarnings']) {
       
		?>
			<script>
				location.href="<?php echo base_url.$page_refer; ?>";
			</script>
		<?php
    }