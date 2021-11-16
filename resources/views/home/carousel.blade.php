<script>
$(document).ready(function(){
console.log("here");

    $('#home_carousel').on('slide.bs.carousel', function(event) {

   	console.log("car change stop video");

       $("#home_carousel video").each(function(){
            $(this).get(0).pause();
       });
    });


    $('#home_carousel video').bind('play', function (e) {
    console.log("car stop");
         $('#home_carousel').carousel('pause');
    });

    $('#home_carousel video').bind('pause', function (e) {
    console.log("car start");
          $('#home_carousel').carousel();
    });
});
</script>


<style type="text/css">
.carousel-wrapper{
	background: #0d4077;
	background: linear-gradient(135deg, #082647 0%, #0d4077 100%);
}
.carousel-item{
	height: 700px;
}
@media only screen and (max-width: 991px) {
  #home_carousel {
    margin-top:65px!important;
  }
}
 .text-shadow-sm:not(.btn){
    /*text-shadow: -1px 1px 3px rgba(150, 150, 150, 1);*/
    text-shadow: -2px 2px 2px rgba(0,0,0,0.75)!important;
  }

  .carousel-control-prev
  ,.carousel-control-next{
      width:9.5%!important;
  }

   .carousel-indicators li {
    background-color: #fff;
    box-shadow: -1px 1px 3px rgba(0, 0, 0, 0.5);
}

  .carousel-indicators .active{
    background-color: #007bed ;
}

    .carousel-control-prev-icon,
.carousel-control-next-icon {
  height: 100px;
  width: 100px;
  outline: black;
  background-size: 100%, 100%;
  background-image: none;
  text-shadow: -1px 1px 3px rgba(0, 0, 0, 0.5);
}

.carousel-control-next-icon:after
{
  content: '❯';
  font-size: 55px;
  color: #fff ;
  opacity:1;
}

.carousel-control-prev-icon:after {
  content: '❮';
  font-size: 55px;
  color: #fff ;
  opacity:1;
}
  .carousel-control-prev, .carousel-control-next{
    opacity:1;
  }

  .carousel-control-prev:hover .carousel-control-prev-icon:after
, .carousel-control-next:hover .carousel-control-next-icon:after{
	color:#007bed!important;
  }
</style>

<div class="carousel-wrapper border-bottom">
<div  class="container p-0" style="max-width:1920px;">
<div id="home_carousel_wrapper" class="row m-0 p-0">
  <div class="col-lg-12 p-0">

    <div id="home_carousel" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	  	@foreach($carausel as $item)
		    <li data-target="#home_carousel" data-slide-to="{{$loop->index}}" @if($loop->first)class="active"@endif></li>
		@endforeach
	  </ol>
	  <div class="carousel-inner">

	  	@foreach($carausel as $item)
	  		@if(class_basename($item) == "Video")

                  @if(!settings()->get('hide_videos'))
		    <div class="carousel-item {{ ($loop->first)?'active':'' }}" style="">
		    	<div class="container h-100" style="max-width: 80%;">
		      <div class="row m-0 p-0 h-100" style="">


		      	<div class="col-lg-6 my-lg-auto text-white bg-info2 order-lg-1 order-2">
		      		<div>
		      		<h2 class="text-shadow-sm">{{ Str::limit($item->name, 80, $end='...')}}</h2>
				      <p class="text-white text-shadow-sm">
				        @if( sizeof($item->categories) > 0 )
				          @foreach($item->categories as $category)
				          {{$category->category->title}}
				            @if(!$loop->last) | @endif
				          @endforeach
				        @endif
				      </p>
				      <p class="mb-0 pb-0 text-shadow-sm">{{ Str::limit($item->description, 140, $end='...')}}</p>

				      <a href="{{ route('videos.show',$item->id)}}" class="btn btn-primary mt-5"><i class="far fa-eye"></i> Go to Video</a>

				      </div>
		      	</div>


		      	<div class="col-lg-6 my-auto pt-2 pb-2 bg-warning2  order-lg-2 order-1">
		      		<video id="{{$item->id}}" class="card-img-top rounded-left shadow-sm bg-dark" poster="{{ url('uploads/videos/thumbs/thumb_'.$item->thumbnail.'_'. $item->file_name.'.png') }}"
                           style="max-height: 400px;  display: block;" controls="true"  preload="metadata" playsinline  preload="none">
				      <source src="{{ url('uploads/videos/previews/preview_'.$item->file_name) }}" type="{{$item->mime}}">
				      Your browser does not support the video tag.
				    </video>


		      	</div>

		      </div>
		      </div>
		    </div>
                      @endif
		    @else

                  @if(!settings()->get('hide_photos'))
    		    @if(sizeof($item->photos) > 0)
    		    <div class="carousel-item {{ ($loop->first)?'active':'' }}" style="
    		    background-color:rgba(0,0,0,0.3);
    		    background-image:url({{url('uploads/photos/compressed/'.$item->photos[0]->file_name)}})!important;
    		    background-size:cover;
    		    background-position:top;
    		    background-repeat:no-repeat;

    		    ">
    		    	<div class="container h-100" style="max-width: 85%;">
    	    			<div class="row m-0 p-0 h-100" style="">
      					<div class="col-lg-12 my-auto text-white bg-info2">
    		    		<h2 class="text-shadow-sm">{{ Str::limit($item->name, 80, $end='...')}}</h2>
    				      <p class="text-white text-shadow-sm">
    				        @if( sizeof($item->categories) > 0 )
    				          @foreach($item->categories as $category)
    				          {{$category->category->title}}
    				            @if(!$loop->last) | @endif
    				          @endforeach
    				        @endif
    				      </p>
    				      <p class="mb-0 pb-0 text-shadow-sm">{{ Str::limit($item->description, 140, $end='...')}}</p>

    				      <a href="{{ route('photos.show',$item->id)}}" class="btn btn-primary mt-5"><i class="far fa-eye"></i> Go to Gallery</a>
    		   		</div>
    		   		</div>
    		   		</div>
    		   </div>
    		    @endif
                      @endif
		    @endif
		@endforeach




	  </div>




	  <a class="carousel-control-prev" href="#home_carousel" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#home_carousel" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>



	</div>

  </div>
</div>
</div>
</div>
