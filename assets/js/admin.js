(function($){
  'use strict';

  function getItemChildren($item){
    return $item.children('.kavro-nav-children');
  }

  function syncItemHeight($item){
    var $children = getItemChildren($item);
    if(!$children.length){ return; }

    if($item.hasClass('is-open')){
      // Temporarily let the browser measure the full nested height, including any
      // already-open descendants. This prevents parent panels from clipping when
      // a deep child menu contains many items or tall labels.
      $children.css('max-height', 'none');
      var height = $children[0].scrollHeight;
      $children.css('max-height', height + 'px');
    }else{
      $children.css('max-height', '0px');
    }
  }

  function refreshOpenHeights(){
    // Measure deepest menus first, then parents. This keeps parent max-height
    // correct after grandchildren expand/collapse.
    $($('.kavro-nav-item.has-children').get().reverse()).each(function(){
      syncItemHeight($(this));
    });
  }

  function openParents($link){
    $link.parents('.kavro-nav-item.has-children').each(function(){
      var $item = $(this);
      $item.addClass('is-open');
      $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','true');
    });
    refreshOpenHeights();
  }

  function activate(tab){
    if(!tab){ tab = $('.kavro-nav-row a:first').data('kavro-tab'); }

    var $link = $('.kavro-nav-row a[data-kavro-tab="'+tab+'"]');

    if(!$link.length){
      tab = $('.kavro-nav-row a:first').data('kavro-tab');
      $link = $('.kavro-nav-row a[data-kavro-tab="'+tab+'"]');
    }

    $('.kavro-nav-row a').removeClass('is-active');
    $link.addClass('is-active');

    $('.kavro-section').removeClass('is-active');
    $('.kavro-section[data-kavro-section="'+tab+'"]').addClass('is-active');

    openParents($link);
  }

  function toggleItem($item){
    var willOpen = !$item.hasClass('is-open');

    $item.toggleClass('is-open', willOpen);
    $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded', willOpen ? 'true' : 'false');

    if(!willOpen){
      // Collapse descendants as well so reopening starts cleanly.
      $item.find('.kavro-nav-item.has-children').removeClass('is-open')
        .children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','false');
      $item.find('.kavro-nav-children').css('max-height','0px');
    }

    syncItemHeight($item);

    window.requestAnimationFrame(function(){
      refreshOpenHeights();
    });
  }

  $(function(){
    $('.kavro-color').wpColorPicker();

    $('.kavro-nav-item.has-children').each(function(){
      syncItemHeight($(this));
    });

    activate(window.location.hash ? window.location.hash.substring(1) : null);

    $(document).on('click','[data-kavro-tab]',function(e){
      e.preventDefault();
      var tab = $(this).data('kavro-tab');
      window.location.hash = tab;
      activate(tab);
    });

    $(document).on('click','.kavro-nav-toggle',function(e){
      e.preventDefault();
      e.stopPropagation();
      toggleItem($(this).closest('.kavro-nav-item'));
    });

    $(window).on('resize', refreshOpenHeights);
  });
})(jQuery);
