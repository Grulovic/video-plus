<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-6 text-left">
        <h4>Add Video</h4>
    </div>
  <div class="col-6 text-right">
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

   
});
</script>



<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('videos.store') }}" method="POST" name="add_video" enctype="multipart/form-data">
    {{ csrf_field() }}
	
	<input type="text" id="session_id" name="session_id" value="{{$session_id}}" hidden="">

  <div class="form-group col-lg-6">
        <strong>Name</strong>
        <input type="text" name="name" class="form-control" placeholder="Enter name of the video..." value="{{ old('name') }}">
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>

    <div class="form-group col-lg-6">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter the location..." value="{{ old('location') }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

     <div class="form-group col-lg-6 mb-3">
      <strong>Video File</strong>
      <div class="custom-file mb-4">
        <input type="file" name="video" id="video" class="custom-file-input">
        <label class="custom-file-label" for="video">Select video file...</label>
      </div>
      <span class="text-danger">{{ $errors->first('video') }}</span>

      <video controls class="w-100" style="height: 250px;  width: 100%!important; display: block;">
          <source src="mov_bbb.mp4" id="video_preview">
            Your browser does not support HTML5 video.
        </video>

    </div>

    

    <div class="col-lg-6">
                   <strong>Categories</strong>
      <div class="input-group  mb-2">

            <select multiple="" class="custom-select" id="category" name="category[]" required>
              <option value="" selected="">None</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
              @endforeach
            </select>
          </div>

    
    <div class="form-group mb-3">
        <strong>Description</strong>
        <textarea class="form-control" col="4" name="description" placeholder="Enter video description..." style="min-height:175px;">{{ old('description') }}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
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

	 <div class="col-lg-12">
                   <strong>Email push: </strong>
      <div class="input-group  mb-2">

            <div class="form-check  form-check-inline mt-3">
  <input class="form-check-input" type="radio" name="email_push" id="email_push_admin" value="admin" checked="">
  <label class="form-check-label video-thumbnail" for="email_push_admin">
    Send email notification to <strong>admins</strong> only.
  </label>
</div>
      
      <div class="form-check  form-check-inline mt-3">
  <input class="form-check-input" type="radio" name="email_push" id="email_push_all" value="all">
  <label class="form-check-label video-thumbnail" for="email_push_admin">
    Send email notification to <strong>everyone</strong> only!
  </label>
</div>
      
            <div class="form-check  form-check-inline mt-3">
  <input class="form-check-input" type="radio" name="email_push" id="email_push_none" value="none">
  <label class="form-check-label video-thumbnail" for="email_push_admin">
  <strong>Don't</strong> send email notifications!
  </label>
</div>
      
      
          </div>
	</div>

    <div class="col-6 mt-3">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload"></i> Upload video</button>
    </div>
    <div class="col-6 mt-3">
        <a href="{{ route('videos.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel upload</a> 
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
	async: false,
  url: '/videos/encoding_progress',
 data: {session_id: "{{$session_id}}" },
  success:function(data){
  			
          var percent = data;
          var percent_converted = percent + '%';

  			console.log( percent  + "-------" + encoding_bar.attr('aria-valuenow') );
  			
  			if( percent != encoding_bar.attr('aria-valuenow') ){    	
            	encoding_bar.attr('aria-valuenow', percent).css("width",percent_converted);
  				console.log( "UPDATED: " + percent  + "-------" + encoding_bar.attr('aria-valuenow') );
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
            	$('.upload_progress').show();
                
            	var percentVal = '0%';
                bar.attr('aria-valuenow', percentVal).css("width",percentVal);
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
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
            },
            complete: function(xhr) {
//             	console.log(xhr.responseText);
				
            	var response = xhr.responseText;
            
            	 $('.encoding_bar').attr('aria-valuenow', 100).css("width","100%");
            	$('.encoding_percent').html("100%");
            	// console.log(response[0]);
                // alert('Done! Thumbnail and preview version created! ');
    				$("#alert-done").show();

               setTimeout(function() { 
                window.location.href = "/videos/"+response;
               }, 10000);
            
            }
          });
    }); 
</script>



</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>