function showMessages1(id){
    document.getElementById('message').style.display = 'flex';
    document.getElementsByClassName('card').style.display = 'none';
    document.getElementById('msg').style.display = 'none';
    document.getElementById('pay').style.display = 'block';
    document.getElementById(id).style.display = 'block';
    // document.getElementById('list').style.width = '3%'
    document.getElementsByClassName('card').style.display = '50%';

}
const pay = () =>{
    document.getElementById('paymentArea').style.display = 'block';
    document.getElementById('message').style.display = 'none';
    document.getElementById('uploads').style.display = 'none';
    
}

const closeMessages = () =>{
    document.getElementById('message').style.display = 'none';
    document.getElementById('card1').style.display = 'block';
    document.getElementById('card2').style.display = 'block';
    document.getElementById('card3').style.display = 'block';
    document.getElementById('msg').style.display = 'block';
    document.getElementById('pay').style.display = 'none';
}
const closePaymentSection = () =>{
    document.getElementById('message').style.display = 'none';
    document.getElementById('uploads').style.display = 'block';
    document.getElementById('pay').style.display = 'none';
    document.getElementById('paymentArea').style.display = 'none';
}
const closePaymentSection1 = () =>{
    document.getElementById('message').style.display = 'none';
    document.getElementById('card1').style.display = 'block';
    document.getElementById('card2').style.display = 'block';
    document.getElementById('card3').style.display = 'block';
   document.getElementById('msg').style.display = 'block';
    document.getElementById('paymentArea').style.display = 'none';
}
const filters = () =>{
    document.getElementById('filters').style.display = 'block';
    document.getElementById('openFilters').style.display = 'none';
    document.getElementById('openFilters2').style.display = 'block';
}
const closeFilters = () =>{
    document.getElementById('filters').style.display = 'none';
    document.getElementById('openFilters').style.display = 'block';
    document.getElementById('openFilters2').style.display = 'none';
}

// let photoDisplay = document.getElementById('editPhoto');



function rentalForm(){
    document.getElementById('rentalForm').style.display = "block"
    document.getElementById('registrationPrompt').style.display = "none"

}
function saleForm(){
    document.getElementById('saleForm').style.display = "block"
    document.getElementById('registrationPrompt').style.display = "none"

}


function showImgs(tourCard){
    console.log(tourCard);
    
    let firstSlide = document.getElementsByClassName('firstSlide');
    for( i = 0; i < firstSlide.length; i++){
    firstSlide[i].style.display = "block";
    }
    document.getElementById('firstSlide' +tourCard).style.display = "none";
    let allSlides = document.getElementsByClassName('secondSlide');
    for( i = 0; i < allSlides.length; i++){
    allSlides[i].style.display = "none";
    }
    document.getElementById('secondSlide'+ tourCard).style.display = "block";
    document.getElementById('slide1').style.display = 'block';
    // window.location.href = "listing.php"
}
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function showSlides(n) {
  var i;
  var x = document.getElementsByClassName("slide");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  x[slideIndex-1].style.display = "block";
}


let amount = document.getElementById('amount');
amount.oninput = () =>{
    console.log(amount.value);
    let credits = amount.value/50;
    document.getElementById('bill').innerHTML = "Purchasing " + credits + " credits" ;
    console.log(document.getElementById('bill').value = "Bill of Ksh" + amount.value);
}

window.onload = () => {
    document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
    });
}

document.getElementById("saleOpt").onclick = () =>{
    document.getElementById("payPlan").style.display = "block";
}

// document.getElementById("section-one-nxt").onclick =() =>{
//     document.getElementById("section-one").style.display = "none";
//     document.getElementById("section-two").style.display = "block";

// }
// document.getElementById("section-two-nxt").onclick =() =>{
//     document.getElementById("section-one").style.display = "none";
//     document.getElementById("section-two").style.display = "none";
//     document.getElementById("section-three").style.display = "block";

// }
document.getElementById('loginPswd').onclick = () =>{
document.getElementById('loginPswd').style.border = "2px solid #c89364";
}
