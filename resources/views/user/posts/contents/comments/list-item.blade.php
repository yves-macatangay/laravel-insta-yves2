<div class="mt-2">
    <a href="{{ route('profile.show', $comment->user->id)}}" class="text-decoration-none fw-bold text-dark">{{ $comment->user->name }}</a>
    &nbsp;
    <span class="fw-light">{{ $comment->body }}</span>
    <div class="text-muted xsmall">
     {{ date('D, M d Y', strtotime($comment->created_at))}}
        @if($comment->user_id == Auth::user()->id)
            <form action="{{ route('comment.destroy', $comment->id)}}" method="post" class="d-inline">
                @csrf 
                @method('DELETE')
                &middot;
                <button type="submit" class="btn shadow-none p-0 text-danger xsmall">Delete</button>
            </form>
        @endif
    </div>
</div>