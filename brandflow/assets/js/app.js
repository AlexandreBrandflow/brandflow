gsap.registerPlugin(ScrollTrigger);

const body = document.body;
const doc = document.querySelector("html");
const nav = document.querySelector("header.header");
const scrollUp = "scroll-up";
const scrollDown = "scroll-down";
const overlay = document.getElementById('overlay');
const menuMobile = document.querySelector('.menu-mobile');
const availScreenWidth = window.screen.availWidth;

document.addEventListener("DOMContentLoaded", function () {

  // smooth scroll
  const lenis = new Lenis()

  function raf(time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
  }

  requestAnimationFrame(raf);
  // smooth scroll

  const selects = document.querySelectorAll('.bfw-select2');
  if (selects) {
    selects.forEach(select => {
      const selectionCssClass = Array.from(select.classList).join(' ');
      jQuery(select).select2({
        minimumResultsForSearch: -1,
        selectionCssClass: selectionCssClass
      });
    });
  }


  const swipers = document.querySelectorAll('.bfw-swiper');
  for (i = 0; i < swipers.length; i++) {
    let parent = swipers[i].closest('[data-parent]');
    swipers[i].classList.add('bfw-swiper-' + i);

    const gap = swipers[i].dataset.gap || 24; // valeur par défaut du gap entre les slides

    const swiperConfig = { // la config de base
      speed: 400,
      spaceBetween: 16, // en dessous du breakpoints
      grabCursor: false,
      slidesPerView: 'auto',
      breakpoints: {
        768: {
          spaceBetween: gap // min-width 768 
        }
      },
    };


    if (swipers[i].classList.contains('actualites-swiper')) { // cas spécifique, sélection par classe
      Object.assign(swiperConfig,
        {
          centeredSlides: true,
          loop: true,
          slideToClickedSlide: true,
          loopAdditionalSlides: 30,
          allowTouchMove: true,
        });
    }



    if (swipers[i].classList.contains('texte-loop-slider__swiper')) { // doubles swipers avec direction inversée
      let reverse = swipers[i].dataset.reversedirection == 1;
      let direction = swipers[i].classList.contains('--vertical') ? 'vertical' : 'horizontal';

      let counter = swipers[i].querySelectorAll('.swiper-slide');
      let speed = counter.length * parseInt(swipers[i].dataset.speedindex);

      // Étendez l'objet de configuration de base avec vos options supplémentaires
      Object.assign(swiperConfig, {
        freeMode: true,
        autoplay: {
          delay: 0,
          disableOnInteraction: false,
          reverseDirection: reverse,
        },
        speed: speed,
        touchRatio: 0,
        loop: true,
        direction: direction,
        allowTouchMove: false,
        preventClicks: true,
        preventInteractionOnTransition: true,
        simulateTouch: false,
      });
    }

    

    if (swipers[i].classList.contains('temoignages__slider')) { // slider centré
      const timing = swipers[i].dataset.timing; // default timing
      Object.assign(swiperConfig,
        {
          slidesPerView: "auto",
          centeredSlides: true,
          allowTouchMove: true,
          grabCursor: false,
          // autoplay: {
          //   delay: timing,
          //   disableOnInteraction: false,
          // },
        });
    }

    if (swipers[i].classList.contains('bfw-dynamic-swiper__nav')) {
      const timing = swipers[i].dataset.timing; // default timing
      Object.assign(swiperConfig,
        {
          slidesPerView: 'auto',
          //centeredSlides: true,
          slideToClickedSlide: true,

          grabCursor: false,
        });
    }

    if (swipers[i].classList.contains('--navigation')) { // boutons de navigation custom custom
      Object.assign(swiperConfig,
        {
          navigation: {
            nextEl: parent.querySelector('.bfw-swiper-nav--next'),
            prevEl: parent.querySelector('.bfw-swiper-nav--prev'),
          },
        });
    }


    const slider = new Swiper('.bfw-swiper-' + i, swiperConfig); // génération de tous les swipers

  }



  // fonction pour les swipers Apple style (pagination dynamique)
  const dynamicSwipers = document.querySelectorAll('.bfw-dynamic-swiper');
  dynamicSwipers.forEach(dynamicSwiper => {
    const main = dynamicSwiper.querySelector('.bfw-dynamic-swiper__main');
    let mainSwiper = main.swiper;
    const pagination = dynamicSwiper.querySelector('.bfw-dynamic-swiper__nav');
    let paginationSwiper; // Declare paginationSwiper here

    if (pagination) {
      paginationSwiper = pagination.swiper;
    }

    if (main && pagination) {
      let paginationWrapper = pagination.querySelector('.swiper-wrapper');
      mainSwiper.controller.control = paginationSwiper;
      paginationSwiper.controller.control = mainSwiper;
    }


  });
});



