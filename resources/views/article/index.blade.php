<x-app-layout>
        <script>
        function copyToClipboard(url) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(url).select();
          document.execCommand("copy");
          $temp.remove();
        }
        </script>
        
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
    <script type="text/javascript" src="{{ asset('js/video-datepicker.js') }}"></script>
    <link href="{{ asset('css/video-datepicker.css') }}" rel="stylesheet">

  <x-slot name="header">

    <div class="row m-0 p-0">
     <div class="col-lg-12 text-center my-auto m-0 p-0">
 <form class="form-inline row m-0 p-0" action="/articles" method="GET">

  <div class="col-lg-3 text-left">
          <div class="input btn-group mb-2">
           @if (!Auth::guest())
         	@can('create', App\Models\Article::class)
            <a href="{{ route('articles.create') }}" class="btn btn-success"><i class="far fa-newspaper"></i> Create article</a> 
          	@endcan	
          @endif
          </div>
  </div>
  <div class="col-lg-3">
  </div>
<div class="col-lg-6 p-0">
  <div class="row m-0 p-0">

    <div class="col-7 col-lg-8 pr-0 text-right"><div class="input-group pr-2  mb-2 ">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
      </div>
        <input class="form-control" type="text" name="search" placeholder="Search..." value='{{(isset(request()->search)) ? request()->search : ""}}' focus>
    </div></div>

    <div class="col-5 col-lg-4 pl-0 pr-4 text-right"><div class="btn-group mb-2 ">
      <button type="submit" class="btn btn-primary font-weight-bold " value="Submit">Search <i class="fas fa-search"></i></button>        
      <a href="/articles" class="btn btn-danger"><i class="fas fa-times"></i></a>
    </div></div>
    
  </div>        
</div>

  <div class="col-lg-3">
        <div class="input-group pr-2 mb-2">
          <div class="input-group-prepend">
              <label class="input-group-text" for="from_date"><i class="far fa-calendar-alt"></i></label>
          </div>
          <input class="form-control" type="text" id="datepicker" name="from_date" placeholder="Chose from date..." value="{{(isset(request()->from_date)) ? request()->from_date : ""}}">
        </div>
  </div>
  <div class="col-lg-3">

         <div class="input-group pr-2  mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="vendor"><i class="fas fa-user"></i></label>
            </div>

            <select class="custom-select" id="user" name="user">
              <option value="" {{(isset(request()->user_id)) ? "selected" : ""}}>All users</option>
              <option disabled>------</option>
              @foreach($users as $user)
                <option value="{{$user->id}}" {{( request()->user == $user->id) ? "selected" : ""}}>{{$user->name}}</option>
              @endforeach
            </select>
          </div>
</div><div class="col-lg-3">
          <div class="input-group pr-2  mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="vendor"><i class="fas fa-archive"></i></label>
            </div>

            <select class="custom-select" id="category" name="category">
              <option value="" {{(isset(request()->user_id)) ? "selected" : ""}}>All categories</option>
              <option disabled>------</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}" {{( request()->category == $category->id) ? "selected" : ""}}>{{$category->title}}</option>
              @endforeach
            </select>
          </div>


</div><div class="col-lg-3">
          <div class="input-group pr-2  mb-2">
            <div class="input-group-prepend">
              <label class="input-group-text" for="sort"><i class="fas fa-long-arrow-alt-up"></i><i class="fas fa-long-arrow-alt-down"></i></label>
            </div>

            <select class="custom-select" id="sort" name="sort">
              <option value="new" {{(request()->sort == "new") ? "selected" : ""}}>Newest first</option>
              <option value="old" {{(request()->sort == "old") ? "selected" : ""}}>Oldest first</option>
            </select>
          </div>
</div>
   
        </form>
      </div>
      
    </div>



  </x-slot>

  <div class="row m-0 p-0 p-3 view-group">
    @include('alerts')
  
  @foreach($articles as $article)

    @include('article.card')

  @endforeach

  <div class="col-lg-12 mt-4">
        {!! $articles->appends(request()->input())->links() !!}
        
      </div>
  </div>


</x-app-layout>