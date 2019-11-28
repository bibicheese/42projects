$(window).click(function(e) {
  if (e.target.id == "login")
    $("#all").css("display", "block");
  else if (e.target.id == "all") {
    $("#all").css("display", "none");
    $("#error_log").css("display", "none");
  }
  else if (e.target.id == "close") {
    $("#all").css("display", "none");
    $("#error_log").css("display", "none");
  }
});
