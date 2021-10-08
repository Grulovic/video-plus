<x-app-layout>
    <x-slot name="header">

 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2>Live Streams:</h2>
  </div>



  <div class="col-3 text-center">
 @if (!Auth::guest())

  @can('create', App\Models\Live::class)
    <a href="{{ route('lives.create') }}" class="btn btn-success float-right ml-1 "><i class="fas fa-archive"></i> Add Live</a>
@endcan
  @endif
  </div>


</div>


    </x-slot>

 <div class="row m-0 p-0 pt-5 pb-5">

   @include('alerts')


            @foreach($lives as $live)

         			@include('live.card')

            @endforeach


 <div class="col-lg-12 p-0" style="">
            @if(count($lives) < 1)
               <div colspan="13" class="text-center">There are no live available yet!</div>
			@endif
        {!! $lives->appends(request()->input())->links() !!}
     </div>

 </div>




 </x-app-layout>
