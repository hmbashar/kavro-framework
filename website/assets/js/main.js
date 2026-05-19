
(function(){
  const toggle = document.querySelector('.mobile-toggle');
  const links = document.querySelector('.nav-links');
  if (toggle && links) {
    toggle.addEventListener('click', function(){ links.classList.toggle('open'); });
  }
  document.querySelectorAll('.nav-trigger').forEach(function(btn){
    btn.addEventListener('click', function(){
      if (window.matchMedia('(max-width: 980px)').matches) {
        const item = btn.closest('.nav-item');
        if (item) item.classList.toggle('open');
      }
    });
  });
})();
