function emptyElement(x){
_(x).innerHTML = "";
}
function login(){
	var u = _("username").value;
	var p = _("password").value;
	if(e == "" || p == ""){
		_("status").innerHTML = "Fill out all of the form data";
	} else {
		_("loginbtn").style.display = "none";
		_("status").innerHTML = 'please wait ...';
		loginrequest = createRequest();
		if (request == null)
			alert("Unable to create request");
		else {
			var theName = document.getElementById("username").value;
			var username = escape(theName);
			var url= "login.php"
			request.onreadystatechange = showloginstatus;
			request.open("POST", url, true);
			request.send("u="+u+"&p="+p);
		}
	}
}

function showloginstatus(){
  if (request.readyState == 4) {
    if (request.status == 200) {
      if (request.responseText == "Login_Failed") {
		_("status").innerHTML = "Login unsuccessful, please try again.";
		_("loginbtn").style.display = "block";
	  }else{
		window.location = "profile.php?u="+ajax.responseText;
	  }
	 }
	}
}