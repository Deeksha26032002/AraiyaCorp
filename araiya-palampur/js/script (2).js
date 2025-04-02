$(document).ready(function () {
  var i = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
  console.log(i),
    1 == i
      ? $("#mySidenav").css("min-height", $(window).height() + 100 + "px")
      : $("#mySidenav").css("min-height", $(window).height() + "px");
});


$(document).ready(function(){
  // Add down arrow icon for collapse element which is open by default
  $(".collapse.show").each(function(){
    $(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
  });
  
  // Toggle right and down arrow icon on show hide of collapse element
  $(".collapse").on('show.bs.collapse', function(){
    $(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
  }).on('hide.bs.collapse', function(){
    $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
  });
});
