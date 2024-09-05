    $( document ).ready(function() {
   	
    
    
    
    $('video').bind('play', function (e) {
          console.log($(this).attr("id"));
    	$.ajax({
  			type:'GET',
   			 async: false,
  			url: '/videos/create_view/'+$(this).attr("id"),
  			success:function(data){

        		console.log('View created successfully.');
      		 
		      },
      		error:function(){
        		console.log('Error creating view.');
      		},
    	});
	});
    
    
	});