let gotoTop_Btn = $("#gotoTop_Btn"); // get button

$(window).scroll(function () {
  if ($(window).scrollTop() > 300) {
    gotoTop_Btn.addClass("show");
  } else {
    gotoTop_Btn.removeClass("show");
  }
});

gotoTop_Btn.on("click", function (e) {
  e.preventDefault();
  $("html, body").animate({ scrollTop: 0 }, "300");
});
