// Fonction pour animer les éléments lors du défilement
function animateOnScroll() {
    const elements = document.querySelectorAll('.animate__animated');
    
    elements.forEach(element => {
        const elementTop = element.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;
        
        if (elementTop < windowHeight - 50) {
            // Réactive l'animation quand l'élément est visible
            const animationClass = Array.from(element.classList).find(className => 
                className.startsWith('animate__') && className !== 'animate__animated'
            );
            
            if (animationClass && element.style.visibility === 'hidden') {
                element.style.visibility = 'visible';
                element.classList.add(animationClass);
            }
        } else {
            // Cache et réinitialise l'animation quand l'élément n'est pas visible
            element.style.visibility = 'hidden';
            const animationClass = Array.from(element.classList).find(className => 
                className.startsWith('animate__') && className !== 'animate__animated'
            );
            if (animationClass) {
                element.classList.remove(animationClass);
            }
        }
    });
}

// Fonction pour confirmer la suppression
function confirmDelete(event, type) {
    if (!confirm(`Êtes-vous sûr de vouloir supprimer ${type === 'student' ? 'cet étudiant' : 'cette filière'} ?`)) {
        event.preventDefault();
    }
}

// Validation des formulaires
document.addEventListener('DOMContentLoaded', function() {
    // Validation du formulaire d'inscription
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                event.preventDefault();
                alert('Les mots de passe ne correspondent pas !');
            }
        });
    }

    // Preview de l'image de profil
    const profileInput = document.getElementById('profileImage');
    const profilePreview = document.getElementById('imagePreview');
    if (profileInput && profilePreview) {
        profileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                    profilePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Animation initiale des éléments visibles
    animateOnScroll();
    
    // Anime les éléments lors du défilement
    window.addEventListener('scroll', animateOnScroll);
    
    // Ajoute un effet de parallaxe sur l'image héro
    const heroImage = document.querySelector('.hero-image');
    if (heroImage) {
        window.addEventListener('mousemove', function(e) {
            const mouseX = e.clientX / window.innerWidth - 0.5;
            const mouseY = e.clientY / window.innerHeight - 0.5;
            
            heroImage.style.transform = `translate(${mouseX * 20}px, ${mouseY * 20}px)`;
        });
    }
    
    // Effet de survol sur les cartes de fonctionnalités
    const featureCards = document.querySelectorAll('.feature-card');
    featureCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
        });
    });
});

// Filtrage des tableaux
function filterTable(inputId, tableId) {
    const input = document.getElementById(inputId);
    const filter = input.value.toLowerCase();
    const table = document.getElementById(tableId);
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        let display = false;
        const cells = rows[i].getElementsByTagName('td');
        
        for (let cell of cells) {
            if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                display = true;
                break;
            }
        }
        
        rows[i].style.display = display ? '' : 'none';
    }
}