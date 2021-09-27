<x-app-layout>
    <x-slot name="header">
 
<div class="row m-0 p-0">
  <div class="col-lg-10">
    <h4>Editing Video <strong><a href="{{ route('videos.show',$video->id) }}">{{$video->name}}</a></strong> {{--(ID: {{ $video->id }})--}}</h4>
  </div>
  <div class="col-lg-2 text-right">
    <a href="{{ route('videos.index') }}" class="btn btn-danger mb-2">Go Back</a> 
  </div>    

</div>

</x-slot>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>


<script type="text/javascript">
$( document ).ready(function() {

   $(document).on("change", "#video", function(evt) {
      var $source = $('#video_preview');
      $source[0].src = URL.createObjectURL(this.files[0]);
      $source.parent()[0].load();
    });

   $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      
      if(fileName.length > 50){
            var length = 50;
            var fileName = fileName.substring(0, length) + "...";
        }
      
      
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

$('input[name=thumbnail]').change(function() {  
	
// alert('label[for'+$(this).attr("id")+']');
	$('.form-check-label img').css("border","2px solid white");
   $('label[for='+$(this).attr("id")+'] img').css("border","2px solid #007bff");

	// $('.video-thumbnail').each(function(){
	// if( $( $(this).attr("for") ).is(':checked')){
	// $(this).css("border","2px solid #007bff");
	// }else{
	// $(this).css("border","none");
	// }
	// });

});

});
</script>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row m-0 p-0" action="{{ route('videos.update', $video->id) }}" method="POST" name="update_video" enctype="multipart/form-data"

