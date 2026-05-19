(function($){
  function activate(tab){
    if(!tab){ tab = $('.kavro-nav-item a:first').data('kavro-tab'); }
    $('.kavro-nav-item a').removeClass('is-active');
    $('.kavro-nav-item a[data-kavro-tab="'+tab+'"]').addClass('is-active');
    $('.kavro-section').removeClass('is-active');
    $('.kavro-section[data-kavro-section="'+tab+'"]').addClass('is-active');
  }
  $(function(){
    $('.kavro-color').wpColorPicker();
    activate(window.location.hash ? window.location.hash.substring(1) : null);
    $(document).on('click','[data-kavro-tab]',function(e){
      e.preventDefault();
      var tab = $(this).data('kavro-tab');
      window.location.hash = tab;
      activate(tab);
    });
  });
})(jQuery);
