<x-app-layout>
    <x-slot name="header">
 
<div class="row m-0 p-0">
  <div class="col-9">
    <h2>Editing Category <a href="{{ route('categories.show',$category->id)}}">{{$category->title}}</a></h2>

  </div>
  <div class="col-3 text-right">
    <a href="{{ route('categories.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a> 
  </div>    

</div>

</x-slot>


<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('categories.update', $category->id) }}" method="POST" name="update_category">
  {{ csrf_field() }}
  @method('PATCH')


  <div class="form-group col-lg-6">
        <strong>Title</strong>
        <input category="text" name="title" class="form-control" placeholder="Enter title" value="{{ $category->title }}">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>


    <div class="form-group col-lg-6">
        <strong>Description</strong>
        <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{ $category->description }}">
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>





<div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            
            
               <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_{{$category->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Edit Gallery">
                   <i class="far fa-edit"></i> Edit gallery
                  </button>
                  
        <!-- Modal -->
        <div class="modal fade text-black" id="modal_{{$category->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$category->id}}_delete_btn" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                Are you sure you want to edit <strong>{{ $category->title }}</strong> role?
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit category</button>
                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
        
        
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('categories.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a> 
        </div>
    </div>

</form>

</div>

<div class="col-md-2"></div>

</div>

</x-app-layout>