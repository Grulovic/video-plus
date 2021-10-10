<x-app-layout>
    <x-slot name="header">

      <div class="row m-0 p-0">

        <div class="col-lg-10">
          <h4>Showing Gallery <strong>{{$gallery->name}}</strong> {{--(ID: {{ $gallery->id }})--}}</h4>
        </div>

        <div class="col-lg-2 text-right">
          <a class="btn btn-danger mb-2" href="{{ URL::previous() }}"><i class="fas fa-caret-left"></i></a>
          <a href="{{ route('photos.index') }}" class="btn btn-danger mb-2 text-right">Go to Photos</a>
        </div>


      </div>

    </x-slot>


<style type="text/css">
  #vide-col .card-img-top{
    border-radius:0.25rem 0 0 0.25rem;
  }

  #desc-card-col .card{
    border-radius:0 0.25rem 0.25rem 0;
  }

  @media only screen and (max-width: 991px) {
    #vide-col .card-img-top{
      border-radius:0.25rem 0.25rem 0 0;
    }

    #desc-card-col .card{
      border-radius:0 0 0.25rem 0.25rem;
    }
  }


</style>



<div class="container">
<div class="row pt-5 pb-5 pl-1 pr-1">

<div id="vide-col" class="col-lg-12 d-flex align-items-stretch p-0 ">


  <div id="gallery{{$gallery->id}}" class="carousel slide card-img-top rounded-top shadow-sm bg-dark" data-ride="carousel" style="max-height: 100%; width: 100%!important; display: block;">
    <ol class="carousel-indicators">
      @foreach($gallery->photos as $photo)
      <li data-target="#gallery{{$gallery->id}}" data-slide-to="{{ $loop->index }}" {{ $loop->first ? 'class="active"':'' }}></li>
      @endforeach
    </ol>
    <div class="carousel-inner  rounded-left text-center h-100  my-auto rounded-top" style="min-height: 600px;">

      @foreach($gallery->photos as $photo)
      <div class="carousel-item {{ $loop->first ? 'active':'' }} h-100 rounded-left text-center h-100 my-auto"
        style="background-image:url({{ url('uploads/photos/'.$photo->file_name) }}); background-size:contain; background-position: center; background-repeat:no-repeat; ">
        <div>
        <p class="mb-0 w-100 text-white bg-secondary text-center"style="position:absolute;bottom:0px;">{{ $photo->file_name }}</p>
        <img src="{{ url('uploads/photos/'.$photo->file_name) }}" class="d-none text-center" style="max-height: 500px; width:auto;  margin-left: auto; margin-right: auto;">
        </div>
      </div>
      @endforeach



    </div>
    <a class="carousel-control-prev " href="#gallery{{$gallery->id}}" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next text-shadow-sm" href="#gallery{{$gallery->id}}" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


</div>

<div id="desc-card-col" class="col-lg-12 d-flex align-items-stretch p-0 ">
  <div class="card w-100  shadow-sm rounded-bottom" style="">


    <div class="card-body">
      <h2>{{$gallery->name}}</h2>
      <p class="text-muted">
        @if( sizeof($gallery->categories) > 0 )
          @foreach($gallery->categories as $category)
          {{$category->category->title}}
            @if(!$loop->last) | @endif
          @endforeach
        @else
          Photo categories not assigned.
        @endif
      </p>
               <p class="text-muted mb-0 pb-0">Number of photos: {{ sizeof($gallery->photos) }}</p>


      <p class="mb-0 pb-0"><strong>Photos uploaded by:</strong> {{ $gallery->user->name}}</p>

      <p class="mb-0 pb-0"><strong>Location:</strong> {{ $gallery->location}}</p>
      <p class="mb-0 pb-0"><strong>Date of upload:</strong> {{ $gallery->created_at}}</p>
      <br><strong>Description:</strong>

       @if( strlen( $gallery->description ) >= 140)
      <script>
      $( document ).ready(function() {
            $( ".show-more-btn" ).click(function() {
              $current = $(this).html();

                  if( $current == "Show more" ){
                      $(this).html("Show less");
                      $('.short-description').hide();
                  }else{
                      $(this).html("Show more");
                      $('.short-description').show();
                  }
            });
      });


      </script>
      <div class="collapse" id="show_more_{{$gallery->id}}">
          <div class="">
            {{ $gallery->description}}
          </div>
        </div>

      <p class="short-description mb-0 pb-0">{{ Str::limit($gallery->description, 140, $end='...')}}</p>

      <a class="show-more-btn btn btn-sm btn-outline-primary" data-toggle="collapse" href="#show_more_{{$gallery->id}}" role="button" aria-expanded="false" aria-controls="show_more_{{$gallery->id}}">Show more</a>

       <br>
       @else
       <p class="mb-0 pb-0">{{ $gallery->description}}</p>
       @endif
      <br>
                      <strong>List of Photos:</strong>
                <div id="upload_images" class="bg-white border rounded" style="max-height: 242px; overflow-y: scroll;">

                @foreach($gallery->photos as $photo)
                <div class="upload_image card m-2 p-1 bg-light" style="word-break: break-all; "><div class="text-left"><i class="fas fa-file-image float-left mt-1 mr-2"></i>{{$photo->original_file_name}}</div></div>
                @endforeach

                </div>


      <br>

<div class="text-muted h5 text-right w-100 pr-2"><small>Views: {{$gallery->view_num()}}</small> </div>

    </div>

    <div class="card-footer text-right rounded-0 rounded-bottom">
        <!-- <input type="text" value="{{ route('photos.show',$gallery->id)}}" id="current_gallery_url"> -->

        <div class="btn-group">
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('photos.show',$gallery->id)}}')"><i class="far fa-share-square"></i> Copy Link</button>
          <!-- <a href="{{ route('photos.show',$gallery->id)}}" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"></i> View</a> -->
          <a href="{{ route('photos.download',$gallery->id)}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a>

          @if( auth()->user()->role == "admin")
          <a href="{{ route('photos.edit',$gallery->id)}}" class="btn btn-sm btn-warning text-white"><i class="far fa-edit"></i> Edit</a>

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$gallery->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>
          @endif



        </div>
      </div>

  </div>
</div>
          @if( auth()->user()->role == "admin")
                <!-- Modal -->
                <div class="modal fade" id="modal_{{$gallery->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$gallery->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Gallery</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $gallery->name }}</strong>?
                      </div>
                      <div class="modal-footer">
                         <form class="" action="{{ route('photos.destroy', $gallery->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete gallery">
                          <i class="far fa-trash-alt"></i> Delete Gallery</button>
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          @endif


<div class="col-lg-12 pt-5 pb-3">
    <h2>Related Galleries:</h2>
</div>

@if(sizeof($related) == 0)
<div class="alert alert-info w-100 shadow-sm" role="alert">
  <h4 class="alert-heading">No related!</h4>
  <hr>
  <p>There are no related Galleries at the moment,</p>
</div>
@endif

@foreach($related as $gallery)

    @include('home.photo_card')

@endforeach

</div>
</div>




</x-app-layout>
