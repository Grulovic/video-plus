<div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 d-flex align-items-stretch  p-1">
  <div class="card mb-4 w-100 shadow-sm">


    <div class="card-body pt-0" style="overflow: hidden;">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="text-left w-100 pr-2">{{ date('j. F Y.', strtotime($plan->date)) }} <strong>{{ date('H:i', strtotime($plan->date)) }}</strong></div>
            </div>

            <div class="col-lg-12">
                <p class="text-muted mb-0 pb-0" style="">Location: {{ $plan->location }}</p>
            </div>

            <div class="col-lg-12 mt-2">

                <h5 class="pb-0 mb-0"><strong>{{ Str::limit($plan->title, 40, $end='...')}}</strong></h5>
                <p class="mb-0 pb-0" style="">{{ Str::limit($plan->description , 100, $end='...')}}</p>
            </div>
            <div class="col-lg-12">
                <div class="row m-0 p-0 mt-2">
                    <div class="col-4 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->videoItems) != 0 || $plan->video)
                            <a class="btn plan-item-btn btn-outline-{{  sizeof($plan->videoItems) == 0 ? "secondary" : "primary" }}  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}videos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}videos">
                                <i class="fas fa-video" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-4 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->photoItems) != 0 || $plan->photo)
                            <a class="btn plan-item-btn btn-outline-{{  sizeof($plan->photoItems) == 0 ? "secondary" : "primary" }}  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}photos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}photos">
                                <i class="fas fa-image" style=""></i>
                            </a>
                        @endif
                    </div>
{{--                    <div class="col-4 text-center mb-2 pl-1 pr-1 p-0">--}}
{{--                        @if(sizeof($plan->textItems) != 0 || $plan->text)--}}
{{--                            <a class="btn plan-item-btn btn-outline-{{  sizeof($plan->textItems) == 0 ? "secondary" : "primary" }}  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}texts" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}texts">--}}
{{--                                <i class="fas fa-file-alt" style=""></i>--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
                    <div class="col-4 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->liveItems) != 0 || $plan->live)
                            <a class="btn plan-item-btn btn-outline-{{  sizeof($plan->liveItems) == 0 ? "secondary" : "primary" }}  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}lives" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}lives">
                                <i class="fas fa-microphone" style=""></i>
                            </a>
                        @endif
                    </div>


                </div>
            </div>
        </div>

    </div>

      <div class="card-footer text-right ">
          <div class="btn-group ">
              <a href="{{ route('plans.show',$plan->id)}}" class="btn btn-sm btn-primary"   data-toggle="tooltip" data-placement="top" title="Show Plan" ><i class="far fa-eye"></i> View</a>
              @if (!Auth::guest())
                  @can('update',$plan)


                      <a href="{{ route('plans.edit',$plan->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> Edit</a>
                  @endcan
                  <a href="{{ route('plans.favorite',$plan->id)  }}" type="button" id="plan-favorite-btn-{{$plan->id}}"
                     class="plan-favorite-btn  btn btn-sm  {{ $plan->inFavorite() ? "btn-info" : "btn-success" }}  pl-4 pr-4" style="border-radius: 0 0.25rem 0.25rem 0;"  data-toggle="tooltip" data-placement="top" title="Get Email Notifications"
                          data-planid="{{$plan->id}}">
                      <strong>{{ $plan->inFavorite() ? "UNFOLLOW" : "FOLLOW" }}</strong>
                  </a>

{{--                      <button type="button" id="plan-favorite-btn-{{$plan->id}}" class="plan-favorite-btn  btn btn-sm  btn-{{ $plan->inFavorite() ? null : "outline-" }}info  pl-4 pr-4" style="border-radius: 0 0.25rem 0.25rem 0;"  data-toggle="tooltip" data-placement="top" title="Get Email Notifications"--}}
{{--                         data-planid="{{$plan->id}}">--}}
{{--                          <strong>{{ $plan->inFavorite() ? "UNFOLLOW" : "FOLLOW" }}</strong>--}}
{{--                      </button>--}}
                  @can('delete',$plan)

                      <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$plan->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete plan">
                          <i class="far fa-trash-alt"></i> Delete
                      </button>
                  @endcan

              @endif

          </div>
      </div>

  </div>
</div>




         @if (!Auth::guest())
			@can('delete',$plan)
                <!-- Modal -->
                <div class="modal fade" id="modal_{{$plan->id}}_delete_btn" tabindex="-1" role="dialog" aria-labelledby="modal_{{$plan->id}}_delete_btn" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Deleting Plan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-left">
                        Are you sure you want to delete <strong>{{ $plan->name }}</strong>?
                      </div>
                      <div class="modal-footer">

                        <form class="" action="{{ route('plans.destroy', $plan->id)}}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button  type="submit" class="btn btn-danger"
                          data-toggle="tooltip" data-placement="top" title="Delete plan">
                          <i class="far fa-trash-alt"></i> Delete Plan</button>
                        </form>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal -->
          @endcan
          @endif
