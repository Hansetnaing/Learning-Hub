function toggleEditForm() {
    const editForm = document.getElementById('editForm');
    if (editForm.style.display === 'none' || editForm.style.display === '') {
        editForm.style.display = 'block';
    } else {
        editForm.style.display = 'none';
    }
}

window.onload = function () {
    if (sessionStorage.getItem('modalState') === 'open') {
        document.getElementById('editForm').style.display = 'block';
    }
};
