<x-app-layout>
    <x-slot name="header">

<div class="row m-0 p-0">
  <div class="col-9">
    <h2>Editing Live <a href="{{ route('lives.show',$live->id)}}">{{$live->title}}</a></h2>

  </div>
  <div class="col-3 text-right">
    <a href="{{ route('lives.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
  </div>

</div>

</x-slot>


<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('lives.update', $live->id) }}" method="POST" name="update_live">
  {{ csrf_field() }}
  @method('PATCH')


  <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input live="text" name="title" class="form-control" placeholder="Enter title" value="{{ $live->title }}">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>




	<div class="form-group col-lg-4">
        <strong>Featured</strong><br>
    <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="featured" id="featured0" value="0"  {{ $live->featured == 0 ? "checked" : "" }}>
  <label class="form-check-label" for="featured0">Don't show</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="featured" id="featured1" value="1" {{ $live->featured == 1 ? "checked" : "" }}>
  <label class="form-check-label" for="featured1">Show on Homepage</label>
</div>
</div>


    <div class="form-group col-lg-4">
        <strong>Try to extract Youtube ID</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="youtube" id="featured0" value="0" checked>
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="youtube" id="featured1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

    <div class="form-group col-lg-12">
        <strong>Description</strong>
        <textarea type="text" name="description" class="form-control" placeholder="Enter description" style="min-height:200px;">{{ $live->description }}</textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
    <div class="form-group col-12">
        <strong>URL</strong>
        <input type="text" name="url" class="form-control" placeholder="Enter url" value="{{ $live->url }}">
        <span class="text-danger">{{ $errors->first('url') }}</span>
    </div>





<div class="col-12 pt-3">
        <div class="w-50 float-left p-1">


             <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_{{$live->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Edit Live">
                   <i class="far fa-edit"></i> Edit Live
                  </button>

        <!-- Modal -->
        <div class="modal fade text-black" id="modal_{{$live->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$live->id}}_delete_btn" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing Live</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                Are you sure you want to edit <strong>{{ $live->title }}</strong>?
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit live</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->


        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('lives.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a>
        </div>
    </div>

</form>

</div>

<div class="col-md-2"></div>

</div>

</x-app-layout>
