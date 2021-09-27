<x-app-layout>
    <x-slot name="header">
 
      <div class="row m-0 p-0">
        
        <div class="col-lg-10">
          <h4>Showing Article <strong>{{$article->name}}</strong> {{--(ID: {{ $article->id }})--}}</h4>
        </div>
        
        <div class="col-lg-2 text-right">
          <a class="btn btn-danger mb-2" href="{{ URL::previous() }}"><i class="fas fa-caret-left"></i></a>
          <a href="{{ route('articles.index') }}" class="btn btn-danger mb-2 text-right">Go to Photos</a> 
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

ul li {
  list-style-type: circle;
margin-left:20px;
}


ol li {
  list-style-type:decimal;
	margin-left:20px;
}

blockquote {
    background: linear-gradient(to right, #6c757d 4px, transparent 4px) 0 100%, linear-gradient(to left, #6c757d 4px, transparent 4px) 100% 0, linear-gradient(to bottom, #6c757d 4px, transparent 4px) 100% 0, linear-gradient(to top, #6c757d 4px, transparent 4px) 0 100%;
    background-repeat: no-repeat;
    background-size: 20px 20px;
}
blockquote {
    position: relative;
    text-align: center;
    padding: 1rem 1.2rem;
    width: 80%;
    color: #484748;
    margin: 1rem auto 2rem;
}

blockquote:before {
    content: "\f10d";
    top: -12px;
    margin-right: -20px;
    right: 100%;
}

blockquote:after {
    content: "\f10e";
    margin-left: -20px;
    left: 100%;
    top: auto;
    bottom: -20px;
}


blockquote:before,blockquote:after {
    font-family: FontAwesome;
    position: absolute;
    color: #6c757d;
    font-size: 34px;
}
</style>



<div class="container">
<div class="row pt-5 pb-5 pl-1 pr-1">

<div id="desc-card-col" class="col-lg-12 d-flex align-items-stretch p-0 ">
  <div class="card w-100  shadow-sm rounded-bottom" style="">
    
  <div class="card-header">
      <h2>{{$article->title}}</h2>
    </div>
    
  <div class="card-body">
      <p class="text-muted">
        @if( sizeof($article->categories) > 0 )
          @foreach($article->categories as $category)
          {{$category->category->title}} 
            @if(!$loop->last) | @endif
          @endforeach
        @else
          Video categories not assigned.
        @endif
      </p>

      
      <p class="mb-0 pb-0"><strong>Article by:</strong> {{ $article->user->name}}</p>
      <p class="mb-0 pb-0"><strong>Date created:</strong> {{ $article->created_at}}</p>
      <br>
      
       
       <p class="mb-0 pb-0">{!! $article->description !!}</p>



    
      <br>

<div class="text-muted h5 text-right w-100 pr-2"><small>Views: {{$article->view_num()}}</small> </div>
    
    </div>
  
  
    @if (!Auth::guest())
    <div class="card-footer text-right rounded-0 rounded-bottom">
        <!-- <input type="text" value="{{ route('articles.show',$article->id)}}" id="current_article_url"> -->

        <div class="btn-group">
          <button class="btn btn-sm btn-info" onclick="copyToClipboard('{{ route('articles.show',$article->id)}}')"><i class="far fa-share-square"></i> Copy Link</button>
          <!-- <a href="{{ route('articles.show',$article->id)}}" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"></i> View</a> -->
          
          @can('update',$article)
          <a href="{{ route('articles.edit',$article->id)}}" class="btn btn-sm btn-warning text-white"><i class="far fa-edit"></i> Edit</a>
		@endcan
        
        @can('delete',$article)
           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$article->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Video">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>
          @endcan


          
        </div>
      </div>
     @endif
  

  </div>
</div>



        @can('delete',$article)
                <!-- Modal -->
                <div class="modal fade" id="modal_{{$article->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$article->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $article->name }}</strong>?
                      </div>
                      <div class="modal-footer">
                         <form class="" action="{{ route('articles.destroy', $article->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete article">
                          <i class="far fa-trash-alt"></i> Delete Article</button>
                        </form>
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          @endcan


<div class="col-lg-12 pt-5 pb-3">
    <h2>Related Articles:</h2>
</div>

@if(sizeof($related) == 0)
<div class="alert alert-info w-100 shadow-sm" role="alert">
  <h4 class="alert-heading">No related!</h4>
  <hr>
  <p>There are no related Articles at the moment,</p>
</div>
@endif

@foreach($related as $article)
    
    @include('article.related')
    
@endforeach

</div>
</div>




</x-app-layout>