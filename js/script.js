$(document).ready(function(){
 $("#rolling").slideDown('slow');
});
$(document).ready(function()
 {
	$("#submit").click(function()
		{
			if($("#uname").val()=="" || $("#pass").val()=="")
			{
				$("p").fadeTo('slow','0.99');
				$("msg").hide();
				$("p").fadeIn('slow',function(){$("p").html("<span class='display' id='error'>Harap isi username dan password.</span>");});
				return false;
			}
			else
			{
				$("p").html('<div class="display"><center><img src="img/loading-spiral.gif" height="19px"><center></div>');
				var uname = $("#uname").val();
				var pass = $("#pass").val();
					$.getJSON("api/server.php",{username:uname,password:pass},function(json)
					{
						// Parse JSON data if json.response.error = 1 then login successfull
						if(json.response.error == "1"){
							data = "<span class='display' id='msg'>Harap tunggu sebentar...</span>";
							setTimeout("location.href = '';",2000);
						}
						else{
							data = "<span class='display' id='error'>Username atau password salah.</span>";
						}
							$("p").fadeTo('slow','0.99');
							$("p").fadeIn('slow',function(){$("p").html("<span id='msg'>"+data+"</span>");});
					});
				return false;
			}
		}
	);

	$("#uname").focus(function(){
			$("p").fadeTo('slow','0.0',function(){$("p").html('');});
		}
	 );
	$("#pass").focus(function(){
			$("p").fadeTo('slow','0.0',function(){$("p").html('');});
		}
	);
});
