const cookieBanner = document.getElementById("cookie-banner")

function showSidebar(){
const sidebar = document.querySelector('.sidebar')
sidebar.style.display = 'flex'
}

function hideSidebar(){
const sidebar = document.querySelector('.sidebar')
sidebar.style.display = 'none'
}

window.addEventListener("load", () => {
    if (localStorage.getItem('cookie-ack') !== "true") {
        cookieBanner.style.display = 'flex'
    }
    console.log("wdwd")
})

document.getElementById("cookie-all-ack").addEventListener('click', () => {
    cookieBanner.style.display = 'none'
    localStorage.setItem('cookie-ack',"true")
})

document.getElementById("cookie-necessary-ack").addEventListener('click', () => {
    cookieBanner.style.display = "none"
})