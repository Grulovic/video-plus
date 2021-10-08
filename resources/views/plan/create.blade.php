<x-app-layout>
    <x-slot name="header">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('js/video-datepicker.js') }}"></script>
        <link href="{{ asset('css/video-datepicker.css') }}" rel="stylesheet">

        <style>
            .ui-timepicker-container{
                position:absolute;
                overflow:hidden;
                box-sizing:border-box
            }
            .ui-timepicker,.ui-timepicker-viewport{
                box-sizing:content-box;
                height:205px;
                display:block;
                margin:0
            }
            .ui-timepicker{
                list-style:none;
                padding:0 1px;
                text-align:center
            }
            .ui-timepicker-viewport{
                padding:0;
                overflow:auto;
                overflow-x:hidden
            }
            .ui-timepicker-standard{
                background-color:#FFF;
                color:#222;
                margin:0;
                padding:2px
            }
            .ui-timepicker-standard a{
                color:#222;
                display:block;
                padding:.2em .4em;
                text-decoration:none;
                font-size:16px;

            }
            .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{

                background: none!important;
                background-color:#007bff!important;
                border:0px!important;
                font-weight:400!important;
                color:#ffffff!important;
            }
            .ui-timepicker-standard .ui-state-hover{
                background-color:#007bff;
                font-weight:400;
                color:#ffffff
            }
            .ui-timepicker-standard .ui-menu-item{
                margin:0;
                padding:0
            }
            .ui-timepicker-corners,.ui-timepicker-corners .ui-corner-all{
                -moz-border-radius:0px;
                -webkit-border-radius:0px;
                border-radius:0px
            }
            .ui-timepicker-hidden{
                display:none
            }
            .ui-timepicker-no-scrollbar .ui-timepicker{
                border:none
            }
            /*# sourceMappingURL=jquery.timepicker.min.css.map */

        </style>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#timepicker').timepicker({
                    timeFormat: 'HH:mm',
                    interval: 5,
                    minTime: '0',
                    maxTime: '11:59pm',
                    defaultTime: '12',
                    startTime: '10:00',
                    dynamic: true,
                    dropdown: true,
                    scrollbar: true
                });
            });
        </script>

<div class="row m-0 p-0">
  <div class="col-9 text-left">
        <h2>Add Plan</h2>
    </div>
  <div class="col-3 text-right">
        <a href="{{ route('plans.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
    </div>

</div>

</x-slot>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form  class="row" action="{{ route('plans.store') }}" method="POST" name="add_plan">
    {{ csrf_field() }}
    <input type="text" name="user_id" hidden="" value="{{ auth()->user()->id }}">

    <div class="form-group col-lg-3">
        <strong>Title</strong>
        <input type="text" name="title" class="form-control" placeholder="Enter title" required>
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>

    <div class="form-group col-lg-3">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter location" required>
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-3">
        <strong>Date</strong>
        <input id="datepicker" type="text" name="date" class="form-control" placeholder="Enter date" required  autocomplete="off">
        <span class="text-danger">{{ $errors->first('date') }}</span>
    </div>


    <div class="form-group col-lg-3">
        <strong>Time</strong>
        <input id="timepicker" type="text" name="time" class="form-control" placeholder="Enter time"  required  autocomplete="off">
        <span class="text-danger">{{ $errors->first('time') }}</span>
    </div>

    <div class="form-group col-lg-6">
        <strong>Description</strong>
        <textarea type="text" name="description" class="form-control" placeholder="Enter description" style="min-height:106px;" required></textarea>
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>

    <div class="form-group  col-lg-6">
        <strong>Categories</strong>
        <select multiple="" class="custom-select" id="category" name="category[]">
            <option value="" selected="">None</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach
        </select>
    </div>

{{--    ITEMS --}}
    <div class="form-group  col-lg-6">
        <strong>Video Items</strong>
        <select multiple="" class="custom-select" id="video_items" name="video_items[]">
            <option value="" selected="">None</option>
            @foreach($videos as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Photo Items</strong>
        <select multiple="" class="custom-select" id="photo_items" name="photo_items[]">
            <option value="" selected="">None</option>
            @foreach($photos as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Text Items</strong>
        <select multiple="" class="custom-select" id="text_items" name="text_items[]">
            <option value="" selected="">None</option>
            @foreach($texts as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Live Items</strong>
        <select multiple="" class="custom-select" id="live_items" name="live_items[]">
            <option value="" selected="">None</option>
            @foreach($lives as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </select>
    </div>



{{--    VIDEO--}}
	<div class="form-group col-lg-3">
        <strong>Video</strong><br>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="video" id="video0" value="0" checked>
          <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="video" id="video1" value="1">
          <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--    PHOTO --}}
    <div class="form-group col-lg-3">
        <strong>Photo</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo0" value="0" checked>
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--   TEXT --}}
    <div class="form-group col-lg-3">
        <strong>Text</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text0" value="0" checked>
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>

{{--  LIVE  --}}
    <div class="form-group col-lg-3">
        <strong>Live</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live0" value="0" checked>
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live1" value="1">
            <label class="form-check-label" for="featured1">Yes</label>
        </div>
    </div>








    <div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-archive"></i> Create plan</button>
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('plans.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i>  Cancel create</a>
        </div>
    </div>



    </div>

</form>

</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>
