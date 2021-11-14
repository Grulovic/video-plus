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


    <div class="row m-0 p-0 pt-5 pb-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form class="row" action="{{ route('settings.update') }}" method="POST" name="update_settings">
                {{ csrf_field() }}
                @method('POST')

                <div class="form-group col-lg-6">
                    <strong>Logo</strong>
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ settings()->get('logo') }}" required>
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                </div>

                <div class="form-group col-lg-6">
                    <strong>Logo Footer</strong>
                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ settings()->get('logo_footer') }}" required>
                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                </div>


                <div class="form-group col-lg-3">
                    <strong>Hide Videos</strong><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hide_videos" id="hide_videos0" value="0"  {{ settings()->get('hide_videos') == 0 ? "checked" : "" }}>
                        <label class="form-check-label" for="featured0">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hide_videos" id="hide_videos1" value="1" {{ settings()->get('hide_videos') == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="featured1">Hide</label>
                    </div>
                </div>


                <div class="form-group col-lg-3">
                    <strong>Hide photos</strong><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hide_photos" id="hide_photos0" value="0"  {{ settings()->get('hide_photos') == 0 ? "checked" : "" }}>
                        <label class="form-check-label" for="featured0">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="hide_photos" id="hide_photos1" value="1" {{ settings()->get('hide_photos') == 1 ? "checked" : "" }}>
                        <label class="form-check-label" for="featured1">Hide</label>
                    </div>
                </div>

                <div class="form-group col-lg-3">
                    <strong>Hide lives</strong><br>
                    <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hide_lives" id="hide_lives0" value="0"  {{ settings()->get('hide_lives') == 0 ? "checked" : "" }}>
                    <label class="form-check-label" for="featured0">No</label>
                </div>


        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="hide_lives" id="hide_lives1" value="1" {{ settings()->get('hide_lives') == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">Hide</label>
        </div>
    </div>


    <div class="form-group col-lg-3">
        <strong>Hide articles</strong><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="hide_articles" id="hide_articles0" value="0"  {{ settings()->get('hide_articles') == 0 ? "checked" : "" }}>
            <label class="form-check-label" for="featured0">No</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="hide_articles" id="hide_articles1" value="1" {{ settings()->get('hide_articles') == 1 ? "checked" : "" }}>
            <label class="form-check-label" for="featured1">Hide</label>
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

</x-app-layout>
