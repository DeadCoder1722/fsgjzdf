
function loadUser() {
    
  var template = $('#template').html();
  Mustache.parse(template);   // optional, speeds up future uses
  var rendered = Mustache.render(template, {
   "Business": [
      {
         "Name": "250 HUDSON",
         "Address": "250 HUDSON ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "2126754550",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "50"
        
      },
      {
         "Name": "BENCHMARC EVENTS",
         "Address": "13 LAIGHT ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "2126258261",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "25"
      },
      {
         "Name": "BENCHMARC EVENTS BY",
         "Address": "",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "30"
      },
      {
         "Name": "BENCHMARC EVENTS BY MARC MURPHY",
         "Address": "11 BEACH ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 625-8270",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "38"
      },
      {
         "Name": "CAPITALE",
         "Address": "130 BOWERY",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 334-5500",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "9"
      },
      {
         "Name": "CATERING BY PERGOLA LL",
         "Address": "129 GRAND ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "46"
      },
      {
         "Name": "CHEFS DIET NATIONAL",
         "Address": "7 WORTH ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "8002656170",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "20"
      },
      {
         "Name": "CITI CAFETERIA",
         "Address": "388 GREENWICH ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 608-6156",
         "Website": "https://mastersofcode-lejamby.c9users.io/citiCafeteria.html",
         "Price": "30"
      },
      {
         "Name": "GREAT PERFORMANCES",
         "Address": "304 HUDSON ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 727-2424",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "7"
      },
      {
         "Name": "HARRYS OFFSITE CATERIN",
         "Address": "131 VARICK ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "2122533955",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "24"
      },
      {
         "Name": "INTL CULINARY CENTER LLC",
         "Address": "462 BROADWAY",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "2122198890",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "49"
      },
      {
         "Name": "KETTLEBELL KITCHEN INC",
         "Address": "161 GRAND ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "9178876540",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "45"
      },
      {
         "Name": "LANDMARC CATERING LLC",
         "Address": "11-17 BEACH ST STE 402",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "6466880058",
         "Website": "https://mastersofcode-lejamby.c9users.io/landmarc.html",
         "Price": "6"
      },
      {
         "Name": "LAPAULEE",
         "Address": "285 W BROADWAY",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "4029357733",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "21"
      },
      {
         "Name": "LOVEANDPAINT",
         "Address": "190 AVENUE OF THE AMERICAS",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "5619974523",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "29"
      },
      {
         "Name": "M H PRINCE CORPORATION",
         "Address": "202 6TH AVE",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 431-0005",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "40"
      },
      {
         "Name": "MATTER",
         "Address": "40 WALKER ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 768-0550",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "41"
      },
      {
         "Name": "MEDIA MOST INTL",
         "Address": "304 HUDSON ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "(212) 583-1990",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "42"
      },
      {
         "Name": "OLIVER CHENG CATERING",
         "Address": "12 VESTRY ST",
         "City": "NEW YORK",
         "State": "NY",
         "ZIP": "10013",
         "Phone": "2125822664",
         "Website": "www.ThisIsAWebsite.com",
         "Price": "41"
      }
   ]
});
  $('#cardz').html(rendered);
}



// $(document).ready(function(){
  
  function confirmPrice(price,mealplan,website){
    // debugger;
    if(parseInt(mealplan) < parseInt(price)){
      alert("Think about it?");
      alert("Really");
      
      confirmationText(website);

    }
    else{
      
      window.location.href = website;
    }
  };
    
  // });


function confirmationText(website) {
    var ask = window.confirm("Seriously, think about it");
    if (ask) {
        window.alert("Fine, you can buy it. We warned you");

        document.location.href = website;

    }
}