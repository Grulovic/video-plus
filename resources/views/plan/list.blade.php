<x-app-layout>
    <x-slot name="header">

 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2>Plan List:</h2>


      <form class="form-inline row m-0 p-0" action="{{ route('plans.index') }}" method="GET">
          @csrf
          <input type="date" name="date" value="{{ $date_before }}" hidden>
          <button type="submit" class="btn btn-primary" value="Submit"> <i class="fas fa-chevron-left"></i> {{ date('j. F', strtotime($date_before)) }} </button>
      </form>

      <form class="form-inline row m-0 p-0" action="{{ route('plans.index') }}" method="GET">
          @csrf
          <input type="date" name="date" value="{{ $today }}" hidden>
          <button type="submit" class="btn btn-primary" value="Submit"> <i class="fas fa-chevron-left"></i> Today </button>
      </form>

      <script>
          $("#datepicker").change(function() {
              this.form.submit();
          });
      </script>
      <form class="form-inline row m-0 p-0" action="{{ route('plans.index') }}" method="GET">
          @csrf
          <input type="date" id="datepicker" name="date" value="{{ $date_before }}">
      </form>

      <form class="form-inline row m-0 p-0" action="{{ route('plans.index') }}" method="GET">
          @csrf
          <input type="date" name="date" value="{{ $date_after }}" hidden>
          <button type="submit" class="btn btn-primary" value="Submit">{{ date('j. F', strtotime($date_after)) }} <i class="fas fa-chevron-right"></i> </button>
      </form>

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
            @if( sizeof($plans) == 0 )
               <div colspan="13" class="text-center">There are no plan available yet!</div>
            @endif
     </div>

 </div>




 </x-app-layout>
