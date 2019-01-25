const urlHost = "algos.altervista.org/server/gateway/Gateway.php";

function getFuncUrl(funcName){
  return urlHost + "?funcName=" + funcName;
}

function getResource(funcName, jsonToSend) {
	return new Promise(function(resolve, reject) {
		var httpReq = new XMLHttpRequest();
		httpReq.onreadystatechange = function() {
			var data;
			if (httpReq.readyState == 4) {
				if (httpReq.status == 200) {
					data = JSON.parse(httpReq.responseText);
					resolve(data);
				} else {
					reject(new Error(httpReq.statusText));
				}
			}
		};
    if(jsonToSend == null){
		  httpReq.open("GET", getFuncUrl() , true);
		  httpReq.send();
    }
    else{
      httpReq.open("POST", getFuncUrl() , true);
      httpReq.send("json=" + jsonToSend);
    }
	});
}

function getResource(funcName){
  return getResource(funcName, null);
}