>
  {{ csrf_field() }}
  @method('PATCH')

    <input type="text" id="session_id" name="session_id" value="{{$video->session_id}}" hidden="">

    <div class="form-group col-6 col-md-6 col-lg-6 mb-3">
        <strong>Name</strong>
        <input type="text" name="name" class="form-control" placeholder="Enter name of the video..." value="{{ $video->name }}">
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>

    <div class="form-group col-6 col-md-6 col-lg-6 mb-3">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter the location..." value="{{ $video->location }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-6 mb-3 w-100">
      <strong>Video File</strong>
      <div class="custom-file mb-2">
        <input type="file" name="video" id="video" class="custom-file-input">
        <label class="custom-file-label" for="video">{{ Str::limit($video->original_file_name, 35, $end='...')}}</label>
      </div>
      <span class="text-danger">{{ $errors->first('video') }}</span>

      <video controls class="" style="height: 250px;  width: 100%!important; display: block;" poster="{{ url('uploads/videos/thumbs/thumb_'.$video->thumbnail.'_'. $video->file_name.'.png') }}" controls="true"  preload="none" playsinline >
          <source src="{{ url('uploads/videos/previews/preview_'.$video->file_name) }}" type="{{$video->mime}}" id="video_preview"  >
            Your browser does not support HTML5 video.
        </video>

    </div>

   <div class="col-lg-6">
                   <strong>Categories</strong>
      <div class="input-group  mb-2">

            <select multiple="" class="custom-select" id="category" name="category[]">
              <option value="" @if(sizeof($video->categories) == 0)selected=""@endif>None</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" 
                  @foreach($video->categories as $video_category)
                            {{ $category->id == $video_category->category_id ? 'selected=""' : '' }}
                  @endforeach
                >{{$category->title}}</option>
              @endforeach
            </select>
          </div>

    
    <div class="form-group mb-3">
        <strong>Description</strong>
        <textarea class="form-control" col="4" name="description" placeholder="Enter video description..." style="min-height:175px;">{{ $video->description }}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>


<div class="col-lg-12">
<strong>Video Thumbnail</strong>
</div>
<div class="col-lg-12">

@for ($i = 1; $i <= 6; $i++)
@if( file_exists ( public_path().'uploads/videos/thumbs/thumb_'.$i.'_'. $video->file_name.'.png' ) )
<div class="form-check  form-check-inline mt-3">
  <input class="form-check-input" type="radio" name="thumbnail" id="thumbnail{{$i}}" value="{{$i}}" {{ $video->thumbnail == $i ? "checked" : "" }}>
  <label class="form-check-label video-thumbnail" for="thumbnail{{$i}}">
    <img src="{{ url('uploads/videos/thumbs/thumb_'.$i.'_'. $video->file_name.'.png') }}" class="rounded" style="max-height:200px; width:auto;  {{ $video->thumbnail == $i ? "border:3px solid #007bff;" : "border:2px solid white;" }}">
  </label>
</div>
@endif
@endfor

</div>


<div class="col-lg-12">
	<div class="upload_progress">
  <strong>Upload Progress:</strong>
  <div class="progress ">
  		<div class="progress-bar upload_bar bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><div class="upload_percent">0%</div></div>
	</div>
	</div>
</div>

<div class="col-lg-12 pt-4">
	<div class="encoding_progress">
    <strong>Encoding Progress:</strong>
	<div class="progress ">
  		<div class="progress-bar encoding_bar  bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><div class="encoding_percent">0%</div></div>
	</div>
	</div>
</div>




    <div class="col-6 mt-3">
        
        
<button type="submit" class="btn btn-primary w-100"><i class="far fa-edit"></i> Edit video</button>
        
        
    </div>
    <div class="col-6 mt-3">
        <a href="{{ route('videos.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a> 
    </div>





<div class="col-lg-12 pt-5">
    <div id="alert-uploaded" class="alert alert-info" role="alert">
  <h4 class="alert-heading">File Uploaded!</h4>
  <p>File Has Been Uploaded Successfully. Now the thumbnail is being created and the video is being compressed for the preview. <br><strong>Please wait!</strong></p>
</div>


<div id="alert-done" class="alert alert-success" role="alert">
  <h4 class="alert-heading">Encoding Done!</h4>
  <p>Thumbnail and preview version created! Your video can now be viewed. 
  <br>You will be <strong>redirected in 10 seconds</strong>!</p>
</div>
	</div>

     
</form>



<script type="text/javascript">
$( document ).ready(function() {

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});


var encoding_bar = $('.encoding_bar');
var encoding_percent = $('.encoding_percent');
    
$('.encoding_progress').hide();
    
var percent_converted = '0%';
		encoding_bar.attr('aria-valuenow', 0).css("width",percent_converted);
        encoding_percent.html(percent_converted);

function get_progress(e) {
// e.preventDefault();
     
     var percent = null;
     var percent_converted = null;
$.ajax({
  type:'POST',
  url: '/videos/encoding_progress',
 data: {session_id: "{{$video->session_id}}" },
  success:function(data){
  			
          var percent = data;
          var percent_converted = percent + '%';

  			// console.log( percent  + "-------" + encoding_bar.attr('aria-valuenow') );
  			
  			if( percent != encoding_bar.attr('aria-valuenow') ){    	
            	encoding_bar.attr('aria-valuenow', percent).css("width",percent_converted);
  				// console.log( "UPDATED: " + percent  + "-------" + encoding_bar.attr('aria-valuenow') );
            	encoding_percent.html(percent_converted);
            }
      },
      error:function(){
        // alert('Error getting progress on video conversion.');
      },
    });
}

// setInterval(get_progress, 2000);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    	$("#alert-uploaded").hide();
    	$("#alert-done").hide();
    
        var bar = $('.upload_bar');
        var percent = $('.upload_percent');
        $('.upload_progress').hide();
    
          $('form').ajaxForm({
            beforeSend: function() {
            // alert($('#video').val());

            	if($('#video').val() != "" ){
            
            		$('.upload_progress').show();
                
            		var percentVal = '0%';
                	bar.attr('aria-valuenow', percentVal).css("width",percentVal);
                	percent.html(percentVal);
            	}
            },
            uploadProgress: function(event, position, total, percentComplete) {
            if($('#video').val() != "" ){
            
                var percentVal = percentComplete + '%';
                bar.attr('aria-valuenow', percentVal).css("width",percentVal);
                percent.html(percentVal);
            	// console.log(percentVal);
            	if(percentComplete == 100){
                    setInterval(get_progress, 2000);

                	setTimeout(function () {
   						 // alert("File Has Been Uploaded Successfully. Now thumbnail is being created and it is being compressed for the preview. Please wait!");
    					$("#alert-uploaded").show();
                    	$('.encoding_progress').show();
					}, 1000);

                }
            }
            },
            complete: function(xhr) {
            
            if($('#video').val() != "" ){
//             	console.log(xhr.responseText);
				
            	var response = xhr.responseText;
            
            	 $('.encoding_bar').attr('aria-valuenow', 100).css("width","100%");
            	$('.encoding_percent').html("100%");
            	// console.log(response[0]);
                // alert('Done! Thumbnail and preview version created! ');
    				$("#alert-done").show();

               setTimeout(function() { 
                window.location.href = "/videos/{{$video->id}}";
               }, 10000);
            
            }else{
          		 window.location.href = "/videos/{{$video->id}}";
          	}
            }
          });
    }); 
</script>






</div>

<div class="col-md-2"></div>

</div>

</x-app-layout>