<div class="modal fade" id="likes-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button data-bs-dismiss="modal" class="btn btn-sm text-primary fw-bold ms-auto">X</button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        @foreach($post->likes as $like)
                            <div class="row mb-3 align-items-center">
                                <div class="col-auto">
                                    <a href="{{ route('profile.show', $like->user_id)}}">
                                        @if($like->user->avatar)
                                            <img src="{{ $like->user->avatar}}" alt="" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="col text-truncate ps-0">
                                    <a href="{{ route('profile.show', $like->user_id)}}" class="text-decoration-none text-dark fw-bold">
                                        {{ $like->user->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>