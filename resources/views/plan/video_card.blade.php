<div class="col-lg-6 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">

    <video id="{{$video->id}}" class="card-img-top bg-dark" poster="{{ url('uploads/videos/thumbs/thumb_'.$video->thumbnail.'_'. $video->file_name.'.png') }}"
    style="height: 190px; height:auto; min-width: 100%!important; display: block;" controls="true" playsinline muted  preload="none">
      <!-- preload="none" -->

      <source src="{{ url('uploads/videos/previews/preview_'.$video->file_name) }}" type="{{$video->mime}}">
      Your browser does not support the video tag.
    </video>


      <div class="text-muted text-right w-100 pr-2"><small>{{ date('j. F Y. H:i', strtotime($video->created_at)) }}</small></div>
    <div class="card-body pt-0" style="overflow: hidden;">
      <a href="{{ route('videos.show',$video->id)}}" class="text-black"><h5 class="pb-0 mb-0">{{ Str::limit($video->name, 35, $end='...')}}</h5></a>

      <p class="text-muted mb-0 pb-0" style="">{{ Str::limit($video->description, 70, $end='...')}}</p>

    </div>
    <div class="text-muted text-right w-100 pr-2"><small>Views: {{$video->view_num()}}</small> </div>
    <div class="card-footer  text-right">
        <div class="btn-group ">
          <a href="{{ route('videos.show',$video->id)}}" class="btn btn-sm btn-primary"   data-toggle="tooltip" data-placement="top" title="Show Video" ><i class="far fa-eye"></i> View</a>
          <a href="{{ route('videos.download',$video->id)}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i></a>
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('videos.show',$video->id)}}')"><i class="far fa-share-square"></i></button>



          @if( auth()->user()->role == "admin")
          <a href="{{ route('videos.edit',$video->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$video->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i>
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
