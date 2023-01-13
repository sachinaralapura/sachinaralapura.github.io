const navBar = document.querySelector("nav"),
               menuBtns = document.querySelectorAll(".menu-icon"),
               overlay = document.querySelector(".overlay");

const Dashboard = document.querySelector(".Dashboard");
const Accounts = document.querySelector(".Accounts");
const Income = document.querySelector(".Income");
const Expenses = document.querySelector(".Expenses");
const Credit =document.querySelector(".Credit");
const Lend = document.querySelector(".Lend");

//contents

const Dashcontents = document.querySelector(".Dashcontents");
const accontents = document.querySelector(".accontents");
const incontents = document.querySelector(".incontents");
const expcontents = document.querySelector(".expcontents");
const creditcontents = document.querySelector(".creditcontents");
const lendcontents = document.querySelector(".lendcontents");
               
menuBtns.forEach(menuBtns =>{
    menuBtns.addEventListener("click",() =>{
        navBar.classList.toggle("open");
        Dashcontents.classList.toggle("Dashcontents");
    });
});

overlay.addEventListener("click",()=>{
    navBar.classList.remove("open");

});

Dashboard.addEventListener("click",()=>{

})


console.log(Dashboard)
