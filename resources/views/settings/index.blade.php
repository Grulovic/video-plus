<x-app-layout>
    <x-slot name="header">

        <div class="row m-0 p-0">
            <div class="col-9">
                <h2>Editing Global Settings</h2>

            </div>
            <div class="col-3 text-right">
                <a href="{{ route('settings.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
            </div>

        </div>

    </x-slot>

    <style>
        label{
            font-size: 15px;
        }
        .form-group strong{
            font-size: 20px;
        }
        input[type="radio"]:checked+label{ font-weight: bold; font-size: 20px; text-decoration: underline;}
    </style>
    <div class="row m-0 p-0 pt-5 pb-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form class="row" action="{{ route('settings.update') }}" method="POST" name="update_settings" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('POST')

                <div class="form-group col-lg-6">
                    <img src="{{ url('uploads/settings/'.settings()->get('logo')) }}">
                </div>

                <div class="form-group col-lg-6">
                    <img src="{{ url('uploads/settings/'.settings()->get('logo_footer')) }}">
                </div>

                <div class="form-group col-lg-6">
{{--                    <strong>Logo</strong>--}}
{{--                    <input type="text" name="logo" class="form-control" placeholder="Enter title" value="{{ settings()->get('logo') }}" required>--}}
{{--                    <span class="text-danger">{{ $errors->first('logo') }}</span>--}}

                    <strong>Logo</strong>

                    <div class="custom-file mb-2">
                        <input type="file" class="form-control-file" name="logo" id="logo" >
                    </div>
                    <span class="text-danger">{{ $errors->first('logo') }}</span>

                </div>

                <div class="form-group col-lg-6">
                    <strong>Logo Footer</strong>

                    <div class="custom-file mb-2">
                        <input type="file" class="form-control-file" name="logo_footer" id="logo_footer" >
                    </div>
                    <span class="text-danger">{{ $errors->first('logo_footer') }}</span>
                </div>

                <div class="form-group col-lg-12">
                    <strong>Dashboard Description</strong>
                    <input type="text" name="dashboard_description" class="form-control" placeholder="Enter dashboard description" value="{{ settings()->get('dashboard_description') }}">
                    <span class="text-danger">{{ $errors->first('dashboard_description') }}</span>
                </div>






                <div class="form-group col-lg-3">
                    <strong><i class="fas fa-video" ></i> Videos</strong><br>
                    <div class="form-check form-check-inline btn btn-success">
                        <input class="form-check-input" type="radio" name="hide_videos" id="hide_videos0" value="0"  {{ settings()->get('hide_videos') == 0 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_videos0">Show</label>
                    </div>
                    <div class="form-check form-check-inline  btn btn-secondary   ">
                        <input class="form-check-input" type="radio" name="hide_videos" id="hide_videos1" value="1" {{ settings()->get('hide_videos') == 1 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_videos1">Hide</label>
                    </div>
                </div>


                <div class="form-group col-lg-3">
                    <strong> <i class="fas fa-image" ></i> Photos</strong><br>
                    <div class="form-check form-check-inline  btn btn-success">
                        <input class="form-check-input" type="radio" name="hide_photos" id="hide_photos0" value="0"  {{ settings()->get('hide_photos') == 0 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_photos0">Show</label>
                    </div>
                    <div class="form-check form-check-inline btn btn-secondary">
                        <input class="form-check-input" type="radio" name="hide_photos" id="hide_photos1" value="1" {{ settings()->get('hide_photos') == 1 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_photos1">Hide</label>
                    </div>
                </div>

                <div class="form-group col-lg-3">
                    <strong> <i class="fas fa-satellite-dish"></i> Lives</strong><br>
                    <div class="form-check form-check-inline btn btn-success">
                    <input class="form-check-input" type="radio" name="hide_lives" id="hide_lives0" value="0"  {{ settings()->get('hide_lives') == 0 ? "checked" : "" }}>
                    <label style="cursor: pointer;" class="form-check-label" for="hide_lives0">Show</label>
                </div>
                    <div class="form-check form-check-inline btn btn-secondary">
                        <input class="form-check-input" type="radio" name="hide_lives" id="hide_lives1" value="1" {{ settings()->get('hide_lives') == 1 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_lives1">Hide</label>
                    </div>
                </div>

                <div class="form-group col-lg-3">
                    <strong><i class="fas fa-calendar-alt"></i> Planner</strong><br>
                    <div class="form-check form-check-inline btn btn-success">
                        <input class="form-check-input" type="radio" name="hide_planner" id="hide_planner0" value="0"  {{ settings()->get('hide_planner') == 0 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_planner0">Show</label>
                    </div>
                    <div class="form-check form-check-inline btn btn-secondary">
                        <input class="form-check-input" type="radio" name="hide_planner" id="hide_planner1" value="1" {{ settings()->get('hide_planner') == 1 ? "checked" : "" }}>
                        <label style="cursor: pointer;" class="form-check-label" for="hide_planner1">Hide</label>
                    </div>
                </div>


    <div class="form-group col-lg-3">
        <strong><i class="fas fa-file-alt"></i> Articles</strong><br>
        <div class="form-check form-check-inline  btn btn-success">
            <input class="form-check-input" type="radio" name="hide_articles" id="hide_articles0" value="0"  {{ settings()->get('hide_articles') == 0 ? "checked" : "" }}>
            <label style="cursor: pointer;" class="form-check-label" for="hide_articles0">Show</label>
        </div>
        <div class="form-check form-check-inline btn btn-secondary">
            <input class="form-check-input" type="radio" name="hide_articles" id="hide_articles1" value="1" {{ settings()->get('hide_articles') == 1 ? "checked" : "" }}>
            <label style="cursor: pointer;" class="form-check-label" for="hide_articles1">Hide</label>
        </div>
    </div>



                <div class="col-12 pt-3">
                    <div class="w-50 float-left p-1">


                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#modal_delete_btn"  data-toggle="tooltip" data-placement="top" title="Edit Live">
                            <i class="far fa-edit"></i> Edit Global Settings
                        </button>

                        <!-- Modal -->
                        <div class="modal fade text-black" id="modal_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_delete_btn" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editing Global Settings</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        Are you sure you want to edit global settings?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i> Edit Settings</button>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->


                    </div>

                    <div class="w-50 float-left p-1">
                        <a href="{{ route('settings.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i> Cancel edit</a>
                    </div>
                </div>

            </form>

        </div>

        <div class="col-md-2"></div>

    </div>


    <div class="row m-0 p-0">

        <div class="col-lg-6" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="{{route('home.index')}}">
                        <i class="fas fa-home" style="width:60px!important; text-align:center!important;"></i> Home</a></div>
            </div>
        </div>

        <div class="col-lg-6" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/videos">
                        <i class="fas fa-video" style="width:60px!important; text-align:center!important;"></i> Videos</a></div>
            </div>
        </div>

        <div class="col-lg-6" >
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/photos">
                        <i class="fas fa-image" style="width:60px!important; text-align:center!important;"></i> Photos</a></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/lives">
                        <i class="fas fa-satellite-dish" style="width:60px!important; text-align:center!important;"></i> Live Streams</a></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/articles">
                        <i class="fas fa-file-alt" style="width:60px!important; text-align:center!important;"></i> Articles</a></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/planner">
                        <i class="fas fa-calendar-alt" style="width:60px!important; text-align:center!important;"></i> Planner</a></div>
            </div>
        </div>

        <div class="col-lg-6-gray-200 border">
            <div class="flex items-center">

                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/categories">
                        <i class="fas fa-boxes" style="width:60px!important; text-align:center!important;"></i> Categories</a></div>
            </div>
        </div>

        <div class="col-lg-6  border-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/users">

                        <i class="fas fa-users" style="width:60px!important; text-align:center!important;"></i> Users</a></div>
            </div>
        </div>

        <div class="col-lg-6 border-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/history">

                        <i class="fas fa-history" style="width:60px!important; text-align:center!important;"></i> History</a></div>
            </div>
        </div>


        <div class="col-lg-6  border-gray-200">
            <div class="flex items-center">
                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold" style="font-size: 40px;"><a href="/user/profile">

                        <i class="fas fa-user" style="width:60px!important; text-align:center!important;"></i>My Profile</a></div>
            </div>
        </div>



    </div>

</x-app-layout>
