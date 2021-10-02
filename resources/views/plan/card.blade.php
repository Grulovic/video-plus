<div class="col-12 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">


    <div class="card-body pt-0" style="overflow: hidden;">

        <div class="row mt-3">
            <div class="col-lg-2">
                <div class="text-left w-100 pr-2">{{ date('j. F Y. H:i', strtotime($plan->date)) }}</div>
            </div>
            <div class="col-lg-2">
                <div class="row m-0 p-0">
                    <div class="col-6 text-center my-auto">
                        @if(sizeof($plan->videoItems) != 0)
                            <a class="btn btn-primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}videos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}videos">
                                <i class="fas fa-video" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center my-auto">
                        @if(sizeof($plan->photoItems) != 0)
                            <a class="btn btn-primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}photos" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}photos">
                                <i class="fas fa-image" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center my-auto">
                        @if(sizeof($plan->textItems) != 0)
                            <a class="btn btn-primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}texts" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}texts">
                                <i class="fas fa-microphone" style=""></i>
                            </a>
                        @endif
                    </div>
                    <div class="col-6 text-center my-auto">
                        @if(sizeof($plan->liveItems) != 0)
                            <a class="btn btn-primary  w-100 h-100" data-toggle="collapse" href="#plan{{ $loop->index }}lives" role="button" aria-expanded="false" aria-controls="#plan{{ $loop->index }}lives">
                                <i class="fas fa-file-alt" style=""></i>
                            </a>
                        @endif
                    </div>
                </div>
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
                    <div class="collapse multi-collapse" id="#plan{{ $loop->index }}videos">
                        <div class="card card-body">Video Items:
                        @foreach( $plan->videoItems as $item )
                            <a href="{{ route('videos.show',$item->item_id)}}">{{ $item->getItem->name }}</a>
                        @endforeach
                        </div>
                    </div>
                @endif

                @if(sizeof($plan->photoItems) != 0)
                <div class="collapse multi-collapse" id="#plan{{ $loop->index }}photos">
                    <div class="card card-body">
                    Photo Items:
                        @foreach( $plan->photoItems as $item )
                            <a href="{{ route('photos.show',$item->item_id)}}">{{ $item->getItem->name }}</a>
                        @endforeach
                        </div>
                    </div>
                @endif
                @if(sizeof($plan->textItems) != 0)
                <div class="collapse multi-collapse" id="#plan{{ $loop->index }}texts">
                    <div class="card card-body">
                    Article Items:
                        @foreach( $plan->textItems as $item )
                            <a href="{{ route('articles.show',$item->item_id)}}">{{ $item->getItem->title }}</a>
                        @endforeach
                        </div>
                    </div>
                @endif
                @if(sizeof($plan->liveItems) != 0)
                <div class="collapse multi-collapse" id="#plan{{ $loop->index }}lives">
                    <div class="card card-body">Live Items:
                        @foreach( $plan->liveItems as $item )
                            <a href="{{ route('lives.show',$item->item_id)}}">{{ $item->getItem->title }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
            <div class="col-lg-2">
                <p class="text-muted mb-0 pb-0" style="">Location: {{ $plan->location }}</p>
            </div>

        </div>













    </div>

    <div class="card-footer  text-right">
        <div class="btn-group ">

           @if (!Auth::guest())
 			@can('update',$plan)


          <a href="{{ route('plans.edit',$plan->id)}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
          @endcan
 			@can('delete',$plan)

           <button type="button" class="btn btn-sm  btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-toggle="modal" data-target="#modal_{{$plan->id}}_delete_btn"  data-toggle="tooltip" data-placement="top" title="Delete plan">
                   <i class="far fa-trash-alt"></i>
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
