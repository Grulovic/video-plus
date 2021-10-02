<x-app-layout>
    <x-slot name="header">

<div class="row m-0 p-0">
  <div class="col-9">
    <h2>Editing Plan <a href="{{ route('plans.show',$plan->id)}}">{{$plan->title}}</a></h2>

  </div>
  <div class="col-3 text-right">
    <a href="{{ route('plans.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
  </div>

</div>

</x-slot>


<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('plans.update', $plan->id) }}" method="POST" name="update_plan">
  {{ csrf_field() }}
  @method('PATCH')


  <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input plan="text" name="title" class="form-control" placeholder="Enter title" value="{{ $plan->title }}">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>


    <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ $plan->title }}">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>


    <div class="form-group col-lg-4">
        <strong>Description</strong>
        <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{ $plan->description }}">
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>

    <div class="form-group col-lg-4">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter location"value="{{ $plan->location }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-4">
        <strong>Date</strong>
        <input type="date" name="date" class="form-control" placeholder="Enter date" value="{{ $plan->date }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group  col-lg-4">
        <strong>Categories</strong>
        <select multiple="" class="custom-select" id="category" name="category[]">
            <option value="" @if(sizeof($plan->categories) == 0)selected=""@endif>None</option>

            @foreach($categories as $category)
                <option value="{{$category->id}}"
                @foreach($plan->categories as $plan_category)
                    {{ $category->id == $plan_category->category_id ? 'selected=""' : '' }}
                    @endforeach
                >{{$category->title}}</option>
            @endforeach


        </select>
    </div>


    {{--    VIDEO--}}
    <div class="form-group col-lg-4">
        <strong>Video</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video" id="video0" value="0" {{ $plan->video == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video" id="video1" value="1" {{ $plan->video == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--    PHOTO --}}
    <div class="form-group col-lg-4">
        <strong>Photo</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo0" value="0" {{ $plan->photo == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo1" value="1" {{ $plan->photo == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--   TEXT --}}
    <div class="form-group col-lg-4">
        <strong>Text</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text0" value="0" {{ $plan->text == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text1" value="1" {{ $plan->text == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--  LIVE  --}}
    <div class="form-group col-lg-4">
        <strong>Live</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live0" value="0" {{ $plan->live == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live1" value="1" {{ $plan->live == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>





<div class="col-12 pt-3">
        <div class="w-50 float-left p-1">


             <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_{{$plan->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Edit Plan">
                   <i class="far fa-edit"></i> Edit Plan
                  </button>

        <!-- Modal -->
        <div class="modal fade text-black" id="modal_{{$plan->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$plan->id}}_delete_btn" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                Are you sure you want to edit <strong>{{ $plan->title }}</strong>?
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit plan</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->


        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('plans.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a>
        </div>
    </div>

</form>

</div>

<div class="col-md-2"></div>

</div>

</x-app-layout>
