<x-app-layout>
    <x-slot name="header">


 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2>Support Messages List:</h2>
      <p>Current date: @php

              echo date("Y/m/d h:i:sa");
          @endphp</p>
  </div>



  <div class="col-3 text-center">



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

                <th>ID</th>
                <th>Email</th>
                <th>Message</th>
                <th>Replied</th>
                <th>Created At</th>
                <th>Reply</th>
                <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach($messages as $message)
            <tr class=" bg-white " >
                <td class="text-center  bg-dark text-white" style="border-color:#454d55;">{{ $message->id }}</td>
              <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>

                <td>{{ $message->created_at }}</td>
                <td class="text-center">@if($message->replied)
                        <i class="fas fa-check text-success"></i>
                    @else
                        <i class="fas fa-times text-danger"></i>
                    @endif</td>
                <td>{{ $message->reply }}</td>
                <td class="text-center  bg-dark text-white" style="border-color:#454d55;">
                    <a href="{{ route('support.create',$message->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Reply message">REPLY</a>
                </td>





            </tr>

            @endforeach

            @if(count($messages) < 1)
              <tr class="bg-white">
               <td colspan="13" class="text-center">There are no support messages!</td>
              </td>
            </tr>
            @endif
         </tbody>
        </table>
     </div>
      <div class="col-md-1"></div>


     <div class="col-md-1"></div>
     <div class="col-md-10">
         {!! $messages->appends(request()->input())->links() !!}
     </div>
     <div class="col-md-1"></div>


 </div>




 </x-app-layout>
