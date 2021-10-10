<div class="col-lg-12 m-0 p-0">
  <div class="card shadow-sm mb-4">
    <div class="row no-gutters" style="max-height: 400px;">

        <div class="col-lg-5 h-100 my-auto border-right" style="
        ">

        @foreach($gallery->photos as $photo)
  @if($loop->first)
        <a href="{{ route('photos.show',$gallery->id)}}"><img src="{{ url('uploads/photos/'.$photo->file_name) }}" class="" style="max-height:400px; width: 100%!important; display: block; object-fit:cover;   object-position:top;"></a>
  @endif
	@endforeach



  {{--<div id="gallery{{$gallery->id}}" class="carousel slide card-img-top rounded-left shadow-sm bg-dark" data-ride="carousel" style="height: 400px; width: 100%!important; display: block;">
    <ol class="carousel-indicators">
      @foreach($gallery->photos as $photo)
      <li data-target="#gallery{{$gallery->id}}" data-slide-to="{{ $loop->index }}" {{ $loop->first ? 'class="active"':'' }}></li>
      @endforeach
    </ol>
    <div class="carousel-inner  rounded-left text-center h-100">

      @foreach($gallery->photos as $photo)
      <div class="carousel-item h-100 {{ $loop->first ? 'active':'' }} bg-info rounded-left text-center" style="
      background-image:url({{ url('uploads/'.$photo->file_name) }});
      background-size:cover;

      ">
        <!-- <img src="{{ url('uploads/'.$photo->file_name) }}" class="h-100 text-center" style="object-fit:cover;"> -->
        <img class="d-none w-100 h-100" src="{{ url('uploads/photos/'.$photo->file_name) }}" alt="First slide">
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
  </div>--}}



        </div>

        <div class="col-lg-7 bg-white">
          <div class="row m-0 p-0  h-100">
            <div class="col-12 pt-2 " >
              <div class="text-muted text-right w-100 pr-2">{{ date('j. F Y. H:i', strtotime($gallery->created_at)) }}</div>
              <a href="{{ route('photos.show',$gallery->id)}}" class="text-black"><h2>{{$gallery->name}}</h2></a>

                <p class="text-muted">
                  @if( sizeof($gallery->categories) > 0 )
                    @foreach($gallery->categories as $category)
                    {{$category->category->title}}
                      @if(!$loop->last) | @endif
                    @endforeach
                  @else
                    Video categories not assigned.
                  @endif
                </p>
            </div>


            <div class="col-lg-5">
                <p class="mb-0 pb-0"><strong>Video uploaded by:</strong> {{ $gallery->user->name}}</p>
                <p class="mb-0 pb-0"><strong>Location:</strong> {{ $gallery->location}}</p>
                <p class="mb-0 pb-0"><strong>Date of upload:</strong> {{ $gallery->created_at}}</p>
                <br>


                <br>
            </div>

            <div class="col-lg-7" style="border-radius: 0px 0px 0.25rem  0px; ">
               <strong>Description:</strong>
                <p class="mb-0 pb-0">{{ Str::limit($gallery->description, 170, $end='...')}}</p>
                <br>
            </div>

          	<div class="text-muted text-right w-100 pr-4 h5"><small>Views: {{$gallery->view_num()}}</small> </div>

             <div class="col-lg-12 card-footer text-center text-lg-right w-100 align-self-end pl-1 pr-3"  style="">
              <div class="btn-group">
                <a href="{{ route('photos.show',$gallery->id)}}" class="btn btn-sm  btn-primary"><i class="far fa-eye"></i> View</a>
                <a href="{{ route('photos.download',$gallery->id)}}" class="btn btn-sm  btn-success"><i class="fas fa-download"></i> Download</a>
                <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('photos.show',$gallery->id)}}')"><i class="far fa-share-square"></i> Copy link</button>


                @if( auth()->user()->role == "admin")

                <a href="{{ route('photos.edit',$gallery->id)}}" class="btn btn-sm  btn-warning"><i class="far fa-edit"></i> Edit</a>

                <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$gallery->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>





                @endif

              </div>
            </div>


          </div>
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
