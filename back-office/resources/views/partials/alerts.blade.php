@if (session('success') || session('error'))
    <div 
        class="alert w-50 mx-auto mt-5 alert-{{ session('success') ? 'success' : 'danger' }} alert-dismissible fade show"
        role="alert"
        id="alert">
        {{ session('success') ?? session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    {{-- Auto-hide script --}}
    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert');
            if (alert) alert.classList.remove('show');
        }, 5000);
    </script>
@endif