    @if (session('success'))
    <div class="alert alert-success shadow-sm" role="alert" style="position:absolute; top:100px; right:10px; z-index:99999;">
        {{ session('success') }}
        <button class="ml-3" type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger shadow-sm" role="alert" style="position:absolute; top:100px; right:10px; z-index:99999;">
        {{ session('error') }}
        <button class="ml-3" type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif