const initSlider = () => {
    const clientJob = document.querySelector(".Huge-container");
    const chevrons = document.querySelectorAll(".chevron");
    const sliderscrollbar = document.querySelector(".slider-scrollbar");
    const scrollbarThumb = sliderscrollbar.querySelector(".scrollbar-thumb");
    const maxScrollLeft = clientJob.scrollWidth - clientJob.clientWidth;
  
    let autoScrollInterval;
  
    const startAutoScroll = () => {
      autoScrollInterval = setInterval(() => {
        clientJob.scrollLeft += 1; // Adjust scroll speed as needed
        if (clientJob.scrollLeft >= maxScrollLeft) {
          clientJob.scrollLeft = 0;
        }
      }, 30); // Adjust scroll interval as needed
    };
  
    const stopAutoScroll = () => {
      clearInterval(autoScrollInterval);
    };
  
    clientJob.addEventListener("mouseenter", stopAutoScroll);
    clientJob.addEventListener("mouseleave", startAutoScroll);
  
    startAutoScroll(); // Start auto scrolling initially
  
    sliderscrollbar.addEventListener("mousedown", (e) => {
      const startX = e.clientX;
      const thumbPosition = scrollbarThumb.offsetLeft;
  
      const handleMouseMove = (e) => {
        const deltaX = e.clientX - startX;
        const newThumbPosition = thumbPosition + deltaX;
        const maxThumbPosition = sliderscrollbar.clientWidth - scrollbarThumb.offsetWidth;
        const boundedPosition = Math.max(0, Math.min(maxThumbPosition, newThumbPosition));
        const scrollPosition = (boundedPosition / maxThumbPosition) * maxScrollLeft;
  
        scrollbarThumb.style.left = `${boundedPosition}px`;
        clientJob.scrollLeft = scrollPosition;
      };
  
      const handleMouseUp = () => {
        document.removeEventListener("mousemove", handleMouseMove);
        document.removeEventListener("mouseup", handleMouseUp);
      };
  
      document.addEventListener("mousemove", handleMouseMove);
      document.addEventListener("mouseup", handleMouseUp);
    });
  
    chevrons.forEach(chevron => {
      chevron.addEventListener("click", () => {
        const direction = chevron.classList.contains("left-chevron") ? -1 : 1;
        const scrollAmount = clientJob.clientWidth * direction;
        clientJob.scrollBy({ left: scrollAmount, behavior: "smooth" });
      });
    });
  
    const handleChevron = () => {
      chevrons[0].style.display = clientJob.scrollLeft <= 0 ? "none" : "block";
      chevrons[1].style.display = clientJob.scrollLeft >= maxScrollLeft ? "none" : "block";
    };
  
    const updateScrollThumbPosition = () => {
      const scrollPosition = clientJob.scrollLeft;
      const thumbPosition = (scrollPosition / maxScrollLeft) * (sliderscrollbar.clientWidth - scrollbarThumb.offsetWidth);
      scrollbarThumb.style.left = `${thumbPosition}px`;
    };
  
    clientJob.addEventListener("scroll", () => {
      handleChevron();
      updateScrollThumbPosition();
    });
  
    handleChevron();
    updateScrollThumbPosition();
  };
  
  window.addEventListener("load", initSlider);
  