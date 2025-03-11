function openAssignmentModal() {
    document.getElementById('assignmentModal').style.display = 'flex';
}

function closeAssignmentModal() {
    document.getElementById('assignmentModal').style.display = 'none';
}

function openLectureModal() {
    document.getElementById('lectureModal').style.display = 'flex';
}

function closeLectureModal() {
    document.getElementById('lectureModal').style.display = 'none';
}

window.onclick = (event) => {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
};
