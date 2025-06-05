// Gets selected tools and fill hidden inputs
function initializeSelectedTools() {
    const checkedTools = document.querySelectorAll('input[name="tools[]"]:checked');
    const selectedToolsEl = document.getElementById('selected-tools');
    const hiddenToolsWrapper = document.getElementById('hidden-tools-wrapper');
    
    selectedToolsEl.innerHTML = '';
    hiddenToolsWrapper.innerHTML = '';
    
    checkedTools.forEach(tool => {
        const toolId = tool.getAttribute('id');
        const label = document.querySelector(`label[for="${toolId}"]`);
        const toolName = label ? label.textContent.trim() : 'undefined';

        // Badge
        selectedToolsEl.innerHTML += `<span class="badge bg-secondary me-1">${toolName}</span>`;

        // Hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'tools[]';
        input.value = tool.value;
        hiddenToolsWrapper.appendChild(input);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Initialise selected tools hidden inputs
    initializeSelectedTools()

    // Elements
    const addToolBtn = document.getElementById('add-tool-btn');
    const toolInput = document.getElementById('new-tool-name');
    const toolDescriptionInput = document.getElementById('new-tool-description');
    const toolLogoInput = document.getElementById('new-tool-logo');
    const toolList = document.getElementById('tool-list');
    const toolModal = document.getElementById('toolModal'); 
    const selectedToolsEl = document.getElementById('selected-tools');

    // Modal views
    const toolViewMode = document.getElementById('tool-view-mode');
    const toolEditMode = document.getElementById('tool-edit-mode');
    const toolDeleteMode = document.getElementById('tool-delete-mode');

    // Edit form inputs
    const editToolForm = document.getElementById('edit-tool-form');
    const editToolIdInput = document.getElementById('edit-tool-id');
    const editToolNameInput = document.getElementById('edit-tool-name');
    const editToolDescriptionInput = document.getElementById('edit-tool-description');
    const editToolLogoInput = document.getElementById('edit-tool-logo');
    const cancelToolEditBtn = document.getElementById('cancel-tool-edit-btn');

    // Delete confirmation buttons
    const confirmToolDeleteBtn = document.getElementById('confirm-tool-delete-btn');
    const cancelToolDeleteBtn = document.getElementById('cancel-tool-delete-btn');

    let toolIdToDelete = null;

    // Create new tag
    addToolBtn.addEventListener('click', function (event) {
        event.preventDefault();

        const toolName = toolInput.value.trim();
        const toolDescription = toolDescriptionInput.value;
        const toolLogo = toolLogoInput.value;
        if (!toolName) return;

        axios.post('/tools', { name: toolName, description: toolDescription, logo: toolLogo })
            .then(response => {
                const tool = response.data;
                const html = `
                    <div class="d-flex align-items-center mb-1" data-tool-id="${tool.id}">
                        <input type="checkbox" name="tools[]" value="${tool.id}" id="tool${tool.id}" checked class="me-2">
                        <label for="tool${tool.id}" class="form-label me-2 mb-0">${tool.name}</label>
                        <button type="button" class="btn btn-sm btn-outline-warning me-1 btn-edit-tool"
                                data-id="${tool.id}"
                                data-name="${tool.name}"
                                data-description="${tool.description}"
                                data-logo="${tool.logo_url}">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete-tool" 
                                data-id="${tool.id}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                `;
                toolList.insertAdjacentHTML('beforeend', html);
                toolInput.value = '';
                toolDescriptionInput.value = '';
                toolLogoInput.value = '';
            })
            .catch(error => {
                console.error(error);
                alert("Error creating tool");
            });
    });

    // Show selected tools in form
    if (toolModal) {
        toolModal.addEventListener('hidden.bs.modal', function () {
            const checkedTools = document.querySelectorAll('input[name="tools[]"]:checked');
            let html = '';
            checkedTools.forEach(tool => {
                const toolId = tool.getAttribute('id');
                const label = document.querySelector(`label[for="${toolId}"]`);
                const toolName = label ? label.textContent.trim() : 'undefined';
                html += `<span class="badge bg-secondary me-1">${toolName}</span>`;
            });
            selectedToolsEl.innerHTML = html;

            // Reset views
            toolEditMode.classList.add('d-none');
            toolDeleteMode.classList.add('d-none');
            toolViewMode.classList.remove('d-none');

            // Add selected tools to form
            const hiddenToolsWrapper = document.getElementById('hidden-tools-wrapper');
            hiddenToolsWrapper.innerHTML = ''; 

            checkedTools.forEach(tool => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'tools[]';
                input.value = tool.value;
                hiddenToolsWrapper.appendChild(input);
            });
        });
    }

    // Click edit / delete
    toolList.addEventListener('click', function (e) {
        const editToolBtn = e.target.closest('.btn-edit-tool');
        const deleteToolBtn = e.target.closest('.btn-delete-tool');

        if (editToolBtn) {
            const toolId = editToolBtn.dataset.id;
            const toolName = editToolBtn.dataset.name;
            const toolDescription = editToolBtn.dataset.description;
            const toolLogo = editToolBtn.dataset.logo;

            // Fill edit form
            editToolIdInput.value = toolId;
            editToolNameInput.value = toolName;
            editToolDescriptionInput.value = toolDescription;
            editToolLogoInput.value = toolLogo;

            toolViewMode.classList.add('d-none');
            toolEditMode.classList.remove('d-none');

        } else if (deleteToolBtn) {
            toolIdToDelete = deleteToolBtn.dataset.id;

            toolViewMode.classList.add('d-none');
            toolDeleteMode.classList.remove('d-none');
        }
    });

    // Submit edits
    editToolForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const toolId = editToolIdInput.value;
        const newToolName = editToolNameInput.value.trim();
        const newToolDescription = editToolDescriptionInput.value;
        const newToolLogo = editToolLogoInput.value;

        axios.put(`/tools/${toolId}`, {
            name: newToolName,
            description: newToolDescription,
            logo: newToolLogo
        })
        .then(response => {
            const updatedTool = response.data;
            const toolWrapper = document.querySelector(`[data-tool-id="${toolId}"]`);
            if (toolWrapper) {
                const label = toolWrapper.querySelector('label');
                if (label) label.textContent = updatedTool.name;

                const editToolBtn = toolWrapper.querySelector('.btn-edit-tool');
                if (editToolBtn) {
                    editToolBtn.dataset.name = updatedTool.name;
                    editToolBtn.dataset.description = updatedTool.description;
                    editToolBtn.dataset.logo = updatedTool.logo_url;
                }
            }

            toolEditMode.classList.add('d-none');
            toolViewMode.classList.remove('d-none');
        })
        .catch(error => {
            console.error(error);
            alert("Error updating tool");
        });
    });

    // Cancel edits
    cancelToolEditBtn.addEventListener('click', function () {
        toolEditMode.classList.add('d-none');
        toolViewMode.classList.remove('d-none');
    });

    // Confirm delete
    confirmToolDeleteBtn.addEventListener('click', function () {
        if (!toolIdToDelete) return;

        axios.delete(`/tools/${toolIdToDelete}`)
            .then(() => {
                const toolWrapper = document.querySelector(`[data-tool-id="${toolIdToDelete}"]`);
                if (toolWrapper) toolWrapper.remove();

                toolDeleteMode.classList.add('d-none');
                toolViewMode.classList.remove('d-none');
                toolIdToDelete = null;
            })
            .catch(error => {
                console.error(error);
                alert("Error deleting tool");
            }); 
    });

    // Cancel delete
    cancelToolDeleteBtn.addEventListener('click', function () {
        toolDeleteMode.classList.add('d-none');
        toolViewMode.classList.remove('d-none');
        toolIdToDelete = null;
    });
});