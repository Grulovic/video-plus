<x-home-layout>

    @include('home.carousel')


	{{--<div class="row m-0 p-0 pt-4 pb-3">
		<div class="col-lg-12 my-auto">
				<h2>Latest:</h2>
		</div>
			@foreach($latest as $item)
    			@if(class_basename($item) == "Video")
                    @php
    					$video = $item;
    				@endphp
					@include('home.video_card')
    			@elseif(class_basename($item) == "Gallery")
    				@php
    					$gallery = $item;
    				@endphp
					@include('home.photo_card')
                @elseif(class_basename($item) == "Article")
    				@php
    					$article = $item;
    				@endphp
					@include('article.card')
    			@endif
			@endforeach
	</div>--}}


    <div class="">
    <div  class="container bg-dark2  mt-5 no-hover " style="max-width:1920px; ">
  	<div class="row m-0 p-0 pt-4 pb-5 text-white justify-content-center card p-2" style="background-color:#484e53;">
		<div class="col-lg-12 my-auto " >
			<div class="text-center">
				<h2>Latest Live Streams:</h2>
				<p>These are the latest lives streams.</p>
			</div>
		</div>
        <div class="row m-0 p-0">
		@foreach($lives as $live)
    		<div class="col-lg-{{  sizeof($lives) <= 4 && sizeof($lives) > 2 ? 12/sizeof($lives) : 4  }} mb-2 d-flex align-items-stretch" style="">
    		<div class="card shadow-lg bg-secondary">
    		    <div class="card-header text-center h4">{{$live->title}}</div>
    			<iframe  class="card-img " style="min-height:265px;" src="{{$live->url}}?autoplay=false"></iframe>
    		</div>
    		</div>
		@endforeach
        </div>
        @if($lives != null)
            @if( sizeof($lives) == 0 )
                <div class="alert alert-secondary shadow-sm w-100" role="alert" style="">
                    There are no live streams at the moment!
                </div>
            @endif
        @endif


	</div>
	</div>
	</div>


<div  class="container" style="max-width:1920px;">

    <div class="row m-0 p-0 pt-4 pb-3">
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-left">
                <h2>Latest Events:</h2>
                <p>These are the following events:.</p>
            </div>
        </div>
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-right mt-2 mb-4">
                <a class="btn btn-outline-primary" href="{{route('plans.index')}}">Show today's events <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
        @if($plans != null)
            @foreach($plans as $plan)
                @include('home.plan_card')
            @endforeach
        @endif

        @if($plans != null)
        @if( sizeof($plans) == 0 )
            <div class="alert alert-secondary shadow-sm w-100" role="alert" style="">
                There are no events at the moment!
            </div>
        @endif
        @endif
    </div>


    <hr>



	<div class="row m-0 p-0 pt-4 pb-3">
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-left">
                <h2>Latest Videos:</h2>
                <p>These are the latest videos uploaded.</p>
            </div>
        </div>
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-right mt-2 mb-4">
                <a class="btn btn-outline-primary" href="{{route('videos.index')}}">Show more videos <i class="fas fa-angle-right"></i></a>
            </div>
        </div>

        @if($latest_videos != null)
			@foreach($latest_videos as $video)
				@include('home.video_card')
			@endforeach
        @endif

        @if($latest_videos != null)
            @if( sizeof($latest_videos) == 0 )
                <div class="alert alert-secondary shadow-sm w-100" role="alert" style="">
                    There are no videos at the moment!
                </div>
            @endif
        @endif
	</div>


<hr>


	<div class="row m-0 p-0 pt-4 pb-3">
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-left">
                <h2>Latest Photos:</h2>
                <p>These are the latest photo galleries uploaded.</p>
            </div>
        </div>
        <div class="col-lg-6 my-auto">
            <div class="text-center text-lg-right mt-2 mb-4">
                <a class="btn btn-outline-primary" href="{{route('photos.index')}}">Show more photos <i class="fas fa-angle-right"></i></a>
            </div>
        </div>
        @if($latest_photos != null)
            @foreach($latest_photos as $gallery)
                @include('home.photo_card')
            @endforeach
        @endif

        @if($latest_photos != null)
            @if( sizeof($latest_photos) == 0 )
                <div class="alert alert-secondary shadow-sm w-100" role="alert" style="">
                    There are no photos at the moment!
                </div>
            @endif
        @endif
	</div>

