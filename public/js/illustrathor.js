$(function() {
  var words = [
    'creator',
    'designer',
    'graphic designer'
  ],
  i = 0;

  // // On gère l'affichage du menu reponsif ppur les écrans inférieurs ou égaux à medium (< 992px)
  // $(".navbar-responsive").toggle();
  //
  $(".menu").click(function (e) {
    e.preventDefault();
    $(".navbar-responsive").toggleClass("navbar-responsive--expanded");
    $("body").removeClass("visible-overflow").toggleClass("hidden-overflow");

    $("#close__menu").on("click", function(event) {
      event.preventDefault();
      $(".navbar-responsive").removeClass("navbar-responsive--expanded");
      $("body").removeClass("hidden-overflow").toggleClass("visible-overflow");
    })
    $(".scroll").on("click", function ()  {
      $(".navbar-responsive").removeClass("navbar-responsive--expanded");
      $("body").removeClass("hidden-overflow").toggleClass("visible-overflow");
    })
  });


  // On gère l'affichage aléatoire des phrases d'accroche du header (toutes les 3.5 secondes)
  setInterval(function() {
    $("#word").fadeOut(function() {
      $(this).html(words[i = (i + 1) % words.length]).fadeIn();
    });
  }, 3500);

  // On gère le scroll vers les différentes sections du site
  $(".scroll").click(function() {
    var section = $("." + this.id);
    $("html,body").animate({scrollTop: section.offset().top}, 'slow');
  });

  // On gère l'affichage des progressbar pour les compétences
  window.sr = ScrollReveal();
  sr.reveal('.progress-bar', {
    origin: 'left',
    duration: 2000,
    distance: '100%'
  })
});
