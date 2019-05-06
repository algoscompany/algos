var domande = null;
var testEffettuato = undefined;

async function getDomande(){
	if(domande == null){
		await getResource("getDomande")
		.then((json) => {
			let obj = JSON.parse(json).domande;
			if(obj != null){
				domande = obj;
			}
		})
		.catch((err) => {
			console.error(err);
		})
	}
	return domande;
}

async function initDomande(){
	let dom = await getDomande();
	if(dom != null){
		dom.forEach(function(entry){
			$('	<div class="form-group mb-4">'+
				  '<label for="formControlRange">' + entry['domanda'] + '</label>'+
					'<div class="row">' +
						'<div class="col-md-1">' +
							'<span id="demo_' + entry['idDomanda'] + '" class="fas fa-surprise"></span>' +
						'</div>' +
						'<div class="col-md">' +
						  '<input type="range" class="form-control-range" id="domanda_' +
							entry['idDomanda']+'" min=1 max=5 onchange="setValoreRisposta(this);"/>'+
						'</div>' +
					'</div>' +
				'</div>').appendTo('.domandelist');
		});
	}
}

async function commitTest(){
	$('#commitTestButton').prop("disabled", true);
	let dom = await getDomande();
	if(dom != null){
		//valori default e pulizia array per commit
		dom.forEach(function(entry){
			if(entry.hasOwnProperty("punteggio") == false)
				entry['punteggio'] = 3;
			else
				entry['punteggio'] = parseInt(entry['punteggio']);
			entry['domanda'] = undefined;
		});

		let json = JSON.stringify({
			"domande": dom
		});
		//commit valori
		getResource("rispondiDomande", json)
		.then((rjson) => {
			let res = JSON.parse(rjson).result;
			if(res == "ok"){
				$('#commitTestButton').fadeOut(50, function(){
					$(this).remove();
				});
				$('#testModal').modal('hide');
				setTestEffettuato();

				//// TODO: Aggiorna grafico eustress / distress
			}
		})
		.catch((err) => {
			alert("Errore di connessione");
			$('#commitTestButton').prop("disabled", false);
			$('#testModal').modal('hide');
			console.error(err);
		})
	}
}

async function setValoreRisposta(o){
	let dom = await getDomande();
	if(dom != null){
		let strid = o.id;
		let id = strid.substring(8, strid.length);
		dom[parseInt(id) - 1]['punteggio'] = o.value;
		domande = dom;

		let output = $('#demo_'+id);
		output.removeClass();
		switch(o.value){
			case '1':
				output.addClass('fas fa-frown');
				break;
			case '2':
				output.addClass('fas fa-meh');
				break;
			case '3':
				output.addClass('fas fa-surprise');
				break;
			case '4':
				output.addClass('fas fa-smile-beam');
				break;
			case '5':
				output.addClass('fas fa-grin-stars');
				break;
		}
	}
}

async function isTestEffettuato(){
	if(testEffettuato == undefined){
		await getResource("isTestEffettuato")
		.then((json) => {
			let res = JSON.parse(json).result;
			testEffettuato = res;
		})
		.catch((err) => {
			console.error(err);
		})
		return testEffettuato;
	}
}

function setTestEffettuato(){
	testEffettuato = true;
	$('#testButton').removeClass('markTestButton');
	$('.navbar-toggler').removeClass('markTestButton');
}

async function initPage(){
	let test = await isTestEffettuato();
	if(!test){
		$('#testButton').addClass('markTestButton');
		$('.navbar-toggler').addClass('markTestButton');
		initDomande();
	}

	$('#testModal').on('show.bs.modal', function(){
		if(testEffettuato){
			$('.domandelist').empty();

			$('<h4 class="text-center">Hai gia\' completato il test oggi!</h4><br/>' +
			'<p class="text-center">Ripassa domani.</p>').appendTo('.domandelist');

			$('#commitTestButton').remove();
		}
	});
}
