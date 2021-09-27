<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-9 text-left">
        <h2>Add Live</h2>
    </div>
  <div class="col-3 text-right">
        <a href="{{ route('lives.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a> 
    </div>
    
</div>

</x-slot>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form  class="row" action="{{ route('lives.store') }}" method="POST" name="add_live">
    {{ csrf_field() }}
    <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">
      
    <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>


    <div class="form-group col-lg-4">
        <strong>Description</strong>
        <input type="text" name="description" class="form-control" placeholder="Enter description">
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>

	<div class="form-group col-lg-4">
        <strong>Featured</strong><br>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="featured" id="featured0" value="0">
  <label class="form-check-label" for="featured0">Don't show</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="featured" id="featured1" value="1">
  <label class="form-check-label" for="featured1">Show on Homepage</label>
</div>
</div>
    
    <div class="form-group col-12">
        <strong>URL</strong>
        <input type="text" name="url" class="form-control" placeholder="Enter url">
        <span class="text-danger">{{ $errors->first('url') }}</span>
    </div>

    






    <div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-archive"></i> Create live</button>
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('lives.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i>  Cancel create</a> 
        </div>
    </div>



    </div>     

</form>

</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>