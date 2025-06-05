// Gets selected tags and fill hidden inputs
function initializeSelectedTags() {
    const checkedTags = document.querySelectorAll('input[name="tags[]"]:checked');
    const selectedTagsEl = document.getElementById('selected-tags');
    const hiddenTagsWrapper = document.getElementById('hidden-tags-wrapper');
    
    selectedTagsEl.innerHTML = '';
    hiddenTagsWrapper.innerHTML = '';
    
    checkedTags.forEach(tag => {
        const tagId = tag.getAttribute('id');
        const label = document.querySelector(`label[for="${tagId}"]`);
        const tagName = label ? label.textContent.trim() : 'undefined';

        // Badge
        selectedTagsEl.innerHTML += `<span class="badge bg-secondary me-1">${tagName}</span>`;

        // Hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'tags[]';
        input.value = tag.value;
        hiddenTagsWrapper.appendChild(input);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialise selected tags hidden inputs
    initializeSelectedTags();

    // Elements
    const addTagBtn = document.getElementById('add-tag-btn');
    const tagInput = document.getElementById('new-tag-name');
    const tagColorInput = document.getElementById('new-tag-color');
    const tagList = document.getElementById('tag-list');
    const tagModal = document.getElementById('tagModal'); 
    const selectedTagsEl = document.getElementById('selected-tags');

    // Modal views
    const tagViewMode = document.getElementById('tag-view-mode');
    const tagEditMode = document.getElementById('tag-edit-mode');
    const tagDeleteMode = document.getElementById('tag-delete-mode');

    // Edit form inputs
    const editTagForm = document.getElementById('edit-tag-form');
    const editTagIdInput = document.getElementById('edit-tag-id');
    const editTagNameInput = document.getElementById('edit-tag-name');
    const editTagColorInput = document.getElementById('edit-tag-color');
    const cancelTagEditBtn = document.getElementById('cancel-tag-edit-btn');

    // Delete confirmation buttons
    const confirmTagDeleteBtn = document.getElementById('confirm-tag-delete-btn');
    const cancelTagDeleteBtn = document.getElementById('cancel-tag-delete-btn');

    let tagIdToDelete = null;

    // Create new tag
    addTagBtn.addEventListener('click', function (event) {
        event.preventDefault();

        const tagName = tagInput.value.trim();
        const tagColor = tagColorInput.value || '#000000';
        if (!tagName) return;

        axios.post('/tags', { name: tagName, color: tagColor })
            .then(response => {
                const tag = response.data;
                const html = `
                    <div class="d-flex align-items-center mb-1" data-tag-id="${tag.id}">
                        <input type="checkbox" name="tags[]" value="${tag.id}" id="tag${tag.id}" checked class="me-2">
                        <label for="tag${tag.id}" class="form-label me-2 mb-0">${tag.name}</label>
                        <button type="button" class="btn btn-sm btn-outline-warning me-1 btn-edit-tag"
                                data-id="${tag.id}"
                                data-name="${tag.name}"
                                data-color="${tag.color || '#000000'}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-tag" 
                                data-id="${tag.id}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `;
                tagList.insertAdjacentHTML('beforeend', html);
                tagInput.value = '';
            })
            .catch(error => {
                console.error(error);
                alert("Error creating tag");
            });
    });

    // Show selected tags in form
    if (tagModal) {
        tagModal.addEventListener('hidden.bs.modal', function () {
            const checkedTags = document.querySelectorAll('input[name="tags[]"]:checked');
            let html = '';
            checkedTags.forEach(tag => {
                const tagId = tag.getAttribute('id');
                const label = document.querySelector(`label[for="${tagId}"]`);
                const tagName = label ? label.textContent.trim() : 'undefined';
                html += `<span class="badge bg-secondary me-1">${tagName}</span>`;
            });
            selectedTagsEl.innerHTML = html;

            // Reset views
            tagEditMode.classList.add('d-none');
            tagDeleteMode.classList.add('d-none');
            tagViewMode.classList.remove('d-none');

            // Add selected tags to form
            const hiddenTagsWrapper = document.getElementById('hidden-tags-wrapper');
            hiddenTagsWrapper.innerHTML = '';

            checkedTags.forEach(tag => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tags[]';
                input.value = tag.value;
                hiddenTagsWrapper.appendChild(input);
            });
        });
    }

    // Click edit / delete
    tagList.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.btn-edit-tag');
        const deleteBtn = e.target.closest('.btn-delete-tag');

        if (editBtn) {
            const tagId = editBtn.dataset.id;
            const tagName = editBtn.dataset.name;
            const tagColor = editBtn.dataset.color;

            // Fill edit form
            editTagIdInput.value = tagId;
            editTagNameInput.value = tagName;
            editTagColorInput.value = tagColor || '#000000';

            tagViewMode.classList.add('d-none');
            tagEditMode.classList.remove('d-none');

        } else if (deleteBtn) {
            tagIdToDelete = deleteBtn.dataset.id;

            tagViewMode.classList.add('d-none');
            tagDeleteMode.classList.remove('d-none');
        }
    });

    // Submit edits
    editTagForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const tagId = editTagIdInput.value;
        const newName = editTagNameInput.value.trim();
        const newColor = editTagColorInput.value;

        axios.put(`/tags/${tagId}`, {
            name: newName,
            color: newColor
        })
        .then(response => {
            const updatedTag = response.data;
            const tagWrapper = document.querySelector(`[data-tag-id="${tagId}"]`);
            if (tagWrapper) {
                const label = tagWrapper.querySelector('label');
                if (label) label.textContent = updatedTag.name;

                const editBtn = tagWrapper.querySelector('.btn-edit-tag');
                if (editBtn) {
                    editBtn.dataset.name = updatedTag.name;
                    editBtn.dataset.color = updatedTag.color;
                }
            }

            tagEditMode.classList.add('d-none');
            tagViewMode.classList.remove('d-none');
        })
        .catch(error => {
            console.error(error);
            alert("Error updating tag");
        });
    });

    // Cancel edits
    cancelTagEditBtn.addEventListener('click', function () {
        tagEditMode.classList.add('d-none');
        tagViewMode.classList.remove('d-none');
    });

    // Confirm delete
    confirmTagDeleteBtn.addEventListener('click', function () {
        if (!tagIdToDelete) return;

        axios.delete(`/tags/${tagIdToDelete}`)
            .then(() => {
                const tagWrapper = document.querySelector(`[data-tag-id="${tagIdToDelete}"]`);
                if (tagWrapper) tagWrapper.remove();

                tagDeleteMode.classList.add('d-none');
                tagViewMode.classList.remove('d-none');
                tagIdToDelete = null;
            })
            .catch(error => {
                console.error(error);
                alert("Error deleting tag");
            }); 
    });

    // Cancel delete
    cancelTagDeleteBtn.addEventListener('click', function () {
        tagDeleteMode.classList.add('d-none');
        tagViewMode.classList.remove('d-none');
        tagIdToDelete = null;
    });
});