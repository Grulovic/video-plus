<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">
    <div class="p-2 pt-0 pb-0 bg-light text-primary" style="position:absolute; top:0; left:0; border-radius: 0.2rem 0 0.2rem 0; opacity:1; padding-top:2px!important; padding-bottom:2px!important;  ">
          <i class="far fa-image"></i>
      </div>

  @foreach($gallery->photos as $photo)
  @if($loop->first)
        <a href="{{ route('photos.show',$gallery->id)}}"><img src="{{ url('uploads/photos/compressed/'.$photo->file_name) }}" class="card-img-top bg-dark" style="height: 250px; min-width: 100%!important; display: block; object-fit:cover;  object-position:top;"></a>
  @endif
	@endforeach

      <div class="text-muted text-right w-100 pr-2"><small>{{ date('j. F Y. H:i', strtotime($gallery->created_at)) }}</small></div>
    <div class="card-body pt-0" style="overflow: hidden;">
      <a href="{{ route('photos.show',$gallery->id)}}" class="text-black"><h5 class="pb-0 mb-0">{{ Str::limit($gallery->name, 70, $end='...')}}</h5></a>

      <p class="text-muted mb-0 pb-0" style="">{{ Str::limit($gallery->description, 100, $end='...')}}</p>
    </div>
      @if (!Auth::guest())
          @if( auth()->user()->role == "admin")
  <div class="text-muted text-right w-100 pr-2"><small>Views: {{$gallery->view_num()}}</small> </div>
@endif
      @endif
    @if (!Auth::guest())
    <div class="card-footer  text-right">
        <div class="btn-group ">
          <a href="{{ route('photos.show',$gallery->id)}}" class="btn btn-sm btn-primary"><i class="far fa-eye"></i> View</a>
          <a href="{{ route('photos.download',$gallery->id)}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i></a>
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('photos.show',$gallery->id)}}')"><i class="far fa-share-square"></i></button>




      @if( auth()->user()->role == "admin")
          <a href="{{ route('photos.edit',$gallery->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>


          <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$gallery->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i>
                  </button>

        @endif

        </div>
      </div>
       @endif
  </div>
</div>

@if (!Auth::guest())
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
        @endif
