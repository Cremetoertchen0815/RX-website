//Narrow navigation
let narrowNav = document.getElementById('navNarrow');
let navArrow = document.getElementById('navArrow');
let narrowNavList = document.getElementById('navNarrowList'); // transform: rotate(180deg);
narrowNav.onclick = () => {

    let direction = narrowNavList.style.height != "0px";
    narrowNavList.style.height = direction ? "0px" : "240px";
    navArrow.style.transform = direction ? "rotate(0deg)" : "rotate(180deg)";
}

//Common navigation
let browser = document.getElementById("pageContainer");
let allNav = document.querySelectorAll(".navPoint");
allNav.forEach(x => x.onclick = () => 
    {
        let nuPath = x.getAttribute("destination");
        allNav.forEach(y => y.style.textDecoration = "none");
        x.style.textDecoration = "underline";
        narrowNavList.style.height = "0px";
        navArrow.style.transform = "rotate(0deg)";
        browser.setAttribute("src", nuPath);
    }
);