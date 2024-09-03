<x-app-layout>
    <x-slot name="header">

<div class="row m-0 p-0">
  <div class="col-6">
    <h2>Showing Live <strong>{{ $live->title }}</strong></h2>
  </div><div class="col-6 text-right">

    <a class="btn btn-danger mb-2" href="{{ URL::previous() }}"><i class="fas fa-caret-left"></i></a>
    <a href="{{ route('lives.index') }}" class="btn btn-danger mb-2 text-right">Go to lives</a>
  </div>

</div>

</x-slot>




<div class="row m-0 p-0 pt-5 pb-5">
  <div class="col-md-2"></div>

  <div class="col-md-8">

    <div class="card">
    @if( isset($live->url) )
    <iframe  class="card-img-top bg-dark" style="height:460px!important; height:auto; min-width: 100%!important; display: block;" src="{{$live->url}}?autoplay=false"></iframe>
    @endif
      <div class="card-body">
        <small class="float-right">ID: {{ $live->id }}</small>
        <h3 class="card-title"><strong>Title:</strong> {{ $live->{'title'} }}</h3>


        <p><strong>Description:</strong>
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
          <p><strong>URL:</strong> <a href="{{ $live->url }}">{{ $live->url }}</a></p>
        <p><strong>Created at:</strong> {{ $live->created_at }}</p>



      </div>
 @if (!Auth::guest())

      <div class="card-footer text-center">

        <div class=" btn-group">

        <div>
        	<button class="btn btn-info mr-3" onclick="copyToClipboard('{{ route('lives.show',$live->id)}}')"><i class="far fa-share-square"></i> Copy Link</button>
    	</div>
          <!-- <div><a href="{{ route('lives.show',$live->id)}}" class="btn btn-warning mr-3">Show <i class="far fa-eye"></i></a></div> -->
         @can('update',$live)

          <div><a href="{{ route('lives.edit',$live->id)}}" class="btn btn-primary mr-3"><i class="far fa-edit"></i> Edit </a></div>
        @endcan

         @can('delete',$live)
          <div>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$live->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>

          </div>
        @endcan

        </div>

      </div>
@endif
    </div>

   @if (!Auth::guest())
  @can('delete',$live)
   <!-- Modal -->
                <div class="modal fade text-black" id="modal_{{$live->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$live->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Live</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $live->title }}</strong>?
                      </div>
                      <div class="modal-footer">
                         <form action="{{ route('lives.destroy', $live->id)}}" method="post">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i> Delete Live</button>
                          </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
        @endcan
@endif





  </div>

  <div class="col-md-2"></div>


</div>



</x-app-layout>
