<x-app-layout>
    <x-slot name="header">

 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2>Plan List:</h2>

      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_before }}" hidden>
          <button type="submit" class="btn btn-outline-primary border-start" value="Submit" style="min-height: 42px;"> <i class="fas fa-chevron-left"></i> {{ date('j. F', strtotime($date_before)) }} </button>
      </form>


      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <script>
              $( document ).ready(function() {
                  $("#datepicker").change(function() {
                      alert("HERE");
                      this.form.submit();
                  });

                  $(".plan-item-btn").click(function() {
                      if( $(this).hasClass('btn-outline-primary') || $(this).hasClass('btn-primary') ){
                          $(this).toggleClass("btn-outline-primary").toggleClass("btn-primary");
                      }
                      if( $(this).hasClass('btn-outline-secondary') || $(this).hasClass('btn-secondary') ){
                          $(this).toggleClass("btn-outline-secondary").toggleClass("btn-secondary");
                      }

                  });
              });

          </script>
          <input type="date" id="datepicker" name="date" value="{{ $date_before }}">
      </form>
        <form class="float-left" action="{{ route('plans.index') }}" method="GET">
            <input type="date" name="date" value="{{ $today }}" hidden>
            <button type="submit" class="btn btn-secondary border-0" value="Submit" style="min-height: 42px;">Today</button>
        </form>


        <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_after }}" hidden>
          <button type="submit" class="btn btn-outline-primary border-end" value="Submit" style="min-height: 42px;">{{ date('j. F', strtotime($date_after)) }} <i class="fas fa-chevron-right"></i> </button>
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
