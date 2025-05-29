const chatHistory = document.getElementById("chatHistory");
const chatContent = document.getElementById("chatContent");
const autoscroll = document.querySelectorAll(".autoscroll");

function enableScrollOnDrag(elm) {
    let isDragging = false;
    let startY, scrollTop;

    for (let autos of autoscroll) {
    elm.addEventListener("mousedown", (e) => {
      isDragging = true;
      startY = e.pageY - elm.offsetTop;
      scrollTop = elm.scrollTop;
      autos.classList.add('isScroll');
    });

    elm.addEventListener("mousemove", (e) => {
      if (!isDragging) return;
      const y = e.pageY - elm.offsetTop;
      const walk = (y - startY) * 3; // Adjust scroll speed
      elm.scrollTop = scrollTop - walk;
    });

    elm.addEventListener("mouseup", () => {
      isDragging = false;
      autos.classList.remove('isScroll');
    });

    elm.addEventListener("mouseleave", () => {
      isDragging = false;
      autos.classList.remove('isScroll');
    });
}
}

  enableScrollOnDrag(chatHistory);
  enableScrollOnDrag(chatContent);