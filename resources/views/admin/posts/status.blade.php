@if(!$post->trashed())
<div class="modal fade" id="hide-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="modal-title text-danger"><i class="fa-solid fa-eye-slash"></i> Hide Post</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to hide this post?
                <img src="{{ $post->image }}" alt="" class="image-lg d-block my-2">
                {{ $post->description }}
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.hide', $post->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger btn-sm">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Hide</button>
                </form>
            </div>
        </div>
    </div>
</div>

@else
<div class="modal fade" id="unhide-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-primary">
            <div class="modal-header border-primary">
                <h4 class="modal-title text-primary"><i class="fa-solid fa-eye"></i> Unhide Post</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to unhide this post?
                <img src="{{ $post->image }}" alt="" class="image-lg d-block my-2">
                {{ $post->description }}
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.posts.unhide', $post->id)}}" method="post">
                    @csrf 
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-outline-primary btn-sm">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Unhide</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif