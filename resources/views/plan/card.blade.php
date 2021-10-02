<div class="col-12 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">


    <div class="card-body pt-0" style="overflow: hidden;">

        <div class="row mt-3">
            <div class="col-lg-2">
                <div class="text-left w-100 pr-2">{{ date('j. F Y. H:i', strtotime($plan->date)) }}</div>
            </div>
            <div class="col-lg-6">
                <p class="text-muted" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        @if(sizeof($plan->categories) > 0)
                            @foreach($plan->categories as $category)
                                {{$category->category->title}}
                                @if(!$loop->last) | @endif
                            @endforeach
                        @else
                            No categories
                        @endif
                    </p>

                <h5 class="pb-0 mb-0">{{ $plan->title }}</h5>
                <p class="mb-0 pb-0" style="">{{ $plan->description }}</p>
                @if(sizeof($plan->videoItems) != 0)
                    <div class="collapse mb-2 " id="plan{{ $loop->index }}videos">
                        <div class="card">
                            <div class="rounded-top bg-light border-bottom font-weight-bold p-1">Videos:</div>
                            <div class="card-body">
                        @foreach( $plan->videoItems as $video )
                                    @php $video = $video->getItem @endphp
                            @include('plan.video_card')
                        @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if(sizeof($plan->photoItems) != 0)
                <div class="collapse mb-2 " id="plan{{ $loop->index }}photos">
                    <div class="card">
                        <div class="rounded-top bg-light border-bottom font-weight-bold p-1">Galleries:</div>
                        <div class="card-body">
                            @foreach( $plan->photoItems as $gallery )
                                @php $gallery = $gallery->getItem @endphp
                                @include('plan.photo_card')
                        @endforeach</div>
                        </div>
                    </div>
                @endif
                @if(sizeof($plan->textItems) != 0)
                <div class="collapse mb-2" id="plan{{ $loop->index }}texts">
                    <div class="card">
                        <div class="rounded-top bg-light border-bottom font-weight-bold p-1">Articles:</div>
                        <div class="card-body">
                            @foreach( $plan->textItems as $article )
                                @php $article = $article->getItem @endphp
                                @include('plan.text_card')
                        @endforeach</div>
                        </div>
                    </div>
                @endif
                @if(sizeof($plan->liveItems) != 0)
                <div class="collapse mb-2" id="plan{{ $loop->index }}lives">
                    <div class="card">
                        <div class="rounded-top bg-light border-bottom font-weight-bold p-1">Live Streams:</div>
                        <div class="card-body">
                            @foreach( $plan->liveItems as $live )
                                @php $live = $live->getItem @endphp
                                @include('plan.live_card')
                        @endforeach</div>
                    </div>
                </div>
                @endif

            </div>
            <div class="col-lg-2">
                <p class="text-muted mb-0 pb-0" style="">Location: {{ $plan->location }}</p>
            </div>
            <div class="col-lg-2">
                <div class="row m-0 p-0">
                    <div class="col-6 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->videoItems) != 0 || $plan->video)
                            <a class="btn btn-{{  sizeof($plan->videoItems) == 0 ? "outline-" : null }}primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}videos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}videos">
                                <i class="fas fa-video" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->photoItems) != 0 || $plan->photo)
                            <a class="btn btn-{{  sizeof($plan->photoItems) == 0 ? "outline-" : null }}primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}photos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}photos">
                                <i class="fas fa-image" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->textItems) != 0 || $plan->text)
                            <a class="btn btn-{{  sizeof($plan->textItems) == 0 ? "outline-" : null }}primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}texts" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}texts">
                                <i class="fas fa-microphone" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center mb-2 pl-1 pr-1 p-0">
                        @if(sizeof($plan->liveItems) != 0 || $plan->live)
                            <a class="btn btn-{{  sizeof($plan->liveItems) == 0 ? "outline-" : null }}primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}lives" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}lives">
                                <i class="fas fa-file-alt" style=""></i>
                            </a>
                        @endif
                    </div>

                    <div class="col-lg-12 text-center ">
                        <div class="btn-group ">

                            @if (!Auth::guest())
                                @can('update',$plan)


                                    <a href="{{ route('plans.edit',$plan->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i> Edit</a>
                                @endcan
                                <button type="button" class="btn btn-sm  btn-info" style="border-radius: 0 0.25rem 0.25rem 0;"  data-toggle="tooltip" data-placement="top" title="Get Email Notifications">
                                   <strong>FOLLOW</strong>
                                </button>
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
