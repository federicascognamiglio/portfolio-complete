<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true"
    data-project-id="{{ $project->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4">

            <!-- VIEW MODE -->
            <div id="media-view-mode">
                <div class="modal-header">
                    <h5 class="modal-title">Add Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <h5>Uploaded Media:</h5>
                    <div id="media-grid" class="d-flex flex-wrap gap-3">

                        @foreach ($project->media as $item)
                        <div class="position-relative media-thumbnail media-card" style="width: 100px; height: 100px;"
                            data-id="{{ $item->id }}">

                            @if ($item->type == App\MediaTypeEnum::IMAGE)
                            <img src="{{ asset('storage/' . $item->url) }}" class="img-fluid rounded"
                                style="object-fit: cover; width: 100%; height: 100%;">
                            @elseif ($item->type == App\MediaTypeEnum::VIDEO)
                            <div class="bg-dark text-white d-flex align-items-center justify-content-center rounded"
                                style="width: 100%; height: 100%;">
                                <i class="bi bi-play-circle fs-1"></i>
                            </div>
                            @elseif ($item->type == App\MediaTypeEnum::GIF)
                            <div class="bg-warning text-white d-flex align-items-center justify-content-center rounded"
                                style="width: 100%; height: 100%;">
                                <span class="fw-bold">GIF</span>
                            </div>
                            @endif

                            <button class="position-absolute top-0 end-0 d-none delete-media-btn"
                                data-id="{{ $item->id }}" style="width: 100px; height: 100px; background-color: white">
                                <i class="fa-solid fa-trash" style="color: black"></i>
                            </button>
                        </div>
                        @endforeach

                        <!-- ADD BUTTON -->
                        <div id="add-media-trigger"
                            class="d-flex justify-content-center align-items-center border rounded"
                            style="width: 100px; height: 100px; cursor: pointer;">
                            <span class="fs-3 text-muted">+</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('projects.show', $project->slug) }}" class="btn btn-primary">Save</a>
                </div>
            </div>

            <!-- ADD MODE -->
            <div id="media-add-mode" class="d-none">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Media</h5>
                </div>
                <div class="modal-body pb-0">
                    <form id="new-media-form" data-action="{{ route('media.store') }}">
                        <div class="row">
                            <div class="col-6">
                                <label for="new-media-type" class="form-label">Media Type*</label>
                                <select name="type" id="new-media-type" class="form-select mb-2">
                                    @foreach (App\MediaTypeEnum::cases() as $type)
                                    <option value="{{ $type->name }}">{{ $type->label() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="new-media-url" class="form-label">Upload File*</label>
                                <input type="file" name="url" id="new-media-url" class="form-control mb-2" required>
                            </div>
                            <div class="col-12">
                                <label for="new-media-description" class="form-label">Description</label>
                                <input type="text" name="description" id="new-media-description" class="form-control">
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2"
                                id="cancel-media-add-btn">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- DELETE MODE -->
            <div id="media-delete-mode" class="d-none" data-media-id="">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Media</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to <strong>permanently delete</strong> this media?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2 mt-2 mb-0"
                        id="cancel-media-delete-btn">Cancel</button>
                    <button type="button" class="btn btn-danger mt-2 mb-0" id="confirm-media-delete-btn">Delete</button>
                </div>
            </div>

        </div>
    </div>
</div>