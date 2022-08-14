<x-app-layout>
    <x-slot name="header">


 <div class="row  m-0 p-0">

  <div class="col-lg-3  text-left">
    <h2>Users List:</h2>
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
                <th>Name</th>
                <th>Email</th>
                <th>Email verified at</th>
                <th>Mail Notifications</th>
                <th>Active</th>
                <th>Role</th>

            </tr>
         </thead>
         <tbody>
            @foreach($users as $user)
            <tr class=" bg-white " >


               <td class="text-center  bg-dark text-white" style="border-color:#454d55;">{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td class="text-center">@if($user->email_verified_at)
                  {{ $user->email_verified_at }}
                    @else
                  <i class="fas fa-times text-danger"></i>
                      @endif
              </td>

                {{--START MAIL NOTIFICATIONS--}}
                <td class="text-center  bg-secondary text-white">

                    @if(auth()->user()->id != $user->id)
                        <form class="text-center form-inline" action="{{ route('users.update', $user->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group mr-2">
                                <select class="form-control w-50" style="min-width:150px; max-width:50%;
                                {{ $user->mail_notifications == 1 ? "background-color:#beffbd;":"background-color:#ffbdbd;" }}
                                    " name="mail_notifications">
                                    <option {{ $user->mail_notifications == 1 ? "selected":"" }} value="1" >On ✓</option>
                                    <option {{ $user->mail_notifications == 0 ? "selected":"" }} value="0" >Off ✗</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-warning" style="max-width:250px;" data-toggle="modal" data-target="#modal_{{$user->id}}_user_mail_notifications"  data-toggle="tooltip" data-placement="top" title="Update Mail Notifications">
                                Update
                            </button>

                            <!-- Modal (mail_notifications) -->
                            <div class="modal fade text-black" id="modal_{{$user->id}}_user_mail_notifications" tabindex="-1" role="dialog" aria-labelledby="modal_{{$user->id}}_mail_notifications" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Updating User Mail Notifications</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            Are you sure you want to update <strong>{{ $user->name }}</strong> mail notifications?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-warning" type="submit" style="max-width:50%;">Update mail notifications</button>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal (mail_notifications)-->


                        </form>
                    @endif
                </td>
                {{--END MAIL NOTIFICATIONS--}}

                {{--START USER ACTIVE--}}
                <td class="text-center  bg-secondary text-white">

                    @if(auth()->user()->id != $user->id)
                        <form class="text-center form-inline" action="{{ route('users.update', $user->id)}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group mr-2">
                                <select class="form-control w-50" style="min-width:150px; max-width:50%;
                                {{ $user->active == 1 ? "background-color:#beffbd;":"background-color:#ffbdbd;" }}
                                    " name="active">
                                    <option {{ $user->active == 1 ? "selected":"" }} value="1" >Active ✓</option>
                                    <option {{ $user->active == 0 ? "selected":"" }} value="0" >Inactive ✗</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-warning" style="max-width:250px;" data-toggle="modal" data-target="#modal_{{$user->id}}_user_active"  data-toggle="tooltip" data-placement="top" title="Update User Active">
                                Update
                            </button>

                            <!-- Modal (ACTIVE) -->
                            <div class="modal fade text-black" id="modal_{{$user->id}}_user_active" tabindex="-1" role="dialog" aria-labelledby="modal_{{$user->id}}_user_active" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Updating User Active</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            Are you sure you want to update <strong>{{ $user->name }}</strong> active?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-warning" type="submit" style="max-width:50%;">Update active</button>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal (ACTIVE)-->


                        </form>
                    @endif
                </td>
                {{--END USER ACTIVE--}}




                {{--START USER ROLE--}}
              <td class="text-center  bg-secondary text-white">
                  @if(auth()->user()->id != $user->id)
                  <form class="text-center form-inline" action="{{ route('users.update', $user->id)}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group mr-2">
                        <select class="form-control w-50" style="min-width:150px; max-width:50%;

                            {{ $user->role == "user" ?: "background-color:#fff7bd;"}}
                            {{ $user->role == "editor" ?:"background-color:#ffbdbd;" }}
                            {{ $user->role == "admin" ?:"background-color:#bddcff;" }}
                         " name="role">
                          <option {{ $user->role == "user" ? "selected":"" }} value="user" >User</option>
                            <option {{ $user->role == "admin" ? "selected":"" }} value="admin" >Admin</option>
                            <option {{ $user->role == "editor" ? "selected":"" }} value="editor" >Editor</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-danger" style="max-width:250px;" data-toggle="modal" data-target="#modal_{{$user->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Update User Role">
                   Update
                  </button>

                    <!-- Modal -->
                    <div class="modal fade text-black" id="modal_{{$user->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$user->id}}_delete_btn" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Updating User Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-left">
                            Are you sure you want to update <strong>{{ $user->name }}</strong> role?
                          </div>
                          <div class="modal-footer">
                             <button class="btn btn-danger" type="submit" style="max-width:50%;">Update role</button>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->


                  </form>
                  @endif
              </td>
                {{--END USER ROLE--}}


                {{--START BLOCK USER--}}
                <td class="text-center  bg-secondary text-white">
                    @if(auth()->user()->id != $user->id)
                        <form class="text-center form-inline" action="{{ route('block.user')}}" method="post">
                            {{ csrf_field() }}
                            <input type="number" value="{{$user->id}}" name="user_id" hidden>

                            <button type="button" class="btn btn-danger" style="max-width:250px;" data-toggle="modal" data-target="#modal_{{$user->id}}_block_btn"  data-toggle="tooltip" data-placement="top" title="Blocking User">
                                Update
                            </button>

                            <!-- Modal -->
                            <div class="modal fade text-black" id="modal_{{$user->id}}_block_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$user->id}}_block_btn" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Blocking User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            Are you sure you want to block <strong>{{ $user->name }}</strong> from using the app?
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" type="submit" style="max-width:50%;">BLOCK USER</button>

                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->


                        </form>
                    @endif
                </td>
                {{--END BLOCK USER--}}


            </tr>

            @endforeach

            @if(count($users) < 1)
              <tr class="bg-white">
               <td colspan="13" class="text-center">There are no user available yet!</td>
              </td>
            </tr>
            @endif
         </tbody>
        </table>
     </div>

  <div class="col-md-1"></div>
      <div class="col-md-10">
          {!! $users->appends(request()->input())->links() !!}
      </div>
      <div class="col-md-1"></div>




 </div>




 </x-app-layout>
