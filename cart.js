var cartarr = null;
var total = 0;
var ingarr=[];
var bottenval;
var botten;
$(".meny-container").ready(function(){

  $(".addPizza").click(function(){


    var pizzaNamn = $(this).parent().find("#pizza-namn").text();
    var pizzaIng = $(this).parent().find("#pizza-ingredienser").text();
    var pizzaPris = $(this).parent().find("#pizza-pris").text();
    pizzaPris = parseInt(pizzaPris);

    console.log(pizzaNamn);
    console.log(pizzaPris);

    addtocart(pizzaNamn, pizzaIng, pizzaPris);
  });

  $('.sendtocart').click(function(){
    var ingredienser = $('.ingrediens');
    ingarr=[];
    for (let i = 0; i < ingredienser.length; i++) {
      var barn = ingredienser[i].children;
      if ($(barn[1]).is(':checked')) {
        var ingNamn = barn[0].innerText;
        var ingPris = parseInt(barn[2].innerText);
        console.log(ingNamn, ingPris);
        total += ingPris;
        itemPris += ingPris;
        ingarr.push([ingNamn, ingPris]);
      }
    }

    bottenval = document.getElementById("botten");
    botten = bottenval.options[bottenval.selectedIndex].text;
    console.log(botten);


    var ls = localStorage.getItem('cart');
    if (ls){
      cartarr = JSON.parse(ls);
      console.log(ls);
    }
    else{
      cartarr = []
    }

    cartarr.push([pizzaNamn, pizzaIng, itemPris, ingarr, botten]);
    localStorage.setItem('cart', JSON.stringify(cartarr));
    $("#cart").css("opacity", "1");
    var itemid = cartarr.length-1;
    console.log(itemPris);
    rendercart(ingNamn, itemPris);
    $('.ing-show').hide();
  });

  $('.back').click(function(){
    $('.ing-show').hide();
  });

  var pizzaNamn;
  var pizzaIng;
  var pizzaPris;
  var itemPris;

  function addtocart(_pizzaNamn, _pizzaIng, _pizzaPris){
    total += _pizzaPris;
    itemPris = _pizzaPris;
    pizzaNamn = _pizzaNamn;
    pizzaIng = _pizzaIng;
    pizzaPris = _pizzaPris;
    $('.addIng').prop('checked', false);
    $('.ing-show').show();
  }
});

function deletefromcart(item){
  console.log(cartarr[item]);
  var delPris = cartarr[item][2];
  total = total - delPris;
  cartarr.splice(item, 1);
  localStorage.setItem('cart', JSON.stringify(cartarr));
  console.log(cartarr);
  rendercart();
}


function rendercart(ingNamn, itemPris){
  var cartstr ="";
  cartstr += "<form method='POST' action='order.php'>";

  for (let i = 0;i<cartarr.length;i++){
    var item = cartarr[i];
    var pizzaNamn = item[0];
    var pizzaIng = item[1];
    var pizzaPris = item[2];
    var extraIng = item[3];
    var bott = item[4];
    cartstr += "<input type='hidden' name='pizzaNamn-"+i+"' value='"+pizzaNamn+"' class='itemNamn' id='"+pizzaNamn+"'><h4>"+pizzaNamn + "</h4>";
    cartstr += "<input type='hidden' name='pizzaIng-"+i+"' value='"+pizzaIng+"' class='itemNamn' id='"+pizzaIng+"'><div class='itemTop' id='"+pizzaIng+"'>"+pizzaIng +"</div>";
    if (extraIng.length <= 0){
    }
    else{
      cartstr += "<p class='summa'>Extra: </p>";
      for (let i = 0; i<item[3].length; i++){
        cartstr += "<p>"+extraIng[i]+"kr</p>";
        console.log("här");
        console.log(extraIng[i][0]);

        cartstr += "<input type='hidden' name='extraIng-"+i+"' value='"+extraIng[i][0]+"' class='itemNamn' id='"+extraIng+"'>";
      }
    }
    cartstr += "<input type='hidden' name='botten' value='"+botten+"'><p>"+ botten + "</p>";
    cartstr += "<div class='itemPris' id='"+itemPris+"'>"+ pizzaPris + "kr</div>";
    cartstr += "<button class='radera' id='radera"+i+"' onclick='deletefromcart("+i+")'>Ta bort</button>";
  }
  cartstr += "<p>Telefonnummer (Frivilligt)</p>";
  cartstr += "<input type='text' name='telefon' id='tel' placeholder='07X-XXX XX XX'>";
  cartstr += "<div class='summa'><p>Summa: "+total+"kr</p></div>";
  cartstr += "<input type='hidden' name='pris' value='"+total+"'>";
  cartstr += "<input type='submit' name='submit' class='continue' value='Forsätt till kassan'>";

  cartstr += "</form>";
  $("#cart").html(cartstr);
}
