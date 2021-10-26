const body = document.getElementsByTagName("BODY")[0];
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("overlay").style.display = "block";
  body.classList.add("overflow-hidden")
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("overlay").style.display = "none";
  body.classList.remove("overflow-hidden")
}

$(document).ready(function () {
  $(".carousel-sm").owlCarousel(
    {
      items: 1,
      dots: true,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
    }
  );
});

$(document).ready(function () {
  $(".items-4").owlCarousel(
    {
      items: 4,
      dots: false,
      nav: true,
      mouseDrag: false,
      touchDrag: false,
      pullDrag: false,
      slideBy: 4,
      responsiveClass: true,
      margin: 10,
      responsive: {
        0: {
          items: 2,
          slideBy: 2,
        },
        575: {
          items: 3,
          slideBy: 3,
        },
        991: {
          items: 4,
        },
      }
    }
  );
});

$(document).ready(function () {
  $(".items-5").owlCarousel(
    {
      items: 5,
      dots: false,
      nav: true,
      mouseDrag: false,
      touchDrag: false,
      pullDrag: false,
      slideBy: 5,
      responsiveClass: true,
      margin: 10,
      responsive: {
        0: {
          items: 2,
          slideBy: 2,
        },
        575: {
          items: 3,
          slideBy: 3,
        },
        768: {
          items: 4,
          slideBy: 4,
        },
        991: {
          items: 5,
          slideBy: 5,
        },
      }
    }
  );
});
$(document).ready(function () {
  $(".items-3").owlCarousel(
    {
      items: 3,
      dots: false,
      nav: true,
      slideBy: 3,
      touchDrag: false,
      mouseDrag: false,
      pullDrag: false,
      responsiveClass: true,
      margin: 10,
      responsive: {

        0: {
          items: 1,
          slideBy: 1,
          touchDrag: true,
          mouseDrag: true,
          pullDrag: true,
          nav: false,
        },
        575: {
          items: 2,
          slideBy: 2,
          touchDrag: true,
          mouseDrag: true,
          pullDrag: true,
          nav: false,
        },
        768: {
          items: 3,
          slideBy: 3,
          touchDrag: false,
          mouseDrag: false,
          pullDrag: false,
          nav: true,
        },
      }
    }
  );
});

// Product IMG 

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) { slideIndex = 1 }
  if (n < 1) { slideIndex = slides.length }
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
  captionText.innerHTML = dots[slideIndex - 1].alt;
}

// Accorddin btn 

const accordinBtns = document.querySelectorAll(".accordin-btns")

accordinBtns.forEach(accordinBtn =>{
  accordinBtn.addEventListener('click',()=>{
    alert("asd")
  })
})
