	/*  Wizard */
	jQuery(function ($) {
		"use strict";
		$('form#wrapped').attr('action', 'finalize.php');
		$("#wizard_container").wizard({
			stepsWrapper: "#wrapped",
			submit: ".submit",
			beforeSelect: function (event, state) {
				//console.log(event);
				//console.log(state);
				if ($('input#website').val().length != 0) {
					return false;
				}
				if (!state.isMovingForward)
					return true;
				var inputs = $(this).wizard('state').step.find(':input');
				if(!inputs.length || !!inputs.valid())
				{
					if(state.isMovingForward && state.stepIndex=="1")
					{
						var data_bool=saveBasicInformation(event,state);
						setTimeout(function(){ 
							return data_bool;
						},5000);
					}
					else if(state.isMovingForward && state.stepIndex=="2")
					{
						var data_bool=saveAboutInformation(event,state);
						setTimeout(function(){ 
							return data_bool;
						},5000);
					}
					else
					{
						return !inputs.length || !!inputs.valid();
					}
				}
				else
				{
					return !inputs.length || !!inputs.valid();
				}
			}
		}).validate({
			errorPlacement: function (error, element) {
				if (element.is(':radio') || element.is(':checkbox')) {
					error.insertBefore(element.next());
				} else {
					error.insertAfter(element);
				}
			}
		});
		var topic_arr=["Basic Information","Basic Information","Professional Experience","Academics","Skills","Resume","Contacts"];
		var topic_arr_1=["Please fill in the basic details to continue.","My life is my message. (Mahatma Gandhi)","No matter what you do, your job is to tell your story. (Gary Vaynerchuk)","Education is the key to unlock the golden door of freedom. (George Washington Carver)","Because the people who are crazy enough to think they can change the world, are the ones who do. (Steve Jobs)","This is not just the resume, but the evolution of passion throughout the years of diligent work to develop a professional reputation","Your network is your net-worth, please import your contacts"];
		//  progress bar
		$("#progressbar").progressbar();
		$("#wizard_container").wizard({
			afterSelect: function (event, state) {
				$("#progressbar").progressbar("value", state.percentComplete);
				$("#location").text("Step " + (parseInt(state.stepsComplete)+1) + " of " + (parseInt(state.stepsPossible)+1));
				$("#topic_heading").text(topic_arr[parseInt(state.stepsComplete)]);
				$("#topic_tagline").text(topic_arr_1[parseInt(state.stepsComplete)]);
			}
		});
		/* Submit loader mask */
		/*$('form').on('submit',function() {
			var form = $("form#wrapped");
			form.validate();
			if (form.valid()) {
				//$("#loader_form").fadeIn();
				$("#wrapped").submit();
			}
		});*/
	});