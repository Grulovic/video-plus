<x-app-layout>
    <x-slot name="header">

      <div class="row m-0 p-0">
        <div class="col-lg-10">
          <h4>Showing Video <strong>{{$video->name}}</strong> {{--(ID: {{ $video->id }})--}}</h4>
        </div><div class="col-lg-2 text-right">

          <a class="btn btn-danger mb-2" href="{{ URL::previous() }}"><i class="fas fa-caret-left"></i></a>
          <a href="{{ route('videos.index') }}" class="btn btn-danger mb-2 text-right">Go to Videos</a>
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
  <video id="{{$video->id}}" class="card-img-top  rounded-top shadow-sm bg-dark h-100" style="height: 400px; width: 100%!important; display: block;"  poster="{{ url('uploads/videos/thumbs/thumb_'.$video->thumbnail.'_'. $video->file_name.'.png') }}" controls="true"  playsinline preload="none">

      <source src="{{ url('uploads/videos/previews/preview_'.$video->file_name) }}" type="{{$video->mime}}">
      Your browser does not support the video tag.
    </video>
</div>

<div id="desc-card-col" class="col-lg-12 d-flex align-items-stretch p-0 ">
  <div class="card w-100  rounded-bottom shadow-sm" style="">


    <div class="card-body">
      <h2>{{$video->name}}</h2>
      <p class="text-muted">
        @if( sizeof($video->categories) > 0 )
          @foreach($video->categories as $category)
          {{$category->category->title}}
            @if(!$loop->last) | @endif
          @endforeach
        @else
          Video categories not assigned.
        @endif
      </p>


      <p class="mb-0 pb-0"><strong>Video uploaded by:</strong> {{ $video->user->name}}</p>

      <p class="mb-0 pb-0"><strong>Location:</strong> {{ $video->location}}</p>
      <p class="mb-0 pb-0"><strong>Date of upload:</strong> {{ $video->created_at}}</p>
      <br>

      <strong>Description:</strong>

      @if( strlen( $video->description ) >= 140)
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
      <div class="collapse" id="show_more_{{$video->id}}">
          <div class="">
            {!!  $video->description !!}
          </div>
        </div>

      <p class="short-description mb-0 pb-0">{!! Str::limit($video->description, 140, $end='...') !!}</p>

      <a class="show-more-btn btn btn-sm btn-outline-primary" data-toggle="collapse" href="#show_more_{{$video->id}}" role="button" aria-expanded="false" aria-controls="show_more_{{$video->id}}">Show more</a>

      <br>
      @else
      <p class="mb-0 pb-0">{!! $video->description !!}</p>


      @endif


      <br>

      <p class="mb-0 pb-0"><strong>File type:</strong> {{ $video->mime}}</p>

      <p class="mb-0 pb-0"><strong>File size:</strong> {{ $video->size}}</p>
      <br>



    </div>
    <div class="text-muted text-right w-100 pr-2 h5"><small>Views: {{$video->view_num()}}</small> </div>
    <div class="card-footer text-right rounded-bottom">
        <!-- <input type="text" value="{{ route('videos.show',$video->id)}}" id="current_video_url"> -->

        <div class="btn-group">
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('videos.show',$video->id)}}')"><i class="far fa-share-square"></i> Copy Link</button>
          <!-- <a href="{{ route('videos.show',$video->id)}}" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"></i> View</a> -->
          <a href="{{ route('videos.download',$video->id)}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a>

          @if( auth()->user()->role == "admin")
          <a href="{{ route('videos.edit',$video->id)}}" class="btn btn-sm btn-warning text-white"><i class="far fa-edit"></i> Edit</a>

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$video->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>
                @endif



        </div>
      </div>

  </div>
</div>


 @if( auth()->user()->role == "admin")
 <!-- Modal -->
                <div class="modal fade" id="modal_{{$video->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$video->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $video->name }}</strong>?
                      </div>
                      <div class="modal-footer">

                        <form class="" action="{{ route('videos.destroy', $video->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete video">
                          <i class="far fa-trash-alt"></i> Delete Video</button>
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          @endif




<div class="col-lg-12 pt-5 pb-3">
    <h2>Related Videos:</h2>
</div>

@if(sizeof($related) == 0)
<div class="alert alert-info w-100 shadow-sm" role="alert">
  <h4 class="alert-heading">No related!</h4>
  <hr>
  <p>There are no related Videos at the moment,</p>
</div>
@endif

@foreach($related as $video)

    @include('video.related_card')

    @endforeach


</div>
</div>




</x-app-layout>
