<x-app-layout>
    <x-slot name="header">

 <div class="row  m-0 p-0">

  <div class="col-9  text-left">
    <h2 class="float-left">Planner:</h2>

      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_before }}" hidden>
          <button type="submit" class="btn btn-primary border-start" value="Submit" style="min-height: 42px; border-top-right-radius:0; border-bottom-right-radius:0; "> <i class="fas fa-chevron-left"></i> {{ date('j. F', strtotime($date_before)) }} </button>
      </form>


      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <script>
              $( document ).ready(function() {
                  $("#datepicker").change(function() {
                      alert("HERE");
                      this.form.submit();
                  });

                  $(".plan-item-btn").click(function() {

                      $(".plan-item-btn.btn-primary").toggleClass("btn-outline-primary").toggleClass("btn-primary");
                      $(".plan-item-btn.secondary").toggleClass("btn-outline-primary").toggleClass("btn-primary");

                      $('.collapse').collapse('hide');

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
            <button type="submit" class="btn btn-{{ isset($_GET['date']) && $_GET['date'] != $today ? "outline-" : null   }}info " value="Submit" style="min-height: 42px; border-radius: 0;">Today</button>
        </form>


        <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_after }}" hidden>
          <button type="submit" class="btn btn-primary border-end" value="Submit" style="min-height: 42px;  border-top-left-radius:0; border-bottom-left-radius:0;" >{{ date('j. F', strtotime($date_after)) }} <i class="fas fa-chevron-right"></i> </button>
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
