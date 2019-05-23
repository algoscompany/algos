
function openNotizia(id){
  let json = JSON.stringify({
    "idNotizia" : id
  });
  getResource("getNotizia", json)
  .then((json) => {
    console.log(json);
    let obj = JSON.parse(json);
    if(obj != null){
      $('#notiziaTitolo').text(obj['titolo']);
      $('#notiziaFonte').text(obj['fonte']);
      $('#notiziaCategoria').text(obj['categoria']);

      $('#notiziaCorpo').empty();
      if(obj['corpo'] != null && obj['corpo'] != "")
        $('#notiziaCorpo').text(obj['corpo']);
      else
        $('<iframe src="' + obj['link'] + '" '+
        'width="100%" height="80" frameborder="0" '+
        'allowtransparency="true" allow="encrypted-media"></iframe>').appendTo('#notiziaCorpo');

      $('#notiziaModal').modal('show');
    }
  })
  .catch((err) => {
    console.error(err);
  })
}
