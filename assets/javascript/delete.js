let deleteUrl = null;

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        deleteUrl = this.href;
        document.getElementById('deleteModal').style.display = 'flex';
    });
});

document.getElementById('confirmDelete').addEventListener('click', () => {
    if (deleteUrl) {
        window.location.href = deleteUrl;
    }
});

document.getElementById('cancelDelete').addEventListener('click', () => {
    deleteUrl = null;
    document.getElementById('deleteModal').style.display = 'none';
});
