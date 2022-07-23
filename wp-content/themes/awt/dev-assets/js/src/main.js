(function ( $ ) {

  /* Initiale Funktionen starten */
  awt_init();

  /* Funktion zum starten aller relevanten JavaScript Animationen beim Laden der Seite */
  function awt_init() {
    awt_page_animations();
  }

  /* Seiten Animationen starten */
  function awt_page_animations() {
    let options = {
      animateClass: 'animated',
      animateThreshold: 100,
      scrollPollInterval: 50
    }
    $('.aniview').AniView( options );
  }
})( jQuery );