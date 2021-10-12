
<x-app-layout>
    <x-slot name="header">


 <div class="row  m-0 p-0">

  <div class="col-lg-12  text-left">
    <h2>History List:</h2>
  </div>

</div>


    </x-slot>

 <div class="row m-0 p-0 pt-5 pb-5">
     <div class="col-md-1"></div>
     <div class="col-md-10 mb-4">
         <div class="row m-0 p-0">
             <div class="col-lg-4">
                 <div class="card shadow-sm" >
                 <div class="card-header h3">Video Stats</div>
                 <div class="card-body">
                     <h4>Downloads: <strong>{{ $video_downloads }}</strong></h4>
                     <h4>Uploads: <strong>{{ $video_uploads }}</strong></h4>
                     <h4>Average Download: <strong>{{ $video_average }}</strong></h4>
                     <h4>Total Unique Views: <strong>{{ $video_views }}</strong></h4>
                     <h4>Average Unique Views: <strong>{{ $video_views_average }}</strong></h4>
                 </div>
                 </div>
             </div>
             <div class="col-lg-4">
                 <div class="card shadow-sm" >
                     <div class="card-header h3">Gallery stats</div>
                     <div class="card-body">
                         <h4>Downloads: <strong>{{ $photo_downloads }}</strong></h4>
                         <h4>Uploads: <strong>{{ $photo_uploads }}</strong></h4>
                         <h4>Average Download: <strong>{{ $photo_average }}</strong></h4>
                         <h4>Total Unique Views: <strong>{{ $photo_views }}</strong></h4>
                         <h4>Average Unique Views: <strong>{{ $photo_views_average }}</strong></h4>
                     </div>
                 </div>

             </div>
             <div class="col-lg-4">
                 <div class="card shadow-sm" >
                     <div class="card-header h3">Other stats</div>
                     <div class="card-body">
                         <h4>Users: <strong>{{ $user_count }}</strong></h4>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <div class="col-md-1"></div>

      <div class="col-md-1"></div>

      <div class="col-md-10 p-0" style="padding-right: 0; overflow-x: auto;">
        <table class="table table-bordered sortable" id="laravel_crud">
         <thead>
            <tr class="thead-dark">
                <th>ID</th>
                <th>User ID</th>
                <th>User Name</th>

                <th>Item ID</th>
                <th>Item Type</th>
                <th>Item Name</th>
                <th>Action</th>


                <th>Created at</th>
            </tr>
         </thead>
         <tbody>
            @foreach($histories as $history)
            <tr class=" bg-white " >

              <td>{{ $history->id }}</td>
              <td>{{ $history->user_id }}</td>
              <td>{{ $history->user->name }}</td>
              <td>
                @if( $history->video_id )
                  {{ $history->video_id }}
                @elseif( $history->gallery_id)
                  {{ $history->gallery_id }}
                @elseif( $history->plan_id)
                      {{ $history->plan_id }}
                @endif
              </td>

              <td>
                @if( $history->video_id)
                  Video
                @elseif($history->gallery_id)
                  Gallery
                @elseif($history->plan_id)
                  Plan
                @endif
              </td>

              <td>

                @if( $history->video_id )
                      @if($history->video != null)
                          <a href="{{ route('videos.show', $history->video_id  )}}">Go to video</a>
                      @else
                          /
                      @endif
                @elseif( $history->gallery_id )
                      @if($history->gallery != null)
                          <a href="{{ route('photos.show', $history->gallery_id  )}}">Go to gallery</a>
                      @else
                          /
                      @endif
                  @elseif( $history->plan_id )
                      @if($history->plan !=null)
                          <a href="{{ route('plans.show', $history->plan_id  )}}">Go to plan</a>
                      @else
                          /
                      @endif

                  @endif
              </td>
              <td>{{ $history->action }}</td>


              <td>{{ $history->created_at }}</td>





            </tr>

            @endforeach

            @if(count($histories) < 1)
              <tr class="bg-white">
               <td colspan="13" class="text-center">There are no History events to show!</td>
              </td>
            </tr>
            @endif
         </tbody>
        </table>

     </div>
      <div class="col-md-1"></div>

      <div class="col-md-1"></div>
      <div class="col-md-10">
          {!! $histories->appends(request()->input())->links() !!}
      </div>
      <div class="col-md-1"></div>





 </div>




 </x-app-layout>
