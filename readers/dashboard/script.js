const body = document.querySelector('body'),
    sidebar = body.querySelector('nav'),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeSwitchSmall = body.querySelector(".small-sun")
    modeText = body.querySelector(".mode-text");


toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click", () => {
    sidebar.classList.remove("close");
})

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
    } else {
        modeText.innerText = "Dark mode";
    }
});
modeSwitchSmall.addEventListener("click", () =>{
    body.classList.toggle("dark")
    if (body.classList.contains("dark")) {
        document.getElementById("small-sun").className = "bx bx-sun icon sun";
    } else {
        document.getElementById("small-sun").className = "bx bx-moon icon moon";
    }
})

// slick slider
$(".variable").slick({
    // dots: true,
    infinite: true,
    variableWidth: true
  });
  $(".vertical").slick({
    dots: true,
    vertical: true,
    centerMode: true,
  });