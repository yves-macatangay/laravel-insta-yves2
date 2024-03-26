<div class="modal fade" id="delete-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h4 class="modal-title text-dark"><i class="fa-solid fa-trash-can"></i> Delete Category</h4>
            </div>
            <div class="modal-body text-start text-dark">
                <p>Are you sure you want to delete <strong>{{ $category->name }}</strong> category?
                </p>
                <p>This will affect all posts under this category. Posts without a category will fall under Uncategorized.
                </p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('admin.categories.destroy', $category->id)}}" method="post">
                    @csrf 
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- EDIT --}}
<div class="modal fade" id="edit-categ{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h4 class="modal-title text-dark"><i class="fa-regular fa-pen-to-square"></i> Edit Category</h4>
            </div>
            <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
                @csrf 
                @method('PATCH')
                <div class="modal-body text-start text-dark">
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>