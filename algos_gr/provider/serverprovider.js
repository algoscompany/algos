//const urlHost = "http://algos.altervista.org/algoscl.php";
const urlHost = "http://algos.altervista.org/algoscl.php";
const timeout = 3000;	//3 sec

function getFuncUrl(funcName){
  return urlHost + "?funcName=" + funcName;
}

function getResource(funcName, jsonToSend) {
	return new Promise((resolve, reject) => {
		let httpReq = new XMLHttpRequest();

		setTimeout(function(){
			reject('408 Request Timeout');
		}, timeout);

		httpReq.onload = function(){
			if (httpReq.readyState == 4 && httpReq.status == 200) {
				resolve(httpReq.responseText);
			}else{
				reject(new Error(httpReq.status + " " + httpReq.statusText));
			}
		}
		httpReq.onerror = function(){
			reject(Error("Network Error"));
		}

		if(jsonToSend == null){
			httpReq.open("GET", getFuncUrl(funcName), true);
			httpReq.send();
		}
		else{
		  httpReq.open('POST', getFuncUrl(funcName), true);
		  httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		  httpReq.send("json="+jsonToSend);
		}

	});
}

/*
//esempio di invocazione senza json
getResource("prova")
  .then(func1)    //nome della funzione da eseguire una volta restituito il risultato
  .catch(errFunc) //nome della funzione da eseguire in caso di errore
*/
