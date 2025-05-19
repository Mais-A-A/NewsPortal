const content = document.getElementById("body-content");
const increaseBtn = document.getElementById("increase-font");
const decreaseBtn = document.getElementById("decrease-font");

let currentFontSize = 18; 

increaseBtn.addEventListener("click", () => {
    currentFontSize += 1;
    content.style.fontSize = currentFontSize + "px";
});

decreaseBtn.addEventListener("click", () => {
    if (currentFontSize > 10) { 
        currentFontSize -= 1;
        content.style.fontSize = currentFontSize + "px";
    }
});

