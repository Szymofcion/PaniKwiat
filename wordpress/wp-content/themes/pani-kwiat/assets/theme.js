document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const navButton = document.getElementById('nav-toggle');
  const nav = document.getElementById('primary-nav');
  const overlay = document.getElementById('nav-overlay');
  const iconMenu = document.getElementById('icon-menu');
  const iconClose = document.getElementById('icon-close');

  if (navButton && nav && overlay) {
    navButton.addEventListener('click', () => {
      const isHidden = nav.classList.toggle('hidden');
      const expanded = !isHidden;
      navButton.setAttribute('aria-expanded', String(expanded));
      overlay.classList.toggle('hidden', !expanded);
      if (iconMenu) iconMenu.classList.toggle('hidden', expanded);
      if (iconClose) iconClose.classList.toggle('hidden', !expanded);
    });
  }

  const lockBody = () => body.classList.add('pricing-scroll-lock');
  const unlockBody = () => body.classList.remove('pricing-scroll-lock');
  const escapeHtml = (value) => String(value)
    .replaceAll('&', '&amp;')
    .replaceAll('"', '&quot;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;');

  document.querySelectorAll('[data-dialog-target]').forEach((button) => {
    button.addEventListener('click', () => {
      const dialogId = button.getAttribute('data-dialog-target');
      const dialog = dialogId ? document.getElementById(dialogId) : null;
      if (!dialog || typeof dialog.showModal !== 'function') return;
      dialog.showModal();
      lockBody();
    });
  });

  document.querySelectorAll('dialog').forEach((dialog) => {
    dialog.addEventListener('close', unlockBody);
    dialog.addEventListener('cancel', () => {
      unlockBody();
    });
    dialog.addEventListener('click', (event) => {
      if (event.target === dialog) {
        dialog.close();
      }
    });
  });

  document.querySelectorAll('.blog-article__content .wp-block-gallery').forEach((gallery, galleryIndex) => {
    const links = Array.from(gallery.querySelectorAll('.wp-block-image a')).filter((link) => {
      const image = link.querySelector('img');
      return link.getAttribute('href') || image?.getAttribute('src');
    });

    if (!links.length) return;

    const dialogId = `pk-blog-gallery-${galleryIndex + 1}`;
    const dialog = document.createElement('dialog');
    dialog.id = dialogId;
    dialog.className = 'blog-gallery-dialog';
    dialog.innerHTML = `
      <article>
        <div class="swiper swiper-horizontal">
          <div class="swiper-wrapper">
            ${links.map((link) => {
              const image = link.querySelector('img');
              const src = link.getAttribute('href') || image?.getAttribute('src') || '';
              const alt = image?.getAttribute('alt') || '';
              return `<div class="swiper-slide"><img src="${escapeHtml(src)}" alt="${escapeHtml(alt)}"></div>`;
            }).join('')}
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </article>
      <form method="dialog">
        <button type="submit" class="close-button" data-dialog-close>X</button>
      </form>
    `;

    gallery.insertAdjacentElement('afterend', dialog);

    dialog.addEventListener('close', unlockBody);
    dialog.addEventListener('cancel', unlockBody);
    dialog.addEventListener('click', (event) => {
      if (event.target === dialog) {
        dialog.close();
      }
    });

    links.forEach((link, slideIndex) => {
      link.addEventListener('click', (event) => {
        event.preventDefault();
        if (typeof dialog.showModal !== 'function') return;

        dialog.showModal();
        lockBody();

        const swiper = dialog.querySelector('.swiper')?.swiper;
        if (swiper) {
          swiper.slideToLoop(slideIndex, 0);
        }
      });
    });
  });

  if (window.Swiper) {
    document.querySelectorAll('.swiper').forEach((element) => {
      const nextEl = element.parentElement?.querySelector('.swiper-button-next');
      const prevEl = element.parentElement?.querySelector('.swiper-button-prev');

      new window.Swiper(element, {
        loop: true,
        navigation: {
          nextEl,
          prevEl,
        },
      });
    });
  }
});