// Loop pour tous les toggles et les boutons d'action

var toggles = document.querySelectorAll('[data-mytoggle]');

Array.from(toggles).forEach(toggle => {
  toggle.addEventListener('click', function (event) {
    let data = toggle.dataset.mytoggle;
    event.preventDefault();
    if (data == 'onglet') {
      let parent = toggle.closest('[data-parent]');
      Array.from(parent.querySelectorAll('.active')).forEach(
        (el) => el.classList.remove('active')
      );
      toggle.classList.add('active');

      href = (toggle.getAttribute("href"));
      if (href) {
        parent.querySelector(href).classList.add('active');
      }
    }
    else if (data.includes('popup')) { // gérer les cas ou le data toggle a plusieurs valeurs comme "popup menu par exemple"
      activeModals = document.querySelectorAll('.modal.active');
      Array.from(activeModals).forEach(
        (el) => el.classList.remove('active')
      );
      href = (toggle.getAttribute("href"));
      if (href) {
        document.querySelector(toggle.getAttribute("href")).classList.add('active');
      }
      activeModals = document.querySelectorAll('.modal.active'); // gérer cas où ouverture modal via une autre modal
      if (body.classList.contains('focus') && activeModals.length == 0) {
        body.classList.remove('focus');
        let hamburger = nav.querySelector('.hamburger');
        hamburger.classList.remove('is-active');
      }
      else {
        body.classList.add('focus');
      }

    }
    else if (data == 'navigation') {
      toggle.parentElement.classList.toggle('active');
      toggle.querySelector('.hamburger').classList.toggle('is-active');
    }
    else if (data == 'self') {
      toggle.classList.toggle('active');
    }
    else if (data == 'self-only') {
      if (!toggle.classList.contains('active')) {
        let parent = toggle.closest('[data-parent]');
        Array.from(parent.querySelectorAll('.active')).forEach(
          (el) => el.classList.remove('active')
        );
      }
      toggle.classList.toggle('active');
    }
    else if (data == 'video') {
      let parent = toggle.closest('[data-parent]');
      parent.classList.toggle('active');
      let embedPlayer = parent.querySelector('.youtube_player, .vimeo_player');

      if (embedPlayer) {
        loadVideo(embedPlayer);
      }
      let dynamicSwiper = toggle.closest('.bfw-dynamic-swiper');
      if (dynamicSwiper) {
        const main = dynamicSwiper.querySelector('.bfw-dynamic-swiper__main');
        if (main) {
          let mainSwiper = main.swiper;
          if (mainSwiper.autoplay.running) {
            dynamicSwiper.classList.add('paused'); // Changement vers l'icône "play"
          } else {
            //mainSwiper.autoplay.start();
            dynamicSwiper.classList.remove('paused'); // Changement vers l'icône "pause"
          }
        }
      }
    }
    else if (data == 'playpause') {
      let dynamicSwiper = toggle.closest('.bfw-dynamic-swiper');
      const main = dynamicSwiper.querySelector('.bfw-dynamic-swiper__main');
      let mainSwiper = main.swiper;
      if (mainSwiper.autoplay.running) {
        mainSwiper.autoplay.stop();
        dynamicSwiper.classList.add('paused'); // Changement vers l'icône "play"
      } else {
        mainSwiper.autoplay.start();
        dynamicSwiper.classList.remove('paused'); // Changement vers l'icône "pause"
      }
    }
    else if (data == 'menu') {
      if (!menuMobile.classList.contains('active')) {
        Array.from(document.querySelectorAll('.modal.active')).forEach(
          (el) => el.classList.remove('active')
        );
      }

      let hamburger = nav.querySelector('.hamburger');
      hamburger.classList.toggle('is-active');
      menuMobile.classList.toggle('active');
      document.body.classList.toggle('focus');
    }

  });
});




var ctatoggles = document.querySelectorAll('.toggle-demo'); // toggles spécifiques à traiter en dehors
Array.from(ctatoggles).forEach(toggle => {
  toggle.addEventListener('click', function (event) {
    event.preventDefault();
    Array.from(document.querySelectorAll('.modal.active')).forEach(
      (el) => el.classList.remove('active')
    );
    document.getElementById('demo').classList.toggle('active');
    body.classList.toggle('focus');
  });
});


// fonction pour mettre des classes au scroll up ou down à partir d'une certaine distance.
let lastScroll = 0;
window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll <= 0) {
    body.classList.remove(scrollUp);
    return;
  }
  if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
    // down 
    body.classList.remove(scrollUp);
    body.classList.add(scrollDown);
  } else if (
    currentScroll < lastScroll &&
    body.classList.contains(scrollDown)
  ) {
    // up 
    body.classList.remove(scrollDown);
    body.classList.add(scrollUp);
  }
  lastScroll = currentScroll;
});




