(function($){
  'use strict';

  function setChildrenHeight($item){
    var $children = $item.children('.kavro-nav-children');
    if(!$children.length){ return; }

    if($item.hasClass('is-open')){
      $children.css('max-height', $children.prop('scrollHeight') + 'px');
    }else{
      $children.css('max-height', '0px');
    }
  }

  function refreshOpenHeights(){
    $('.kavro-nav-item.is-open').each(function(){
      setChildrenHeight($(this));
    });
  }

  function openParents($link){
    $link.parents('.kavro-nav-item.has-children').addClass('is-open').children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','true');
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
    var isOpen = $item.hasClass('is-open');
    $item.toggleClass('is-open', !isOpen);
    $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded', isOpen ? 'false' : 'true');
    setChildrenHeight($item);
    refreshOpenHeights();
  }

  $(function(){
    $('.kavro-color').wpColorPicker();

    $('.kavro-nav-item.has-children').each(function(){
      setChildrenHeight($(this));
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
