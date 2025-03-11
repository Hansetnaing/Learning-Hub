const modal = document.getElementById("createGroupModal");
        const openModal = document.getElementById("createGroupBtn");
        const closeModal = document.getElementById("closeModal");

        openModal.onclick = function() {
            modal.style.display = "flex";
        }

        closeModal.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }    
