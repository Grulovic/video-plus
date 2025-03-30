<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="margin-top:65px!important;">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ml-2 mr-2">
                <div class="sm:px-20 bg-white border-b border-gray-200" style="padding-left: 0px!important; padding-right: 0px!important;">
                    <div class="p-6 my-auto" style="padding-right: 50px!important;padding-left: 50px!important;">
                        <div>
                            <img src="{{ url('uploads/settings/'.settings()->get('logo')) }}" style="max-height: 100px; " class="mb-5">
                        </div>

                        <div class="mt-8 text-2xl">
                            <h5 class="text-uppercase fw-bold mb-4 text-primary">IMPRESUM</h5>
                        </div>

                        @include('impresum_section')
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-home-layout>
