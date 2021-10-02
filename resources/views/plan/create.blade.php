<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-9 text-left">
        <h2>Add Plan</h2>
    </div>
  <div class="col-3 text-right">
        <a href="{{ route('plans.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
    </div>

</div>

</x-slot>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form  class="row" action="{{ route('plans.store') }}" method="POST" name="add_plan">
    {{ csrf_field() }}
    <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">

    <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>




    <div class="form-group col-lg-4">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter location">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-4">
        <strong>Date</strong>
        <input type="date" name="date" class="form-control" placeholder="Enter date">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-6">
        <strong>Description</strong>
        <textarea type="text" name="description" class="form-control" placeholder="Enter description" style="min-height:106px;"></textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>

    <div class="form-group  col-lg-6">
        <strong>Categories</strong>
        <select multiple="" class="custom-select" id="category" name="category[]">
            <option value="" selected="">None</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>


{{--    VIDEO--}}
	<div class="form-group col-lg-3">
        <strong>Video</strong><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="video" id="video0" value="0">
          <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="video" id="video1" value="1">
          <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--    PHOTO --}}
    <div class="form-group col-lg-3">
        <strong>Photo</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo0" value="0">
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--   TEXT --}}
    <div class="form-group col-lg-3">
        <strong>Text</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text0" value="0">
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--  LIVE  --}}
    <div class="form-group col-lg-3">
        <strong>Live</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live0" value="0">
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>








    <div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-archive"></i> Create plan</button>
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('plans.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i>  Cancel create</a>
        </div>
    </div>



    </div>

</form>

</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>
