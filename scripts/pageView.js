document.onload = function() {
  TimeMe.setIdleDurationInSeconds(30);
  TimeMe.setCurrentPageName("ex-filmezine");
  TimeMe.initialize();  
}

window.onbeforeunload = function (event) {
    xmlhttp=new XMLHttpRequest();
    xmlhttp.open("POST","ENTER_URL_HERE",false);
    xmlhttp.setRequestHeader("Content-type", "localhost/ex-filmezine");
    var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
    xmlhttp.send(timeSpentOnPage);
};