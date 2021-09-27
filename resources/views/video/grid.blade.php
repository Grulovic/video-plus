<x-app-layout>
        <script>
        function copyToClipboard(url) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(url).select();
          document.execCommand("copy");
          $temp.remove();
        }
        </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
    <script type="text/javascript" src="{{ asset('js/video-datepicker.js') }}"></script>
    <link href="{{ asset('css/video-datepicker.css') }}" rel="stylesheet">

  <x-slot name="header">
@include('video.filter_bar')
  </x-slot>

  <div class="row m-0 p-0 p-3 view-group">

  @include('alerts')
  
  @foreach($videos as $video)

    @include('video.grid_card')

  @endforeach

  <div class="col-lg-12 mt-4">
        {!! $videos->appends(request()->input())->links() !!}
        
      </div>
  </div>






</x-app-layout>