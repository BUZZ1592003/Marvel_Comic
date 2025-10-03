// public/js/characters.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Character-specific functionality
    initializeCharacterSearch();
    animateCharacterStats();
    initializeCharacterFilters();
    
    function initializeCharacterSearch() {
        const searchInput = document.getElementById('character-search');
        const filterSelect = document.getElementById('character-filter');
        const characterCards = document.querySelectorAll('.character-card');

        if (searchInput && filterSelect) {
            searchInput.addEventListener('input', filterCharacters);
            filterSelect.addEventListener('change', filterCharacters);
        }

        function filterCharacters() {
            const searchTerm = searchInput.value.toLowerCase();
            const filterType = filterSelect.value;

            characterCards.forEach(card => {
                const name = card.querySelector('.character-name')?.textContent.toLowerCase() || '';
                const alias = card.querySelector('.character-alias')?.textContent.toLowerCase() || '';
                const type = card.dataset.type;

                const matchesSearch = name.includes(searchTerm) || alias.includes(searchTerm);
                const matchesFilter = !filterType || type === filterType;

                if (matchesSearch && matchesFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    }

    function animateCharacterStats() {
        const statBars = document.querySelectorAll('.stat-fill-detailed');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const targetWidth = bar.style.width;
                    bar.style.width = '0%';
                    
                    setTimeout(() => {
                        bar.style.width = targetWidth;
                    }, 200);
                    
                    observer.unobserve(bar);
                }
            });
        });

        statBars.forEach(bar => observer.observe(bar));
    }

    function initializeCharacterFilters() {
        const badges = document.querySelectorAll('.character-badge');
        
        badges.forEach(badge => {
            badge.addEventListener('click', function() {
                const filterType = this.textContent.toLowerCase();
                const filterSelect = document.getElementById('character-filter');
                
                if (filterSelect) {
                    filterSelect.value = filterType === 'hero' ? 'hero' : 
                                         filterType === 'villain' ? 'villain' : 
                                         filterType === 'anti-hero' ? 'antihero' : '';
                    filterSelect.dispatchEvent(new Event('change'));
                }
            });
        });
    }

    console.log('Character page functionality loaded! 🦸‍♂️');
});
