<x-app-layout>
    <x-slot name="header">
   

 <div class="row  m-0 p-0">
  
  <div class="col-9  text-left">
    <h2>Category List:</h2>
  </div>



  <div class="col-3 text-center">

    <a href="{{ route('categories.create') }}" class="btn btn-success float-right ml-1 "><i class="fas fa-archive"></i> Add Category</a> 

  </div>

  
</div>


    </x-slot>

 <div class="row m-0 p-0 pt-5 pb-5">
 
   @include('alerts')
 
      <div class="col-md-1"></div>

      <div class="col-md-10 p-0" style="padding-right: 0; overflow-x: auto;">          
        <table class="table table-bordered sortable" id="laravel_crud">
         <thead>
            <tr class="thead-dark">
               <th colspan="3" class="text-center">Action</th>

                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>User ID</th>
                <th>User Name</th>
                <th>Created at</th>
            </tr>
         </thead>
         <tbody>
            @foreach($categories as $category)
            <tr class=" bg-white " >
              
              <td class="text-center  bg-dark text-white" style="border-color:#454d55;">
                <a href="{{ route('categories.show',$category->id)}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Show Category"><!-- Show --> <i class="far fa-eye"></i></a>
              </td>
               <td class="text-center  bg-dark text-white" style="border-color:#454d55;">
                <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary"><!-- Edit --> <i class="far fa-edit"></i></a></td>
               <td class="text-center  bg-dark text-white" style="border-color:#454d55;">
                   
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_{{$category->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Category">
                   <i class="far fa-trash-alt"></i>
                  </button>
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
                            <button class="btn btn-danger" category="submit"><i class="far fa-trash-alt"></i> Delete Category</button>
                          </form>
                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
                
                
               
              </td>

               <td class="text-center  bg-dark text-white" style="border-color:#454d55;">{{ $category->id }}</td>
              

              <td>{{ $category->title }}</td>
              <td>{{ $category->description }}</td>                
              <tD>{{ $category->user->id }}</td>
              <td>{{ $category->user->name }}</tD>
              <td>{{ $category->created_at }}</td>
              


              

            </tr>

            @endforeach
 
            @if(count($categories) < 1)
              <tr class="bg-white">
               <td colspan="13" class="text-center">There are no category available yet!</td>
              </td>
            </tr>
            @endif
         </tbody>
        </table>
     </div> 
      <div class="col-md-1"></div>

  <div class="col-md-1"></div>
      <div class="col-md-10">
          {!! $categories->appends(request()->input())->links() !!}
      </div>
      <div class="col-md-1"></div>

     


 </div>




 </x-app-layout>