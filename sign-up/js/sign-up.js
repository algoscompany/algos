
function checkEmail(){
	let email = document.forms[0][0].value;

	let json = JSON.stringify(
		{
			'email' : email
		}
	);

	getResource("existEmail", json)
	.then(function(json){
		let res = JSON.parse(json).result;
		if(res == true){	//esiste la email?
			//segnala email esistente
			alert("email esistente, scegline un'altra");
		}
		else{
			//ok
		}
	})
	.catch(console.error);
}

function signUp(){
	let btn = document.forms[0][4];
	btn.disabled = true;

	let email = document.forms[0][0].value;
	let nome = document.forms[0][1].value;
	let cognome = '';
	let passw = document.forms[0][2].value;
	let confPassword = document.forms[0][3].value;

	if(passw != confPassword){
		alert("password diverse");
		return false;
	}

	let json = JSON.stringify(	//per il momento invio la password in chiaro
	{
		'email' : email,
		'nome' : nome,
		'cognome' : cognome,
		'password' : passw
	});
	getResource("registrazioneUtente", json)
	.then((json) => {
		let res = JSON.parse(json).result;
		if(res == "ok")
			redirectPage("home-page");
		else{
			alert("errore nella registrazione");
			btn.disabled = false;
		}
	})
	.catch((err) => {
		btn.disabled = false;
		console.error(err);
	})


	return false;
}
