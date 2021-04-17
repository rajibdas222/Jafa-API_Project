jQuery(document).ready(function($) {
	var support = 0;
	try {
	  var SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
	  var recognition = new SpeechRecognition();
	  var lang = 'ja-JP';
	  recognition.lang = lang;
	  support = 1;
	  // $(".microphone").removeClass('d-none').addClass('d-block');
	}
	catch(e) {
	  console.log(e);
	  support = 0;
	  $(".microphone").removeClass('d-block').addClass('d-none');
	}

	
	var noteTextarea = $('#product_keyword3');
	// var instructions = $('#recording-instructions');
	// var notesList = $('ul#notes');

	var noteContent = '';

	// Get all notes from previous sessions and display them.
	// var notes = getAllNotes();
	// renderNotes(notes);



	/*-----------------------------
	      Voice Recognition 
	------------------------------*/

	// If false, the recording will stop after a few seconds of silence.
	// When true, the silence period is longer (about 15 seconds),
	// allowing us to keep recording even when the user pauses. 
	// console.log(recognition);
	var userAgent = window.navigator.userAgent;

	if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i)) {
		$('.microphone').on('click', function(e) {
		  var timeleft = 200;
		  // var timeleft = 20;
		   speech_timer = setInterval(function(){
		    timeleft -= 1;
		   
		    var seconds = 2;
		    seconds = (timeleft/100);
		    // seconds = (timeleft/10);
		    var ss = seconds.toFixed(2).replace(".", ":");
		    // mil_seconds = (timeleft/100);
		    // if (mil_seconds == 2) {}
		     // console.log(ss);
		     // alert(ss);
		     // return false;
		    $(".second_countdown").text(ss);
		    // $(".second_countdown").text(timeleft);
		    // $("#mili_second_countdown").text(mil_seconds);
		    if (timeleft == 0) {
		    	$(".second_countdown").text('2:00');
		    	// $(".second_countdown").text('20');
		    	 noteTextarea.removeClass('disabled');
		    	 noteTextarea.attr('placeholder', '商品名か？バーコード入力か？');
		    	 noteTextarea.css("background-color", "white");
		    	$("#product_keyword3").val("");
		    	// $("#microphone_icon").removeClass('fa-microphone-alt').addClass('fa-microphone');
		    	clearInterval(speech_timer);
		    }
		  }, 100);
		});
	} else {
		if (support ==1) {
			recognition.continuous = true;

			// This block is called every time the Speech APi captures a line. 
			recognition.onresult = function(event) {

			// event is a SpeechRecognitionEvent object.
			// It holds all the lines we have captured so far. 
			// We only need the current one.
			var current = event.resultIndex;

			// Get a transcript of what was said.
			var transcript = event.results[current][0].transcript;

			// Add the current transcript to the contents of our Note.
			// There is a weird bug on mobile, where everything is repeated twice.
			// There is no official solution so far so we have to handle an edge case.
			var mobileRepeatBug = (current == 1 && transcript == event.results[0][0].transcript);

			if(!mobileRepeatBug) {
			noteContent = transcript;
			noteTextarea.css("background-color", "white");
			noteTextarea.val(noteContent);
			$(".voice_suggestion_screen").removeClass('d-none').addClass('d-block');

			$(".recording-instructions").html('<img style="display: block; margin-left: auto; margin-right: auto;" src="resource/img/ajax/Magnify-1s-200px.gif">');
			search_by_voice_keyword(noteContent);
			recognition.stop();
			clearInterval(speech_timer); // stop the interval
			}
		}
	   	
	};

	   	$('.microphone').on('click', function(e) {
	   	  if (noteContent.length) {
	   	    noteContent += ' ';
	   	  }
	   	  $(".voice_suggestion_screen").removeClass('d-block').addClass('d-none');
	   	  try {
				start_countdown()
	   	  }
	   	  catch(err) {
	   	  	console.log(err);
	   	    // document.getElementById("demo").innerHTML = err.message;
	   	  }
	   	  
	   	});


	   	$('#pause-record-btn').on('click', function(e) {
	   	  recognition.stop();
	   	  // instructions.text('Voice recognition paused.');
	   	});

	   	// Sync the text inside the text area with the noteContent variable.
	   	noteTextarea.on('input', function() {
	   	  noteContent = $(this).val();
	   	})

	   	$('#save-note-btn').on('click', function(e) {
	   	  recognition.stop();

	   	  if(!noteContent.length) {
	   	    // instructions.text('Could not save empty note. Please add a message to your note.');
	   	  }
	   	  else {
	   	    // Save note to localStorage.
	   	    // The key is the dateTime with seconds, the value is the content of the note.
	   	    saveNote(new Date().toLocaleString(), noteContent);

	   	    // Reset variables and update UI.
	   	    noteContent = '';
	   	    renderNotes(getAllNotes());
	   	    noteTextarea.val('');
	   	    instructions.text('Note saved successfully.');
	   	  }
	   	      
	   	})


	   	



	   	/*-----------------------------
	   	      Speech Synthesis 
	   	------------------------------*/

	   	
	   	var speech_timer = null;
	   	var running = 0;
	   	function start_countdown() {   		

	   		if (running==0) {
	   			var timeleft = 20;
	   			running = 1;
	   			
	   			 speech_timer = setInterval(function(){
	   			  timeleft -= 1;
	   			 // $(".voice_search_text").text('音声検索準備中');
	   			 $(".voice_search_text").text('AI音声検索準備中');
	   			  var seconds = 2;
	   			  seconds = (timeleft/10);
	   			  // var ss = seconds.toFixed(2).replace(".", ":");
	   			  var ss = seconds.toFixed(2);
	   			  mil_seconds = (timeleft/100);
	   			  // if (mil_seconds == 2) {}
	   			   // console.log(ss);
	   			   // alert(ss);
	   			   // return false;
	   			  $(".second_countdown").text(ss);
	   			  // $(".second_countdown").text(timeleft);
	   			  // $("#mili_second_countdown").text(mil_seconds);


	   			  if (timeleft == 0) {
	   			  	// $(".microphone_btn_mobile").css({"background": "#DB2A2A"});
	   			  	$(".microphone_icon").html('<img src="resource/img/ajax-loader.gif">');
	   			  	// $(".voice_small_text").text('※お話し下さい');
	   			  	$("#voice_image_cat").html('');
	   			  	$(".voice_small_text").text('');
	   			  	$(".voice_search_text").text('お話し下さい');
	   			  	$(".second_countdown").text('');

	   			  	// $(".voice_search_text").text('AI音声検索実行中');
	   			  	recognition.start();
	   			  	// $(".second_countdown").text('Start Now');
	   			  	var sTopleft = 20;
	   			  	stoper_timer = setInterval(function(){
	   			  		
	   			  		sTopleft -= 1;
	   			  		var seconds = 2;
	   			  		seconds = (sTopleft/10);
	   			  		// var ss = seconds.toFixed(2).replace(".", ":");
	   			  		var ss = seconds.toFixed(2);

	   			  		
	   			  		$(".second_countdown").text(ss);
	   			  		$(".mobile_hide_countdown").text(ss);
	   			  		var sTopseconds = (sTopleft/10);
	   			  		noteTextarea.css("background-color", "#F2D2F2");
	   			  		// noteTextarea.val("音声入力してください");
	   			  		noteTextarea.val("音声検索中");
	   			  		$(".mobile_hide_countdown").removeClass('d-none').addClass('d-block');
	   					noteTextarea.addClass('disabled');
	   			  		// sTopseconds = 
	   			  		if (sTopleft == 0) {
	   			  			running = 0;
	   			  			recognition.stop();
	   			  			$(".mobile_hide_countdown").removeClass('d-block').addClass('d-none');
	   			  			$(".microphone_btn_mobile").css({"background": "url('resource/img/AI音声検索.png')", "background-size": '100%', "background-repeat": "no-repeat"});
	   			  			$("#voice_image_cat").html('<img height="40" src="resource/img/voice.png">');
	   			  			$(".voice_search_text").text('AI音声検索');
	   			  			$(".voice_small_text").text('※ボタンを押して商品名をお話しください');
	   			  			clearInterval(stoper_timer);
	   			  			$(".microphone_icon").html('<i id="" class="fa fa-microphone-alt"></i>');
	   			  			$(".second_countdown").text('2.0');
	   			  			 noteTextarea.removeClass('disabled');
	   			  			 noteTextarea.attr('placeholder', '商品名か？バーコード入力か？');
	   			  			 noteTextarea.css("background-color", "white");
	   			  			$("#product_keyword3").val("");
	   			  			// alert("Finished");
	   			  		}
	   			  		
	   			  	}, 100)
	   			  	clearInterval(speech_timer);
	   			  }
	   			}, 100);
	   		}
	   		
	   	}

	   	function search_by_voice_keyword(keywords) {
	       	var base_url = $("#base_url").val();	  
	       	if (keywords !="") {
	   	    	$.ajax({
	   				url: base_url+'main_controller/get_yahoo_suggestion/',
	   				type: 'post',
	   				data: {keyword: keywords},
	   			})
	   			.done(function(data) {
	   				var sugg_response = JSON.parse(data);
	   				sugg_response = Object.values(sugg_response);
	   				if (sugg_response.length>0) {
	   					var html_string = "<div>";
	   					for (var i = 0; i < sugg_response.length; i++) {
	   						var voice_value = sugg_response[i].jan;
	   						if (voice_value == "") {
	   							voice_value = sugg_response[i].value;
	   						}
	   						html_string += "<div class='voice_product_list'>";
	   						html_string += "<a href='#' attr-data-label='"+sugg_response[i].label+"' attr-data-value='"+voice_value+"' class='voice_product_select'>"+sugg_response[i].label+"</a>";
	   						html_string += "</div>";
	   					}
	   					html_string += "</div>";
	   					$(".recording-instructions").html(html_string)
	   				}else{
	   					$(".recording-instructions").html("商品が一致しません。");
	   				}
	   				console.log(sugg_response);
	   			})
	   			.fail(function() {
	   				console.log("error");
	   			})
	   			.always(function() {
	   				console.log("complete");
	   			});
	       	} 
	   	}
	}
	

	
	
});
