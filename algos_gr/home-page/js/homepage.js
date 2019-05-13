var utenteInfo = null;
var news = null;
var newsByCategoria = null;
const nloadfuncs = 3;
var loadedfunc = 0;
//getUtenteInfo();	//risolvo immediatamente le info dell'utente

async function logout(){
	getResource("logout")
	.then((json) => {
		let res = JSON.parse(json).result;
		if(res == "ok"){
			redirectPage("login");
		}
		else
			alert("Logout non eseguito");
	})
	.catch((err) => {
		console.error(err);
	})
}

async function getUtenteInfo(u){
	if(utenteInfo == null || u == 'get'){
		console.log(u);
		await getResource("getUtenteInfo")
		.then((json) => {
			let obj = JSON.parse(json);
			if(obj != null){
				utenteInfo = obj;
			}
		})
		.catch((err) => {
			console.error(err);
		})
	}
	return utenteInfo;
}

async function getNews(){
	if(news == null){
		await getResource("getOverviewNotizie")
		.then((json) => {
			let obj = JSON.parse(json);
			if(obj != null){
				news = obj;
			}
		})
		.catch((err) => {
			console.error(err);
		})
	}
	return news;
}


async function setChart(){
	let obj = await getUtenteInfo();
	if(obj != null){
		myLineChart.data.datasets[0].data[0] = obj.eustress;
		myLineChart.data.datasets[0].data[1] = obj.distress;

		myLineChart.update();
		incLoadedFunc();
	}
}

async function updateChart(){
	await getUtenteInfo('get');
	setChart();
}

async function setNavBar(){
	let ui = await getUtenteInfo();
	if(ui != null){
		$("#profileButton").text(ui.nome).css("text-transform", "capitalize");
		if(ui.administrator)
			$("#administratorButton").show();

		incLoadedFunc();
	}
}

async function getNewsByCategoria(){
	if(newsByCategoria == null){
		let anews = await getNews();
		let cat = new Array();
		anews.forEach(function(entry){
//		if(!cat.includes(entry["categoria"])){
			if(!Object.keys(cat).includes(entry["categoria"])){
				cat[entry["categoria"]] = new Array();
			}
			cat[entry["categoria"]].push(entry);
		});
		newsByCategoria = cat;
	}
	return newsByCategoria;
}

async function initNewsCarousel(){
	let arr = await getNewsByCategoria();
	for(let key in arr) {
		let cts = cardToString(arr[key]);
		$('<div class="carousel-item">'+
				'<h4 class="text-center py-4">'+
					key +
				'</h4>'+
				'<div class="container">'+
					'<div class="card-columns">'+
						cts +
					'</div>'+
				'</div>'+
			'</div>').appendTo('.carousel-inner');

    $('<li data-target="#news-carousel" data-slide-to="' + key + '"></li>').appendTo('.carousel-indicators');
  }
  $('.carousel-item').first().addClass('active');
  $('.carousel-indicators > li').first().addClass('active');
  $('#news-carousel').carousel();
	incLoadedFunc();
}

function cardToString(arr){
	var str = '';
	arr.forEach(function(entry){
		str +=
		'<div class="card mb-4">'+
			'<div class="view overlay">'+
				'<img class="card-img-top" src="https://source.unsplash.com/category/nature,happy/287x191?sig='+entry['idNotizia']+'" alt="Card image cap">'+
			'</div>'+
			'<div class="card-body">'+
				'<h4 class="card-title">' + entry["titolo"] + '</h4>'+
				'<div class="card-body-algos">'+
					'<button type="button" class="btn btn-light-blue btn-md" onclick="openNotizia('+entry['idNotizia']+');">Scopri di piu\'\</button>'+
				'</div>'+
			'</div>'+
		'</div>';
	});
	return str;
}

function initHomePage(){
	//NB: se aggiungi una funzione da eseguire al caricamento della pagina,
	//ricordati di modificare in cima al file la costante nloadfuncs.
	setChart();
	setNavBar();
	initNewsCarousel();
	//non necessarie alla visualizzazione della pagina:
	initWsf();
}

function incLoadedFunc(){
	loadedfunc++;
	if(loadedfunc >= nloadfuncs)
		$("#overdiv").fadeOut(200, function(){
			$(this).remove();
		});
}

setTimeout(function(){
	if(loadedfunc < nloadfuncs)
		alert("Errore di caricamento o connessione lenta");
}, 6000);
