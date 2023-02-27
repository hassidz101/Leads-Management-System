

(function($) {
    /* "use strict" */
	
 var dlabChartlist = function(){
	
	var screenWidth = $(window).width();
	let draw = Chart.controllers.line.__super__.draw; //draw shadow

    var activity2 = function(){
		var options = {
            series: [75],
            chart: {
            width: 150,    
            height: 150,
            type: 'radialBar',
            toolbar: {
              show: true
            }
          },
          plotOptions: {
            radialBar: {
              startAngle: -135,
              endAngle: 225,
               hollow: {
                margin: 0,
                size: '50%',
                background: '#fff',
                image: undefined,
                imageOffsetX: 0,
                imageOffsetY: 0,
                position: 'front',
                dropShadow: {
                  enabled: true,
                  top: 3,
                  left: 0,
                  blur: 4,
                  opacity: 0.24
                }
              },
              track: {
                background: '#fff',
                strokeWidth: '75%',
                margin: 0, // margin is in pixels
                dropShadow: {
                  enabled: true,
                  top: -3,
                  left: 0,
                  blur: 4,
                  opacity: 0.35
                }
              },
          
              dataLabels: {
                show: true,
                name: {
                  offsetY: -10,
                  show: false,
                  color: '#888',
                  fontSize: '17px'
                },
                value: {
                  formatter: function(val) {
                    return parseInt(val);
                  },
                  color: '#111',
                  fontSize: '18px',
                  show: true,
                }
              }
            }
          },
          fill: {
            color: '#EB62D0',
          },
          stroke: {
            lineCap: 'round'
          },
          labels: ['Percent'],
          };
  
		var chartArea = new ApexCharts(document.querySelector("#activity2"), options);
        chartArea.render();

	}
	
	/* Function ============ */
		return {
			init:function(){
			},
			
			load:function(){
				activity2();	
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