<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">

   <div class="card-header">
   
   <a href="{{ route('articles.show',$article->id)}}" class="text-black"><h5 class="pb-0 mb-0">
        {{ Str::limit($article->title, 60, $end='...')}}</h5></a>
   
  </div>

    
      <div class="text-muted text-right w-100 pr-2"><small>{{ date('j. F Y. H:i', strtotime($article->created_at)) }}</small></div>
    <div class="card-body pt-0" style="overflow: hidden;">
      {{--<p class="text-muted mb-0 pb-0"><small># of articles: {{ sizeof($article->articles) }}</small></p>--}}
      <p class="text-muted" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><small>
        @if(sizeof($article->categories) > 0)
          @foreach($article->categories as $category)
          {{$category->category->title}} 
            @if(!$loop->last) | @endif
          @endforeach
        @else
          No categories
        @endif
      </small></p>

      <p class="text-muted mb-0 pb-0" style="">{!! Str::limit( strip_tags($article->description), 200, $end='...') !!}</p>
    </div>
  
  <div class="text-muted text-right w-100 pr-2"><small>Views: {{$article->view_num()}}</small> </div>
  
    <div class="card-footer  text-right">
        <div class="btn-group ">
          <a href="{{ route('articles.show',$article->id)}}" class="btn btn-sm btn-primary"><i class="far fa-eye"></i> View</a>
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('articles.show',$article->id)}}')"><i class="far fa-share-square"></i></button>
          
          @if( auth()->user()->role == "admin")
          <a href="{{ route('articles.edit',$article->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$article->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i>
                  </button>
                <!-- Modal -->
                <div class="modal fade" id="modal_{{$article->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$article->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Gallery</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $article->title }}</strong>?
                      </div>
                      <div class="modal-footer">
                         <form class="" action="{{ route('articles.destroy', $article->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete article">
                          <i class="far fa-trash-alt"></i> Delete Gallery</button>
                        </form>
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
            @endif
        
        </div>
      </div>

  </div>
</div>