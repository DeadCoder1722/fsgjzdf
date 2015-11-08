/*var xmlHttp = new XMLHttpRequest();
xmlHttp.open("GET", "http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" + zip + "&MCCCode=" + mcc, false); // false for synchronous request
xmlHttp.send(null);
var xmlData = xmlHttp.responseText;*/
var jsonReturns;
function getInfo(zipcode)
{
     /*$.ajax({
            method: "GET",
            url: "http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" + zipcode + "&MCCCode=5811",
            success: function(results) {
               console.log(results)
    
            }
        });

        function store(results) {
           alert("Done");
        }*/
    (function($) {
	var url = 'http://dmartin.org:8026/merchantpoi/v1/merchantpoisvc.svc/merchantpoi?PostalCode=" + zipcode + "&MCCCode=5811&format=json';
	$.ajax({
	   type: 'GET',
		url: url,
		async: false,
		contentType: "application/json",
		
		dataType: 'jsonp',
		function(results) {
               console.log(results)
    
            }
	});
})(jQuery);

}
