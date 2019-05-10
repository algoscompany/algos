const token = null;

function getToken(){
	if(this.token == null){
		let em = document.getElementById("inputIconEx1").value;
		if(em != ""){
			let json = JSON.stringify(
				{'email': em}
			);
			getResource("getPasswordToken", json)
			.then(function(token){
				let obj = JSON.parse(token);
				this.token = obj.token;
				//console.log(this.token);//
			})
			.catch(console.error);
		}
	}
	return this.token;
}

function checkLogin(){
	let btn = document.forms[0][3];
	btn.disabled = true;

	let em = document.forms[0][0].value;
	let pw = document.forms[0][1].value;

	if((em != null) && (pw != null)){
		let key = CryptoJS.MD5(em + getToken() + CryptoJS.MD5(pw).toString()).toString();
		let remMe = $('#rememberMeButton').prop("checked");
		let json = JSON.stringify(
			{
				'email': em,
				'key': key,
				'rememberMe' : remMe
			}
		);

		getResource("login", json)
		.then((json) => {
			let res = JSON.parse(json).result;
			if(res == "ok")
				redirectPage("home-page");
			else{
				alert("controlla i dati inseriti");
				btn.disabled = false;
			}
		})
		.catch((err) => {
			btn.disabled = false;
			console.error(err);
		})
	}
	return false;
}
