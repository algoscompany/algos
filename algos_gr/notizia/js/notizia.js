
function openNotizia(id){
  let json = JSON.stringify({
    "idNotizia" : id
  });
  getResource("getNotizia", json)
  .then((json) => {
    let obj = JSON.parse(json);
    if(obj != null){
      $('#notiziaTitolo').text(obj['titolo']);
      $('#notiziaCorpo').text(obj['corpo']);
      $('#notiziaFonte').text(obj['fonte']);
      $('#notiziaCategoria').text(obj['categoria']);

      $('#notiziaModal').modal('show');
    }
  })
  .catch((err) => {
    console.error(err);
  })
}
