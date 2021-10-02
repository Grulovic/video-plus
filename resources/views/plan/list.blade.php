<x-app-layout>
    <x-slot name="header">

 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2>Plan List:</h2>
  </div>



  <div class="col-3 text-center">
 @if (!Auth::guest())

  @can('create', App\Models\Plan::class)
    <a href="{{ route('plans.create') }}" class="btn btn-success float-right ml-1 "><i class="fas fa-archive"></i> Add Plan</a>
@endcan
  @endif
  </div>


</div>


    </x-slot>

 <div class="row m-0 p-0 pt-5 pb-5">

   @include('alerts')


            @foreach($plans as $plan)

         			@include('plan.card')

            @endforeach


 <div class="col-lg-12 p-0" style="">
            @if(isset($plans))
            @if(count($plans) < 1)
               <div colspan="13" class="text-center">There are no plan available yet!</div>
			@endif
            @endif
     </div>

 </div>




 </x-app-layout>
