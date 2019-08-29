/**
 * dependencies
 */
import Rellax from 'rellax';
// import SimpleBar from 'simplebar';
import Glide from '@glidejs/glide';
import Masonry from 'masonry-layout';
import OverlayScrollbars from 'overlayscrollbars';

/**
 * stuffs
 */
import {
  elements,
  selectors
} from "./base";
import { rellaxers } from './parallax';

/**
 * parallax scrolling
 */
export function initParallax() {
  const selector = 'rellax';
  const base = 'data-rellax-';
  const options = ['speed', 'percentage', 'zindex'];

  var rellax = rellaxers.frontPage;

  rellax.forEach(rellaxer => {
    const element = rellaxer.element;

    element.classList.add(selector);

    options.forEach(option => {
      if (rellaxer.hasOwnProperty(option)) {
        element.setAttribute(base + option, rellaxer[option]);
      }
    });
  });

  rellax = new Rellax(`.${selector}`, {
    round: false
  });
}

/**
 * masonry
 */
export function initMasonry(instance) {
  new Masonry(elements.frontPage.gallery, {
    itemSelector: '[class^=gallery__item-]',
    columnWidth: '.cornerstone',
    percentPosition: true,
  });
}

/**
 * sliders
 */
export function initSlider(ImagesLoaded) {
  let slider = elements.frontPage.testimonials;

  const slides = slider.querySelector('[data-glide-el="track"]>ul');
  const count = slides.childElementCount;
  const maxSlides = 1;

  slider = new Glide(slider, {
    type: 'carousel',
    perView: (count < maxSlides) ? count : maxSlides,
    // autoplay: (count <= maxSlides) ? false : 5000
    autoplay: false
  });

  slider.mount();
}

/**
 * scrollbars
 */
export function initSimpleBar(e) {
  const scrollElements = elements.frontPage.testimonialContent;

  const instances = OverlayScrollbars(scrollElements, {
    className: "os-theme-thin-light",
    paddingAbsolute: true,
    overflowBehavior: {
      x: 'hidden',
      y: 'visible-hidden',
    },
    scrollbars: {
      visibility: 'auto',
      autoHide: "leave",
      autoHideDelay: 300
    }
  });

  // instances.forEach(instance => {
  //   let overflow = instance.getState('hasOverflow').y;

  //   if (true === overflow) {

  //     instance.getElements('target').querySelector('.os-content').classList.add('fix-os-scroll');
  //   }
  // })

  // Array.from(scrollElements).forEach(el => el = new SimpleBar(el, {
  //   autoHide: false
  // }));
}
