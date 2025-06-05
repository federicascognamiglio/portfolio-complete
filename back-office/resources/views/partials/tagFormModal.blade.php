<!-- Modal -->
<div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content px-4">
            <!-- Tag list -->
            <div id="tag-view-mode">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagModalLabel">Select Tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body">
                    <h5>Available Tags:</h5>
                    <div id="tag-list">
                        @foreach($tags as $tag)
                        <div class="d-flex align-items-center mb-1" data-tag-id="{{ $tag->id }}">
                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag{{ $tag->id }}"
                                class="me-2" {{ isset($selectedTags) && in_array($tag->id, $selectedTags) ? 'checked' : '' }}>
                            <label for="tag{{ $tag->id }}" class="form-label me-2 mb-0">{{ $tag->name }}</label>
                            <button type="button" class="btn btn-sm btn-outline-warning me-1 btn-edit-tag"
                                data-id="{{ $tag->id }}" data-name="{{ $tag->name }}"
                                data-color="{{ $tag->color ?? '#000000' }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-tag"
                                data-id="{{ $tag->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <hr>

                    <h5>Add new tag</h5>
                    <div class="row">
                        <div class="col-6">
                            <label for="new-tag-name" class="form-label">Tag name*</label>
                            <input type="text" name="name" id="new-tag-name" class="form-control mb-2" required>
                        </div>
                        <div class="col-3">
                            <label for="new-tag-color" class="form-label">Tag color</label>
                            <input type="color" name="color" id="new-tag-color" class="form-control">
                        </div>
                    </div>
                    <button type="button" id="add-tag-btn" class="btn btn-sm btn-primary mt-2">Add Tag</button>
                    <div class="modal-footer mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                aria-label="Save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Tag -->
            <div id="tag-edit-mode" class="d-none">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagModalLabel">Edit Tag</h5>
                </div>
                <form id="edit-tag-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit-tag-id" name="id">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="edit-tag-name" class="form-label">Tag Name*</label>
                                <input type="text" class="form-control" id="edit-tag-name" name="name" required>
                            </div>
                            <div class="col-6">
                                <label for="edit-tag-color" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color" id="edit-tag-color"
                                    name="color">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" id="cancel-tag-edit-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            <!-- Confirm delete -->
            <div id="tag-delete-mode" class="d-none">
                <div class="modal-header">
                    <h5 class="modal-title" id="tagModalLabel">Delete Tag</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this tag?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end mt-4">
                    <button type="button" id="cancel-tag-delete-btn" class="btn btn-secondary w-45 me-2">Cancel</button>
                    <button type="button" id="confirm-tag-delete-btn" class="btn btn-danger w-45">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>