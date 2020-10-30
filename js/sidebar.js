 function opensidebar() {
  var sidebar = document.getElementById('verticalnav');
  sidebar.style.width = "400px";
  document.getElementById('sidebarwrapper').classList.add('open');
}

async function closesidebar() {
  var sidebar = document.getElementById('verticalnav');
    sidebar.style.width = "0px";
    const result = await resolveAfter2Seconds();

}

function resolveAfter2Seconds() {
  return new Promise(resolve => {
    setTimeout(() => {
      // resolve('resolved');
        document.getElementById('sidebarwrapper').classList.remove('open');
    }, 600);
  });
}
