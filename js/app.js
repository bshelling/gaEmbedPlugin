jQuery(document).ready(function($){
		console.log("Loaded");
		var textArea = $("#gaCode");
		var submitBtn = $("#submitCode");
		var removeBtn = $("#removeCode");
		var statusBox = $("#status");

		if(textArea.val() != ""){
			textArea.css("display","none");
			$("#inputLabel").css("display","none");
			statusBox.css("display","block");
			statusBox.css({
				    "width":"500px",
				    "display": "block",
				    "background-color": "#fff",
				    "border": "1px solid rgba(167, 167, 167, 0.611765)",
				    "padding": "15px",
				    "margin-right": "75%",
				    "color": "#444",
				    "font-size": "1rem"
			});
			submitBtn.css("display","none");

			statusBox.text($.trim(textArea.val()));
		}
		else{
			$("#inputLabel").css("display","block");
			removeBtn.css("display","none");
			statusBox.css("display","none");
		}

		removeBtn.on("click",function(e){
			e.preventDefault();
			$("#inputLabel").css("display","block");
			statusBox.slideUp();
			textArea.slideDown();
			submitBtn.css("display","block");
			submitBtn.val("Save Analytics Code");
			$(this).css("display","none");
		});

	});