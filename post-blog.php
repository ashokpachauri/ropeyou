<?php
	include_once 'connection.php';
	if(isset($_POST['post_blog']))
	{
		$title=$_POST['title'];
		$page_refer=$_POST['page_refer'];
		$description=addslashes($_POST['description']);
		$content=addslashes($_POST['content']);
		$tags=addslashes($_POST['tags']);
		$tmp=str_replace(" ","-",$title);
		$tmp=str_replace("'","_",$tmp);
		$tmp=str_replace("@rub","rub",$tmp);
		$blog_url="@rub-".$tmp."-".time();	
		$blog_url=strtolower($blog_url);
		$title=addslashes($title);		
		$query="INSERT INTO users_blogs SET user_id='".$_COOKIE['uid']."',title='$title',description='$description',content='$content',tags='$tags',blog_url='$blog_url',status=1,added=NOW()";
		if(mysqli_query($conn,$query))
		{
			$blog_id=mysqli_insert_id($conn);
			?>
			<script>
				location.href="<?php echo base_url.$blog_url; ?>";
			</script>
			<?php
		}
		else
		{
			//echo $query;
			//die();
			?>
			<script>
				location.href="<?php echo base_url.$page_refer; ?>?error";
			</script>
			<?php
		}
	}
	else
	{
		?>
		<script>
			location.href="<?php echo base_url; ?>404";
		</script>
		<?php
	}
?>