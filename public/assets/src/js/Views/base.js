export const selectors = {
  frontPage: {
    testimonials: ".glide",
    testimonialContent: '.testimonial-content',
    // testimonialContent: '.scroller',
    gallery: ".gallery",
    header: {
      base: "#page-header",
      bgImg: "#page-header__background-image",
      logo: "#intro"
    }
  }
};

export const elements = {
  frontPage: {
    testimonials: document.querySelector(selectors.frontPage.testimonials),
    gallery: document.querySelector(selectors.frontPage.gallery),
    header: document.querySelector(selectors.frontPage.header.base),
    headerBackground: document.querySelector(selectors.frontPage.header.bgImg),
    headerLogo: document.querySelector(selectors.frontPage.header.logo),
    testimonialContent: document.querySelectorAll(selectors.frontPage.testimonialContent),
  }
};
