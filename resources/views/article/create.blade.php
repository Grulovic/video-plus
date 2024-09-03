<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-6 text-left">
        <h4>Add Article</h4>
    </div>
  <div class="col-6 text-right">
        <a href="{{ route('articles.index') }}" class="btn btn-danger mb-2">Go Back</a> 
    </div>
    
</div>

</x-slot>

<script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>


<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('articles.store') }}" method="POST" name="add_article" enctype="multipart/form-data">
    {{ csrf_field() }}

<div class="col-lg-4">

  <div class="form-group">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title of the article..." value="{{ old('title') }}" required>
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>
	
	<strong>Categories</strong>
	<div class="input-group  mb-2">
            <select multiple="" class="custom-select" id="category" name="category[]" style="height:200px;">
              <option value="" selected="">None</option>
              @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
              @endforeach
            </select>
    </div>

</div>   
	


    <div class="col-lg-8">
		
      

    <div class="form-group mb-3">
        <strong>Description</strong>
        <textarea class="form-control ckeditor" col="4" name="description" placeholder="Enter article description..." style="min-height:280px;">{{ old('description') }}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
</div>




    <div class="col-6 mt-3">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-upload"></i> Upload article</button>
    </div>
    <div class="col-6 mt-3">
        <a href="{{ route('articles.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel upload</a> 
    </div>
    
</form>

</div>



<div class="col-md-2"></div>


</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });

    CKEDITOR.replace('wysiwyg-editor', {
        filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });

</script>


</x-app-layout>