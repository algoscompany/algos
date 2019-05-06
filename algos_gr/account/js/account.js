var userobj = null;
var isModified = false;

function getUserData(){
  let em = document.forms[0][0];
  let passw = document.forms[0][1];
  let nome = document.forms[0][2];
  let cognome = document.forms[0][3];

  getResource("getUtenteInfo")
  .then((json) => {
    let obj = JSON.parse(json);
    if(obj != "NULL"){
      userobj = obj;
      em.value = obj.email;
      nome.value = obj.nome;
      cognome.value = obj.cognome;
      userobj["password"] = "";
      fillAlert();
    }else {
      alert("Errore di caricamento");
    }
  })
  .catch((err) => {
    console.error(err);
    alert("Errore");
  })
}

function checkModified(pname, value){
  if(userobj[pname] == value)
    return false;
  else
    return true;
}

function checkChanged(o){
  let mod = checkModified(o.name, o.value);
  if(mod){
    this.isModified = true;
    document.forms[0][4].disabled = false;
  }
}

function updateUtenteInfo(){
  if(isModified){
    let em = document.forms[0][0].value;
    let passw = document.forms[0][1].value;
    let nome = document.forms[0][2].value;
    let cognome = document.forms[0][3].value;

    //conferma password
    if(passw != ""){
      let confPassw = window.prompt("Conferma la password:");
      if(confPassw == passw){
        //invio dati al server
        let json = JSON.stringify({
          "email": em,
          "nome": nome,
          "cognome": cognome,
          "password": passw
        });
        getResource("updateUtenteInfo", json)
        .then((json) => {
          let res = JSON.parse(json).result;
          if(res == "ok"){
          }else {
            redirectPage("home-page");
            alert("Errore in aggiornamento");
          }
        })
        .catch((err) => {
          alert("Errore generale");
          console.error(err);
        })
      }
    }else {
      alert("Inserisci una password");
    }
  }
  return false;
}

async function backButton(){
  if(isModified){
    let yes = window.confirm("Le modifiche effettuate andranno perse. Continuare?");
    if(yes)
      redirectPage("home-page");
  }else
    redirectPage("home-page");
}

function fillAlert(){
  let fn = $('#firstName');
  let ln = $('#lastName');

  if(fn.val() == "")
    $('#firstNameSpan').css('display', 'block');
  if(ln.val() == "")
    $('#lastNameSpan').css('display', 'block');
}

function hideFillAlrt(){
  let fn = $('#firstName');
  let ln = $('#lastName');

  if(fn.val() != "")
    $('#firstNameSpan').css('display', 'none');
  if(ln.val() != "")
    $('#lastNameSpan').css('display', 'none');
}
