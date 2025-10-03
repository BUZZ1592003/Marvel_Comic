// public/js/comics.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize comics functionality
    initializeComicsSearch();
    initializeComicsFilters();
    initializeFavorites();
    initializeComicReader();
    initializeViewToggle();
    
    function initializeComicsSearch() {
        const searchInput = document.querySelector('.comic-search-input');
        const comicCards = document.querySelectorAll('.comic-card-enhanced');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                comicCards.forEach(card => {
                    const title = card.querySelector('.comic-main-title')?.textContent.toLowerCase() || '';
                    const series = card.querySelector('.comic-series-title')?.textContent.toLowerCase() || '';
                    const description = card.querySelector('.comic-description-enhanced')?.textContent.toLowerCase() || '';
                    
                    const matches = title.includes(searchTerm) || 
                                  series.includes(searchTerm) || 
                                  description.includes(searchTerm);
                    
                    if (matches || searchTerm === '') {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.3s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                updateResultsCount();
            });
        }
    }
    
    function initializeComicsFilters() {
        const seriesFilter = document.getElementById('series-filter');
        const yearFilter = document.getElementById('year-filter');
        const sortSelect = document.getElementById('sort-select');
        const comicCards = document.querySelectorAll('.comic-card-enhanced');
        
        // Filter functionality
        [seriesFilter, yearFilter].forEach(filter => {
            if (filter) {
                filter.addEventListener('change', filterComics);
            }
        });
        
        // Sort functionality
        if (sortSelect) {
            sortSelect.addEventListener('change', sortComics);
        }
        
        function filterComics() {
            const selectedSeries = seriesFilter?.value || '';
            const selectedYear = yearFilter?.value || '';
            
            comicCards.forEach(card => {
                const series = card.dataset.series || '';
                const year = card.dataset.year || '';
                
                const matchesSeries = !selectedSeries || series === selectedSeries;
                const matchesYear = !selectedYear || year === selectedYear;
                
                if (matchesSeries && matchesYear) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateResultsCount();
        }
        
        function sortComics() {
            const sortBy = sortSelect.value;
            const container = document.querySelector('.comics-grid');
            const cards = Array.from(comicCards);
            
            cards.sort((a, b) => {
                switch(sortBy) {
                    case 'title':
                        return a.querySelector('.comic-main-title').textContent.localeCompare(
                               b.querySelector('.comic-main-title').textContent);
                    case 'year':
                        return (b.dataset.year || 0) - (a.dataset.year || 0);
                    case 'rating':
                        return (b.dataset.rating || 0) - (a.dataset.rating || 0);
                    default:
                        return 0;
                }
            });
            
            // Reappend sorted cards
            cards.forEach(card => container.appendChild(card));
        }
    }
    
    function initializeFavorites() {
        const favoriteButtons = document.querySelectorAll('.btn-favorite');
        
        favoriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.className = 'fas fa-heart';
                    showNotification('Added to favorites!', 'success');
                } else {
                    icon.className = 'far fa-heart';
                    showNotification('Removed from favorites!', 'info');
                }
            });
        });
    }
    
    function initializeComicReader() {
        const readerControls = document.querySelector('.reader-controls');
        const comicPages = document.querySelectorAll('.comic-page-image');
        let currentPage = 0;
        
        if (readerControls && comicPages.length > 0) {
            const prevBtn = readerControls.querySelector('#prev-page');
            const nextBtn = readerControls.querySelector('#next-page');
            const pageInfo = readerControls.querySelector('#page-info');
            
            function updatePageDisplay() {
                // Hide all pages
                comicPages.forEach((page, index) => {
                    page.parentElement.style.display = index === currentPage ? 'block' : 'none';
                });
                
                // Update controls
                if (prevBtn) prevBtn.disabled = currentPage === 0;
                if (nextBtn) nextBtn.disabled = currentPage === comicPages.length - 1;
                if (pageInfo) pageInfo.textContent = `${currentPage + 1} / ${comicPages.length}`;
            }
            
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    if (currentPage > 0) {
                        currentPage--;
                        updatePageDisplay();
                        scrollToTop();
                    }
                });
            }
            
            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    if (currentPage < comicPages.length - 1) {
                        currentPage++;
                        updatePageDisplay();
                        scrollToTop();
                    }
                });
            }
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft' && currentPage > 0) {
                    currentPage--;
                    updatePageDisplay();
                    scrollToTop();
                } else if (e.key === 'ArrowRight' && currentPage < comicPages.length - 1) {
                    currentPage++;
                    updatePageDisplay();
                    scrollToTop();
                }
            });
            
            updatePageDisplay();
        }
    }
    
    function initializeViewToggle() {
        const toggleButtons = document.querySelectorAll('.toggle-btn');
        const comicsGrid = document.querySelector('.comics-grid');
        
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                toggleButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const viewType = this.dataset.view;
                
                if (comicsGrid) {
                    if (viewType === 'grid') {
                        comicsGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(300px, 1fr))';
                    } else if (viewType === 'list') {
                        comicsGrid.style.gridTemplateColumns = '1fr';
                    }
                }
            });
        });
    }
    
    function updateResultsCount() {
        const visibleCards = document.querySelectorAll('.comic-card-enhanced[style*="display: block"], .comic-card-enhanced:not([style*="display: none"])');
        const resultsCount = document.querySelector('.results-count');
        
        if (resultsCount) {
            resultsCount.textContent = `Showing ${visibleCards.length} comics`;
        }
    }
    
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#4CAF50' : '#2196F3'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
    
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    
    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
        
        @keyframes slideOut {
            from { transform: translateX(0); }
            to { transform: translateX(100%); }
        }
    `;
    document.head.appendChild(style);
    
    console.log('Comics functionality loaded! 📚');
});
