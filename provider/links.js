
async function getLink(name){
  var reslink = undefined;
  await getResource("getLink", name)
  .then((res) => {
    reslink = res;
  })
  .catch((err) => {
    console.error(err);
    reslink = null;
  })
  return reslink;
}

async function redirectPage(name){
  window.location = await getLink(name);
}
