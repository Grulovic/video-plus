<div class="container-fluid  pb-0 mb-0 justify-content-center text-muted shadow-lg" style="background-color2:#c7363d; ">
     <footer class="max-w-7xl  mx-auto " style="">
         <div class="row justify-content-center pt-5 pb-5">
             <div class="col-11">
                 <div class="row ">
                     <div class="col-xl-8 col-md-4 col-sm-4 col-12 my-auto mx-auto a ">
                         <a href="{{route('about')}}" ><img src="{{ asset('video-plus-logo.png') }}" style="max-height: 100px; " class="mb-5"></a>
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                         <h6 class="mb-3 mb-lg-4 bold-text "><b>MENU</b></h6>
                         <ul class="list-unstyled">
                             <li><a href="{{route('home.index')}}">Home</a></li>
                             <li><a href="{{route('videos.index')}}">Dashboard</a></li>
                             <li><a href="{{route('videos.index')}}">Videos</a></li>
                             <li><a href="{{route('photos.index')}}">Photos</a></li>
                             <li><a href="{{route('lives.index')}}">Live Streams</a></li>
                             <li><a href="{{route('plans.index')}}">Planner</a></li>
                             <li><a href="{{route('about')}}">About Us</a></li>
                         </ul>
                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-12">
                         <h6 class="mb-3 mb-lg-4 text-muted bold-text mt-sm-0 mt-5"><b>ADDRESS</b></h6>
                         <p class="mb-1">Resavska 40/1</p>
                         <p>Belgrade, Serbia</p>
                            <br><br>
                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contact_us">
                             <i class="fas fa-envelope"></i> CONTACT US
                         </button>
                     @if (!Auth::guest())
                         @if(Auth::user()->isAdmin())
                             <a href="{{route('support.index')}}" class="btn btn-success">
                                 REPLY TO MESSAGES
                             </a>
                         @endif
                     @endif


                         <!-- Modal -->
                         <div class="modal fade" id="contact_us" tabindex="-1" role="dialog" aria-labelledby="contact_us" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="create_modal_label">Contact Us</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>

                                     <div class="modal-body">
                                         <form action="{{ route('contact') }}" method="POST" name="contact">
                                             {{ csrf_field() }}

                                             <div class="form-group col-12">
                                                 <strong>Email</strong>
                                                 <input type="text" name="email" class="form-control" placeholder="Enter email" required>
                                                 <span class="text-danger">{{ $errors->first('title') }}</span>
                                             </div>


                                             <div class="form-group col-12">
                                                 <strong>Message</strong>
                                                 <textarea type="text" name="message" class="form-control" placeholder="Enter message" required style="min-height: 106px;"></textarea>
                                                 <span class="text-danger">{{ $errors->first('description') }}</span>
                                             </div>


                                             <div class="modal-footer">
                                                 <button type="submit" class="btn btn-primary"><i class="fas fa-envelope"></i> Send Message</button>
                                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                             </div>
                                         </form>

                                     </div>


                                 </div>
                             </div>
                         </div>
                         <!-- End modal -->
                     </div>
                 </div>
                 <div class="row ">
                     <div class="col-xl-8 col-md-4 col-sm-4 col-auto my-md-0 mt-5 order-sm-1 order-3 align-self-end">

                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-1 align-self-end ">

                     </div>
                     <div class="col-xl-2 col-md-4 col-sm-4 col-auto order-2 align-self-end mt-3 ">

                     </div>
                 </div>
             </div>
         </div>
     </footer>
 </div>

@include('alerts')
