<div class="col-lg-12 m-0 p-0">
  <div class="card shadow-sm mb-4">
    <div class="row no-gutters">
        
        <div class="col-lg-5 h-100 bg-dark my-auto" style="">
       
        
        <video id="{{$video->id}}" class="card-img-top" poster="{{ url('uploads/videos/thumbs/thumb_'.$video->thumbnail.'_'. $video->file_name.'.png') }}"
    style="min-height:100%; width: 100%!important; display: block;"  controls="true" playsinline muted preload="none">
      <!-- preload="none" -->

      <source src="{{ url('uploads/videos/previews/preview_'.$video->file_name) }}" type="{{$video->mime}}">
      Your browser does not support the video tag.
    </video>
        

        </div>

        <div class="col-lg-7 bg-white">
          <div class="row m-0 p-0  h-100">
            <div class="col-12 pt-2 " >
              <div class="text-muted text-right w-100 pr-2"><small>{{ date('j. F Y. H:i', strtotime($video->created_at)) }}</small></div>
              <a href="{{ route('videos.show',$video->id)}}" class="text-black"><h2>{{$video->name}}</h2></a>
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
            </div>
          

            <div class="col-lg-5">
                <p class="mb-0 pb-0"><strong>Video uploaded by:</strong> {{ $video->user->name}}</p>
                <p class="mb-0 pb-0"><strong>Location:</strong> {{ $video->location}}</p>
                <p class="mb-0 pb-0"><strong>Date of upload:</strong> {{ $video->created_at}}</p>
                <br>
                <p class="mb-0 pb-0"><strong>File type:</strong> {{ $video->mime}}</p>
                <p class="mb-0 pb-0"><strong>File size:</strong> {{ $video->size}}</p>
                <br>
            </div>

            <div class="col-lg-7" style="border-radius: 0px 0px 0.25rem  0px; ">
               <strong>Description:</strong>
                <p class="mb-0 pb-0">{{ $video->description}}</p>
                <br>
            </div>

          <div class="text-muted text-right w-100 pr-4 pb-2"><small>Views: {{$video->view_num()}}</small> </div>
          
             <div class="col-lg-12 card-footer text-center text-lg-right w-100 align-self-end pl-1 pr-3"  style="">
              <div class="btn-group">
                <a href="{{ route('videos.show',$video->id)}}" class="btn btn-sm  btn-primary"><i class="far fa-eye"></i> View</a>
                <a href="{{ route('videos.download',$video->id)}}" class="btn btn-sm  btn-success"><i class="fas fa-download"></i> Download</a>
                <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('videos.show',$video->id)}}')"><i class="far fa-share-square"></i> Copy link</button>
                
                
                
                @if( auth()->user()->role == "admin")
                <a href="{{ route('videos.edit',$video->id)}}" class="btn btn-sm  btn-warning"><i class="far fa-edit"></i> Edit</a>
                
                 <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$video->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
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
