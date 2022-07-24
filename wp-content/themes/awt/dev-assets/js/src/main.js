(function ( $ ) {
  /* Init Funktionen starten */
  awt_init();

  /* Init Funktionen aufrufen */
  function awt_init() {
    awt_linktree_animation_calculation();
  }

  /* Linktree Animations übergänge berechnen */
  function awt_linktree_animation_calculation() {
    if( $( '.linktree' ).length ) {
      let item = $( '.linktree .linktree-item:first-of-type' );
      let height = item.outerHeight();
      let width = item.outerWidth() * 2;
      $( '.linktree-item' ).each( function() {
        if( $( this ).hasClass( 'animation-left' ) ) {
          $( this ).css( 'background-position-x', - width );
        }
        if( $( this ).hasClass( 'animation-right' ) ) {
          $( this ).css( 'background-position-x', width );
        }
        if( $( this ).hasClass( 'animation-up' ) ) {
          $( this ).css( 'background-position-y', height );
        }
        if( $( this ).hasClass( 'animation-down' ) ) {
          $( this ).css( 'background-position-y', - height );
        }
      } );
    }
  }

  /* Funktionen ausführen, wenn die Fenster Grösse verändert wird */
  $( window ).on( 'resize', function() {
    awt_linktree_animation_calculation();
  });
})( jQuery );