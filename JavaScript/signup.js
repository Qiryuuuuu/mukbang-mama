 //Asssigning Variables//
 var myInput = document.getElementById ("pass");
 var length = document.getElementById ("length");
 var capital = document.getElementById ("capital");
 var letter = document.getElementById ("letter");
 var number = document.getElementById ("number");
 var special = document.getElementById ("special");
 var specialComment = document.getElementById("special-comment");
 var confirmP = document.getElementById("confirm-password");
 var confirmV = document.getElementById("confirm-validation");

 //Displays password requirements when clicked//
 myInput.onfocus = function (){
     document.getElementById("validation").style.display = "block";
 }

 //Hides the password requirement when not clicked//
 myInput.onblur = function (){
     document.getElementById ("validation").style.display = "none";
 }
 

 //Collect info from the input//
 myInput.onkeyup = function(){
     //validate length//

     if(myInput.value.length >=8){
         length.classList.remove ("invalid");
         length.classList.add("valid");
     } else {
         length.classList.remove("valid");
         length.classList.add("invalid")
     }

     var upperCaseLetters = /[A-Z]/g;
     if(myInput.value.match(upperCaseLetters)){
         capital.classList.remove("invalid");
         capital.classList.add("valid");
     } else {
         capital.classList.remove("valid");
         capital.classList.add ("invalid");
     }

     var lowerCaseLetters = /[a-z]/g;
     if(myInput.value.match(lowerCaseLetters)){
         letter.classList.remove("invalid");
         letter.classList.add("valid");
     } else {
         letter.classList.remove("valid");
         letter.classList.add("invalid");
     }

     var numbers = /[0-9]/g;
     if(myInput.value.match(numbers)){
         number.classList.remove("invalid");
         number.classList.add("valid");
     } else {
         number.classList.remove ("valid");
         number.classList.add ("invalid");
     }

     var specialCharacters = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
     if (myInput.value.match(specialCharacters) && !myInput.value.match(/[\\\s~<>]/)) {
         special.classList.remove("invalid");
         special.classList.add("valid");
     } else {
         special.classList.remove("valid");
         special.classList.add("invalid");
         if (myInput.value.match(/[\\\s~<>]/)) {
             specialComment.innerHTML = "Cannot use \\, ~, <, >, space, or tab.";
             specialComment.style.display = "block";
         } else {
             specialComment.style.display = "none";
         }
     }

 }

 document.querySelector('form').addEventListener('submit', function(e){
      if (myInput.value != confirmP.value){
         e.preventDefault();
         confirmV.style.display = 'block';
      }
 });

