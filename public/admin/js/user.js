

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var donutChart2 = function(){
		$("span.donut3").peity("donut", {
			width: "150",
			height: "150"
		})
	}
	
	
	
	/* Function ============ */
		return {
			init:function(){
            },
			
			
			load:function(){
                donutChart2();
			},
			
			resize:function(){
			}
		}
	
	}();

	
		
	jQuery(window).on('load',function(){
		setTimeout(function(){
			dlabChartlist.load();
		}, 1000); 
		
	});

     

})(jQuery);