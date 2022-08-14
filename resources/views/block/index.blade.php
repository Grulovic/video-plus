<x-app-layout>
    <x-slot name="header">


 <div class="row  m-0 p-0">

  <div class="col-lg-3  text-left">
    <h2>Blocked Users List:</h2>
      <a href="{{route('users.index')}}" class="btn btn-primary">USERS LIST</a>

  </div>



  <div class="col-lg-9 text-center">

  </div>


</div>


    </x-slot>

 <div class="row m-0 p-0 pt-5 pb-5">

   @include('alerts')



      <div class="col-md-12 p-0" style="padding-right: 0; overflow-x: auto;">
        <table class="table table-bordered sortable" id="laravel_crud">
         <thead>
            <tr class="thead-dark">

                <th>ID</th>
                <th>User ID</th>
                <th>IP Address</th>
                <th>Email</th>
                <th>Action</th>

            </tr>
         </thead>
         <tbody>
            @foreach($blocks as $block)
            <tr class=" bg-white " >


               <td class="text-center  bg-dark text-white" style="border-color:#454d55;">{{ $block->id }}</td>
                <td>{{ $block->user_id ?? "/" }}</td>
                <td>{{ $block->ip_address ?? "/" }}</td>
                <td>{{ $block->email ?? "/" }}</td>


                {{--START UNBLOCK USER--}}
                <td class="text-center  bg-secondary text-white">
                        <form class="text-center form-inline" action="{{ route('unblock.user',$block)}}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <button type="button" class="btn btn-primary" style="max-width:250px;" data-toggle="modal" data-target="#modal_{{$block->id}}_unblock_btn"  data-toggle="tooltip" data-placement="top" title="Unblocking User">
                                UNBLOCK
                            </button>


                            <!-- Modal -->
                            <div class="modal fade text-black" id="modal_{{$block->id}}_unblock_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$block->id}}_unblock_btn" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Unblocking User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            Are you sure you want to unblock these?
                                            @if($block->user_id)
                                                <br>User ({{ $block->user_id }}): <strong>{{ $block->user->name }}</strong> / <strong>{{ $block->user->email }}</strong>
                                            @endif

                                            @if($block->user_id)
                                                <br>Ip Address: <strong>{{ $block->ip_address }}</strong>
                                            @endif

                                            @if($block->email)
                                                <br>Email: <strong>{{ $block->email }}</strong>
                                            @endif

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit" style="max-width:50%;">UNBLOCK USER</button>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->


                        </form>
                </td>
                {{--END UNBLOCK USER--}}


            </tr>

            @endforeach

            @if(count($blocks) < 1)
              <tr class="bg-white">
               <td colspan="13" class="text-center">There are no blocks!</td>
              </td>
            </tr>
            @endif
         </tbody>
        </table>
     </div>

  <div class="col-md-1"></div>
      <div class="col-md-10">
          {!! $blocks->appends(request()->input())->links() !!}
      </div>
      <div class="col-md-1"></div>




 </div>




 </x-app-layout>
