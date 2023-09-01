@if (@isset($pagename))
    {{ $pagename }}
@endif

<div class="container">
    <div class="row">

    @if(isset($blogs_list))
    @foreach($blogs_list as $item)
        <div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <div style="height: 225px">
                    <img @if(!empty($item['picture'])) src="{{ asset($item['picture']) }}" @else src="{{$item['image']}}" @endif alt="" height="100px" style="width: 100%; height:100%; object-fit:cover" class="card-img-top">
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <h2 class="mb-3 text-muted"> {{$item['title']}} </h2>
                        <p class="text-truncate">{{$item['content']}}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('indexWithId', ['id'=>$item['id']])}}" class="btn btn-sm btn-outline-secondary">View</a>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        <small class="text-muted">9 min(s)</small>
                    </div>
                    <p class="mt-2">
                    @if ($item->user)
                        Plubié par: <span class="text-success"> {{ $item->user->Fullname }} </span>
                    @endif
                    </p>
                </div>
            </div>
        </div>
        
            
        
        @endforeach
        {{-- {{ $blogs_list->links() }} --}}

    @endif

    </div>
</div>