function validate() {
	var $valid = true;
	document.getElementById("user_info").innerHTML = "";
	document.getElementById("password_info").innerHTML = "";

	var userName = document.getElementById("login-form").elements.namedItem("tscNo").value;
	var password = document.getElementById("login-form").elements.namedItem("password").value;

	if (userName == null || userName == "") {
		document.getElementById("user_info").innerHTML = "Tsc number cannot be empty!";
		$valid = false;
	}

	if (password == null || password == "") {
		document.getElementById("password_info").innerHTML = "Password cannot be empty!";
		$valid = false;
	}
	return $valid;
}