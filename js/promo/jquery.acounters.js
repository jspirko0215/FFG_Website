counterValues=null;
$.fn.acounters = function(options){

    var element = this;
    
    var defaults = {
    	number: 23489,
        speed: 10000,
        prefix: '',
        suffix:'',
        method: 1,
        child: '',
        coef: 0.15
    };
	
	var options = $.extend(defaults, options);
	
	//todo - allow users to set the number within the counterWrap
    function formatCurrency (num, integer){
    if (integer) {
		num = isNaN(num) || num==='' || num === null ? 0 : num;
		return num;
	}
	else	
		num = isNaN(num) || num==='' || num === null ? 0.00 : num;
    var fixed = parseFloat(num).toFixed(2);
    var numParts = fixed.split('.');
    num = numParts[1] === '00' ? numParts[0]+'.00' : fixed;
    return num;
}    
    function addCommas(nStr) {
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
		}
    
    function get(){ //for ajax
            if(counterValues)
            {
                if(options.method == '1'){ 
                    options.number=(counterValues.wattHoursCount/1000).toFixed(2);
                }
                if(options.method == '2'){
                    options.number=counterValues.membersCount;
                }
                if(options.method == '3'){
                    options.number=counterValues.teamsCount;
                }
            }
          return options.number; 
        } 
    function loadTicker(element){
         element.html(options.prefix+' '+addCommas(get())+' '+((get()!=1&&options.suffix!='kW/h')?options.suffix+'s':options.suffix));
     };
	
    $(element).each(function(){
	element.addClass('counters');
        loadTicker(element)
	setInterval(function(){loadTicker(element)},options.speed);
    }); 
};

$(document).ready(function ()
{
    setInterval(function(){
            $.ajax(
            {
                url: '/ajax/counters',
                type: 'GET',
                cache: false,
                success: function(result)
                {
                    counterValues=$.parseJSON(result);
                }
            });
    }, 30000);
});