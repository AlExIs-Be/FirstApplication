const menuBtn = document.querySelector(".menuBtn")
const menu = document.querySelector("#menu")
const switchMode = document.querySelector("#switchMode")

function openMenu( toggle = true ){
    if( toggle ){
        menu.classList.toggle("opened")
        menuBtn.classList.toggle("fa-times")
    }else{
        menu.classList.remove("opened")
        menuBtn.classList.remove("fa-times")
    }
}
menuBtn.addEventListener( "click", function( event ){
    event.stopPropagation()
    openMenu()
})
document.body.addEventListener( "click", ()=> openMenu( false ) )

function switchmode(){
    if( localStorage.getItem("mode") == "night" ){
        setmode("day")
    }else{
        setmode("night")
    }
}
function setmode(mode){
    if(mode == "night"){
        localStorage.setItem("mode", "night")
        document.body.classList.add("darkmode")
        switchMode.textContent="\u263c"
    }else if(mode == "day"){
        localStorage.setItem("mode", "day")
        document.body.classList.remove("darkmode")
        switchMode.textContent="\u263d"
    }
}
setmode(localStorage.getItem("mode"))

switchMode.addEventListener( "click", ()=>switchmode())