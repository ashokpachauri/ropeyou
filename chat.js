(function(){
  var base_url=localStorage.getItem("base_url");
  var r_user_id =localStorage.getItem('r_user_id ');
  var chat = {
    messageToSend: '',
	messageSenderName:'',
	messageSenderImage:'',
	r_user_id:'',
	s_user_id:'',
	messageStatus:'Sent',
	base_url:localStorage.getItem("base_url"),
	
    messageResponses: [
		"","",""
    ],
	fetchMessages:function(){
		var ajax_get_messages = function(selected_user="") {
			if(selected_user=="")
			{
				selected_user=$("#message_box_button").attr("data-ruid").trim();
			}
			//console.log(selected_user);
			$.ajax({
				type:'POST',
				url: base_url+"messenger-api",
				data:{endpoint:"get_messages_as_per_user",r_user_id:selected_user},
				success:function(data){
					var parsedJson=JSON.parse(data);
					var message_transaction_data=parsedJson.message_transaction_data;
					if(parsedJson.status=="success")
					{
						//console.log(parsedJson);
						if(parseInt(parsedJson.sound_to_play)==1)
						{
							playSound();
						}
						if(parsedJson.data!="")
						{
							$("#chat_history").append(parsedJson.data);
						}
						$("#message_box_button").attr("data-ruid",selected_user);
						$("#message_transaction_data_"+r_user_id).html(message_transaction_data);
					}
					else
					{
						//console.log(parsedJson);
					}
				}
			});
		}
		var interval = 1000 * 60 * 0.3;
		setInterval(ajax_get_messages, interval);
	},
    init: function() {
      this.cacheDOM();
      this.bindEvents();
      this.render();
	  this.fetchMessages();
	  this.scrollToBottom();
    },
    cacheDOM: function() {
      this.$chatHistory = $('.chat-history');
      this.$button = $('#message_box_button');
      this.$textarea = $('#message_box');
      this.$chatHistoryList =  this.$chatHistory.find('#chat_history');//ul
    },
    bindEvents: function() {
      this.$button.on('click', this.addMessage.bind(this));
      this.$textarea.on('keyup', this.addMessageEnter.bind(this));
    },
    render: function() {
      this.scrollToBottom();
      if (this.messageToSend.trim() !== '') {
        var template = Handlebars.compile( $("#message-template").html());
        var context = { 
          messageOutput: this.messageToSend,
          time: this.getCurrentTime(),
		  messageSenderImage:this.messageSenderImage,
		  r_user_id:this.r_user_id,
		  s_user_id:this.s_user_id,
		  messageSenderName:this.messageSenderName,
		  messageStatus:'Sent'
        };

        this.$chatHistoryList.append(template(context));
        this.scrollToBottom();
        this.$textarea.val('');
        
        // responses
        var templateResponse = Handlebars.compile( $("#message-response-template").html());
        var contextResponse = { 
          response: this.getRandomItem(this.messageResponses),
          time: this.getCurrentTime()
        };
        
        setTimeout(function() {
          //this.$chatHistoryList.append(templateResponse(contextResponse));
          this.scrollToBottom();
        }.bind(this), 1500);
        
      }
      
    },
    addMessage: function() {
		this.messageToSend = this.$textarea.val().trim();
		this.messageSenderName = $("#message_box_button").attr("data-msnm").trim();
		this.messageSenderImage = $("#message_box_button").attr("data-suimg").trim();
		this.r_user_id=$("#message_box_button").attr("data-ruid").trim();
		this.s_user_id=$("#message_box_button").attr("data-suid").trim();
		if(this.messageToSend!="" && this.messageSenderImage!="" && this.r_user_id!="" && this.s_user_id!="")
		{
			this.render();  
			$.ajax({
				type:'POST',
				url: base_url+"send-message",
				data:{r_user_id:this.r_user_id,s_user_id:this.s_user_id,s_user_img:this.messageSenderImage,page_refer:"messenger",text_message:this.messageToSend},
				success:function(data){
					var parsedJson=JSON.parse(data);
					if(parsedJson.status=="success")
					{
						//this.messageStatus
						//$("#message_box").val('');
						//$("#messages_stack").html(parsedJson.data);
					}
					else
					{
						//$("#message_box").val('');
						/*swal({
						  title: "Attention!",
						  text: parsedJson.message,
						  icon: "error",
						  buttons: {
							cancel: false,
							confirm: "Close",
						  },
						  dangerMode: false,
						});*/
					}
				}
			});
		}
		else
		{
			swal({
			  title: "Attention!",
			  text: "Blank messages are not allowed.",
			  icon: "error",
			  buttons: {
				cancel: false,
				confirm: "Close",
			  },
			  dangerMode: false,
			});
		}       
    },
    addMessageEnter: function(event) {
        // enter was pressed
        if (event.keyCode === 13) {
          this.addMessage();
        }
    },
    scrollToBottom: function() {
       this.$chatHistory.scrollTop($("#chat_history")[0].scrollHeight);
    },
    getCurrentTime: function() {
      return new Date().toLocaleTimeString().
              replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
    },
    getRandomItem: function(arr) {
      return arr[Math.floor(Math.random()*arr.length)];
    }
    
  };
  
  chat.init();
  
  var searchFilter = {
    options: { valueNames: ['name'] },
    init: function() {
      var userList = new List('people-list', this.options);
      var noItems = $('<div class="p-3 d-flex align-items-center border-bottom osahan-post-header overflow-hidden" style="cursor:pointer;" id="no-items-found">'+
	'<div class="font-weight-bold mr-1 overflow-hidden">'+'<div class="text-truncate name">Nothing Found</div>'+'</div>'+'</div>');
      
      userList.on('updated', function(list) {
        if (list.matchingItems.length === 0) {
          $(list.list).append(noItems);
        } else {
          noItems.detach();
        }
      });
    }
  };
  
  searchFilter.init();
  
})();