// gérer les évènements de click sur l'overlay (popups, menu ...)
if (overlay) {
  overlay.addEventListener('click', function (event) {
    var activeMenus = nav.querySelectorAll('li.show');
    activeMenus.forEach(menu => menu.classList.remove('show'));
    body.classList.remove('focus');
    Array.from(document.querySelectorAll('.modal.active')).forEach(
      (el) => el.classList.remove('active')
    );
  });
}






// HUBSPOT, UX & TRACKING (à supprimer si pas besoin)
document.addEventListener('DOMContentLoaded', function () {
  window.addEventListener('message', function (event) {
    if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {


      const formId = event.data.id; // Récupère l'ID du formulaire prêt
      const formElement = document.querySelector(`form[data-form-id="${formId}"]`);

      if (formElement) {
        // Désactiver l'autocomplétion pour tous les champs du formulaire
        const formFields = formElement.querySelectorAll('input, textarea');
        formFields.forEach(function (field) {
          field.setAttribute('autocomplete', 'off');
        });
      }

      if (event.data.id === '37c08c31-da30-4165-a908-bf342ae9e36e') { // Replace 'hs-news-form' with the actual form ID
        const hsNewsForm = document.getElementById('hs-news-form');
        if (hsNewsForm) {
          let toggle = hsNewsForm.querySelector('input[type="email"]');
          if (toggle) {
            toggle.addEventListener('click', function (event) {
              hsNewsForm.classList.add('active');
            });
          }
        }
      }
    }
  });

  window.addEventListener("message", function (event) {
    if (event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormSubmitted') {
      window.dataLayer.push({
        'event': 'hubspot-form-success',
        'hs-form-guid': event.data.id,
        'data': event.data
      });

    }

  });
});




// Slider qui se déplace au scroll, n'utilise pas swiper mais gsap car pas d'autre intéraction.
const bfwLoopSlider = document.querySelector(".bfw-loop-slider");

if (bfwLoopSlider) {
  gsap.utils.toArray(".bfw-loop-slider").forEach((item, index) => {
    const rows = item.querySelectorAll('.bfw-loop-slider__grid__wrapper');

    gsap.to(rows, {
      x: -100,
      ease: "none",
      scrollTrigger: {
        trigger: item,
        start: "top 90%",
        end: "bottom 30%",
        scrub: 2
      }
    });
  });
}


//



// dropdowns du mega menu, calcul de la taille maximum pour ne jamais dépasser le container. 
const dropdowns = nav.querySelectorAll('.mega-menu__item__toggle');

Array.from(dropdowns).forEach(dropdown => {
  dropdown.addEventListener('click', function (event) {
    let targetElement = event.target;
    let href = targetElement.getAttribute('href');
    if (href == '#') {
      event.preventDefault();
    }
    event.stopPropagation();

    let pop = dropdown.querySelector('.mega-menu__dropdown');
    let containerInner = dropdown.closest('.navbar');

    // Vérifier si le menu dépasse l'extrémité droite du conteneur
    let dropdownRect = dropdown.getBoundingClientRect();
    let containerInnerRect = containerInner.getBoundingClientRect();

    // Calculer la largeur maximale disponible
    let maxWidth = containerInnerRect.right - dropdownRect.left;
    pop.style.maxWidth = maxWidth + 'px';

    if (!dropdown.classList.contains('show')) {
      let activeMenus = nav.querySelectorAll('li.show');
      activeMenus.forEach(menu => menu.classList.remove('show'));
    }
    dropdown.classList.toggle('show');
  });
});


document.addEventListener('click', function (event) {
  if (!event.target.closest('.mega-menu__item__toggle')) {
    var activeMenus = nav.querySelectorAll('li.show');
    activeMenus.forEach(menu => menu.classList.remove('show'));
  }
});

// Fonction pour charger des vidéos
function loadVideo(player) {
  const videoID = player.getAttribute('videoID');

  if (player.classList.contains('youtube_player')) {
    // Charger la vidéo YouTube
    player.innerHTML = '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + videoID + '?rel=0&amp;controls=1&amp;showinfo=1&amp;autoplay=0&amp;enablejsapi=1" frameborder="0" allowfullscreen></iframe>';
  } else if (player.classList.contains('vimeo_player')) {
    // Charger la vidéo Vimeo
    player.innerHTML = '<iframe src="https://player.vimeo.com/video/' + videoID + '" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
  }
}