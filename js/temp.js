let galleryHTML = "";

gallery.forEach((image, index) => {
  const active = index === 0 ? "active" : "";
  const next = index === 1 ? "next" : "";
  const nextNext = index === 2 ? "next-next" : "";
  const nextNextNext = index === 3 ? "next-next-next" : "";
  galleryHTML += `<div class="${active} ${next} ${nextNext} ${nextNextNext}" style="background-image:url(${image})" alt="Travemo Club"></div>`;
});

const images = $(galleryHTML);

images.appendTo(".tour-gallery");

let nextSlide = 2;

const tourSliderElements = images;

setInterval(() => {
  changeSlide();
}, 2000);

function changeSlide() {
  $(".tour-gallery div.active").removeClass("active").addClass("prev");

  $(".tour-gallery div.next").removeClass("next").addClass("active");

  $(".tour-gallery div.next-next").removeClass("next-next").addClass("next");

  if (nextSlide + 1 == gallery.length) {
    nextSlide = 0;
    $(".tour-gallery div").eq(0).removeClass("next-next").addClass("next-next");
  } else {
    nextSlide++;
    $(".tour-gallery div")
      .eq(nextSlide)
      .removeClass("next-next")
      .addClass("next-next");
  }
}
