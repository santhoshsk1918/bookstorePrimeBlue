window.onload = initPage;

function initPage() {
  document.getElementById("username").onblur = checkUsername;
  document.getElementById("email").onblur = checkemail;
  document.getElementById("pass2").onblur = checkPassword;
 // document.getElementById("signupbtn").disabled = true;
}

function checkUsername() {
	var theName = document.getElementById("username").value;
	if(theName == ""){
	document.getElementById("unamestatus").innerHTML = "please enter username";
	}else{
  document.getElementById("unamestatus").innerHTML = "Checking...";
  request = createRequest();
  if (request == null)
    alert("Unable to create request");
  else {
    
    var username = escape(theName);
    var url= "register/checkName.php?username=" + username;
    request.onreadystatechange = showUsernameStatus;
    request.open("GET", url, true);
    request.send(null);
  }
}
}

function showUsernameStatus() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      if (request.responseText == "okay") {
        document.getElementById("unamestatus").innerHTML = "Username Available!!";
		//usernameValid = true;
        
      } else {
        document.getElementById("unamestatus").innerHTML = request.responseText ;
        document.getElementById("username").focus();
        document.getElementById("username").select();
		//usernameValid = false;
       
      }
    }
  }
}
function checkemail() {
	var useremail  = document.getElementById("email").value;
	if(useremail == ""){
	document.getElementById("emailstatus").innerHTML = "please enter email";
	}else{
	  document.getElementById("emailstatus").innerHTML = "Checking...";
	  emailrequest = createRequest();
	  if (emailrequest == null)
		alert("Unable to create request");
	  else {
		
		
		var url= "register/checkemail.php?useremail=" + useremail;
		emailrequest.onreadystatechange = showemailStatus;
		emailrequest.open("GET", url, true);
		emailrequest.send(null);
		}
	}
}
function showemailStatus() {
  if (emailrequest.readyState == 4) {
    if (emailrequest.status == 200) {
      if (emailrequest.responseText == "okay") {
        document.getElementById("emailstatus").innerHTML = "Approved!!";
        
      } else {
        document.getElementById("emailstatus").innerHTML = emailrequest.responseText ;
        document.getElementById("email").focus();
        document.getElementById("email").select();
       
      }
    }
  }
}
function checkPassword() {
  var password1 = document.getElementById("pass1");
  var password2 = document.getElementById("pass2");
  var passstatus = document.getElementById("passstatus");
  passstatus.innerHTML = "Checking...";

  // First compare the two passwords
  if ((password1.value == "") || (password1.value != password2.value)) {
    passstatus.innerHTML = "Password Dont Match";
    return;
  } 

  // Passwords match, so send request to server
  passwordRequest = createRequest();
  if (passwordRequest == null) {
    alert("Unable to create request");
  } else {
    var password = escape(password1.value);
    var url = 'register/checkPass.php?password=' + password;
    passwordRequest.onreadystatechange = showPasswordStatus;
    passwordRequest.open('GET', url, true);
    passwordRequest.send(null);
  }
}

function showPasswordStatus() {
  if (passwordRequest.readyState == 4) {
    if (passwordRequest.status == 200) {
      var passstatus = document.getElementById("passstatus");
      if (passwordRequest.responseText == 'okay') {
       passstatus.innerHTML = "Approved!!";
       //passwordValid = true;
      } else {
       passstatus.innerHTML = passwordRequest.responseText;
		document.getElementById("pass1").focus();
        document.getElementById("pass1").select();
     //  passwordValid = false;
      }
      checkFormStatus();
    }
  }
}


/*function checkFormStatus() {
  if (usernameValid && passwordValid) {
    document.getElementById("signupbtn").disabled = false;
  } else {
    document.getElementById("signupbtn").disabled = true;
  }
}*/

function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
_(x).innerHTML = "";
}
function openTerms(){
_("terms").style.display = "block";
emptyElement("status");
}
function signup(){
//alert ("In Signup");

var u = _("username").value;
var e = _("email").value;
var p1 = _("pass1").value;
var p2 = _("pass2").value;
var g = _("gender").value;
var fn = _("fname").value;
var ln = _("lname").value;
var ph = _("phoneno").value;
var status = _("status");
if(u == "" || e == "" || p1 == "" || p2 == "" || g == "" || fn == "" || ln == "" || ph == ""){
status.innerHTML = "Fill out all of the form data";
} else if(p1 != p2){
status.innerHTML = "Your password fields do not match";
} else if( _("terms").style.display == "none"){
status.innerHTML = "Please view the terms of use";
}else{
	  _("signupbtn").style.display = "none";
	  registerRequest = createRequest();
	  if (registerRequest == null) {
			alert("Unable to create request.");
		} else {
				//alert ("Created Request.");
				var url = "register.php";
				var requestdata = "username=" + 
				escape(document.getElementById("username").value) + "&password=" +
				escape(document.getElementById("pass1").value) + "&fname=" +
				escape(document.getElementById("fname").value) + "&lname=" +
				escape(document.getElementById("lname").value) + "&email=" +
				escape(document.getElementById("email").value) + "&geder=" +
				escape(document.getElementById("gender").value) + "&phoneno=" +
				escape(document.getElementById("phoneno").value);
				registerRequest.onreadystatechange = registrationProcessed;
    			registerRequest.open('POST', url, true);
   				 registerRequest.setRequestHeader("Content-Type",
    			  "application/x-www-form-urlencoded");
   				 registerRequest.send(requestdata);
			}
	}
}
function registrationProcessed(){
	//alert('In Registration Prossed');
 if (registerRequest.readyState == 4) {
    if (registerRequest.status == 200) {
		
		if(registerRequest.responseText == "okay"){
		//window.scrollTo(0,0);
		document.getElementById("signupform").innerHTML="Thankyou for registering";
		}else{
			document.getElementById("signupform").innerHTML=registerRequest.responseText;
		}
	}
}
}
	

