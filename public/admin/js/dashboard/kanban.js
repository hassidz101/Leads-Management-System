var Weducation = function(){
    "use strict"
   /* Search Bar ============ */
   var screenWidth = $( window ).width();
   var screenHeight = $( window ).height();
   
   
  
       
  
   


   /* Function ============ */
   return {
       init:function(){
          
        handleDraggableCard();
           
       },

       
       load:function(){
           handlePreloader();
           /* handleNiceSelect(); */
           handleCustomActions();
       },
       
       resize:function(){
           vHeight();
           
       },
       
       handleMenuPosition:function(){
           
           handleMenuPosition();
       },
   }
   
}();

/* Document.ready Start */	
jQuery(document).ready(function() {
   $('[data-bs-toggle="popover"]').popover();
   'use strict';
   Weducation.init();
   
});
/* Document.ready END */

/* Window Load START */
jQuery(window).on('load',function () {
   'use strict'; 
   Weducation.load();
   setTimeout(function(){
           Weducation.handleMenuPosition();
   }, 1000);
   
});
/*  Window Load END */
/* Window Resize START */
jQuery(window).on('resize',function () {
   'use strict'; 
   Weducation.resize();
   setTimeout(function(){
           Weducation.handleMenuPosition();
   }, 1000);
});
/*  Window Resize END */