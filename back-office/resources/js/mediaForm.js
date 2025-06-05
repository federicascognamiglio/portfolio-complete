document.addEventListener('DOMContentLoaded', () => {
    // Data from DOM
    const mediaList = document.getElementById('media-grid');
    const newMediaForm = document.getElementById('new-media-form');
    const actionUrl = newMediaForm.dataset.action;
    const deleteConfirmBtn = document.getElementById('confirm-media-delete-btn');
    const cancelAddBtn = document.getElementById('cancel-media-add-btn');
    const cancelDeleteBtn = document.getElementById('cancel-media-delete-btn');
    const modal = document.getElementById('mediaModal');
    const projectId = modal.dataset.projectId;

    // Function to switch between media modes
    function switchMediaMode(mode) {
        document.getElementById('media-view-mode').classList.toggle('d-none', mode !== 'view');
        document.getElementById('media-add-mode').classList.toggle('d-none', mode !== 'add');
        document.getElementById('media-delete-mode').classList.toggle('d-none', mode !== 'delete');
    }

    // Function to create a media card
    function createMediaCard(media) {
        const card = document.createElement('div');
        card.classList.add('position-relative', 'media-thumbnail', 'media-card');
        card.setAttribute('data-id', media.id);
        card.style.width = '100px';
        card.style.height = '100px';
    
        let content;
        if (media.type === 'IMAGE') {
            content = `
                <img src="/storage/${media.url}" class="img-fluid rounded" 
                     style="object-fit: cover; width: 100%; height: 100%;" alt="Image">
            `;
        } else if (media.type === 'VIDEO') {
            content = `
                <div class="bg-dark text-white d-flex align-items-center justify-content-center rounded" 
                    style="width: 100%; height: 100%;">
                    <i class="bi bi-play-circle fs-1"></i>
                </div>
            `;
        } else if (media.type === 'GIF') {
            content = `
                <div class="bg-warning text-white d-flex align-items-center justify-content-center rounded" 
                    style="width: 100%; height: 100%;">
                    <span class="fw-bold">GIF</span>
                </div>
            `;
        }
    
        card.innerHTML = `
            ${content}
            <button class="position-absolute top-0 end-0 d-none delete-media-btn"
                data-id="{{ $item->id }}" style="width: 100px; height: 100px; background-color: white">
                <i class="fa-solid fa-trash fs-5" style="color: black"></i>
            </button>
        `;
    
        const deleteBtn = card.querySelector('.delete-media-btn');
        card.addEventListener('mouseenter', () => deleteBtn.classList.remove('d-none'));
        card.addEventListener('mouseleave', () => deleteBtn.classList.add('d-none'));
    
        deleteBtn.addEventListener('click', () => {
            document.getElementById('media-delete-mode').dataset.mediaId = media.id;
            switchMediaMode('delete');
        });
    
        return card;
    }

    // Event to handle new media form submission
    newMediaForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('project_id', projectId);

        axios.post(actionUrl, formData)
            .then(response => {
                const media = response.data;
                const mediaCard = createMediaCard(media);
                const addButton = document.getElementById('add-media-trigger');
                mediaList.insertBefore(mediaCard, addButton);
                newMediaForm.reset();
                switchMediaMode('view');
            })
            .catch(error => {
                console.error('Error saving media:', error.response.data);
            });
    });

    // Event to handle delete confirmation
    deleteConfirmBtn.addEventListener('click', () => {
        const mediaId = document.getElementById('media-delete-mode').dataset.mediaId;

        axios.delete(`/media/${mediaId}`)
            .then(response => {
                const cardToRemove = document.querySelector(`.media-card[data-id="${mediaId}"]`);
                if (cardToRemove) cardToRemove.remove();
                switchMediaMode('view');
            })
            .catch(error => {
                console.error('Error deleting media:', error.response.data);
            });
    });

    // Cards delete button hover event
    document.querySelectorAll('.media-card').forEach(card => {
        const deleteBtn = card.querySelector('.delete-media-btn');
    
        card.addEventListener('mouseenter', () => {
            deleteBtn?.classList.remove('d-none');
        });
    
        card.addEventListener('mouseleave', () => {
            deleteBtn?.classList.add('d-none');
        });
    
        // Enable delete feature at start
        deleteBtn?.addEventListener('click', () => {
            const mediaId = deleteBtn.dataset.id;
            document.getElementById('media-delete-mode').dataset.mediaId = mediaId;
            switchMediaMode('delete');
        });
    });

    // Event to handle cancel buttons
    cancelAddBtn.addEventListener('click', () => switchMediaMode('view'));
    cancelDeleteBtn.addEventListener('click', () => switchMediaMode('view'));

    // Event to handle add media button
    const addMediaBtn = document.getElementById('add-media-trigger');
    if (addMediaBtn) {
        addMediaBtn.addEventListener('click', () => switchMediaMode('add'));
    }
});
