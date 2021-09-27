<x-app-layout>
    <x-slot name="header">
 
<div class="row m-0 p-0">
  <div class="col-6">
    <h2>Showing Category <strong><a href="{{ route('categories.show',$category->id) }}">{{ $category->title }}</a></strong></h2>
  </div><div class="col-6 text-right">
    
    <a class="btn btn-danger mb-2" href="{{ URL::previous() }}"><i class="fas fa-caret-left"></i></a>
    <a href="{{ route('categories.index') }}" class="btn btn-danger mb-2 text-right">Go to categories</a> 
  </div>

</div>

</x-slot>
  



<div class="row m-0 p-0 pt-5 pb-5">
  <div class="col-md-2"></div>

  <div class="col-md-8">

    <div class="card">
      <div class="card-body">
        <small class="float-right">ID: {{ $category->id }}</small>
        <h3 class="card-title"><strong>Title:</strong> {{ $category->{'title'} }}</h3>
        

        <p><strong>User ID:</strong> {{ $category->user_id }}</p>
        <p><strong>User Name:</strong> {{ $category->user->name }}</p>
        <p><strong>Description:</strong> {{ $category->description }}</p>
        <p><strong>Created at:</strong> {{ $category->created_at }}</p>

       

      </div>

      <div class="card-footer text-center">
        
        <div class=" btn-group">
          <!-- <div><a href="{{ route('categories.show',$category->id)}}" class="btn btn-warning mr-3">Show <i class="far fa-eye"></i></a></div> -->
          <div><a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary mr-3"><i class="far fa-edit"></i> Edit </a></div>

          <div>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$category->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Category">
                   <i class="far fa-trash-alt"></i> Delete
                  </button>
             
                
                
              
          
          </div>
        </div>

      </div>

    </div>

            
               <!-- Modal -->
                <div class="modal fade text-black" id="modal_{{$category->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$category->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $category->title }}</strong>?
                      </div>
                      <div class="modal-footer">
                         <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button class="btn btn-danger mr-3" category="submit"><i class="far fa-trash-alt"></i> Delete</button>
                          </form>
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
  

  </div>

  <div class="col-md-2"></div>


</div>
  


</x-app-layout>