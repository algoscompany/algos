//wholesome fact js
//Si utilizza la API di https://catfact.ninja
//https://catfact.ninja/facts?limit=5
const nWsf = 5;
const timeToChange = 8000;
var wsf = null;
var lastIndex = 0;

function initWsf(){
  if(wsf == null){
    getResource("getWsf", nWsf)
    .then((json) => {
      let data = JSON.parse(json).data;
      wsf = data;
       $('#wholesomefacts').text(unescape(wsf[0]['fact']));

      setInterval(function(){
        lastIndex++;
        if(lastIndex >= nWsf)
          lastIndex = 0;

        $('#wholesomefacts').fadeOut(function(){
          $('#wholesomefacts').text(unescape(wsf[lastIndex]['fact'])).fadeIn();
        });

      }, timeToChange);
    })
    .catch((err) => {
      console.error(err);
      $('#wholesomefacts').text('Non ci sono wholesome facts da mostrare');
    })
  }
}
