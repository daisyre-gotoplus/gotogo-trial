$(function (){
	"use strict"
	
	var locationArray = $.map(locations, function (value, key) { return { value: value, data: key }; });
	
	// Setup jQuery ajax mock:
	$.mockjax({
		url: "*",
		responseTime: 2000,
		response: function (settings){
			var query = settings.data.query,
				queryLowerCase = query.toLowerCase(),
				re = new RegExp("\\b" + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), "gi"),
				suggestions = $.grep(locationArray, function (country) {
					// return country.value.toLowerCase().indexOf(queryLowerCase) === 0;
					return re.test(country.value);
				}),
				response = {
					query: query,
					suggestions: suggestions
				};

			this.responseText = JSON.stringify(response);
		}
	});

	// Initialize ajax autocomplete:
	$("#autocomplete").autocomplete({
		// serviceUrl: "/autosuggest/service/url",
		autoSelectFirst: true,
		lookup: locationArray,
		lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
			var re = new RegExp("\\b" + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), "gi");
			return re.test(suggestion.value);
		},
		onSelect: function(suggestion) {
			//$("#outputcontent").val("You selected: " + suggestion.value + ", " + suggestion.data);
			$("#location").val(suggestion.data);
		},
		onInvalidateSelection: function() {
			$("#location").val("");
		}
		//onHint: function (hint) {
		//	$("#autocomplete-x").val(hint);
		//},
		//onInvalidateSelection: function() {
		//	$("#outputcontent").html("You selected: none");
		//}
	});
});