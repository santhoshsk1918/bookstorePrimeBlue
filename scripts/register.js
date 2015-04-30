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
function checkusername(){
var u = _("username").value;
if(u != ""){
	_("unamestatus").innerHTML = 'checking ...';
var ajax = ajaxObj("POST", "../register.php");
        ajax.onreadystatechange = function() {
       if(ajaxReturn(ajax) == true) {
           _("unamestatus").innerHTML = ajax.responseText;
       }
    }
        ajax.send("usernamecheck="+u);
}
}
function signup(){
var u = _("username").value;
var e = _("email").value;
var p1 = _("pass1").value;
var p2 = _("pass2").value;
var s = _("state").value;
var g = _("gender").value;
var fn = _("fname").value;
var ln = _("lname").value;
var ph = _("phoneno").value;
var status = _("status");
if(u == "" || e == "" || p1 == "" || p2 == "" || s == "" || g == "" || fn == "" || ln == "" || ph == ""){
status.innerHTML = "Fill out all of the form data";
} else if(p1 != p2){
status.innerHTML = "Your password fields do not match";
} else if( _("terms").style.display == "none"){
status.innerHTML = "Please view the terms of use";
} else {
_("signupbtn").style.display = "none";
status.innerHTML = 'please wait ...';
var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
       if(ajaxReturn(ajax) == true) {
           if(ajax.responseText != "signup_success"){
status.innerHTML = ajax.responseText;
_("signupbtn").style.display = "block";
} else {
window.scrollTo(0,0);
_("signupform").innerHTML = "Thankyou for Registering "+u <br />+"please check your email inbox at <u>"+e+"</u> in a moment to complete the sign up process by activating your account.";
}
       }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&s="+s+"&g="+g+"&fn="+fn"&ln="+ln"&ph="+pn);
}
}
function openTerms(){
_("terms").style.display = "block";
emptyElement("status");
}