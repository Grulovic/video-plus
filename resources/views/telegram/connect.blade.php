<x-home-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    <div class="container">
    <div class="row m-0 p-0 pt-5 pb-5">
        <div class="col-lg-12">
        <script 
        async 
        type="application/javascript"
        src="https://telegram.org/js/telegram-widget.js?7"
        data-telegram-login="{{ config('services.telegram-bot-api.name') }}" 
        data-size="large" 
        data-auth-url="{{ route('telegram.connect') }}" 
        data-request-access="write"
    ></script>
        
    	</div>
    </div>
    </div>
    
    
</x-home-layout>
