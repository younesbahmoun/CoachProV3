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

// Réserver une séance
function reserverSeance(button) {
    if (confirm('Confirmer la réservation de cette séance ?')) {
        const card = button.closest('.seance-card');
        const statusBadge = card.querySelector('.status-badge');
        
        // Change status
        statusBadge.textContent = 'Réservée';
        statusBadge.classList.remove('status-disponible');
        statusBadge.classList.add('status-reservee');
        
        // Change button
        button.outerHTML = '<button class="btn btn-danger btn-sm" onclick="annulerSeance(this)"><i class="fas fa-times"></i> Annuler</button>';
        
        alert('Séance réservée avec succès !');
    }
}

// Annuler une réservation
function annulerSeance(button) {
    if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')) {
        const card = button.closest('.seance-card');
        
        // Option 1: Remove the card
        card.style.opacity = '0';
        setTimeout(() => {
            card.remove();
        }, 300);
        
        alert('Réservation annulée avec succès !');
    }
}