{{--  <hr>--}}

{{--	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>Latest Articles:</h2>--}}
{{--				<p>These are the latest articles posted.</p>--}}
{{--			</div>--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('articles.index')}}">Show latest articles <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--        @if($latest_articles != null)--}}
{{--			@foreach($latest_articles as $article)--}}
{{--				@include('article.card')--}}
{{--	--}}
{{--		@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}

{{--  <hr>--}}

{{--  	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>{{ $most_videos_category->title }} Videos:</h2>--}}
{{--				<p>This is the most used category for videos.</p>--}}
{{--			</div>--}}
{{--            @if( $most_videos_category->id != 0)--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('videos.index')}}?category={{$most_videos_category->id}}">Show more {{ $most_videos_category->title }} videos <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--            @endif--}}
{{--		</div>--}}
{{--        @if($most_videos != null)--}}
{{--            @foreach($most_videos as $video)--}}
{{--				@include('home.video_card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}


{{--<hr>--}}
{{--	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>{{ $most_photos_category->title }} Photos:</h2>--}}
{{--				<p>This is the most used category for photos.</p>--}}
{{--			</div>--}}
{{--            @if( $most_photos_category->id != 0)--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('photos.index')}}?category={{$most_photos_category->id}}">Show  more {{ $most_photos_category->title }} photos <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--            @endif--}}
{{--		</div>--}}
{{--        @if($most_photos != null)--}}
{{--            @foreach($most_photos as $gallery)--}}
{{--				@include('home.photo_card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}

{{--  <hr>--}}

{{--	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>{{ $most_articles_category->title }} Articles:</h2>--}}
{{--				<p>This is the most used category for articles.</p>--}}
{{--			</div>--}}
{{--            @if( $most_articles_category->id != 0)--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('articles.index')}}?category={{$most_articles_category->id}}">Show  more {{ $most_articles_category->title }} articles <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--            @endif--}}
{{--		</div>--}}
{{--        @if($most_articles != null)--}}
{{--            @foreach($most_articles as $article)--}}
{{--				@include('article.card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}

{{--  <hr>--}}




{{--  	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>Most Downloaded Videos:</h2>--}}
{{--				<p>These are the most downloaded videos ordered by date added.</p>--}}
{{--			</div>--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('videos.index')}}">Show latest videos <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--        @if($most_downloaded_videos != null)--}}
{{--			@foreach($most_downloaded_videos as $video)--}}
{{--				@include('home.video_card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}


{{--<hr>--}}

{{--	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>Most Downloaded Photos:</h2>--}}
{{--				<p>These are the most downloaded photos ordered by date added.</p>--}}
{{--			</div>--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('photos.index')}}">Show latest photos <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--        @if($most_downloaded_photos != null)--}}
{{--			@foreach($most_downloaded_photos as $gallery)--}}
{{--				@include('home.photo_card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}


{{--<hr>--}}

{{--	<div class="row m-0 p-0 pt-4 pb-3">--}}
{{--		<div class="col-lg-12 my-auto">--}}
{{--			<div class="float-left">--}}
{{--				<h2>Most Viewed Articles:</h2>--}}
{{--				<p>These are the most viewed articles ordered by date added.</p>--}}
{{--			</div>--}}
{{--			<div class="float-right mt-2">--}}
{{--				<a class="btn btn-outline-primary" href="{{route('articles.index')}}">Show latest articles <i class="fas fa-angle-right"></i></a>--}}
{{--			</div>--}}
{{--		</div>--}}
{{--        @if($most_viewed_articles != null)--}}
{{--            @foreach($most_viewed_articles as $article)--}}
{{--				@include('article.card')--}}
{{--			@endforeach--}}
{{--        @endif--}}
{{--	</div>--}}





</div>




</x-home-layout>
