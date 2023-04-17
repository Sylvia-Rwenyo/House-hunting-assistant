const showMenu = () =>{
    document.getElementById('menuBars').style.display = 'none';
    document.getElementById('menu').style.display = 'block';
}
const closeMenu = () =>{
    document.getElementById('menuBars').style.display = 'block';
    document.getElementById('menu').style.display = 'none';
}
// const showMessages1 = (id) => {
//     document.getElementById('message').style.display = 'flex';
//     document.getElementsByClassName('card').style.display = 'none';
//     document.getElementById('msg').style.display = 'none';
//     document.getElementById('pay').style.display = 'block';
//     document.getElementById('id').style.display = 'block';

// }
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
let profilePhoto = document.getElementById('profilePhoto');
let pfp = document.getElementById('pfp');
pfp.onclick = () =>{
    profilePhoto.style.display = "block"
}
profilePhoto.oninput = () =>{
    // profilePhoto.style.display = "none"
    console.log(profilePhoto.value);
    let pfpName = profilePhoto.value;
   
    let photo = 'Uploads/' +  pfpName.replace('C:\\fakepath\\', '');
    pfp.src = photo;
}
let phoneNo = document.getElementById('phoneNumber');
    phoneNo.onclick = () =>{
    phoneNo.type = "number";
}

function editProfile(){
    document.getElementById('completeProfile').style.display = "none";
    document.getElementById('editingProfile').style.display = "block";
}

function pswdDisplay(){
    let showPswd = document.getElementById('showPswd');
    let pswd = document.getElementById("password");
    if(pswd.type == "text"){
        pswd.type = "password";
        showPswd.innerHTML = "Show";
    }else{
        pswd.type = "text";
        showPswd.textContent = "Hide";
    }
}

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

let filterBedrooms = document.getElementById('filterBedrooms');
let filterBathrooms = document.getElementById('filterBathrooms');
let filterSize = document.getElementById('filterSize');
let filterParkingSpace = document.getElementById('filterParkingSpace');
let filterPlayground = document.getElementById('filterPlayground');

 function filterBedrooms(){
    let number = filterBedrooms.value;
    window.location.href = "listing.php?action=filter&bedrooms=" + number;
}
function filterBathrooms(){
    let number = filterBathrooms.value;
    window.location.href = "listing.php?action=filter&bathrooms=" + number;
}
function filterSize(){
    let number = filterSize.value;
    window.location.href = "listing.php?action=filter&size=" + number;
}
function filterParkingSpace(){
    let availability = 1;
    window.location.href = "listing.php?action=filter&parkingSpace=" + availability;
}
function filterPlayground (){
    let availability = 1;
    window.location.href = "listing.php?action=filter&playground=" + availability;
}