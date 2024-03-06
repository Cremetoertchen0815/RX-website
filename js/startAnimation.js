let contentLoaded = false;
let animationComplete = false;

startFadeOut = () => {
    let cover = document.getElementById("pageCover");
    cover.classList.add("fadeOut");
    cover.onanimationend = () => console.log("peen");
    cover.style.pointerEvents = "none";
};

const container = document.getElementById("pageContainer");
container.src = "start.php";
container.onload = () => {
    contentLoaded = true;
    if (animationComplete) startFadeOut();
};



const animated = document.getElementById("logoText");
animated.addEventListener('animationend', () => {
    animationComplete = true;
    if (contentLoaded) startFadeOut();
});