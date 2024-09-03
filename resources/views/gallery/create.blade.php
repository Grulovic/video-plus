<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-6 text-left">
        <h4>Add Gallery</h4>
    </div>
  <div class="col-6 text-right">
        <a href="{{ route('photos.index') }}" class="btn btn-danger mb-2">Go Back</a> 
    </div>
    
</div>

</x-slot>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>


<script type="text/javascript">
$( document ).ready(function() {
  function readURL(input) {
    if (input.files && input.files[0]) {
        $('.carousel-inner').empty();

        for (i = 0; i < input.files.length; i++) {
          console.log(event.target.files[i]);
            var source = URL.createObjectURL(event.target.files[i]);

            if(i==0){
                $('.carousel-inner').append('<div class="carousel-item active" ><p class="mb-0 w-100 text-white bg-info text-center"style="position:absolute;bottom:0px;">'+event.target.files[i]['name']+'</p><img class="d-block " src="' + source +'" style="max-height: 400px; margin-left: auto; margin-right: auto;"></div>');
            }else{
                $('.carousel-inner').append('<div class="carousel-item" ><p class="mb-0 w-100 text-white bg-info text-center"style="position:absolute;bottom:0px;">'+event.target.files[i]['name']+'</p><img class="d-block " src="' + source +'" style="max-height: 400px; margin-left: auto; margin-right: auto;"></div>');
            }
        }

        $("#gallery_preview").show();

    }
}

   $("#gallery").change(function(){
    $("#upload_images").empty();
    readURL(this);
    var upload_images = this.files;

    for(var i=0; i< this.files.length; i++){
        var file = this.files[i];

        $("#upload_images").append('<div class="upload_image card m-2 p-1 bg-light"><div class="text-left"><i class="fas fa-file-image float-left mt-1 mr-2"></i>' + file.name +'</div></div>');
    }

    // $("#upload_images").show();
});


// $("#upload_images").hide();

$("#gallery_preview").hide();





   $(".custom-file-input").on("change", function() {
      // var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html("List of files selected below.");
    });
});



</script>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('photos.store') }}" method="POST" name="add_gallery" enctype="multipart/form-data">
    {{ csrf_field() }}


  <div class="form-group col-lg-6">
        <strong>Gallery Name</strong>
        <input type="text" name="name" class="form-control" placeholder="Enter name of the gallery..." value="{{ old('name') }}" required>
        <span class="text-danger">{{ $errors->first('name') }}</span>
    </div>

    <div class="form-group col-lg-6">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter the location..." value="{{ old('location') }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

     <div class="form-group col-lg-6 mb-3">
      <strong>Photos</strong>
      <div class="custom-file mb-2">
        <input type="file" name="gallery[]" id="gallery" class="custom-file-input" multiple required>
        <label class="custom-file-label" for="gallery">Select image files...</label>
      </div>
      <span class="text-danger">{{ $errors->first('gallery') }}</span>


      <strong>File list:</strong>
      <div id="upload_images" class="card" style="max-height: 242px; overflow-y: scroll;">
      <div class="upload_image card m-2 p-1" style="background-color:#ea868f; "><div class="text-left"><i class="fas fa-file-image float-left mt-1 mr-2"></i><i class="fas fa-exclamation-circle"></i> No photos selected.</div></div>
      </div>

    </div>

    

    <div class="col-lg-6">
                   <strong>Categories</strong>
      <div class="input-group  mb-2">

            <select multiple="" class="custom-select" id="category" name="category[]">
              <option value="" selected="">None</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
              @endforeach
            </select>
    </div>

    <div class="form-group mb-3">
        <strong>Description</strong>
        <textarea class="form-control" col="4" name="description" placeholder="Enter gallery description..." style="min-height:175px;">{{ old('description') }}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>



<div id="gallery_preview" class="col-lg-12">
    <strong>Gallery Preview</strong>

  <div  id="gallery-preview-carousel" class="carousel slide container-fluid m-0 p-0 bg-dark" data-ride="carousel">

      <div class="carousel-inner">
        
          <div class="carousel-item active" >
            <img class="d-block bg-dark " src="" style="max-height: 400px; margin-left: auto; margin-right: auto;">
          </div>
      
          <div class="carousel-item" >
            <img class="d-block bg-dark" src="" style="max-height: 400px; margin-left: auto; margin-right: auto;">
          </div>

      </div>
      <a class="carousel-control-prev" href="#gallery-preview-carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#gallery-preview-carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

</div>


<div class="col-lg-12 pt-5">
  <div class="upload_progress">
  <strong>Upload Progress:</strong>
  <div class="progress ">
      <div class="progress-bar upload_bar bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"><div class="upload_percent">0%</div></div>
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
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload"></i> Upload gallery</button>
    </div>
    <div class="col-6 mt-3">
        <a href="{{ route('photos.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel upload</a> 
    </div>
    


<div class="col-lg-12 pt-5">
    <div id="alert-uploaded" class="alert alert-success" role="alert">
  <h4 class="alert-heading">Upload Done!</h4>
  <p>Images have been uploaded successfully. 
    <br>You will be <strong>redirected in 10 seconds</strong>!</p>
</div>


</form>



<script type="text/javascript">
$( document ).ready(function() {

    	$("#alert-uploaded").hide();
    
        var bar = $('.upload_bar');
        var percent = $('.upload_percent');
        $('.upload_progress').hide();
    
          $('form').ajaxForm({
            beforeSend: function() {
            // alert($('#video').val());
            
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

   						 // alert("File Has Been Uploaded Successfully. Now thumbnail is being created and it is being compressed for the preview. Please wait!");
    					$("#alert-uploaded").show();
                    	$('.encoding_progress').show();

                }
            },
            complete: function(xhr) {
            
//             	console.log(xhr.responseText);
				
            	var response = xhr.responseText;
            	// console.log(response[0]);
              // alert('Done! Thumbnail and preview version created! ');

               setTimeout(function() { 
                window.location.href = "/photos/" + response;
               }, 10000);


            }
          });
    }); 
</script>




</div>
<div class="col-md-2"></div>


</div>


</x-app-layout>