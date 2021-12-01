function call_js() {
  //변수지정
  let slideshow = document.querySelector(".slideshow");
  let slideshowSlides = document.querySelector(".slideshow_slides");
  let slides = document.querySelectorAll(".slideshow_slides a");
  let prev = document.querySelector(".prev");
  let next = document.querySelector(".next");
  let slidesCount = slides.length;
  let indicators = document.querySelectorAll(".slide_indicator a");

  //이미지화면 위치를 저장한다.(0 -> 1번이미지, 1->2번이미지)
  let currentIndex = 0;

  //이미지를 절대배치로 가로방식으로 배열한다
  for (let i = 0; i < slidesCount; i++) {
    let newLeft = i * 100 + "%";
    slides[i].style.left = newLeft;
  }

  function gotoSlide(index) {
    currentIndex = index;
    let newLeft = currentIndex * -100 + "%";
    slideshowSlides.style.left = newLeft;
    slideshowSlides.classList.add("animated");

    for (let i = 0; i < indicators.length; i++) {
      indicators[i].classList.remove("active");
    }
    indicators[currentIndex].className = "active";
  }

  prev.addEventListener("click", function (event) {
    event.preventDefault();
    //인덱스 0번일때 -> 3으로지정하면 된다
    //인덱스 0번이 아닐때 -> 1을 빼주면된다.
    if (currentIndex !== 0) {
      currentIndex = currentIndex - 1;
    } else {
      currentIndex = slidesCount - 1;
    }
    gotoSlide(currentIndex);
  });

  next.addEventListener("click", function (event) {
    event.preventDefault();
    //인덱스 0번일때 -> 3으로지정하면 된다
    //인덱스 0번이 아닐때 -> 1을 더해주면된다.
    if (currentIndex !== slidesCount - 1) {
      currentIndex = currentIndex + 1;
    } else {
      currentIndex = 0;
    }
    gotoSlide(currentIndex);
  });

  function startTimer() {
    timer = setInterval(function () {
      let nextIndex = (currentIndex + 1) % slidesCount;
      gotoSlide(nextIndex);
    }, 3000);
  }
  startTimer();

  slideshowSlides.addEventListener("mouseover", function () {
    clearInterval(timer);
  });
  slideshowSlides.addEventListener("mouseleave", function () {
    startTimer();
  });

  for (let i = 0; i < indicators.length; i++) {
    indicators[i].addEventListener("click", function (event) {
      event.preventDefault();
      gotoSlide(i);
    });
  }
  gotoSlide(1);
}
