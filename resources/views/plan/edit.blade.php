<x-app-layout>
    <x-slot name="header">

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all">
        <script type="text/javascript" src="{{ asset('js/video-datepicker.js') }}"></script>
        <link href="{{ asset('css/video-datepicker.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>

        <script>
            jQuery(function($) {
                $("#datetimepicker").datetimepicker();
            });
        </script>

<div class="row m-0 p-0">
  <div class="col-9">
    <h2>Editing Plan {{$plan->title}}</h2>

  </div>
  <div class="col-3 text-right">
    <a href="{{ route('plans.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
  </div>

</div>

</x-slot>


<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form class="row" action="{{ route('plans.update', $plan->id) }}" method="POST" name="update_plan">
  {{ csrf_field() }}
  @method('PATCH')


  <div class="form-group col-lg-4">
        <strong>Title</strong>
        <input plan="text" name="title" class="form-control" placeholder="Enter title" value="{{ $plan->title }}">
        <span class="text-danger">{{ $errors->first('title') }}</span>
    </div>

    <div class="form-group col-lg-4">
        <strong>Location</strong>
        <input type="text" name="location" class="form-control" placeholder="Enter location"value="{{ $plan->location }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-4">
        <strong>Date</strong>

{{--        <input type="datetime-local" name="date" class="form-control" placeholder="Enter date" value="{{ date_format(date_create($plan->date),'Y-m-d')."T".date_format(date_create($plan->date),'h:i:s') }}">--}}
        <input id="datetimepicker" type="text" name="date" class="form-control" placeholder="Enter date" value="{{ date_format(date_create($plan->date),'Y-m-d h:i:s') }}">
        <span class="text-danger">{{ $errors->first('location') }}</span>
    </div>

    <div class="form-group col-lg-6">
        <strong>Description</strong>
        <input type="text" name="description" class="form-control" placeholder="Enter description" value="{{ $plan->description }}" style="min-height: 106px;">
        <span class="text-danger">{{ $errors->first('description') }}</span>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Categories</strong>
        <select multiple="" class="custom-select" id="category" name="category[]">
            <option value="" @if(sizeof($plan->categories) == 0)selected=""@endif>None</option>

            @foreach($categories as $category)
                <option value="{{$category->id}}"
                @foreach($plan->categories as $plan_category)
                    {{ $category->id == $plan_category->category_id ? 'selected=""' : '' }}
                    @endforeach
                >{{$category->title}}</option>
            @endforeach


        </select>
    </div>

    {{--    ITEMS --}}
    <div class="form-group  col-lg-6">
        <strong>Video Items</strong>
        <select multiple="" class="custom-select" id="video_items" name="video_items[]">
            <option value=""  @if(sizeof($plan->videoItems) == 0)selected=""@endif>None</option>
            @foreach($videos as $item)
                <option value="{{$item->id}}"
                @foreach($plan->videoItems as $video_item)
                    {{ $item->id == $video_item->item_id ? 'selected=""' : '' }}
                    @endforeach
                >{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Photo Items</strong>
        <select multiple="" class="custom-select" id="photo_items" name="photo_items[]">
            <option value=""  @if(sizeof($plan->photoItems) == 0)selected=""@endif>None</option>
            @foreach($photos as $item)
                <option value="{{$item->id}}"
                @foreach($plan->photoItems as $photo_item)
                    {{ $item->id == $photo_item->item_id ? 'selected=""' : '' }}
                    @endforeach>{{$item->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Text Items</strong>
        <select multiple="" class="custom-select" id="text_items" name="text_items[]">
            <option value=""  @if(sizeof($plan->textItems) == 0)selected=""@endif>None</option>
            @foreach($texts as $item)
                <option value="{{$item->id}}"
                @foreach($plan->textItems as $text_item)
                    {{ $item->id == $text_item->item_id ? 'selected=""' : '' }}
                    @endforeach>{{$item->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group  col-lg-6">
        <strong>Live Items</strong>
        <select multiple="" class="custom-select" id="live_items" name="live_items[]">
            <option value=""  @if(sizeof($plan->liveItems) == 0)selected=""@endif>None</option>
            @foreach($lives as $item)
                <option value="{{$item->id}}"
                @foreach($plan->liveItems as $live_item)
                    {{ $item->id == $live_item->item_id ? 'selected=""' : '' }}
                    @endforeach>{{$item->title}}</option>
            @endforeach
        </select>
    </div>



    {{--    VIDEO--}}
    <div class="form-group col-lg-3">
        <strong>Video</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video" id="video0" value="0" {{ $plan->video == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="video" id="video1" value="1" {{ $plan->video == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--    PHOTO --}}
    <div class="form-group col-lg-3">
        <strong>Photo</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo0" value="0" {{ $plan->photo == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="photo" id="photo1" value="1" {{ $plan->photo == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--   TEXT --}}
    <div class="form-group col-lg-3">
        <strong>Text</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text0" value="0" {{ $plan->text == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="text" id="text1" value="1" {{ $plan->text == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    {{--  LIVE  --}}
    <div class="form-group col-lg-3">
        <strong>Live</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live0" value="0" {{ $plan->live == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="live" id="live1" value="1" {{ $plan->live == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">No</label>
        </div>
    </div>

    <div class="col-lg-12">
        <strong>Email push: </strong>
        <div class="input-group  mb-2">

            <div class="form-check  form-check-inline mt-3">
                <input class="form-check-input" type="radio" name="email_push" id="email_push_admin" value="admin" checked="">
                <label class="form-check-label video-thumbnail" for="email_push_admin">
                    Send email notification to <strong>admins</strong> only.
                </label>
            </div>

            <div class="form-check  form-check-inline mt-3">
                <input class="form-check-input" type="radio" name="email_push" id="email_push_all" value="all">
                <label class="form-check-label video-thumbnail" for="email_push_admin">
                    Send email notification to <strong>subscribed</strong> only!
                </label>
            </div>

            <div class="form-check  form-check-inline mt-3">
                <input class="form-check-input" type="radio" name="email_push" id="email_push_none" value="none">
                <label class="form-check-label video-thumbnail" for="email_push_admin">
                    <strong>Don't</strong> send email notifications!
                </label>
            </div>


        </div>
    </div>





<div class="col-12 pt-3">
        <div class="w-50 float-left p-1">


             <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_{{$plan->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Edit Plan">
                   <i class="far fa-edit"></i> Edit Plan
                  </button>

        <!-- Modal -->
        <div class="modal fade text-black" id="modal_{{$plan->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$plan->id}}_delete_btn" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editing Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-left">
                Are you sure you want to edit <strong>{{ $plan->title }}</strong>?
              </div>
              <div class="modal-footer">
                 <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit plan</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->


        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('plans.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a>
        </div>
    </div>

</form>

</div>

<div class="col-md-2"></div>

</div>

</x-app-layout>
