<x-app-layout>
    <x-slot name="header">


<div class="row m-0 p-0">
  <div class="col-9 text-left">
        <h2>Reply to Contact Us</h2>
    </div>
  <div class="col-3 text-right">
        <a href="{{ route('support.index') }}" class="btn btn-danger mb-2"><i class="fas fa-chevron-left"></i> Go Back</a>
    </div>

</div>

</x-slot>

<div class="row m-0 p-0 pt-5 pb-5">
<div class="col-md-2"></div>
<div class="col-md-8">
<form  class="row" action="{{ route('support.reply') }}" method="POST" name="add_category">
    {{ csrf_field() }}
    <input type="text" name="message_id"  value="{{$support->id}}" hidden>{{$support->id}}

    <div class="form-group col-lg-6">
        <strong>Email</strong>
        <input type="text" name="email" class="form-control" placeholder="Enter email" value="{{$support->email}}">{{$support->email}}
        <span class="text-danger">{{ $errors->first('email') }}</span>
    </div>


    <div class="form-group col-lg-6">
        <strong>Reply Message</strong>
        <input type="text" name="message" class="form-control" placeholder="Enter message">
        <span class="text-danger">{{ $errors->first('message') }}</span>
    </div>








    <div class="col-12 pt-3">
        <div class="w-50 float-left p-1">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-archive"></i> Reply to message</button>
        </div>

        <div class="w-50 float-left p-1">
            <a href="{{ route('support.index') }}" class="btn btn-danger w-100"><i class="fas fa-ban"></i>  Cancel reply</a>
        </div>
    </div>



    </div>

</form>

</div>
<div class="col-md-2"></div>
</div>


</x-app-layout>
