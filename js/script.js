/*
    The MIT License (MIT)

    Copyright (c) 2014 Dirk Groenen

    Permission is hereby granted, free of charge, to any person obtaining a copy of
    this software and associated documentation files (the "Software"), to deal in
    the Software without restriction, including without limitation the rights to
    use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
    the Software, and to permit persons to whom the Software is furnished to do so,
    subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.
*/

(function ($) {
  $.fn.viewportChecker = function (useroptions) {
    // Define options and extend with user
    var options = {
      classToAdd: "visible",
      classToRemove: "invisible",
      classToAddForFullView: "full-visible",
      removeClassAfterAnimation: false,
      offset: 100,
      repeat: false,
      invertBottomOffset: true,
      callbackFunction: function (elem, action) {},
      scrollHorizontal: false,
      scrollBox: window,
    };
    $.extend(options, useroptions);

    // Cache the given element and height of the browser
    var $elem = this,
      boxSize = {
        height: $(options.scrollBox).height(),
        width: $(options.scrollBox).width(),
      };

    /*
     * Main method that checks the elements and adds or removes the class(es)
     */
    this.checkElements = function () {
      var viewportStart, viewportEnd;

      // Set some vars to check with
      if (!options.scrollHorizontal) {
        viewportStart = Math.max(
          $("html").scrollTop(),
          $("body").scrollTop(),
          $(window).scrollTop()
        );
        viewportEnd = viewportStart + boxSize.height;
      } else {
        viewportStart = Math.max(
          $("html").scrollLeft(),
          $("body").scrollLeft(),
          $(window).scrollLeft()
        );
        viewportEnd = viewportStart + boxSize.width;
      }

      // Loop through all given dom elements
      $elem.each(function () {
        var $obj = $(this),
          objOptions = {},
          attrOptions = {};

        //  Get any individual attribution data
        if ($obj.data("vp-add-class"))
          attrOptions.classToAdd = $obj.data("vp-add-class");
        if ($obj.data("vp-remove-class"))
          attrOptions.classToRemove = $obj.data("vp-remove-class");
        if ($obj.data("vp-add-class-full-view"))
          attrOptions.classToAddForFullView = $obj.data(
            "vp-add-class-full-view"
          );
        if ($obj.data("vp-keep-add-class"))
          attrOptions.removeClassAfterAnimation = $obj.data(
            "vp-remove-after-animation"
          );
        if ($obj.data("vp-offset")) attrOptions.offset = $obj.data("vp-offset");
        if ($obj.data("vp-repeat")) attrOptions.repeat = $obj.data("vp-repeat");
        if ($obj.data("vp-scrollHorizontal"))
          attrOptions.scrollHorizontal = $obj.data("vp-scrollHorizontal");
        if ($obj.data("vp-invertBottomOffset"))
          attrOptions.scrollHorizontal = $obj.data("vp-invertBottomOffset");

        // Extend objOptions with data attributes and default options
        $.extend(objOptions, options);
        $.extend(objOptions, attrOptions);

        // If class already exists; quit
        if ($obj.data("vp-animated") && !objOptions.repeat) {
          return;
        }

        // Check if the offset is percentage based
        if (String(objOptions.offset).indexOf("%") > 0)
          objOptions.offset =
            (parseInt(objOptions.offset) / 100) * boxSize.height;

        // Get the raw start and end positions
        var rawStart = !objOptions.scrollHorizontal
            ? $obj.offset().top
            : $obj.offset().left,
          rawEnd = !objOptions.scrollHorizontal
            ? rawStart + $obj.height()
            : rawStart + $obj.width();

        // Add the defined offset
        var elemStart = Math.round(rawStart) + objOptions.offset,
          elemEnd = !objOptions.scrollHorizontal
            ? elemStart + $obj.height()
            : elemStart + $obj.width();

        if (objOptions.invertBottomOffset) elemEnd -= objOptions.offset * 2;

        // Add class if in viewport
        if (elemStart < viewportEnd && elemEnd > viewportStart) {
          // Remove class
          $obj.removeClass(objOptions.classToRemove);
          $obj.addClass(objOptions.classToAdd);

          // Do the callback function. Callback wil send the jQuery object as parameter
          objOptions.callbackFunction($obj, "add");

          // Check if full element is in view
          if (rawEnd <= viewportEnd && rawStart >= viewportStart)
            $obj.addClass(objOptions.classToAddForFullView);
          else $obj.removeClass(objOptions.classToAddForFullView);

          // Set element as already animated
          $obj.data("vp-animated", true);

          if (objOptions.removeClassAfterAnimation) {
            $obj.one(
              "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
              function () {
                $obj.removeClass(objOptions.classToAdd);
              }
            );
          }

          // Remove class if not in viewport and repeat is true
        } else if ($obj.hasClass(objOptions.classToAdd) && objOptions.repeat) {
          $obj.removeClass(
            objOptions.classToAdd + " " + objOptions.classToAddForFullView
          );

          // Do the callback function.
          objOptions.callbackFunction($obj, "remove");

          // Remove already-animated-flag
          $obj.data("vp-animated", false);
        }
      });
    };

    /**
     * Binding the correct event listener is still a tricky thing.
     * People have expierenced sloppy scrolling when both scroll and touch
     * events are added, but to make sure devices with both scroll and touch
     * are handles too we always have to add the window.scroll event
     *
     * @see  https://github.com/dirkgroenen/jQuery-viewport-checker/issues/25
     * @see  https://github.com/dirkgroenen/jQuery-viewport-checker/issues/27
     */

    // Select the correct events
    if ("ontouchstart" in window || "onmsgesturechange" in window) {
      // Device with touchscreen
      $(document).bind(
        "touchmove MSPointerMove pointermove",
        this.checkElements
      );
    }

    // Always load on window load
    $(options.scrollBox).bind("load scroll", this.checkElements);

    // On resize change the height var
    $(window).resize(function (e) {
      boxSize = {
        height: $(options.scrollBox).height(),
        width: $(options.scrollBox).width(),
      };
      $elem.checkElements();
    });

    // trigger inital check if elements already visible
    this.checkElements();

    // Default jquery plugin behaviour
    return this;
  };
})(jQuery);

