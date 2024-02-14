//Narrow navigation
let narrowNav = document.getElementById('navNarrow');
let narrowNavList = document.getElementById('navNarrowList');
narrowNav.onclick = () => narrowNavList.style.height = narrowNavList.style.height != "0%" ? "0%" : "100%";

//Common navigation
let browser = document.getElementById("pageContainer");
let allNav = document.querySelectorAll(".navPoint");
allNav.forEach(x => x.onclick = () => 
    {
        let nuPath = x.getAttribute("destination");
        allNav.forEach(y => y.style.textDecoration = "none");
        x.style.textDecoration = "underline";
        narrowNavList.style.height = "0%";
        browser.setAttribute("src", nuPath);
    }
);