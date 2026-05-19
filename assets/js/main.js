
(function(){
  'use strict';

  var doc = document.documentElement;
  var body = document.body;

  function qs(selector, context){ return (context || document).querySelector(selector); }
  function qsa(selector, context){ return Array.prototype.slice.call((context || document).querySelectorAll(selector)); }

  // Reading progress bar for docs and long field pages.
  var progress = document.createElement('div');
  progress.className = 'kavro-progress';
  body.appendChild(progress);

  function updateProgress(){
    var scrollTop = window.pageYOffset || doc.scrollTop || 0;
    var height = Math.max(1, doc.scrollHeight - window.innerHeight);
    progress.style.width = Math.min(100, Math.max(0, (scrollTop / height) * 100)) + '%';
  }

  // Sticky nav elevation after scroll.
  var navShell = qs('.nav-shell');
  function updateNav(){
    if (!navShell) return;
    navShell.classList.toggle('is-scrolled', (window.pageYOffset || doc.scrollTop || 0) > 12);
  }

  // Mobile menu and megamenu interaction.
  var toggle = qs('.mobile-toggle');
  var links = qs('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', function(){
      links.classList.toggle('open');
      toggle.setAttribute('aria-expanded', links.classList.contains('open') ? 'true' : 'false');
    });
  }

  qsa('.nav-trigger').forEach(function(btn){
    btn.addEventListener('click', function(){
      if (window.matchMedia('(max-width: 980px)').matches) {
        var item = btn.closest('.nav-item');
        if (!item) return;
        qsa('.nav-item.open').forEach(function(openItem){ if (openItem !== item) openItem.classList.remove('open'); });
        item.classList.toggle('open');
      }
    });
  });

  qsa('.nav-links a').forEach(function(anchor){
    anchor.addEventListener('click', function(){
      if (links && window.matchMedia('(max-width: 980px)').matches) {
        links.classList.remove('open');
        qsa('.nav-item.open').forEach(function(item){ item.classList.remove('open'); });
      }
    });
  });

  // Smooth in-page anchor scrolling.
  qsa('a[href^="#"]').forEach(function(anchor){
    anchor.addEventListener('click', function(event){
      var target = qs(anchor.getAttribute('href'));
      if (!target) return;
      event.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      history.replaceState(null, '', anchor.getAttribute('href'));
    });
  });

  // Scroll reveal animation. Uses natural document order and small stagger groups.
  var revealSelector = [
    '.eyebrow', '.hero h1', '.lead', '.hero-actions', '.hero-meta', '.panel-preview', '.stats .stat',
    '.section-head', '.feature-card', '.info-panel', '.module', '.code-copy', 'pre', '.field-cloud a', '.field-cloud span',
    '.doc-card', '.page-card', '.doc-content > *', '.sidebar', '.cta'
  ].join(',');

  var revealItems = qsa(revealSelector).filter(function(el){ return !el.classList.contains('kavro-progress'); });
  revealItems.forEach(function(el, index){
    el.classList.add('kavro-reveal');
    var localIndex = index % 8;
    el.style.setProperty('--reveal-delay', (localIndex * 45) + 'ms');
  });

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function(entries){
      entries.forEach(function(entry){
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.08, rootMargin: '0px 0px -8% 0px' });
    revealItems.forEach(function(el){ observer.observe(el); });
  } else {
    revealItems.forEach(function(el){ el.classList.add('is-visible'); });
  }

  // Code copy buttons for documentation snippets.
  qsa('pre').forEach(function(pre){
    if (qs('.copy-code', pre)) return;
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'copy-code';
    btn.textContent = 'Copy';
    pre.appendChild(btn);
    btn.addEventListener('click', function(){
      var code = qs('code', pre);
      var text = code ? code.innerText : pre.innerText.replace(/Copy$/, '');
      if (!navigator.clipboard) return;
      navigator.clipboard.writeText(text).then(function(){
        btn.textContent = 'Copied';
        btn.classList.add('is-copied');
        setTimeout(function(){ btn.textContent = 'Copy'; btn.classList.remove('is-copied'); }, 1500);
      });
    });
  });

  // Heading anchors for generated docs pages.
  qsa('.doc-content h2, .doc-content h3').forEach(function(heading){
    if (!heading.id) {
      heading.id = heading.textContent.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    }
    if (!qs('.heading-anchor', heading)) {
      var a = document.createElement('a');
      a.className = 'heading-anchor';
      a.href = '#' + heading.id;
      a.setAttribute('aria-label', 'Link to ' + heading.textContent);
      a.textContent = '#';
      heading.appendChild(a);
    }
  });

  // Active sidebar link when URL matches.
  var path = window.location.pathname.split('/').pop();
  qsa('.side-links a').forEach(function(a){
    if (a.getAttribute('href') && a.getAttribute('href').split('/').pop() === path) {
      a.style.background = 'rgba(255,255,255,.09)';
      a.style.color = '#fff';
    }
  });

  window.addEventListener('scroll', function(){ updateProgress(); updateNav(); }, { passive: true });
  window.addEventListener('resize', updateProgress, { passive: true });
  updateProgress();
  updateNav();
})();
