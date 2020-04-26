function getCreditCardType(accountNumber){
   //start without knowing the credit card type
   var result = "unknown";

   //first check for MasterCard
   if (/^5[1-5]/.test(accountNumber)){
      result = "mastercard";
   }//then check for Visa 
   else if (/^4/.test(accountNumber)){
      result = "visa";
   }//then check for AmEx
   else if (/^3[47]/.test(accountNumber)){
      result = "amex";
   }
   return result;
}

function handleEvent(event){
   var value   = event.target.value;  
   var type    = getCreditCardType(value);
   
   switch (type){
      case "mastercard":
	  //show mastercard icon
	  if(document.getElementById("cc-type").innerHTML !== ""){
		  break;
	  } else {
         var image = document.createElement("img");
	     image.id = "exist";
	     image.src = "mastercard.png";
	     document.getElementById("cc-type").appendChild(image);
	  }
      break;

      case "visa":
      //show Visa icon
	  if(document.getElementById("cc-type").innerHTML !== ""){
		  break;
	  } else {
         var image = document.createElement("img");
	     image.id = "exist";
	     image.src = "visa.png";
	     document.getElementById("cc-type").appendChild(image);
	  }
      break;

      case "amex":
      //show American Express icon
	  if(document.getElementById("cc-type").innerHTML !== ""){
		  break;
	  } else {
         var image = document.createElement("img");
	     image.id = "exist";
	     image.src = "amex.png";
	     document.getElementById("cc-type").appendChild(image);
	  }
      break;

      default:
      document.getElementById("cc-type").innerHTML = "";
      //show error?
   } 
}

// or window.onload
document.addEventListener("DOMContentLoaded", function(){
   var textbox = document.getElementById("cc-num");
   textbox.addEventListener("keyup", handleEvent, false);
   textbox.addEventListener("blur", handleEvent, false);
}, false);
