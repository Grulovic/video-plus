<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">
    <iframe  class="card-img-top bg-dark" style="height:260px!important; height:auto; min-width: 100%!important; display: block;" src="{{$live->url}}?autoplay=false"></iframe>

      <div class="text-muted text-right w-100 pr-2"><small>{{ date('j. F Y. H:i', strtotime($live->created_at)) }}</small></div>
    <div class="card-body pt-0" style="overflow: hidden;">
      <a href="{{ route('lives.show',$live->id)}}" class="text-black"><h5 class="pb-0 mb-0">{{ Str::limit($live->title, 35, $end='...')}}</h5></a>




      <p class="text-muted mb-0 pb-0" style="">
          @php
              foreach(preg_split("/((\r?\n)|(\r\n?))/", $live->description) as $line){
                    if(filter_var($line, FILTER_VALIDATE_URL)){
                     echo '<a href="'.$line.'">'.$line.'</a><br>';
                    }else{
                     echo $line.'<br>';
                    }
                 }
          @endphp
      </p>

    </div>

    <div class="card-footer  text-right">
        <div class="btn-group ">
          <a href="{{ route('lives.show',$live->id)}}" class="btn btn-sm btn-primary"   data-toggle="tooltip" data-placement="top" title="Show live" ><i class="far fa-eye"></i> View</a>

          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('lives.show',$live->id)}}')"><i class="far fa-share-square"></i></button>


           @if (!Auth::guest())
 			@can('update',$live)


          <a href="{{ route('lives.edit',$live->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
          @endcan
 			@can('delete',$live)

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$live->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete live">
                   <i class="far fa-trash-alt"></i>
                  </button>
          @endcan

          @endif

        </div>
      </div>

  </div>
</div>




         @if (!Auth::guest())
			@can('delete',$live)
                <!-- Modal -->
                <div class="modal fade" id="modal_{{$live->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$live->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Live</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $live->name }}</strong>?
                      </div>
                      <div class="modal-footer">

                        <form class="" action="{{ route('lives.destroy', $live->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete live">
                          <i class="far fa-trash-alt"></i> Delete Live</button>
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          @endcan
          @endif
