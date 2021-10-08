<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top:65px!important;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="sm:px-20 bg-white border-b border-gray-200" style="padding-left: 0px!important; padding-right: 0px!important;">
                    <div class="p-6 my-auto" style="padding-right: 50px!important;padding-left: 50px!important;">
                        <div>
                            <img src="{{ asset('video-plus-logo.png') }}" style="max-height: 100px; " class="mb-5">
                        </div>

                        <div class="mt-8 text-2xl">
                            Welcome to {{ config('app.name') }}!
                        </div>

                        <div class="mt-6 text-gray-500">
                            Video plus production and live streaming services are a growing brand in the region, offering live services on social media and production services. In addition, there is plenty of video and IP streaming for TV stations, portals, and other media.

                            <br><br>Our team cooperated with all leading world agencies such as Reuters, Anadoly agency, Ruptley, and AP for national and regional media. Reporting on the territory of Serbia, Kosovo and Metohija, Montenegro, Albania, Macedonia, and Bosnia and Herzegovina.

                            <br><br>We took advantage of our many years of experience in video production and went a step further.

                            <br><br>We have created a state-of-the-art web application for the delivery of video files, photos, texts, and live broadcasts. The media solution is a solution for news agencies and other institutions that need their video services.

                            <br><br>Given that the speed of information flow requires new standards, our team is able to offer a state-of-the-art event transmission system, which can simultaneously download dozens of media (without satellites), live broadcast online, and download multiple media at the same time.

                            <br><br>We have a live streaming service that also offers an integrated channel for downloading TV signals in RTMP, RTSP, HLS formats in FullHD quality 6 Mbps. Also, inclusions can be broadcast simultaneously on social networks, Twitter, Facebook, and YouTube.

                            <br><br>We have devices for the renowned company LiveU, which has proven to be the most stable hardware for video signal transmission.

                            <br><br>In addition to being broadcasted live, we offer you another interesting option and that is quick access to files that are broadcasted through our network in FullHD resolution. For example, anything that is broadcasted as live or delayed live television can also be made available to you as a video file in its entirety within 10 minutes of the end.

                            <br><br>Also, our system has been further improved and solutions have been found that can be integrated on any better computer where it can be recorded and broadcast immediately in the service, which gives you the speed of broadcasting video material through your services.

                            <br><br>We are ready to present everything on the spot, we also offer a trial period in which you can see for yourself the quality of our services and solutions we offer.
                            <br><br><br><br>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-home-layout>
