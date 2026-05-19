(function($){
  'use strict';

  function children($item){ return $item.children('.kavro-nav-children'); }
  function setHeight($panel, open){ $panel.each(function(){ var el=this; if(open){ el.style.height = el.scrollHeight + 'px'; } else { el.style.height = '0px'; } }); }
  function refreshOpenHeights(){
    $($('.kavro-nav-item.has-children.is-open').get().reverse()).each(function(){ setHeight(children($(this)), true); });
  }
  function openParents($link){
    $link.parents('.kavro-nav-item.has-children').each(function(){
      var $item=$(this); $item.addClass('is-open');
      $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','true');
    });
    refreshOpenHeights();
  }
  function activate(tab){
    if(!tab){ tab=$('.kavro-nav-row a:first').data('kavro-tab'); }
    var $link=$('.kavro-nav-row a[data-kavro-tab="'+tab+'"]');
    if(!$link.length){ tab=$('.kavro-nav-row a:first').data('kavro-tab'); $link=$('.kavro-nav-row a[data-kavro-tab="'+tab+'"]'); }
    $('.kavro-nav-row a').removeClass('is-active'); $link.addClass('is-active');
    $('.kavro-section').removeClass('is-active'); $('.kavro-section[data-kavro-section="'+tab+'"]').addClass('is-active');
    openParents($link);
  }
  function toggleItem($item){
    var willOpen=!$item.hasClass('is-open');
    $item.toggleClass('is-open', willOpen);
    $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded', willOpen?'true':'false');
    if(!willOpen){
      $item.find('.kavro-nav-item.has-children').removeClass('is-open').children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','false');
      setHeight($item.find('.kavro-nav-children'), false);
    }
    setHeight(children($item), willOpen);
    window.requestAnimationFrame(refreshOpenHeights);
  }
  function initMedia(){
    $(document).on('click','.kavro-media-upload',function(e){
      e.preventDefault();
      var $wrap=$(this).closest('.kavro-media'), frame=wp.media({title:'Select Media',button:{text:'Use this media'},multiple:false});
      frame.on('select',function(){ var attachment=frame.state().get('selection').first().toJSON(); $wrap.find('input[type=text]').val(attachment.url).trigger('change'); $wrap.find('.kavro-media-preview').html('<img src="'+attachment.url+'" alt="">'); });
      frame.open();
    });
    $(document).on('click','.kavro-media-remove',function(e){ e.preventDefault(); var $wrap=$(this).closest('.kavro-media'); $wrap.find('input[type=text]').val(''); $wrap.find('.kavro-media-preview').empty(); });
  }
  function initRepeater(){
    $(document).on('click','.kavro-repeater-add',function(e){
      e.preventDefault();
      var $rep=$(this).closest('.kavro-repeater'), $items=$rep.find('.kavro-repeater-items'), $clone=$items.children('.kavro-repeater-item:first').clone();
      var index=$items.children('.kavro-repeater-item').length;
      $clone.find('input').each(function(){ this.value=''; this.name=this.name.replace(/\[\d+\]/,'['+index+']'); });
      $items.append($clone);
    });
    $(document).on('click','.kavro-repeater-remove',function(e){ e.preventDefault(); var $items=$(this).closest('.kavro-repeater-items'); if($items.children().length>1){ $(this).closest('.kavro-repeater-item').remove(); } });
  }
  $(function(){
    $('.kavro-color').wpColorPicker();
    activate(window.location.hash ? window.location.hash.substring(1) : null);
    $(document).on('click','[data-kavro-tab]',function(e){ e.preventDefault(); var tab=$(this).data('kavro-tab'); window.location.hash=tab; activate(tab); });
    $(document).on('click','.kavro-nav-toggle',function(e){ e.preventDefault(); e.stopPropagation(); toggleItem($(this).closest('.kavro-nav-item')); });
    $(document).on('input','.kavro-range input[type=range]',function(){ $(this).siblings('output').text(this.value); });
    initMedia(); initRepeater();
    $(window).on('resize', refreshOpenHeights);
  });
})(jQuery);
