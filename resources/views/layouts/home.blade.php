<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/64252806a4.js" crossorigin="anonymous"></script>

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <style type="text/css">
        /*.card:hover{*/
        /*    transform:scale(1.05);*/
        /*    transition:0.3s;*/
        /*    z-index:9;*/
        /*}*/
        </style>

		<script type="text/javascript" src="{{ URL::asset('js/create_view.js') }}"></script>
  <script src="{{ asset('js/additions.js') }}" defer></script>
   <link href="{{ asset('css/additions.css') }}" rel="stylesheet">
         <script>
        function copyToClipboard(url) {
          var $temp = $("<input>");
          $("body").append($temp);
          $temp.val(url).select();
          document.execCommand("copy");
          $temp.remove();
        }
        </script>
    </head>
    <body class="font-sans antialiased">





        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-simple')



            <!-- Page Content -->
            <main>

                @if (Auth::guest())
                    <script type="text/javascript">
                        $(window).on('load', function() {

                            window.setTimeout(function (){
                               $('#registerModal').modal('show');
                                }, 5000);
                        });
                    </script>


                    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="contact_us" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="create_modal_label">Don't have an account?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h5>Register for FREE and gain access to all of the content!</h5>
                                </div>
                                <div class="modal-footer">

                                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-success">REGISTER</a>

                                </div>

                            </div>
                        </div>
                    </div>

                @endif
                {{ $slot }}
            </main>
        </div>

        @include('footer')

        @stack('modals')

        @livewireScripts
    </body>
</html>
