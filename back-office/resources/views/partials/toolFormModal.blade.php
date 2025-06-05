<!-- Modal -->
<div class="modal fade" id="toolModal" tabindex="-1" aria-labelledby="toolModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content px-4">
            <!-- Tool list -->
            <div id="tool-view-mode">
                <div class="modal-header">
                    <h5 class="modal-title" id="toolModalLabel">Select Tools</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
                </div>
                <div class="modal-body">
                    <h5>Available Tools:</h5>
                    <div id="tool-list">
                        @foreach($tools as $tool)
                        <div class="d-flex align-items-center mb-1" data-tag-id="{{ $tool->id }}">
                            <input type="checkbox" name="tools[]" value="{{ $tool->id }}" id="tool{{ $tool->id }}"
                                class="me-2" {{ isset($selectedTools) && in_array($tool->id, $selectedTools) ? 'checked' : '' }}>
                            <label for="tool{{ $tool->id }}" class="form-label me-2 mb-0">{{ $tool->name }}</label>
                            <button type="button" class="btn btn-sm btn-outline-warning me-1 btn-edit-tool"
                                data-id="{{ $tool->id }}" data-name="{{ $tool->name }}"
                                data-description="{{ $tool->description }}"
                                data-logo="{{ $tool->logo_url }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-tool"
                                data-id="{{ $tool->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>

                    <hr>

                    <h5>Add new tool</h5>
                    <div class="row">
                        <div class="col-4">
                            <label for="new-tool-name" class="form-label">Tool name*</label>
                            <input type="text" name="name" id="new-tool-name" class="form-control mb-2" required>
                        </div>
                        <div class="col-4">
                            <label for="new-tool-description" class="form-label">Description</label>
                            <input type="text" name="description" id="new-tool-description" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="new-tool-logo" class="form-label">Logo</label>
                            <input type="text" name="logo_url" id="new-tool-logo" class="form-control">
                        </div>
                    </div>
                    <button type="button" id="add-tool-btn" class="btn btn-sm btn-primary mt-2">Add Tool</button>
                    <div class="modal-footer mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                aria-label="Save">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Tool -->
            <div id="tool-edit-mode" class="d-none">
                <div class="modal-header">
                    <h5 class="modal-title" id="toolModalLabel">Edit Tool</h5>
                </div>
                <form id="edit-tool-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit-tool-id" name="id">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="edit-tool-name" class="form-label">Tool Name*</label>
                                <input type="text" class="form-control" id="edit-tool-name" name="name" required>
                            </div>
                            <div class="col-4">
                                <label for="edit-tool-description" class="form-label">Description</label>
                                <input type="text" class="form-control form-control-description" id="edit-tool-description"
                                    name="description">
                            </div>
                            <div class="col-4">
                                <label for="edit-tool-logo" class="form-label">Logo</label>
                                <input type="text" class="form-control form-control-logo" id="edit-tool-logo"
                                    name="logo_url">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" id="cancel-tool-edit-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

            <!-- Confirm delete -->
            <div id="tool-delete-mode" class="d-none">
                <div class="modal-header">
                    <h5 class="modal-title" id="toolModalLabel">Delete Tool</h5>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this tool?</p>
                </div>
                <div class="modal-footer d-flex justify-content-end mt-4">
                    <button type="button" id="cancel-tool-delete-btn" class="btn btn-secondary w-45 me-2">Cancel</button>
                    <button type="button" id="confirm-tool-delete-btn" class="btn btn-danger w-45">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>