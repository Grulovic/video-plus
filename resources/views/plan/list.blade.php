<x-app-layout>
    <x-slot name="header">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('js/video-datepicker.js') }}"></script>
        <link href="{{ asset('css/video-datepicker.css') }}" rel="stylesheet">


 <div class="row  m-0 p-0">

  <div class="col-lg-2  text-left">
    <h2 class="float-left mr-5">Planner:</h2>
  </div>
      <div class="col-lg-8  text-left">
      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_before }}" hidden>

          <div class="d-block d-lg-none"><button type="submit" class="btn btn-primary border-start" value="Submit" style="min-height: 42px; border-top-right-radius:0; border-bottom-right-radius:0; "> <i class="fas fa-chevron-left"></i></button></div>
          <div class="d-none d-lg-block"><button type="submit" class="btn btn-primary border-start" value="Submit" style="min-height: 42px; border-top-right-radius:0; border-bottom-right-radius:0; "> <i class="fas fa-chevron-left"></i> {{ date('j. F', strtotime($date_before)) }} </button></div>

      </form>


      <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <script>
              $( document ).ready(function() {
                  $("#datepicker").change(function() {
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

                  // $(".plan-favorite-btn").click(function() {
                  //     var plan_id = $(this).attr("data-planid");
                  //
                  //     var favorite_btn_id = '#plan-favorite-btn-'+plan_id;
                  //
                  //     console.log(plan_id);
                  //     $.ajax({
                  //         type:'GET',
                  //         async: false,
                  //         url: '/planner/favorite/'+plan_id,
                  //         success:function(data){
                  //             $(favorite_btn_id).toggleClass('btn-outline-info').toggleClass('btn-info');
                  //
                  //             if( $(favorite_btn_id).html() == "FOLLOW" ){
                  //                 $(favorite_btn_id).html("UNFOLLOW");
                  //             }else{
                  //                 $(favorite_btn_id).html("FOLLOW");
                  //             }
                  //             console.log('Added/Removed to favorites successfully.');
                  //         },
                  //         error:function(xhr, status, error){
                  //             console.log('Error adding/removing from favorites.');
                  //             var err = eval("(" + xhr.responseText + ")");
                  //         },
                  //     });
                  //
                  // });

              });

          </script>
          <input type="text" id="datepicker" name="date" value="{{ $date }}" style="width: 150px;"  autocomplete="off">
      </form>
        <form class="float-left" action="{{ route('plans.index') }}" method="GET">
            <input type="date" name="date" value="{{ $today }}" hidden>
            <button type="submit" class="btn btn-{{ isset($_GET['date']) && $_GET['date'] != $today ? "outline-" : null   }}info " value="Submit" style="min-height: 42px; border-radius: 0;">Today</button>
        </form>


        <form class="float-left" action="{{ route('plans.index') }}" method="GET">
          <input type="date" name="date" value="{{ $date_after }}" hidden>
            <div class="d-block d-lg-none"><button type="submit" class="btn btn-primary border-end" value="Submit" style="min-height: 42px;  border-top-left-radius:0; border-bottom-left-radius:0;" > <i class="fas fa-chevron-right"></i> </button></div>
            <div class="d-none d-lg-block"><button type="submit" class="btn btn-primary border-end" value="Submit" style="min-height: 42px;  border-top-left-radius:0; border-bottom-left-radius:0;" >{{ date('j. F', strtotime($date_after)) }} <i class="fas fa-chevron-right"></i> </button></div>



      </form>

      </div>
          <div class="col-lg-2  text-left">
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
             <div class="col-lg-12">
                 <div class="alert alert-info shadow-sm w-100" role="alert" style="">
                     There are no events for this date yet!
                 </div>
             </div>
            @endif
     </div>

 </div>




 </x-app-layout>
