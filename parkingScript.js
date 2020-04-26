
$('document').ready(function(){

  //get the user's time
  var hourOfDay = new Date().getHours();
 
  var spots = [];
  var totalPrice = 0;


  //increase the price by $5 when its between 6pm to 6 am
  var priceConstant = 0;
  if(hourOfDay >= 18 || hourOfDay <= 6){
    priceConstant = 5;
  } 

  //variable to store selected parking spots
  var selectedSpotIds = [];
  
  document.getElementById("check-out").addEventListener("click", checkOut);
  document.getElementById("exit_modal").addEventListener("click", toggleModal);
  document.getElementById("pay-parking").addEventListener("click", payParking);


  //general fake parking spots 
  for(var i = 0; i < 49; i++){
    var name = "vip"
    var rand = Math.random() >= 0.5;

    if(i > 13) name = "general"

    spots.push({
     name: name + '_' + i,
     inStock: rand
     
      // spots.push({
      // name: "",
      // inStock: ""

    }) 
  }


  //generate grid to show parking availability
  function makeParkingGrid(row, col) {

    //size of parking space = row * col 
    var row = 7;
    var col = 7;

    var parkingGrid = document.getElementById("parkingGrid");
    var table = document.createElement('TABLE');
    var tableBody = document.createElement('TBODY');
    table.appendChild(tableBody);
      
    var index = 0;  
    for (var i=0; i < row; i++){
        var tr = document.createElement('TR');
        tableBody.appendChild(tr);
       
        for (var j=0; j < col; j++){

          var td = document.createElement('TD');
          var card = document.createElement('div');

            card.classList.add("cards");
            card.addEventListener("click", spotSelection);

            
            td.appendChild(card);
            tr.appendChild(td);

          index++
        }
    }

    parkingGrid.appendChild(table); 


    //display parking data from DB
    fillSpots();
  }



  //display parking data from dataBase
  function fillSpots(){


    var cards = $('.cards');

    for(var i = 0; i < cards.length; i++){

      var spot = spots[i];
      $(cards[i]).attr('id', spot.name)

      //if spot name contain 'vip' put a class on the div
      if(spots[i].name.indexOf("vip") > -1){
        $(cards[i]).addClass('vip-card');
      }


      if(spot.inStock){
        $(cards[i]).addClass('available');
      } else{
        $(cards[i]).addClass('not-available');
      }

    }
  }


  //called when parking spot is clicked
  function spotSelection(){
    if($(this).hasClass("not-available")) return;
    $(this).toggleClass("available");
    $(this).toggleClass("select");
  }


  //called when preview and checkout is called
  function checkOut(){

    selectedSpotIds = [];

    var cards = $('.cards');
    for(var i = 0; i < cards.length; i++){
      var spot = cards[i];
      if($(spot).hasClass("select")){
        selectedSpotIds.push( $(spot).attr('id') );
      }
    }

    //show a modal for the preview and check out
    toggleModal();
  }


  //open and close modal
  function toggleModal(){

    //close modal if it is already opened
    //which means exit was clicked
    if(document.getElementById("myModal").style.display == 'block'){
      document.getElementById("myModal").style.display = 'none';
      return;
    }


    var content = document.createElement("ul")


    var total = 0;
    for(var i = 0; i < selectedSpotIds.length; i++){

      //add priceConstant after 6 pm to 6 am
      var price = 10 + priceConstant;

      //change parking price, if selected price is VIP
      if(selectedSpotIds[i].indexOf('vip') > -1){
        //add priceConstant after 6 pm to 6 am
        price = 20 + priceConstant;
      }

      //price total 
      total += price;

      var li = document.createElement("li")
      li.innerHTML = selectedSpotIds[i] + " price: $"+price;
      content.append(li);
    }

    var total_li = document.createElement("p")
    total_li.innerHTML ="total = $"+total;
    content.append(total_li);

    $("#preview-checkout").html(content);

    //display the modal
    document.getElementById("myModal").style.display = "block"

    totalPrice = total;
  }


  //handle parking payment
  function payParking(){
    //selectedSpotIds is an array containing the name(s) of the parking spot selected and ready to be purchase 
    //totalPrice is an integer containing the totalPrice of the parking spots selected
    alert("pay_now")
  }


   //create parking availability grid 
  makeParkingGrid();

})





