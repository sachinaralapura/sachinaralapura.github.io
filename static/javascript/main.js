const navBar = document.querySelector("nav"),
  menuBtns = document.querySelectorAll(".menu-icon"),
  overlay = document.querySelector(".overlay");

const Dashboard = document.querySelector(".Dashboard");
const Accounts = document.querySelector(".Accounts");
const Income = document.querySelector(".Income");
const Expenses = document.querySelector(".Expenses");
const Credit = document.querySelector(".Credit");
const cards = document.querySelector(".cards");

//contents
var mainpanel = document.querySelector(".mainpanel");
var mainpanelchild = mainpanel.children;


//accounts

const addacc = document.querySelector(".addacc");
const accform = document.querySelector(".accform");

//income 

const addincome = document.querySelector(".addincome");
const incomeform = document.querySelector(".incomeform");

// display income form 

const displayincomeform = document.querySelector(".displayincomeform");
const incomedisplayform = document.querySelector(".incomedisplayform");

// display income

const displayincome = document.querySelector(".displayincome");
const incometable = document.querySelector(".incometable");

// const accontents = document.querySelector(".accontents");
// const incontents = document.querySelector(".incontents");
// const expcontents = document.querySelector(".expcontents");
// const creditcontents = document.querySelector(".creditcontents");
// const lendcontents = document.querySelector(".lendcontents");

//===============================expenses =======================
const addexpense = document.querySelector(".addexpense");
const expenseform = document.querySelector(".expenseform");

// =============================display expense form ===================

const displayexpenseform  = document.querySelector(".displayexpenseform");
const expensedisplayform = document.querySelector(".expensedisplayform");

//================================== credits  =======================

const addcredits = document.querySelector(".addcredits");
const creditsform = document.querySelector(".creditsform");

const deletecredits =document.querySelector(".deletecredits");
const deletecreditsform = document.querySelector(".deletecreditsform");

// =====================================cards ==============================

const addcardbutton = document.querySelector(".addcardbutton");
const addcardsform = document.querySelector(".addcardsform");



menuBtns.forEach(menuBtns => {
  menuBtns.addEventListener("click", () => {
    navBar.classList.toggle("open");
    mainpanel.classList.toggle("show");
  });
});


Dashboard.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
  }
  
  localStorage.setItem("Dashboard",1);
  //console.log("clicked on dashboard");
  mainpanelchild[0].style.display = "block";

});

Accounts.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
  }
  console.log("clicked on accounts");
  mainpanelchild[1].style.display = "block";
});

Income.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
 }
 console.log("clicked on income");
  mainpanelchild[2].style.display = "block";
}
);

Expenses.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
  }
  console.log("clicked on expenses");
  mainpanelchild[3].style.display = "block";
});

Credit.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
  }
  console.log("clicked on credits");
  mainpanelchild[4].style.display ="block";
});

cards.addEventListener("click", () => {
  for (i = 0; i < mainpanelchild.length; i++) {
    mainpanelchild[i].style.display = "none";
  }
  console.log("clicked on cards");
  mainpanelchild[5].style.display = "block";
});


//accounts

addacc.addEventListener("click", () => {
  accform.classList.toggle("hideform");
})


//income

addincome.addEventListener("click", () => {
  incomeform.classList.toggle("hideform");
})


// display income form 

displayincomeform.addEventListener("click",()=>{
  incomedisplayform.classList.toggle("hideform");
})

//display income table

// displayincome.addEventListener("click",()=>{
//   incometable.classList.toggle("hidetable");
// })


// ==================expenses ===========================
// =========================inserting expenses into expenses table =========================


addexpense.addEventListener("click",()=> {
  //console.log("clicked");
  expenseform.classList.toggle("hideform");
})

// ================================== displaying expenses form ======================

displayexpenseform.addEventListener("click",()=>{
  console.log("clicked");
  expensedisplayform.classList.toggle("hideform");
})


// ===================================credits =========================

addcredits.addEventListener("click",()=>{
  creditsform.classList.toggle("hideform");
})

//===========================credits delete form================
deletecredits.addEventListener("click",()=>{
  deletecreditsform.classList.toggle("hideform");
})


//======================================cards ======================================

addcardbutton.addEventListener("click",()=>{
  addcardsform.classList.toggle("hideform");
})


