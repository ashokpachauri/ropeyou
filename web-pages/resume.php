<?php include_once 'resume-master.php'; ?>
<!DOCTYPE html>
<html lang="en" id="source-html">
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<meta property="og:url" content="<?php echo base_url."resume/".$_username; ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="<?php echo "{$_WEB_AUTHOR}"; ?> - <?php echo "{$_WEB_DESIGNATION}"; ?> Powered by @RopeYou Connects" />
		<meta property="og:description" content="<?php echo @strip_tags($_WEB_AUTHOR_ABOUT); ?>" />
		<meta property="og:image" content="<?php echo "{$_WEB_AUTHOR_IMAGE}";?>"/>
		<meta property="fb:app_id" content="465307587452391"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
		<meta name="author" content="RopeYou Connects,<?php echo "{$_WEB_AUTHOR}"; ?>,<?php echo "{$_WEB_DESIGNATION}"; ?> #xboyonweb #xgirlonweb"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>
		<title><?php echo "{$_WEB_AUTHOR}"; ?> :: RUResume</title>
		<?php //include_once "simple/".$_theme_selected."/resume-head.php"; ?>
	</head>
	<body>
		<?php
			//include_once '../libs/word-proccessor/samples/Sample_Header.php';
			require_once __DIR__ . '/../libs/word-proccessor/bootstrap.php';
			$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('simple/'.$_theme_selected.'/resume_template_'.$_theme_selected.'.docx');
			$templateProcessor->setValue('_WEB_AUTHOR', $_WEB_AUTHOR);
			$templateProcessor->setImageValue('_WEB_AUTHOR_IMAGE', $_WEB_AUTHOR_IMAGE);
			$about_me_title="PROFILE";

			/******************************** PUBLISHING KEY SKILLS ******************************************************/
			$key_skills_heading="KEY SKILLS";
			$_WEB_KS_COUNT=0;
			if($_personal_skills)
			{
				foreach($_personal_skills as $_personal_skill)
				{
					if($_personal_skill!=null && !empty($_personal_skill))
					{
						$_WEB_KS_COUNT=$_WEB_KS_COUNT+1;
					}
				}	
			}
			if($_WEB_KS_COUNT>0)
			{
				$templateProcessor->cloneBlock('KSH-COPY',1);
				$templateProcessor->cloneBlock('KS-COPY',$_WEB_KS_COUNT,true,true);
				$templateProcessor->setValue('_WEB_KEYSKILLS_HEADING', $key_skills_heading);
				$_WEB_KS_COUNTER=0;
				foreach($_personal_skills as $_personal_skill)
				{
					if($_personal_skill!=null && !empty($_personal_skill))
					{
						$_WEB_KS_COUNTER=$_WEB_KS_COUNTER+1;
						$_WEB_SKILLS=$_personal_skill['skill'];
						$_WEB_SKILLS_PROF=$_personal_skill['proficiency']."%";
						$templateProcessor->setValue('_WEB_SKILLS#'.$_WEB_KS_COUNTER,$_WEB_SKILLS);
						$templateProcessor->setValue('_WEB_SKILLS_PROF#'.$_WEB_KS_COUNTER,$_WEB_SKILLS_PROF);
					}
				}
			}
			else
			{
				$templateProcessor->deleteBlock('KSH-COPY');
				$templateProcessor->deleteBlock('KS-COPY');
			}

			/******************************** PUBLISHING Personal Information ******************************************************/
			$templateProcessor->setValue('_WEB_AUTHOR_EMAIL', $_WEB_COMMUNICATION_EMAIL);
			$templateProcessor->setValue('_WEB_AUTHOR_MOBILE', $_WEB_COMMUNICATION_MOBILE);
			$templateProcessor->setValue('_WEB_AUTHOR_ADDRESS', $_WEB_COMMUNICATION_ADDRESS);
			$templateProcessor->setValue('_WEB_PASSPORT', $_WEB_PASSPORT);
			$templateProcessor->setValue('_WEB_RELOCATE_ABROAD', $_WEB_RELOCATE_ABROAD);
			$templateProcessor->setValue('_WEB_COPYRIGHT_STATEMENT', '© RUResume Powered by ROPEYOU CONNECTS');
			$templateProcessor->setValue('_WEB_DESIGNATION', 'Blogger, Poet, Software Developer');
			$templateProcessor->setValue('_WEB_ABOUT_ME', strip_tags($_WEB_AUTHOR_ABOUT));
			$templateProcessor->setValue('_WEB_ABOUT_HEADING', $about_me_title);


			/******************************** PUBLISHING EXPERIENCES ******************************************************/

			$_WEB_EXP_COUNT=0;
			foreach($_WEB_EXP as $experience){
				if(!empty($experience)){
					$_WEB_EXP_COUNT=$_WEB_EXP_COUNT+1;
				}
			}
			if($_WEB_EXP_COUNT>0)
			{
				$templateProcessor->cloneBlock('EXP-COPY',$_WEB_EXP_COUNT,true,true);
				$_WEB_EXP_COUNTER=0;
				foreach($_WEB_EXP as $experience){
					if(!empty($experience)){
						$_WEB_EXPERIENCE_TITLE=$experience['designation']['title'];
						$_WEB_EXPERIENCE_COMPANY=$experience['company']['title'];
						if(!!$experience['company']['city'])
						{
							$_WEB_EXPERIENCE_COMPANY.=", ".$experience['company']['city']['title'];
						}
						if(!!$experience['company']['city']['state'])
						{
							$_WEB_EXPERIENCE_COMPANY.=", ".$experience['company']['city']['state']['title'];
						}
						if(!!$experience['company']['city']['country'])
						{
							$_WEB_EXPERIENCE_COMPANY.=", ".$experience['company']['city']['country']['title'];
						}
						$_WEB_EXPERIENCE_COMPANY_WEBSITE="";
						if(isset($experience['website'])){
							$_WEB_EXPERIENCE_COMPANY_WEBSITE=$experience['website'];
						}
						$_WEB_EXPERIENCE_DURATION=$experience['duration'];
						$_WEB_EXPERIENCE_DESCRIPTION=strip_tags($experience['description']);
						$_WEB_EXP_COUNTER=$_WEB_EXP_COUNTER+1;
						$templateProcessor->setValue('_WEB_EXP_COUNT#'.$_WEB_EXP_COUNTER,$_WEB_EXP_COUNTER);
						$templateProcessor->setValue('_WEB_EXPERIENCE_TITLE#'.$_WEB_EXP_COUNTER,$_WEB_EXPERIENCE_TITLE);
						$templateProcessor->setValue('_WEB_EXPERIENCE_COMPANY#'.$_WEB_EXP_COUNTER,$_WEB_EXPERIENCE_COMPANY);
						$templateProcessor->setValue('_WEB_EXPERIENCE_DURATION#'.$_WEB_EXP_COUNTER, $_WEB_EXPERIENCE_DURATION);
						$templateProcessor->setValue('_WEB_EXPERIENCE_COMPANY_WEBSITE#'.$_WEB_EXP_COUNTER,$_WEB_EXPERIENCE_COMPANY_WEBSITE);
						$templateProcessor->setValue('_WEB_EXPERIENCE_DESIGNATION#'.$_WEB_EXP_COUNTER, $_WEB_EXPERIENCE_TITLE);
						$templateProcessor->setValue('_WEB_EXPERIENCE_DESCRIPTION#'.$_WEB_EXP_COUNTER,$_WEB_EXPERIENCE_DESCRIPTION);
					}
				}
			}
			else{
				$templateProcessor->deleteBlock('EXP-COPY');
			}
			/******************************** PUBLISHING EDUCATION ******************************************************/

			$templateProcessor->setValue('_WEB_EDU_HEADING',"EDUCATION");
			$_WEB_EDU_COUNT=0;
			foreach($_WEB_EDU as $education){
				if(!empty($education)){
					$_WEB_EDU_COUNT=$_WEB_EDU_COUNT+1;
				}
			}
			if($_WEB_EDU_COUNT>0)
			{
				$templateProcessor->cloneBlock('EDU-COPY',$_WEB_EDU_COUNT,true,true);
				$_WEB_EDU_COUNTER=0;
				foreach($_WEB_EDU as $education){
					if(!empty($education)){
						$_WEB_EDU_TITLE=$education['course']['title'];
						$_WEB_EDU_UNIVERSITY=$education['university']['title'];
						if(!!$education['university']['city'])
						{
							$_WEB_EDU_UNIVERSITY.=", ".$education['university']['city']['title'];
						}
						if(!!$education['university']['city']['state'])
						{
							$_WEB_EDU_UNIVERSITY.=", ".$education['university']['city']['state']['title'];
						}
						if(!!$education['university']['city']['country'])
						{
							$_WEB_EDU_UNIVERSITY.=", ".$education['university']['city']['country']['title'];
						}
						$_WEB_EXPERIENCE_COMPANY_WEBSITE="";
						if(isset($education['website'])){
							$_WEB_EDU_WEBSITE=$education['website'];
						}
						$_WEB_EDU_DURATION=$education['duration'];
						$_WEB_EDU_DESCRIPTION=strip_tags($education['description']);
						$_WEB_EDU_COUNTER=$_WEB_EDU_COUNTER+1;
						$templateProcessor->setValue('_WEB_EDU_TITLE#'.$_WEB_EDU_COUNTER,$_WEB_EDU_TITLE);
						$templateProcessor->setValue('_WEB_EDU_UNIVERSITY#'.$_WEB_EDU_COUNTER,$_WEB_EDU_UNIVERSITY);
						$templateProcessor->setValue('_WEB_EDU_DURATION#'.$_WEB_EDU_COUNTER, $_WEB_EDU_DURATION);
						$templateProcessor->setValue('_WEB_EDU_DESCRIPTION#'.$_WEB_EDU_COUNTER,$_WEB_EDU_DESCRIPTION);
					}
				}
			}
			else{
				$templateProcessor->deleteBlock('EDU-COPY');
			}

			/******************************** PUBLISHING Technical Skills *************************************/
			$tech_skills_heading="PROFESSIONAL SKILLS";
			$_WEB_TS_COUNT=0;
			if($_professional_skills)
			{
				foreach($_professional_skills as $_professional_skill)
				{
					if($_professional_skill!=null && !empty($_professional_skill))
					{
						$_WEB_TS_COUNT=$_WEB_TS_COUNT+1;
					}
				}	
			}
			if($_WEB_TS_COUNT>0)
			{
				$templateProcessor->cloneBlock('TSH-COPY',1);
				$templateProcessor->cloneBlock('TS-COPY',$_WEB_TS_COUNT,true,true);
				$templateProcessor->setValue('_WEB_TSKILLS_HEADING', $tech_skills_heading);
				$_WEB_TS_COUNTER=0;
				foreach($_professional_skills as $_professional_skill)
				{
					if($_professional_skill!=null && !empty($_professional_skill))
					{
						$_WEB_TS_COUNTER=$_WEB_TS_COUNTER+1;
						$_WEB_TSKILLS=$_professional_skill['skill'];
						$_WEB_TSKILLS_PROF=$_professional_skill['proficiency']."%";
						$templateProcessor->setValue('_WEB_TSKILLS#'.$_WEB_TS_COUNTER,$_WEB_TSKILLS);
						$templateProcessor->setValue('_WEB_TSKILLS_PROF#'.$_WEB_TS_COUNTER,$_WEB_TSKILLS_PROF);
					}
				}
			}
			else
			{
				$templateProcessor->deleteBlock('TSH-COPY');
				$templateProcessor->deleteBlock('TS-COPY');
			}

			/******************************** PUBLISHING Technical Skills *************************************/
			$languages_heading="LANGUAGES";
			$_WEB_LS_COUNT=0;
			if($_languages)
			{
				foreach($_languages as $_language)
				{
					if($_language!=null && !empty($_language))
					{
						$_WEB_LS_COUNT=$_WEB_LS_COUNT+1;
					}
				}	
			}
			if($_WEB_LS_COUNT>0)
			{
				$templateProcessor->cloneBlock('LSH-COPY',1);
				$templateProcessor->cloneBlock('LS-COPY',$_WEB_LS_COUNT,true,true);
				$templateProcessor->setValue('_WEB_LSKILLS_HEADING', $languages_heading);
				$_WEB_LS_COUNTER=0;
				foreach($_languages as $_language)
				{
					if($_language!=null && !empty($_language))
					{
						$_WEB_LS_COUNTER=$_WEB_LS_COUNTER+1;
						$_WEB_LSKILLS=$_language['skill'];
						$_WEB_LSKILLS_PROF=$_language['proficiency']."%";
						$templateProcessor->setValue('_WEB_LSKILLS#'.$_WEB_LS_COUNTER,$_WEB_LSKILLS);
						$templateProcessor->setValue('_WEB_LSKILLS_PROF#'.$_WEB_LS_COUNTER,$_WEB_LSKILLS_PROF);
					}
				}
			}
			else
			{
				$templateProcessor->deleteBlock('LSH-COPY');
				$templateProcessor->deleteBlock('LS-COPY');
			}

			/******************************** PUBLISHING INTERESTS *************************************/
			$interests_heading="INTERESTS";
			$_WEB_IS_COUNT=0;
			if($_WEB_INTERESTS && !empty($_WEB_INTERESTS))
			{
				foreach($_WEB_INTERESTS as $_WEB_INTEREST)
				{
					if($_WEB_INTEREST!=null && !empty($_WEB_INTEREST))
					{
						$_WEB_IS_COUNT=$_WEB_IS_COUNT+1;
					}
				}	
			}
			if($_WEB_IS_COUNT>0)
			{
				$templateProcessor->cloneBlock('WEB-INT-H',1);
				$templateProcessor->cloneBlock('WEB_INTEREST',$_WEB_IS_COUNT,true,true);
				$templateProcessor->setValue('_WEB_INTERESTS_HEADING', $interests_heading);
				$_WEB_IS_COUNTER=0;
				foreach($_WEB_INTERESTS as $_WEB_INTEREST)
				{
					if($_WEB_INTEREST!=null && !empty($_WEB_INTEREST))
					{
						$_WEB_IS_COUNTER=$_WEB_IS_COUNTER+1;
						$_WEB_INT=$_WEB_INTEREST['interests']['title'];
						$templateProcessor->setValue('_WEB_INT#'.$_WEB_IS_COUNTER,$_WEB_INT);
					}
				}
			}
			else
			{
				$templateProcessor->deleteBlock('WEB-INT-H');
				$templateProcessor->deleteBlock('WEB_INTEREST');
			}
			$doc=time().".docx";
			/*--------------------------- PUBLISHING DOCUMENT & SAVING INTO DIR -----------------------*/
			$templateProcessor->saveAs('simple/'.$_theme_selected.'/'.$doc.'');
			$post_media=urlencode('https://ropeyou.com/cut/web-pages/simple/'.$_theme_selected.'/'.$doc);
			?>
			<iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $post_media; ?>" frameborder="no" style="width:100%;height:500px"></iframe>
	</body>
</html>