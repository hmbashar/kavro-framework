/**
 * Kavro Framework admin interactions.
 *
 * Handles premium dashboard navigation, nested menu animation, media controls,
 * repeaters, inline tabs/accordions, icon picking, and enhanced field behavior.
 */
(function($){
  'use strict';

  /** Return the direct child panel for a nested navigation item. */
  function children($item){ return $item.children('.kavro-nav-children'); }

  /** Animate a collapsible element using measured height for smooth transitions. */
  function setHeight($panel, open){
    $panel.each(function(){
      var el=this;
      el.style.height = open ? el.scrollHeight + 'px' : '0px';
    });
  }

  /** Recalculate heights for every opened nested menu from deepest to shallowest. */
  function refreshOpenHeights(){
    $($('.kavro-nav-item.has-children.is-open').get().reverse()).each(function(){
      setHeight(children($(this)), true);
    });
  }

  /** Open all parent menu items for the active navigation link. */
  function openParents($link){
    $link.parents('.kavro-nav-item.has-children').each(function(){
      var $item=$(this);
      $item.addClass('is-open');
      $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','true');
    });
    refreshOpenHeights();
  }

  /** Switch the visible option section and highlight the related menu item. */
  function activate(tab){
    if(!tab){ tab=$('.kavro-nav-row a:first').data('kavro-tab'); }

    var $link=$('.kavro-nav-row a[data-kavro-tab="'+tab+'"]');
    if(!$link.length){
      tab=$('.kavro-nav-row a:first').data('kavro-tab');
      $link=$('.kavro-nav-row a[data-kavro-tab="'+tab+'"]');
    }

    $('.kavro-nav-row a').removeClass('is-active');
    $link.addClass('is-active');
    $('.kavro-section').removeClass('is-active');
    $('.kavro-section[data-kavro-section="'+tab+'"]').addClass('is-active');
    openParents($link);
  }

  /** Toggle a nested sidebar branch while keeping child state consistent. */
  function toggleItem($item){
    var willOpen=!$item.hasClass('is-open');
    $item.toggleClass('is-open', willOpen);
    $item.children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded', willOpen?'true':'false');

    if(!willOpen){
      $item.find('.kavro-nav-item.has-children')
        .removeClass('is-open')
        .children('.kavro-nav-row').find('.kavro-nav-toggle').attr('aria-expanded','false');
      setHeight($item.find('.kavro-nav-children'), false);
    }

    setHeight(children($item), willOpen);
    window.requestAnimationFrame(refreshOpenHeights);
  }

  /** Initialize WordPress media uploader controls. */
  function initMedia(){
    $(document).on('click','.kavro-media-upload',function(e){
      e.preventDefault();
      var $wrap=$(this).closest('.kavro-media');
      var frame=wp.media({title:'Select Media',button:{text:'Use this media'},multiple:false});
      frame.on('select',function(){
        var attachment=frame.state().get('selection').first().toJSON();
        $wrap.find('input[type=text]').val(attachment.url).trigger('change');
        $wrap.find('.kavro-media-preview').html('<img src="'+attachment.url+'" alt="">');
      });
      frame.open();
    });

    $(document).on('click','.kavro-gallery-upload',function(e){
      e.preventDefault();
      var $wrap=$(this).closest('.kavro-gallery');
      var frame=wp.media({title:'Select Gallery Images',button:{text:'Use selected images'},multiple:true});
      frame.on('select',function(){
        var urls=[];
        var preview='';
        frame.state().get('selection').each(function(model){
          var attachment=model.toJSON();
          urls.push(attachment.url);
          preview += '<img src="'+attachment.url+'" alt="">';
        });
        $wrap.find('input[type=text]').val(urls.join(',')).trigger('change');
        $wrap.find('.kavro-gallery-preview').html(preview);
      });
      frame.open();
    });

    $(document).on('click','.kavro-media-remove',function(e){
      e.preventDefault();
      var $wrap=$(this).closest('.kavro-media');
      $wrap.find('input[type=text]').val('').trigger('change');
      $wrap.find('.kavro-media-preview,.kavro-gallery-preview').empty();
    });
  }

  /** Initialize repeatable field groups. */
  function initRepeater(){
    $(document).on('click','.kavro-repeater-add',function(e){
      e.preventDefault();
      var $rep=$(this).closest('.kavro-repeater');
      var $items=$rep.find('.kavro-repeater-items');
      var $clone=$items.children('.kavro-repeater-item:first').clone();
      var index=$items.children('.kavro-repeater-item').length;

      $clone.find('input,textarea,select').each(function(){
        this.value='';
        this.name=this.name.replace(/\[\d+\]/,'['+index+']');
      });

      $items.append($clone);
    });

    $(document).on('click','.kavro-repeater-remove',function(e){
      e.preventDefault();
      var $items=$(this).closest('.kavro-repeater-items');
      if($items.children().length>1){
        $(this).closest('.kavro-repeater-item').remove();
      }
    });
  }

  /** Initialize smaller premium UI helpers. */
  function initPremiumFields(){
    $(document).on('input','.kavro-range input[type=range]',function(){
      $(this).siblings('output').text(this.value);
    });

    $(document).on('click','.kavro-step',function(){
      var $input=$(this).siblings('input[type=number]');
      var step=parseFloat($input.attr('step') || '1');
      var current=parseFloat($input.val() || '0');
      var next=$(this).data('step') === 'up' ? current + step : current - step;
      var min=$input.attr('min');
      var max=$input.attr('max');
      if(min !== undefined){ next=Math.max(next, parseFloat(min)); }
      if(max !== undefined){ next=Math.min(next, parseFloat(max)); }
      $input.val(next).trigger('change');
    });

    $(document).on('click','.kavro-icon-choice',function(){
      var icon=$(this).data('icon');
      var $picker=$(this).closest('.kavro-icon-picker');
      $picker.find('input[type=text]').val(icon).trigger('change');
      $picker.find('.kavro-icon-choice').removeClass('is-selected');
      $(this).addClass('is-selected');
    });

    $(document).on('click','.kavro-accordion-title',function(){
      $(this).closest('.kavro-accordion-item').toggleClass('is-open');
    });

    $(document).on('click','.kavro-tab-button',function(){
      var id=$(this).data('kavro-inline-tab');
      var $tabs=$(this).closest('.kavro-tabs-field');
      $tabs.find('.kavro-tab-button,.kavro-tab-panel').removeClass('is-active');
      $(this).addClass('is-active');
      $tabs.find('[data-kavro-inline-panel="'+id+'"]').addClass('is-active');
    });

    $('.kavro-sortable-list,.kavro-sorter-list').sortable({
      connectWith: '.kavro-sorter-list',
      placeholder: 'kavro-sortable-placeholder'
    });
  }

  /** Boot all Kavro admin behavior after the WordPress admin screen is ready. */
  $(function(){
    $('.kavro-color').wpColorPicker();
    activate(window.location.hash ? window.location.hash.substring(1) : null);

    $(document).on('click','[data-kavro-tab]',function(e){
      e.preventDefault();
      var tab=$(this).data('kavro-tab');
      window.location.hash=tab;
      $('.kavro-active-section').val(tab);
      activate(tab);
    });

    $(document).on('click','.kavro-nav-toggle',function(e){
      e.preventDefault();
      e.stopPropagation();
      toggleItem($(this).closest('.kavro-nav-item'));
    });

    initMedia();
    initRepeater();
    initPremiumFields();
    $(window).on('resize', refreshOpenHeights);
  });

  /**
   * Provide a small premium save interaction. WordPress still performs the
   * real option save through options.php; this only gives instant UI feedback
   * before the browser navigates.
   */
  $(document).on('submit', '.kavro-main form', function(){
    setReturnHash();
    var $form = $(this);
    if (!$form.find('.kavro-save-status').length) {
      $form.find('.kavro-topbar').append('<span class="kavro-save-status is-visible">Saving...</span>');
    } else {
      $form.find('.kavro-save-status').addClass('is-visible').text('Saving...');
    }
  });

  /**
   * Backup helpers: export the current form payload into a JSON textarea and
   * allow importing JSON back into simple matching fields for demo testing.
   */
  $(document).on('click', '.kavro-backup-export', function(e){
    e.preventDefault();
    var $wrap = $(this).closest('.kavro-backup');
    var data = {};
    $('.kavro-main form').serializeArray().forEach(function(item){ data[item.name] = item.value; });
    $wrap.find('textarea').val(JSON.stringify(data, null, 2)).trigger('change');
  });

  $(document).on('click', '.kavro-backup-import', function(e){
    e.preventDefault();
    var $wrap = $(this).closest('.kavro-backup');
    try {
      var data = JSON.parse($wrap.find('textarea').val() || '{}');
      Object.keys(data).forEach(function(name){ $('[name="'+name.replace(/"/g,'\\"')+'"]').val(data[name]).trigger('change'); });
    } catch(err) {
      window.alert('Invalid JSON payload.');
    }
  });


  /** Add/remove rows for the KeyValue field. */
  $(document).on('click', '.kavro-kv-add', function(e){
    e.preventDefault();
    var $wrap = $(this).closest('[data-kavro-key-value]');
    var $last = $wrap.find('.kavro-key-value-row:last');
    var $clone = $last.clone();
    var index = $wrap.find('.kavro-key-value-row').length;
    $clone.find('input').each(function(){
      var name = $(this).attr('name').replace(/\[\d+\]/, '['+index+']');
      $(this).attr('name', name).val('');
    });
    $clone.insertBefore($(this));
  });
  $(document).on('click', '.kavro-kv-remove', function(e){
    e.preventDefault();
    var $rows = $(this).closest('[data-kavro-key-value]').find('.kavro-key-value-row');
    if ($rows.length > 1) { $(this).closest('.kavro-key-value-row').remove(); }
  });



  /** Copy a read-only field value to the clipboard with a small visual label update. */
  $(document).on('click', '.kavro-copy-button', function(e){
    e.preventDefault();
    var $button = $(this);
    var target = $button.data('kavro-copy');
    var value = $(target).val() || '';
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(value);
    } else {
      $(target).trigger('select');
      document.execCommand('copy');
    }
    var original = $button.text();
    $button.text('Copied!');
    setTimeout(function(){ $button.text(original); }, 1200);
  });

})(jQuery);
