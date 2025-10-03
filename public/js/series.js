// public/js/series.js

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize series functionality
    initializeSeriesSearch();
    initializeSeriesFilters();
    initializeFollowButtons();
    initializeViewToggle();
    initializeTimelineView();
    
    function initializeSeriesSearch() {
        const searchInput = document.querySelector('.series-search-input');
        const seriesCards = document.querySelectorAll('.series-card');
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                seriesCards.forEach(card => {
                    const title = card.querySelector('.series-title')?.textContent.toLowerCase() || '';
                    const subtitle = card.querySelector('.series-subtitle')?.textContent.toLowerCase() || '';
                    const description = card.querySelector('.series-description')?.textContent.toLowerCase() || '';
                    
                    const matches = title.includes(searchTerm) || 
                                  subtitle.includes(searchTerm) || 
                                  description.includes(searchTerm);
                    
                    if (matches || searchTerm === '') {
                        card.style.display = 'block';
                        card.style.animation = 'fadeIn 0.3s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                updateSeriesCount();
            });
        }
    }
    
    function initializeSeriesFilters() {
        const statusFilter = document.getElementById('status-filter');
        const genreFilter = document.getElementById('genre-filter');
        const sortSelect = document.getElementById('series-sort');
        const seriesCards = document.querySelectorAll('.series-card');
        
        // Filter functionality
        [statusFilter, genreFilter].forEach(filter => {
            if (filter) {
                filter.addEventListener('change', filterSeries);
            }
        });
        
        // Sort functionality
        if (sortSelect) {
            sortSelect.addEventListener('change', sortSeries);
        }
        
        function filterSeries() {
            const selectedStatus = statusFilter?.value || '';
            const selectedGenre = genreFilter?.value || '';
            
            seriesCards.forEach(card => {
                const status = card.dataset.status || '';
                const genre = card.dataset.genre || '';
                
                const matchesStatus = !selectedStatus || status === selectedStatus;
                const matchesGenre = !selectedGenre || genre === selectedGenre;
                
                if (matchesStatus && matchesGenre) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            updateSeriesCount();
        }
        
        function sortSeries() {
            const sortBy = sortSelect.value;
            const container = document.querySelector('.series-grid');
            const cards = Array.from(seriesCards);
            
            cards.sort((a, b) => {
                switch(sortBy) {
                    case 'title':
                        return a.querySelector('.series-title').textContent.localeCompare(
                               b.querySelector('.series-title').textContent);
                    case 'year':
                        return (b.dataset.year || 0) - (a.dataset.year || 0);
                    case 'issues':
                        return (b.dataset.issues || 0) - (a.dataset.issues || 0);
                    case 'popularity':
                        return (b.dataset.popularity || 0) - (a.dataset.popularity || 0);
                    default:
                        return 0;
                }
            });
            
            // Reappend sorted cards
            cards.forEach(card => container.appendChild(card));
        }
    }
    
    function initializeFollowButtons() {
        const followButtons = document.querySelectorAll('.btn-follow');
        
        followButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.className = 'fas fa-check';
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    showNotification('Following series!', 'success');
                } else {
                    icon.className = 'fas fa-plus';
                    this.innerHTML = '<i class="fas fa-plus"></i>';
                    showNotification('Unfollowed series!', 'info');
                }
            });
        });
    }
    
    function initializeViewToggle() {
        const viewButtons = document.querySelectorAll('.view-btn');
        const seriesContainer = document.querySelector('.series-grid');
        
        viewButtons.forEach(button => {
            button.addEventListener('click', function() {
                viewButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                const viewType = this.dataset.view;
                
                if (seriesContainer) {
                    if (viewType === 'grid') {
                        seriesContainer.style.gridTemplateColumns = 'repeat(auto-fill, minmax(350px, 1fr))';
                        seriesContainer.classList.remove('list-view');
                    } else if (viewType === 'list') {
                        seriesContainer.style.gridTemplateColumns = '1fr';
                        seriesContainer.classList.add('list-view');
                    }
                }
            });
        });
    }
    
    function initializeTimelineView() {
        const timelineItems = document.querySelectorAll('.timeline-item');
        
        // Animate timeline items on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        timelineItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(50px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    }
    
    function updateSeriesCount() {
        const visibleCards = document.querySelectorAll('.series-card[style*="display: block"], .series-card:not([style*="display: none"])');
        const countElement = document.querySelector('.series-count');
        
        if (countElement) {
            countElement.textContent = `${visibleCards.length} series found`;
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
    
    // Issue filtering on series detail pages
    function initializeIssueFiltering() {
        const issueSearch = document.getElementById('issue-search');
        const issueCards = document.querySelectorAll('.issue-card');
        
        if (issueSearch) {
            issueSearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                issueCards.forEach(card => {
                    const title = card.querySelector('.issue-title')?.textContent.toLowerCase() || '';
                    const number = card.querySelector('.issue-number')?.textContent.toLowerCase() || '';
                    
                    if (title.includes(searchTerm) || number.includes(searchTerm) || searchTerm === '') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    }
    
    // Initialize issue filtering if on series detail page
    if (document.querySelector('.issues-section')) {
        initializeIssueFiltering();
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
        
        .list-view .series-card {
            display: flex;
            max-width: 100%;
        }
        
        .list-view .series-card .series-banner {
            width: 200px;
            height: 150px;
            flex-shrink: 0;
        }
        
        .list-view .series-info {
            flex: 1;
        }
    `;
    document.head.appendChild(style);
    
    console.log('Series functionality loaded! 📚');
});
