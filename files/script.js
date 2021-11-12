const menuBtn = document.querySelector(".menuBtn")
const menu = document.querySelector("#menu")
const darkMode = document.querySelector("#switchMode")

function openMenu(toggle=true){
    if(toggle){
        menu.classList.toggle("opened")
        menuBtn.classList.toggle("fa-times")
    }else{
        menu.classList.remove("opened")
        menuBtn.classList.remove("fa-times")
    }
}
menuBtn.addEventListener("click", function(event){
    event.stopPropagation()
    openMenu()
})
document.body.addEventListener("click", ()=> openMenu(false))

darkMode.addEventListener("click", ()=>{
    document.body.classList.toggle("darkmode")
})