let postsOffest = 4;

jQuery(($) => {
  if ($(".post-type-archive-experiences").length > 0) {
    if (window.location.href.split("#").length > 1) {
      var top = $("#" + window.location.href.split("#")[1]).offset().top;
      setTimeout(() => {
        window.scrollTo(0, top);
      }, 2000);
    }
  }
  $("#load-more").on("click", () => {
    var data = {
      action: "load_more_posts",
      offset: postsOffest,
    };

    // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
    jQuery.post(Travemo.ajax_url, data, function (response) {
      const posts = $(response);
      posts.appendTo(".blog-wrap");
      postsOffest += 4;
    });
  });
  /* Nav menu */

  if (typeof locations !== "undefined") {
    let html = "";

    locations.forEach((location, index) => {
      const active = index === 0 ? "accordion--active" : "";
      html += `<div class="accordion ${active}">
      <div class="accordion__head">
          <div class="accordion__head_text">${location.title}</div>
          <button class="accordion__head_btn"></button>
      </div>
      <div class="accordion__body" style=""><div class="accordion__body_text">
      `;

      location.description.forEach((paragraph) => {
        html += paragraph + "<br>";
      });

      html += `</div></div>
    </div>`;
    });

    $(".accordion-wrapper").html(html);

    $(".accordion-wrapper").on("click", ".accordion__head", (e) => {
      $(".accordion--active").removeClass("accordion--active");
      $(e.currentTarget).parent().addClass("accordion--active");
    });
  }
  $(".menu-toggle, .menu-close").click(function () {
    $("nav").toggleClass("open");
  });
  /* Header scrolling */

  var didScroll;
  var lastScrollTop = 0;
  var delta = 5;
  var navbarHeight = $("header").outerHeight();

  $(window).scroll(function (event) {
    didScroll = true;
    if ($(document).scrollTop() > 100) {
      $("header").addClass("scrolled");
    } else {
      $("header").removeClass("scrolled");
    }
  });

  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  function hasScrolled() {
    var st = $(this).scrollTop();

    // Make scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta) return;

    // If scrolled down and past the navbar, add class .nav-up.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down
      $("header").removeClass("nav-down").addClass("nav-up");
    } else {
      // Scroll Up
      if (st + $(window).height() < $(document).height() + 100) {
        $("header").removeClass("nav-up").addClass("nav-down");
      }
    }

    lastScrollTop = st;
  }
  class fadeSlider {
    constructor(els) {
      this.els = els;
      this.currentSlide = 0;
    }

    changeSlide(value) {
      if (value == this.currentSlide) return;

      this.els.forEach((els) => {
        els.eq(this.currentSlide).removeClass("active");
      });

      if (value == "prev") {
        if (this.currentSlide - 1 == -1) {
          this.currentSlide = this.els[0].length - 1;
        } else {
          this.currentSlide--;
        }
      } else if (value == "next") {
        if (this.currentSlide + 1 == this.els[0].length) {
          this.currentSlide = 0;
        } else {
          this.currentSlide++;
        }
      } else {
        this.currentSlide = value;
      }

      this.els.forEach((els) => {
        els.eq(this.currentSlide).addClass("active");
      });
    }
  }

  if (
    $(".home").length > 0 ||
    $(".post-type-archive-tour-collection").length > 0
  ) {
    /* Feature Fade Slider */

    const featureSlideNavElements = $(".feature-slider .slider-nav button");

    const featureSlideSlideElements = $(".feature-slider .fade-slider article");

    const featureSlider = new fadeSlider([
      featureSlideNavElements,
      featureSlideSlideElements,
    ]);

    setInterval(() => {
      featureSlider.changeSlide("next");
    }, 9000);

    featureSlideNavElements.on("click", (e) => {
      const index = $(e.currentTarget).index();
      featureSlider.changeSlide(index);
    });

    const testimonialSlider = new fadeSlider([$(".testimonial-slide")]);

    $(".custom-next").on("click", () => {
      testimonialSlider.changeSlide("next");
    });

    $(".custom-prev").on("click", () => {
      testimonialSlider.changeSlide("prev");
    });

    const populateToursAndExperiences = () => {
      let tours_and_experiences_html = "";

      articles.forEach((article) => {
        const type =
          article.type == "tour" ? "Premium tour" : "Premium experience";
        tours_and_experiences_html += `<article>
                          <a href="${article.url}" class="tours-image"><img src="${article.media.url}" alt="Travemo Club"></a>
                          <h4><a href="${article.url}"><span>${article.title}</span><img src="${Travemo.template_url}/img/arrow-right.svg" alt="Travemo Club"></a></h4>
                         
                          <p>${type}</p>
                      </article>`;
      });

      $(".tours-wrapper-inner").html(tours_and_experiences_html);

      if (screen.width > 768) {
        const slider = document.querySelector(".tours-wrapper");
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener("mousedown", (e) => {
          isDown = true;

          slider.classList.add("active");
          startX = e.pageX - slider.offsetLeft;
          scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener("mouseleave", () => {
          isDown = false;
          slider.classList.remove("active");
        });
        slider.addEventListener("mouseup", () => {
          isDown = false;
          slider.classList.remove("active");
        });
        slider.addEventListener("mousemove", (e) => {
          if (!isDown) return;
          e.preventDefault();
          const x = e.pageX - slider.offsetLeft;
          const walk = (x - startX) * 3; //scroll-fast
          slider.scrollLeft = scrollLeft - walk;
          // console.log(walk);
          if (walk) {
            document.querySelector(".tours-cursor").classList.add("hide");
          } else if ((walk = startX)) {
            document.querySelector(".tours-cursor").classList.remove("hide");
            console.log("works");
          }
        });
      }
    };

    populateToursAndExperiences();
  }
  $(".destinations-map a").on({
    mouseenter: function (e) {
      $(".destinations-map .active, .destinations-content .active").removeClass(
        "active"
      );
      $(e.currentTarget).addClass("active");
      const country = $(e.currentTarget).attr("id");
      $("#" + country + "_images").addClass("active");
      console.log("#" + country + "_images");
    },
    mouseleave: function (e) {
      $(".destinations-map .active, .destinations-content .active").removeClass(
        "active"
      );

      $("#croatia").addClass("active");

      $("#croatia_images").addClass("active");
    },
  });

  $(
    ".feature-slider, .tours-wrapper,  .destinations-images, .stories-wrapper, .cta-section .btn"
  )
    .addClass("hidden")
    .viewportChecker({
      classToAdd: "visible animate__animated animate__fadeIn",
      offset: 150,
    });
  $(
    ".feature-section .title h2, .tours-section .title-default,  .testimonials-slider p,  .member .title h2, .cta-section h2, .destinations-content .title-default, .stories .title-default"
  )
    .addClass("hidden")
    .viewportChecker({
      classToAdd: "visible animate__animated animate__fadeInUp",
      offset: 150,
    });

  if ($(".post-type-archive-tours-collection").length > 0) {
    let tours_and_experiences_html = "";
    articles.forEach((article) => {
      const type =
        article.type == "tour" ? "Premium tour" : "Premium experience";
      tours_and_experiences_html += `<article>
                        <a class="tours-image"><img src="${article.media.url}" alt="Travemo Club"></a>
                        <h4><a href="${article.url}"><span>${article.title}</span><img src="${Travemo.template_url}/img/arrow-right.svg" alt="Travemo Club"></a></h4>
                       
                        <p>${type}</p>
                    </article>`;
    });

    $(".tours-wrapper-inner").html(tours_and_experiences_html);
  }

  $(".error").on("input", (e) => {
    if (e.currentTarget.value.length > 0) {
      $(e.currentTarget).removeClass("error");
      $(e.currentTarget).siblings(".error-message").hide();
    }
  });

  if (typeof gallery !== "undefined") {
    if ($(".single-tour-collection").length > 0) {
      let galleryHTML = "";

      gallery.forEach((image, index) => {
        const active = index === 0 ? "active" : "";
        galleryHTML += `<div class="${active} next-${index}" style="background-image:url(${image})" alt="Travemo Club"></div>`;
      });

      const images = $(galleryHTML);

      images.appendTo(".tour-gallery");

      let nextSlide = 6;

      const tourSliderElements = images;

      setInterval(() => {
        if (!document.hidden) {
          // do what you need
          changeSlide();
        }
      }, 2000);

      function changeSlide() {
        $(".tour-gallery div.active").removeClass("active").addClass("prev");

        $(".tour-gallery div.next-1").removeClass("next-1").addClass("active");

        $(".tour-gallery div.next-2").removeClass("next-2").addClass("next-1");

        $(".tour-gallery div.next-3").removeClass("next-3").addClass("next-2");

        $(".tour-gallery div.next-4").removeClass("next-4").addClass("next-3");
        $(".tour-gallery div.next-5").removeClass("next-5").addClass("next-4");

        if (nextSlide == gallery.length) {
          $(".tour-gallery div")
            .eq(0)
            .css("transition", "none")
            .removeClass("prev")
            .addClass("next-5");
          setTimeout(() => {
            $(".tour-gallery div").eq(0).css("transition", "2s all");
            nextSlide = 1;
          }, 100);
        } else {
          $(".tour-gallery div")
            .eq(nextSlide)
            .css("transition", "none")
            .removeClass("prev")
            .addClass("next-5");

          setTimeout(() => {
            $(".tour-gallery div").eq(nextSlide).css("transition", "2s all");
            nextSlide++;
          }, 100);
        }
      }
    }
  }

  if (typeof destinationGallery !== "undefined") {
    let destinationGalleryHTML = "";

    destinationGallery.forEach((image, index) => {
      const active = index === 0 ? "active" : "";
      destinationGalleryHTML += `<div class="${active} next-${index}" style="background-image:url(${image})" alt="Travemo Club"></div>`;
    });

    const destinationImages = $(destinationGalleryHTML);

    destinationImages.appendTo(".destinations-slider");

    let nextSlide = 6;

    setInterval(() => {
      changeDSlide();
    }, 2000);

    function changeDSlide() {
      $(".destinations-slider div.active")
        .removeClass("active")
        .addClass("prev");

      $(".destinations-slider div.next-1")
        .removeClass("next-1")
        .addClass("active");

      $(".destinations-slider div.next-2")
        .removeClass("next-2")
        .addClass("next-1");

      $(".destinations-slider div.next-3")
        .removeClass("next-3")
        .addClass("next-2");

      $(".destinations-slider div.next-4")
        .removeClass("next-4")
        .addClass("next-3");
      $(".destinations-slider div.next-5")
        .removeClass("next-5")
        .addClass("next-4");

      if (nextSlide == destinationGallery.length) {
        $(".destinations-slider div")
          .eq(0)
          .css("transition", "none")
          .removeClass("prev")
          .addClass("next-5");
        setTimeout(() => {
          $(".destinations-slider div").eq(0).css("transition", "2s all");
          nextSlide = 1;
        }, 100);
      } else {
        $(".destinations-slider div")
          .eq(nextSlide)
          .css("transition", "none")
          .removeClass("prev")
          .addClass("next-5");

        setTimeout(() => {
          $(".destinations-slider div")
            .eq(nextSlide)
            .css("transition", "2s all");
          nextSlide++;
        }, 100);
      }
    }
  }
  if (typeof features !== "undefined") {
    const imgURL = $(".single-tour-icons img").attr("src");

    let featuresHTML = "";

    features.forEach((feature) => {
      const iconURL =
        imgURL + feature.toLowerCase().replaceAll(" ", "-") + ".svg";
      console.log(feature.toLowerCase().replace(" ", "-"));

      featuresHTML += `<article>
    <img src="${iconURL}" alt="Travemo Club">
    <h4>${feature}</h4>
</article>`;
    });
    $(".single-tour-icons").html(featuresHTML);
  }

  if (typeof itinerary !== "undefined") {
    if ($(".single-tour-collection").length > 0) {
      $(".duration").html("Suggested duration: " + duration);

      let itineraryHTML = "";

      itinerary.forEach((item) => {
        item = item.split("@");
        if (item[1]) {
          item = item[0] + "</br><span>" + item[1] + "</span>";
        } else {
          item = item[0];
        }

        itineraryHTML += `<li>${item}</li>`;
      });

      $(".itinerary-plan ul").html(itineraryHTML);
    }
  }
});

function slugify(str) {
  return String(str) // trim leading or trailing whitespace
    .toLowerCase()
    .replace(/\s+/g, "-"); // replace spaces with hyphens
}
