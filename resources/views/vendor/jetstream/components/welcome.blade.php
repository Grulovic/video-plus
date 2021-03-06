<div class="sm:px-20 bg-white border-b border-gray-200 grid grid-cols-1 md:grid-cols-2" style="padding-left: 0px!important; padding-right: 0px!important;">
    <div class="p-6 my-auto" style="padding-right: 50px!important;padding-left: 50px!important;">
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>

        <div class="mt-8 text-2xl">
            Welcome to {{ config('app.name') }}!
        </div>

        <div class="mt-6 text-gray-500">
            {{ config('app.name') }} is a specialised pool service that provides non-aligned, yet related, audiovisual material for media professionals.
            You can download news items such as live feeds, video files, stock shots and photography.
        </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">

        <div class="p-6 border" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="{{route('home.index')}}">
                        <i class="fas fa-home" style="width:60px!important; text-align:center!important;"></i> Home</a></div>
            </div>
        </div>

        <div class="p-6 border" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/videos">
                    <i class="fas fa-video" style="width:60px!important; text-align:center!important;"></i> Videos</a></div>
            </div>
        </div>

        <div class="p-6 border" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/photos">
                    <i class="fas fa-image" style="width:60px!important; text-align:center!important;"></i> Photos</a></div>
            </div>
        </div>

        <div class="p-6 border">
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/lives">
                        <i class="fas fa-satellite-dish" style="width:60px!important; text-align:center!important;"></i> Live Streams</a></div>
            </div>
        </div>

{{--        <div class="p-6 border">--}}
{{--            <div class="flex items-center">--}}
{{--                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/articles">--}}
{{--                        <i class="fas fa-file-alt" style="width:60px!important; text-align:center!important;"></i> Articles</a></div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="p-6 border">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/planner">
                        <i class="fas fa-calendar-alt" style="width:60px!important; text-align:center!important;"></i> Planner</a></div>
            </div>
        </div>

@if( auth()->user()->role == "admin" )
        <div class="p-6 border-gray-200 border">
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/categories">
                    <i class="fas fa-boxes" style="width:60px!important; text-align:center!important;"></i> Categories</a></div>
            </div>
        </div>

        <div class="p-6 border  border-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/users">

                <i class="fas fa-users" style="width:60px!important; text-align:center!important;"></i> Users</a></div>
            </div>
        </div>

            <div class="p-6 border border-gray-200">
                <div class="flex items-center">
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/history">

                            <i class="fas fa-history" style="width:60px!important; text-align:center!important;"></i> History</a></div>
                </div>
            </div>
@endif

        <div class="p-6 border  border-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/user/profile">

                        <i class="fas fa-user" style="width:60px!important; text-align:center!important;"></i>My Profile</a></div>
            </div>
        </div>



    </div>


</div>
