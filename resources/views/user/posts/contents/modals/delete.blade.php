<div class="modal fade" id="delete-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="h5 modal-title text-danger">
                    <i class="fa-solid fa-circle-exclamation"></i> Delete Post
                </h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this post?
                <img src="{{ $post->image }}" alt="" class="d-block mt-3 mb-1 image-lg">
                <p class="text-muted fw-light">{{ $post->description }}</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.destroy', $post->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>