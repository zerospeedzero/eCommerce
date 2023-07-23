let nav = document.getElementById("nav");
let menu = nav.getElementsByClassName("menu");
for (var i = 0; i < menu.length; i++) {
  menu[i].className = (menu[i].childNodes[0].href.search(window.location.pathname + '$' ) > 0) ? "menu activemenu" : "menu";
}