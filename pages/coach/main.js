// Switch between tabs
function switchTab(tabName) {
    // Hide all tab contents
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.remove('active');
    });

    // Remove active class from all tabs
    const tabs = document.querySelectorAll('.nav-tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // Show selected tab
    document.getElementById(tabName).classList.add('active');

    // Add active class to clicked tab
    event.target.closest('.nav-tab').classList.add('active');
}

// Open modal
function openModal(modalId) {
    document.getElementById(modalId).classList.add('active');
}

// Close modal
function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('active');
}

// Close modal when clicking outside
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.classList.remove('active');
    }
}

// Delete seance
function deleteSeance(button) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')) {
        const card = button.closest('.seance-card');
        card.style.opacity = '0';
        setTimeout(() => {
            card.remove();
        }, 300);
        alert('Séance supprimée avec succès !');
    }
}

// Open edit modal
function openEditModal(button) {
    alert('Fonctionnalité de modification à implémenter');
    // Vous pouvez créer un autre modal pour l'édition
}

// Handle form submissions
// document.getElementById('addSeanceForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     alert('Séance créée avec succès !');
//     closeModal('addSeanceModal');
//     this.reset();
// });

// document.getElementById('profilForm').addEventListener('submit', function(e) {
//     e.preventDefault();
//     alert('Profil mis à jour avec succès !');
// });