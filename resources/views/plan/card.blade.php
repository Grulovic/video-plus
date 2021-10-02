<div class="col-12 d-flex align-items-stretch p-1">
  <div class="card mb-4 w-100 shadow-sm">


    <div class="card-body pt-0" style="overflow: hidden;">
        <div class="text-left w-100 pr-2">{{ date('j. F Y. H:i', strtotime($plan->date)) }}</div>
      <h5 class="pb-0 mb-0">{{ Str::limit($plan->title, 35, $end='...')}}</h5>
        <p class="text-muted" style=" white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><small>
                @if(sizeof($plan->categories) > 0)
                    @foreach($plan->categories as $category)
                        {{$category->category->title}}
                        @if(!$loop->last) | @endif
                    @endforeach
                @else
                    No categories
                @endif
            </small></p>
        @if($plan->video)
        <i class="fas fa-video"></i>
        @endif
        @if($plan->photo)
            <i class="fas fa-image"></i>
        @endif
        @if($plan->live)
            <i class="fas fa-microphone"></i>
        @endif
        @if($plan->text)
            <i class="fas fa-file-alt"></i>
        @endif

        <p>Video Items:
            @foreach( $plan->videoItems as $item )
                <a href="{{ route('videos.show',$item->item_id)}}">{{ $item->getItem->first()->name }}</a>
            @endforeach
        </p>
        <p>Photo Items:
            @foreach( $plan->photoItems as $item )
                <a href="{{ route('photos.show',$item->item_id)}}">{{ $item->getItem->first()->name }}</a>
            @endforeach
        </p>
        <p>Article Items:
            @foreach( $plan->textItems as $item )
                <a href="{{ route('articles.show',$item->item_id)}}">{{ $item->getItem->first()->title }}</a>
            @endforeach
        </p>
        <p>Live Items:
            @foreach( $plan->liveItems as $item )
                <a href="{{ route('lives.show',$item->item_id)}}">{{ $item->getItem->first()->title }}</a>
            @endforeach
        </p>

      <p class="text-muted mb-0 pb-0" style="">{{ Str::limit($plan->description, 70, $end='...')}}</p>

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
