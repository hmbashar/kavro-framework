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

    $(document).on('click','.kavro-add-row',function(e){
      e.preventDefault();
      var $wrap=$(this).closest('.kavro-table-field');
      var index=$wrap.find('.kavro-table-row').length;
      var base=$wrap.closest('.kavro-field').find('.kavro-table-row:first input:first').attr('name') || '';
      base=base.replace(/\[rows\]\[\d+\]\[label\].*/, '');
      $('<div class="kavro-table-row"><input type="text" name="'+base+'[rows]['+index+'][label]" placeholder="Label"><input type="text" name="'+base+'[rows]['+index+'][value]" placeholder="Value"></div>').insertBefore($(this));
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


  /** Read a query-string parameter without depending on modern browser features. */
  function getQueryParam(name){
    var match = new RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match ? decodeURIComponent(match[1].replace(/\+/g, ' ')) : '';
  }

  /** Return the currently active Kavro section slug. */
  function getCurrentSection(){
    return $('.kavro-nav-row a.is-active').data('kavro-tab') || window.location.hash.substring(1) || getQueryParam('kavro_section') || '';
  }

  /**
   * Preserve the selected Kavro section across WordPress Settings API saves.
   *
   * WordPress receives no URL hash fragment on form submit, so Kavro injects
   * the active section into the generated _wp_http_referer URL. After options.php
   * redirects back, init code reads kavro_section and activates the same panel.
   */
  function setReturnHash(){
    var tab = getCurrentSection();
    if(!tab){ return; }

    $('.kavro-active-section').val(tab);

    var $referer = $('input[name="_wp_http_referer"]');
    if(!$referer.length){ return; }

    var url = $referer.val() || window.location.href;
    url = url.split('#')[0].replace(/([?&])kavro_section=[^&]*(&?)/, function(match, prefix, suffix){
      return suffix ? prefix : '';
    }).replace(/[?&]$/, '');
    url += (url.indexOf('?') === -1 ? '?' : '&') + 'kavro_section=' + encodeURIComponent(tab);
    $referer.val(url);
  }

  /** Remove Kavro's temporary section query argument after the UI is restored. */
  function cleanSectionUrl(){
    if(!window.history || !window.history.replaceState || window.location.search.indexOf('kavro_section=') === -1){ return; }
    var params = window.location.search.substring(1).split('&').filter(function(part){ return part.indexOf('kavro_section=') !== 0; });
    var clean = window.location.pathname + (params.length ? '?' + params.join('&') : '') + window.location.hash;
    window.history.replaceState({}, document.title, clean);
  }

  /** Initialize a lightweight premium Kavro date/time picker. */
  function initKavroPicker(){
    var $picker = $('<div class="kavro-picker" aria-hidden="true"></div>').appendTo('body');
    var activeInput = null;

    function pad(value){ return String(value).padStart(2, '0'); }
    function today(){ var d = new Date(); return d.getFullYear() + '-' + pad(d.getMonth()+1) + '-' + pad(d.getDate()); }
    function nowTime(){ var d = new Date(); return pad(d.getHours()) + ':' + pad(d.getMinutes()); }

    function render($input){
      var mode = $input.data('kavro-picker');
      var value = $input.val() || '';
      var parts = value.split(/[T ]/);
      var dateValue = parts[0] || today();
      var timeValue = (parts[1] || nowTime()).substring(0,5);
      var html = '<div class="kavro-picker-card">';
      html += '<div class="kavro-picker-title">Choose ' + (mode === 'time' ? 'Time' : mode === 'datetime' ? 'Date & Time' : 'Date') + '</div>';
      if(mode === 'date' || mode === 'datetime'){
        html += '<input class="kavro-picker-date" type="date" value="'+dateValue+'">';
      }
      if(mode === 'time' || mode === 'datetime'){
        html += '<input class="kavro-picker-time" type="time" value="'+timeValue+'">';
      }
      html += '<div class="kavro-picker-actions"><button type="button" class="kavro-picker-today">Today</button><button type="button" class="kavro-picker-clear">Clear</button><button type="button" class="kavro-picker-apply">Apply</button></div>';
      html += '</div>';
      $picker.html(html);
    }

    function place($input){
      var o = $input.offset();
      $picker.css({ top: o.top + $input.outerHeight() + 10, left: o.left, minWidth: Math.max(280, $input.outerWidth()) });
    }

    function apply(){
      if(!activeInput){ return; }
      var $input = $(activeInput);
      var mode = $input.data('kavro-picker');
      var d = $picker.find('.kavro-picker-date').val() || today();
      var t = $picker.find('.kavro-picker-time').val() || nowTime();
      var value = mode === 'date' ? d : mode === 'time' ? t : d + 'T' + t;
      $input.val(value).trigger('change');
      closePicker();
    }

    function closePicker(){
      $picker.removeClass('is-open').attr('aria-hidden','true');
      activeInput = null;
    }

    $(document).on('focus click', '[data-kavro-picker]', function(e){
      activeInput = this;
      var $input = $(this);
      render($input);
      place($input);
      $picker.addClass('is-open').attr('aria-hidden','false');
    });

    $(window).on('resize scroll', function(){ if(activeInput){ place($(activeInput)); } });
    $(document).on('click', '.kavro-picker-apply', apply);
    $(document).on('click', '.kavro-picker-clear', function(){ if(activeInput){ $(activeInput).val('').trigger('change'); } closePicker(); });
    $(document).on('click', '.kavro-picker-today', function(){
      $picker.find('.kavro-picker-date').val(today());
      $picker.find('.kavro-picker-time').val(nowTime());
    });
    $(document).on('mousedown', function(e){
      if(activeInput && !$(e.target).closest('.kavro-picker,[data-kavro-picker]').length){ closePicker(); }
    });
  }

  /** Boot all Kavro admin behavior after the WordPress admin screen is ready. */
  $(function(){
    $('.kavro-color').wpColorPicker();
    activate(window.location.hash ? window.location.hash.substring(1) : getQueryParam('kavro_section'));
    cleanSectionUrl();

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
    initKavroPicker();
    $(window).on('resize', refreshOpenHeights);
  });

  /**
   * Save Kavro options through admin-ajax.php with the regular form submit as
   * fallback. The PHP handler repeats capability checks, nonce verification,
   * schema-aware sanitization, and option updates before returning JSON.
   */
  $(document).on('submit', '.kavro-options-form[data-kavro-ajax="1"]', function(e){
    setReturnHash();

    var $form = $(this);
    var submitter = e.originalEvent && e.originalEvent.submitter ? $(e.originalEvent.submitter) : $();
    var isReset = submitter.hasClass('kavro-reset');
    var config = window.KavroAdmin || {};
    var messages = config.messages || {};

    if(!config.ajaxUrl || !config.saveAction || !window.FormData){
      return;
    }

    if(isReset && !window.confirm(config.confirmReset || 'Reset all saved Kavro settings for this panel?')){
      e.preventDefault();
      return;
    }

    e.preventDefault();

    var $status = $form.find('.kavro-save-status');
    var $buttons = $form.find('.kavro-save, .kavro-reset');
    var data = new FormData(this);

    data.set('action', isReset ? config.resetAction : config.saveAction);
    data.set('kavro_ajax_nonce', config.nonce || data.get('kavro_ajax_nonce') || '');
    data.set('kavro_active_section', getCurrentSection());

    $buttons.prop('disabled', true).addClass('is-busy');
    $status.removeClass('is-error is-success').addClass('is-visible').text(isReset ? (messages.resetting || 'Resetting...') : (messages.saving || 'Saving...'));

    $.ajax({
      url: config.ajaxUrl,
      method: 'POST',
      data: data,
      processData: false,
      contentType: false,
      dataType: 'json'
    }).done(function(response){
      if(response && response.success){
        $status.removeClass('is-error').addClass('is-success').text(isReset ? (messages.reset || 'Reset complete') : (messages.saved || 'Saved'));
        if(isReset){
          $form.find('input[type="text"], input[type="email"], input[type="url"], input[type="number"], input[type="password"], input[type="tel"], textarea').val('').trigger('change');
          $form.find('input[type="checkbox"], input[type="radio"]').prop('checked', false).trigger('change');
          $form.find('select').prop('selectedIndex', 0).trigger('change');
        }
        setTimeout(function(){ $status.removeClass('is-visible'); }, 1800);
      } else {
        var message = response && response.data && response.data.message ? response.data.message : (messages.error || 'Something went wrong. Please try again.');
        $status.removeClass('is-success').addClass('is-error is-visible').text(message);
      }
    }).fail(function(){
      $status.removeClass('is-success').addClass('is-error is-visible').text(messages.error || 'Something went wrong. Please try again.');
    }).always(function(){
      $buttons.prop('disabled', false).removeClass('is-busy');
    });
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

/**
 * Extended field polish.
 *
 * Keeps visual previews such as progress meters and gradients in sync while the
 * user edits values, without requiring a page reload.
 */
(function ($) {
  'use strict';

  $(document).on('input change', '.kavro-progress-field input[type="range"]', function () {
    var value = this.value || 0;
    var $field = $(this).closest('.kavro-progress-field');
    $field.find('.kavro-progress-track span').css('width', value + '%');
    $field.find('strong').text(value + '%');
  });

  $(document).on('input change', '.kavro-gradient-field input, .kavro-gradient-field select', function () {
    var $field = $(this).closest('.kavro-gradient-field');
    var from = $field.find('input[name$="[from]"]').val() || '#6d5dfc';
    var to = $field.find('input[name$="[to]"]').val() || '#10b6d8';
    var direction = $field.find('select[name$="[direction]"]').val() || '135deg';
    $field.find('.kavro-gradient-preview').css('background', 'linear-gradient(' + direction + ',' + from + ',' + to + ')');
  });
})(jQuery);

/**
 * Rating field visual state controller.
 *
 * The radio buttons remain responsible for saving values. This layer only keeps
 * the premium star UI synchronized for hover, click, keyboard, and reload states.
 */
(function ($) {
  'use strict';

  function paint($rating, value, hover) {
    value = parseInt(value || 0, 10);
    $rating.find('.kavro-rating-star').each(function () {
      var $star = $(this);
      var rating = parseInt($star.data('rating') || 0, 10);
      $star.toggleClass(hover ? 'is-hover' : 'is-active', rating <= value);
    });
  }

  function selectedValue($rating) {
    return $rating.find('input:checked').val() || 0;
  }

  function refresh($rating) {
    $rating.find('.kavro-rating-star').removeClass('is-hover');
    paint($rating, selectedValue($rating), false);
  }

  $(function () {
    $('[data-kavro-rating]').each(function () {
      refresh($(this));
    });
  });

  $(document).on('mouseenter', '.kavro-rating-star', function () {
    var $star = $(this);
    var $rating = $star.closest('[data-kavro-rating]');
    $rating.find('.kavro-rating-star').removeClass('is-hover');
    paint($rating, $star.data('rating'), true);
  });

  $(document).on('mouseleave', '[data-kavro-rating]', function () {
    refresh($(this));
  });

  $(document).on('click change keyup', '.kavro-rating-star input', function () {
    refresh($(this).closest('[data-kavro-rating]'));
  });
})(jQuery);


/**
 * Filter Kavro smart select options as the user types.
 *
 * This lightweight progressive enhancement keeps the field dependency-free
 * while still making long post, term, user, and relationship lists easier to scan.
 */
document.addEventListener('input', function (event) {
  if (!event.target.classList || !event.target.classList.contains('kavro-smart-filter')) {
    return;
  }

  var wrapper = event.target.closest('.kavro-smart-select');
  var select = wrapper ? wrapper.querySelector('select') : null;
  var query = event.target.value.toLowerCase();

  if (!select) {
    return;
  }

  Array.prototype.forEach.call(select.options, function (option) {
    var text = option.textContent.toLowerCase();
    option.hidden = query && text.indexOf(query) === -1;
  });
});

/**
 * Kavro Select2-style enhancement.
 *
 * This is a dependency-free searchable select interface designed for WordPress.org
 * compatibility. It keeps the native select in the DOM for saving while rendering
 * a polished, keyboard-friendly visual control on top of it.
 */
(function ($) {
  'use strict';

  function selectedLabels(select) {
    return Array.prototype.filter.call(select.options, function (option) {
      return option.selected && option.value !== '';
    }).map(function (option) { return option.textContent; });
  }

  function refresh($wrap) {
    var select = $wrap.find('select')[0];
    var labels = selectedLabels(select);
    var placeholder = $(select).data('placeholder') || 'Select option';
    var text = labels.length ? labels.join(', ') : placeholder;
    $wrap.find('.kavro-select2-value').text(text).toggleClass('is-placeholder', !labels.length);

    $wrap.find('.kavro-select2-option').each(function () {
      var value = $(this).data('value').toString();
      var option = Array.prototype.filter.call(select.options, function (opt) {
        return opt.value.toString() === value;
      })[0];
      $(this).toggleClass('is-selected', !!(option && option.selected));
    });
  }

  function build(select) {
    var $select = $(select);
    if ($select.data('kavro-select2-ready')) {
      return;
    }

    $select.data('kavro-select2-ready', true).addClass('kavro-select2-native');

    var multiple = select.multiple;
    var placeholder = $select.data('placeholder') || 'Select option';
    var html = '<div class="kavro-select2-wrap" data-kavro-select2-wrap>';
    html += '<button type="button" class="kavro-select2-control" aria-expanded="false">';
    html += '<span class="kavro-select2-value is-placeholder">' + placeholder + '</span><span class="dashicons dashicons-arrow-down-alt2"></span></button>';
    html += '<div class="kavro-select2-dropdown" aria-hidden="true"><input type="search" class="kavro-select2-search" placeholder="Search..."><div class="kavro-select2-options">';

    Array.prototype.forEach.call(select.options, function (option) {
      if (option.value === '') { return; }
      html += '<button type="button" class="kavro-select2-option" data-value="' + option.value.replace(/"/g, '&quot;') + '">' + option.textContent + '</button>';
    });

    html += '</div></div></div>';
    var $wrap = $(html);
    $select.after($wrap);
    $wrap.prepend($select);
    $wrap.toggleClass('is-multiple', multiple);
    refresh($wrap);
  }

  function closeAll(except) {
    $('[data-kavro-select2-wrap]').not(except || []).removeClass('is-open')
      .find('.kavro-select2-control').attr('aria-expanded', 'false').end()
      .find('.kavro-select2-dropdown').attr('aria-hidden', 'true');
  }

  function initializeSelect2(context) {
    $(context || document).find('select[data-kavro-select2], select.kavro-select2').each(function () {
      build(this);
    });
  }

  $(function () {
    initializeSelect2(document);
  });

  $(document).on('click', '.kavro-select2-control', function (event) {
    event.preventDefault();
    var $wrap = $(this).closest('[data-kavro-select2-wrap]');
    var open = !$wrap.hasClass('is-open');
    closeAll($wrap);
    $wrap.toggleClass('is-open', open);
    $(this).attr('aria-expanded', open ? 'true' : 'false');
    $wrap.find('.kavro-select2-dropdown').attr('aria-hidden', open ? 'false' : 'true');
    if (open) {
      $wrap.find('.kavro-select2-search').val('').trigger('input').trigger('focus');
    }
  });

  $(document).on('input', '.kavro-select2-search', function () {
    var query = this.value.toLowerCase();
    $(this).siblings('.kavro-select2-options').find('.kavro-select2-option').each(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(query) !== -1);
    });
  });

  $(document).on('click', '.kavro-select2-option', function (event) {
    event.preventDefault();
    var $optionButton = $(this);
    var $wrap = $optionButton.closest('[data-kavro-select2-wrap]');
    var select = $wrap.find('select')[0];
    var value = $optionButton.data('value').toString();

    Array.prototype.forEach.call(select.options, function (option) {
      if (option.value.toString() === value) {
        option.selected = select.multiple ? !option.selected : true;
      } else if (!select.multiple) {
        option.selected = false;
      }
    });

    $(select).trigger('change');
    refresh($wrap);

    if (!select.multiple) {
      closeAll();
    }
  });

  $(document).on('change', 'select[data-kavro-select2], select.kavro-select2', function () {
    refresh($(this).closest('[data-kavro-select2-wrap]'));
  });

  $(document).on('mousedown', function (event) {
    if (!$(event.target).closest('[data-kavro-select2-wrap]').length) {
      closeAll();
    }
  });
})(jQuery);

/**
 * Advanced Kavro field behaviors.
 *
 * Adds conditional dependencies, cloneable rows and dynamic tag insertion while
 * keeping the controls progressive-enhancement friendly for WordPress admin.
 */
(function ($) {
  'use strict';

  function fieldValue(fieldId) {
    var $fields = $('[name$="[' + fieldId + ']"], [name$="[' + fieldId + '][]"]');
    if (!$fields.length) { return ''; }
    if ($fields.is(':checkbox')) {
      var values = [];
      $fields.filter(':checked').each(function () { values.push(this.value || '1'); });
      return values.length > 1 ? values : (values[0] || '');
    }
    if ($fields.is(':radio')) { return $fields.filter(':checked').val() || ''; }
    return $fields.first().val();
  }

  function compare(actual, operator, expected) {
    operator = operator || '==';
    if ($.isArray(actual)) { actual = actual.map(String); }
    var a = $.isArray(actual) ? actual : String(actual);
    var e = $.isArray(expected) ? expected.map(String) : String(expected);
    if (operator === '!=' || operator === 'not') { return a !== e; }
    if (operator === 'contains') { return $.isArray(a) ? a.indexOf(e) !== -1 : String(a).indexOf(e) !== -1; }
    if (operator === 'empty') { return !actual || ($.isArray(actual) && !actual.length); }
    if (operator === 'not_empty') { return !!actual && (!$.isArray(actual) || actual.length > 0); }
    return $.isArray(a) ? a.indexOf(e) !== -1 : a === e;
  }

  function refreshDependencies() {
    $('[data-kavro-dependency]').each(function () {
      var $field = $(this);
      var dep = $field.data('kavro-dependency');
      if (!dep || !dep.field) { return; }
      var visible = compare(fieldValue(dep.field), dep.operator, dep.value);
      $field.toggleClass('kavro-dependency-hidden', !visible);
    });
  }

  $(document).on('change input', '.kavro-main input, .kavro-main select, .kavro-main textarea', refreshDependencies);
  $(refreshDependencies);

  $(document).on('click', '.kavro-clone-add', function (e) {
    e.preventDefault();
    var $wrap = $(this).closest('[data-kavro-cloneable]');
    var $clone = $wrap.find('.kavro-cloneable-row:first').clone();
    var index = $wrap.find('.kavro-cloneable-row').length;
    $clone.find('input, textarea, select').each(function () {
      var name = $(this).attr('name') || '';
      $(this).attr('name', name.replace(/\[\d+\]/, '[' + index + ']')).val('');
    });
    $clone.insertBefore($(this));
  });

  $(document).on('click', '.kavro-clone-remove', function (e) {
    e.preventDefault();
    var $wrap = $(this).closest('[data-kavro-cloneable]');
    if ($wrap.find('.kavro-cloneable-row').length > 1) {
      $(this).closest('.kavro-cloneable-row').remove();
    }
  });

  $(document).on('click', '.kavro-tag', function (e) {
    e.preventDefault();
    var $input = $(this).closest('.kavro-dynamic-tags').find('input');
    $input.val(($input.val() || '') + $(this).data('tag')).trigger('change').focus();
  });
})(jQuery);
