/*
document.write("hello world\n");
var jav = "234fweff";
document.write(jav);
function addMe(a,b){
    alert(a + "+" + b + " is " + (a+b));
    return "two number are added";
}

var items = ['pens','flame-throwers','knife','machete'];
document.write(items[3])
items[4]='stones';
document.write(items);
//document.write(addMe(3,4));
*/

/*
var orc ={
    hair:"greem",
    age: 34,
    stomachFull:false,
    eat:function(){
        document.write("eat")
    }
};

orc.age = 55;
orc.hair=2;
document.write(orc.hair);
orc.legs='four';
document.write(orc.legs);
delete orc.legs;
document.write(orc.age);
if(orc.stomachFull == false)
    orc.eat();
*/

// string objects
/*
var color ="green"
document.write(color.length + "  ");
document.write(color.toUpperCase() + " ");
document.write(color.charAt(3) + " ");
document.write(color.replace('green','red') +"  ")
document.write(color.bold())
*/

// math object
/*
var number = 4.6;
document.write(Math.round(number) + "  ");
document.write(Math.ceil(number) + " ");// floor method
document.write(Math.sqrt(16));
*/
/*
var todayDate = new Date();
document.write(todayDate + " ")
document.write(todayDate.toDateString() + "  ");
*/


// ==============object=================

// there no class in javascript =============
//object consists of properties and method similar to java
// ===============creating an object =======
/*
var myObj = {}; // empty object 
console.log(myObj);

var mammals = {
    legs:4,
    eyes:2,
    domestic:true,
    address:{
        street:"22ss",
        city:"bam",
        pincode:"533233"
    } 
};

console.log(mammals.eyes);

// ===============function as a class ===========

function createEmployeeObj(firstName,lastName,gender,designatioin){
    //var emp ={};//var this ={};
    this.firstName = firstName;
    this.lastName = lastName;
    this.gender = gender;
    this.designation = designatioin;
    //return emp;
}

//console.log(createEmployeeObj('sachin','as','m','manager'));

var emp1 = new createEmployeeObj("sumanth","aralapura",'M',"manager");
console.log(emp1);
document.write(emp1.firstName);

*/

/*
//====================================================
function createBicycleObj(cadence,speed,gear){
    var Bicycle = {};
    Bicycle.cadence = cadence;
    Bicycle.speed = speed;
    Bicycle.gear = gear;
    return Bicycle;
}

var Bicycle1 = createBicycleObj(50,20,2);
var Bicycle2 =  new createBicycleObj(23,55,2);
// =========constructor function ===========
function CreateBicycleObjConstructor(cadence,speed,gear){
    this.cadence = cadence;
    this.speed = speed;
    this.gear = gear;
}

var Bicycle3 = new CreateBicycleObjConstructor(40,55,3);

//====================================================
*/

/*
// ================= types of function calls===========
//----------------------Method 1----------------
function foo(){
    // var this = {};
    this.legss = "fifty";
    console.log("hello world");
    //console.log(this);// this refers to the global objcet window
    // return this;
}

foo();
//-------------------------------------------------
// --------------------method 2 -------------
var obj = {
    arms:5,
    pp : function(){
        console.log("pppp");
        console.log(this);  // 'this' refers to the obj object 
    }
};

obj.legs = "twenty";

obj.gtt = function(){
    document.write("what ra");
    console.log("what ra");
    console.log(this);  // 'this' refers to the obj object 
}
// ---------------------method 3 ----------------

//var newobj = new foo();

 */

// ================================================

/*
function CreateBicycleObjConstructor(cadence,speed,gear,pressure){
    this.cadence = cadence;
    this.speed = speed;
    this.gear = gear;
    this.tierPressure = pressure;

    this.increaseGear = function(){
        this.gear += 1;
        console.log("added a new gear");
    }

    this.inflatePressure = function(){
        this.tierPressure+=3;
    }

}

var bicycle1 = new CreateBicycleObjConstructor(44,53,1,79);
var bicycle2 = new CreateBicycleObjConstructor(33,55,3,50);

function Mechanic(name){
    this.name = name;

    this.addPressure = function(cycle){
        cycle.inflatePressure();
    } 

    
}

var mike = new Mechanic("mike");
var john = new Mechanic("john");

*/

/*
function Employee(name){
    //var this = {};
    this.name = name;
    // return this; 
};

Employee.prototype.getName = function(){
    return this.name;
}

var emp1 = new Employee("sachin");

function Manager(name,Dept){
    this.name = name;
    this.Department = Dept;

}

Manager.prototype.getDept = function(){
    return this.Department;
}

var manager1 = new Manager("vinag","physics");

Manager.prototype.__proto__ = Employee.prototype;

*/

/*
function changeStyle(){
    para= document.getElementsByTagName("p");
    para.style.backgroundColor="red";
    var para1  = document.getElementById("para1");
    para1.style.color="orange";
    document.body.style.backgroundColor="teal";
}
*/

function changeStyle() {
    console.log("submit has been clicked");
    var para = document.getElementsByClassName("para");
    para[0].innerHTML = "text of para 1 ";
    para[1].innerHTML = "text of para 2";

    var image = document.getElementById("image");
    image.src = "https://images.saymedia-content.com/.image/c_limit%2Ccs_srgb%2Cq_auto:eco%2Cw_426/MTg4MTYzMzg1MzU4NDI3OTQ2/the-top-10-worst-dictators-in-history.webp"

    console.log(para[1].innerHTML);
}

function changeImg() {
    document.getElementById("image").src = "https://images.saymedia-content.com/.image/c_limit%2Ccs_srgb%2Cq_auto:eco%2Cw_426/MTg4MTYzMzg1MzU4NDI3OTQ2/the-top-10-worst-dictators-in-history.webp"

    console.log(" over image")
}

function oldImg() {
    document.getElementById("image").src = "https://images.saymedia-content.com/.image/c_limit%2Ccs_srgb%2Cq_auto:eco%2Cw_620/MTg4MTYzMzg1MzU4MzYyNDEw/the-top-10-worst-dictators-in-history.webp";
    console.log("out of image")
}
var counter = 0;
function moreText() {
    if (!counter) {
        document.getElementById("more").style.display = "inline";
        document.getElementById("read").innerHTML = "Read less";
        counter = 1;
    }
    else {
        document.getElementById("more").style.display = "none";
        document.getElementById("read").innerHTML = "Read more";
        counter = 0;
    }

}

function validateTextbox() {
    var namebox = document.getElementById("name");
    var addbox = document.getElementById("address");
    if (namebox.value == "" || addbox.value == "") {
        alert("Name cannot be blank");
        addbox.focus();
        //namebox.style.border = "solid 5px red";
        return false;
    }
    if ((namebox.value.length) < 4) {
        alert("Name length cannot be less than 4");
        return false;
    
    }
    if(confirm("confirm to submit") == false)
        return false;

}

function test(firstname,lastName,gender,phno){
    this.name = firstname + lastName;
    this.gender = gender;
    this.phno = phno;
}

var emp1 = new test("sachin","aralapura",'male',34545345345);
var emp2 = new test("sachinas","rararalapura",'malesss',3355345345);

function changeSite(){
    window.location="message.html";
}

var body =document.getElementsByTagName("body");

var arr = [2,5,3,63,1,4,6];