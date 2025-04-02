function updateSliderArrowsStatus(
    cardsContainer,
    containerWidth,
    cardCount,
    cardWidth
  ) {
    if (
      $(cardsContainer).scrollLeft() + containerWidth <
      cardCount * cardWidth + 15
    ) {
      $("#slide-right-container").addClass("active");
    } else {
      $("#slide-right-container").removeClass("active");
    }
    if ($(cardsContainer).scrollLeft() > 0) {
      $("#slide-left-container").addClass("active");
    } else {
      $("#slide-left-container").removeClass("active");
    }
  }
  $(function() {
    // Scroll products' slider left/right
    let div = $("#cards-container");
    let cardCount = $(div)
      .find(".cards")
      .children(".card").length;
    let speed = 1000;
    let containerWidth = $(".container").width();
    let cardWidth = 250;
  
    updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
  
    //Remove scrollbars
    $("#slide-right-container").click(function(e) {
      if ($(div).scrollLeft() + containerWidth < cardCount * cardWidth) {
        $(div).animate(
          {
            scrollLeft: $(div).scrollLeft() + cardWidth
          },
          {
            duration: speed,
            complete: function() {
              setTimeout(
                updateSliderArrowsStatus(
                  div,
                  containerWidth,
                  cardCount,
                  cardWidth
                ),
                1005
              );
            }
          }
        );
      }
      updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
    });
    $("#slide-left-container").click(function(e) {
      if ($(div).scrollLeft() + containerWidth > containerWidth) {
        $(div).animate(
          {
            scrollLeft: "-=" + cardWidth
          },
          {
            duration: speed,
            complete: function() {
              setTimeout(
                updateSliderArrowsStatus(
                  div,
                  containerWidth,
                  cardCount,
                  cardWidth
                ),
                1005
              );
            }
          }
        );
      }
      updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
    });
  
    // If resize action ocurred then update the container width value
    $(window).resize(function() {
      try {
        containerWidth = $("#cards-container").width();
        updateSliderArrowsStatus(div, containerWidth, cardCount, cardWidth);
      } catch (error) {
        console.log(
          `Error occured while trying to get updated slider container width: 
              ${error}`
        );
      }
    });
  });
  
  const slider = document.getElementsByClassName('c-slider')[0];
  const timeline = new TimelineLite();
  const info = document.getElementsByClassName('c-drag')[0];
  
  let canMove = false;
  let touchDown = 0;
  let prevX = 0;
  let slides = document.getElementsByClassName('c-slide');
  const slideWidth = slides[0].offsetWidth + 20;
  
  
  const init = () => {
    slider.addEventListener('mousedown', handleMouse);
    slider.addEventListener('mouseup', handleMouse);
    slider.addEventListener('mousemove', handleMove);
    
    slider.addEventListener('touchstart', handleTouch);
    slider.addEventListener('touchmove', handleTouchMove);
  };
  
  /* Mouse handlers */
  const handleMouse = e => {
    if (e.type === 'mouseup') {
      canMove = false;
    } else {
      canMove = true;
    }
  };
  
  const handleMove = e => {
    if (e.pageX < prevX && canMove) {
      /* to left */
      info.innerHTML = 'Swiping left!';
      handleSwipeLeft();
      canMove = false;
    } else if (e.pageX > prevX && canMove) {
      /* to right */
      info.innerHTML = 'Swiping right!';
      handleSwipeRight();
      canMove = false;
    }
  
    prevX = e.pageX;
  };
  
  /* Touch handlers */
  const handleTouch = e => {
    touchDown = e.touches[0].clientX
  }
  
  const handleTouchMove = e => {
    if (!touchDown) {
      return
    }
  
    const touchUp = e.touches[0].clientX
    const touchDiff = touchDown - touchUp
  
    if (touchDiff > 0) {
      info.innerHTML = 'Swiping left!';
      handleSwipeLeft();
    } else {
      info.innerHTML = 'Swiping right!';
      handleSwipeRight();
    }
  
     touchDown = null
   };
  
  /* Swipe handlers */
  const handleSwipeLeft = () => {  
    timeline.fromTo(slider, 1, 
      {
        x: '0px'
      },
      {
        x: `-${slideWidth}px`,
        ease: Power4.easeOut
      }
    );
    
    timeline.to(slider, 0.001, 
      {
        x: '0px',
        onComplete: () => {
          slider.appendChild(slides[0]);
          slides = document.getElementsByClassName('c-slide');
        }
      }
    );
  };
  
  const handleSwipeRight = () => {  
    timeline.to(slider, 0.001, 
      {
        x: `-${slideWidth}px`,
        onComplete: () => {
          const first = slides[0];
          const last = slides[slides.length - 1];
          slider.insertBefore(last, first);
          slides = document.getElementsByClassName('c-slide');
        }
      }
    );
    
    timeline.to(slider, 1, 
      {
        x: `0px`,
        ease: Power4.easeOut
      }
    );
  };
  
  init();



  

  