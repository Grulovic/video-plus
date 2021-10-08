<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top:65px!important;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>

    <div class="container">
    <div class="row m-0 p-0 pt-5 pb-5">
        <div class="col-lg-12 pb-4">
            <h2>@if($messages)Latest Messages:@endif

            @if( auth()->user()->role == "admin")
            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#create_modal">
              <i class="fas fa-envelope"></i> Create new Message
            </button>
            @endif

            </h2>

            <!-- Button trigger modal -->

            @if( auth()->user()->role == "admin")
            <!-- Modal -->
            <div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="create_modal" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="create_modal_label">Create New Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <form action="{{ route('messages.store') }}" method="POST" name="add_live">
                        {{ csrf_field() }}
                        <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">

                        <div class="form-group col-12">
                            <strong>Title</strong>
                            <input type="text" name="title" class="form-control" placeholder="Enter title">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>


                        <div class="form-group col-12">
                            <strong>Description</strong>
                            <input type="text" name="description" class="form-control" placeholder="Enter description">
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                        </div>


                  <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> Create new Message</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                  </div>
                  </form>

                  </div>


                </div>
              </div>
            </div>
            <!-- End modal -->
            @endif

        </div>
        @foreach($messages as $message)
        <div class="col-lg-12">

            <div class="alert alert-light shadow-sm" role="alert">
              <h4 class="alert-heading"><strong>{{$message->title}}</strong>


             @if( auth()->user()->role == "admin")
             <button type="button" class="float-right btn" data-toggle="modal" data-target="#edit_modal_{{$message->id}}">
              <i class="far fa-edit"></i>
            </button>

                <button class="float-right  btn" type="button" data-toggle="modal" data-target="#modal_{{$message->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete Message">
                   <i class="far fa-trash-alt"></i>
              </button>
              @endif



              </h4>






              {{$message->description}}
              <hr>
              <div class="mb-0 row ">
            	<div class="col-6"><strong>{{$message->user->name}}</strong></div>
            	<div class="col-6 text-right"><strong>{{$message->created_at}}</strong></div>
              </div>
            </div>

        </div>

            @if( auth()->user()->role == "admin")
            <!-- Delete Modal -->
                <div class="modal fade text-black" id="modal_{{$message->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$message->id}}_delete_btn" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Deleting Message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                Are you sure you want to delete <strong>{{ $message->title }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('messages.destroy', $message->id)}}" method="post">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i> Delete Message</button>
                                </form>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Edit Modal -->
                <div class="modal fade" id="edit_modal_{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_modal_{{$message->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit_modal_{{$message->id}}_label">Create New Message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="{{ route('messages.update', $message->id ) }}" method="POST" name="add_live">
                                    {{ csrf_field() }}
                                    <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">

                                    <div class="form-group col-12">
                                        <strong>Title</strong>
                                        <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{$message->title}}">
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>


                                    <div class="form-group col-12">
                                        <strong>Description</strong>
                                        <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{$message->description}}">
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning"><i class="fas fa-envelope"></i> Edit Message</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            @endif
        @endforeach


        <div class="col-lg-12">
            {!! $messages->appends(request()->input())->links() !!}
        </div>
    </div>
    </div>


</x-home-layout>
