<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-9 text-left">
        <h2>Add Category</h2>
    </div>
  <div class="col-3 text-right">
        <a href="{{ route('categories.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a> 
    </div>
    
</div>

</x-slot>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form  class="row" action="{{ route('categories.store') }}" method="POST" name="add_category">
    {{ csrf_field() }}
    <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">
      
    <div class="form-group col-lg-6">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>


    <div class="form-group col-lg-6">
        <strong>Description</strong>
        <input type="text" name="description" class="form-control" placeholder="Enter description">
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>

    






    <div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-archive"></i> Create category</button>
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('categories.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i>  Cancel create</a> 
        </div>
    </div>



    </div>     

</form>

</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>