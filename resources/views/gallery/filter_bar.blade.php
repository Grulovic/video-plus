    <div class="row m-0 p-0">
     <div class="col-lg-12 text-center my-auto m-0 p-0">
 <form class="form-inline row m-0 p-0" action="/photos" method="GET">

  <div class="col-lg-3 text-left">
          <div class="input btn-group mb-2">
            @php
          
              $url_components = parse_url($_SERVER['REQUEST_URI']); 
              if( isset($url_components['query']) ){
                $parameters = $url_components['query'];
              }
            @endphp
            <a href="{{ route('photos.index')}}?{{isset($parameters) ? $parameters : "" }}" class="btn btn-secondary {{ strtok($_SERVER["REQUEST_URI"], '?') == parse_url(route('photos.index'), PHP_URL_PATH) ? "active" : "" }}"><i class="fas fa-th"></i></a>
            <a href="{{ route('photos.list')}}?{{isset($parameters) ? $parameters : "" }}" class="btn btn-secondary {{ strtok($_SERVER["REQUEST_URI"], '?') == parse_url(route('photos.list'), PHP_URL_PATH) ? "active" : "" }}"><i class="fas fa-bars"></i></a>
          @if( auth()->user()->role == "admin")
            <a href="{{ route('photos.create') }}" class="btn btn-success"><i class="fas fa-photo-video"></i> Upload gallery</a> 
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
      <a href="/photos" class="btn btn-danger"><i class="fas fa-times"></i></a>
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
