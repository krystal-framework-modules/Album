(function($){

    function Layout(nodeList, maxHeight){
        this.nodeList = nodeList;
        this.maxHeight = maxHeight;
    }
    
    Layout.prototype = {
        calculateHeight : function(nodeList, width){
          width -= nodeList.length * 5;
          var height = 0;
          
          nodeList.each(function(){
            var $self = $(this)[0];
            height += $self.naturalWidth / $self.naturalHeight;
          });
          
          return width / height;
        },
        
        applyHeight : function(nodeList, height){
          nodeList.each(function(){
            var $self = $(this)[0];
            
            $(this).css({
              width : height * $self.naturalWidth / $self.naturalHeight,
              height : height
            });
          });
        },
        
        bootsrap : function(){
          var size = window.innerWidth - 50;
          var iteration = 0;
          var images = this.nodeList;
          
          w: while (images.length > 0){
            for (var i = 1; i < images.length + 1; ++i){
              
              var slice = images.slice(0, i);
              var height = this.calculateHeight(slice, size);
              
              if (height < this.maxHeight){
                this.applyHeight(slice, height);
                iteration++;
                images = images.slice(i);
                continue w;
              }
            }
            
            this.applyHeight(slice, Math.min(this.maxHeight, height));
            iteration++;
            
            break;
          }
        }
    }
    
    $.fn.layout = function(maxHeight){
        var grid = new Layout(this, maxHeight);
        grid.bootsrap();

        $(window).resize(function(){
            grid.bootsrap();
        });
    }
    
})(jQuery);

$(function(){
    $('img').layout(205);
});
