/**
 * dependencies
 */
import ImagesLoaded from 'imagesloaded'
import Aos from 'aos'

/**
 * stuffs
 */
import * as rearrangeView from './Views/rearrangeView'
import {
  elements
} from './Views/base'

/**
 * init if you gotta
 */
Aos.init()

/**
 * testimonials
 */
ImagesLoaded(elements.frontPage.testimonials, rearrangeView.initSlider)
// document.addEventListener('DOMContentLoaded', rearrangeView.initSlider);

/**
 * gallery
 */
// ImagesLoaded(elements.frontPage.gallery, rearrangeView.initMasonry);

/**
 * parallax
 */
// document.addEventListener('DOMContentLoaded', rearrangeView.initParallax);
ImagesLoaded(elements.frontPage.headerBackground, rearrangeView.initParallax)

/**
 * scrollbars
 */
document.addEventListener('DOMContentLoaded', rearrangeView.initSimpleBar)
