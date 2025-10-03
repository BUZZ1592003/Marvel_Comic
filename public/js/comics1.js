document.addEventListener('DOMContentLoaded', function() {
    // Comic Reader Functionality
    let currentPage = 1;
    let totalPages = 22;
    let currentMode = 'single';
    let zoomLevel = 1;
    
    const readerControls = document.getElementById('reader-controls');
    const pageInfo = document.getElementById('page-info');
    const comicImages = document.querySelectorAll('.comic-page-image');
    
    // Navigation buttons
    const firstPageBtn = document.getElementById('first-page');
    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const lastPageBtn = document.getElementById('last-page');
    
    // Mode toggle buttons
    const singlePageBtn = document.getElementById('single-page');
    const doublePageBtn = document.getElementById('double-page');
    const continuousBtn = document.getElementById('continuous-scroll');
    
    // Other controls
    const startReadingBtn = document.getElementById('start-reading');
    const fullscreenBtn = document.getElementById('fullscreen-btn');
    const zoomInBtn = document.getElementById('zoom-in');
    const zoomOutBtn = document.getElementById('zoom-out');
    const favoriteBtn = document.getElementById('add-favorite');
    
    // Initialize reader
    function updatePageDisplay() {
        if (currentMode === 'single') {
            document.querySelectorAll('#single-page-reader .comic-page-container').forEach((page, index) => {
                page.style.display = index === currentPage - 1 ? 'block' : 'none';
            });
        } else if (currentMode === 'double') {
            const doublePageIndex = Math.ceil(currentPage / 2) - 1;
            document.querySelectorAll('#double-page-reader .comic-page-container').forEach((page, index) => {
                page.style.display = index === doublePageIndex ? 'block' : 'none';
            });
        }
        
        // Update controls
        firstPageBtn.disabled = currentPage === 1;
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
        lastPageBtn.disabled = currentPage === totalPages;
        pageInfo.textContent = `${currentPage} / ${totalPages}`;
    }
    
    // Navigation event listeners
    firstPageBtn.addEventListener('click', () => {
        currentPage = 1;
        updatePageDisplay();
        scrollToTop();
    });
    
    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            updatePageDisplay();
            scrollToTop();
        }
    });
    
    nextPageBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            updatePageDisplay();
            scrollToTop();
        }
    });
    
    lastPageBtn.addEventListener('click', () => {
        currentPage = totalPages;
        updatePageDisplay();
        scrollToTop();
    });
    
    // Reading mode toggles
    function switchMode(mode) {
        currentMode = mode;
        
        // Hide all readers
        document.querySelectorAll('.reader-mode').forEach(reader => {
            reader.style.display = 'none';
        });
        
        // Show selected reader
        document.getElementById(mode + '-reader').style.display = 'block';
        
        // Update toggle buttons
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        if (mode === 'single') {
            singlePageBtn.classList.add('active');
            readerControls.style.display = 'flex';
        } else if (mode === 'double') {
            doublePageBtn.classList.add('active');
            readerControls.style.display = 'flex';
        } else if (mode === 'continuous') {
            continuousBtn.classList.add('active');
            readerControls.style.display = 'none';
        }
        
        updatePageDisplay();
    }
    
    singlePageBtn.addEventListener('click', () => switchMode('single'));
    doublePageBtn.addEventListener('click', () => switchMode('double'));
    continuousBtn.addEventListener('click', () => switchMode('continuous'));
    
    // Start reading button
    startReadingBtn.addEventListener('click', () => {
        document.getElementById('comic-reader').scrollIntoView({ behavior: 'smooth' });
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (currentMode !== 'continuous') {
            if (e.key === 'ArrowLeft' && currentPage > 1) {
                currentPage--;
                updatePageDisplay();
                scrollToTop();
            } else if (e.key === 'ArrowRight' && currentPage < totalPages) {
                currentPage++;
                updatePageDisplay();
                scrollToTop();
            }
        }
    });
    
    // Zoom functionality
    zoomInBtn.addEventListener('click', () => {
        if (zoomLevel < 3) {
            zoomLevel += 0.25;
            applyZoom();
        }
    });
    
    zoomOutBtn.addEventListener('click', () => {
        if (zoomLevel > 0.5) {
            zoomLevel -= 0.25;
            applyZoom();
        }
    });
    
    function applyZoom() {
        comicImages.forEach(img => {
            img.style.transform = `scale(${zoomLevel})`;
        });
    }
    
    // Fullscreen toggle
    fullscreenBtn.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            document.getElementById('comic-reader').requestFullscreen();
            fullscreenBtn.innerHTML = '<i class="fas fa-compress"></i>';
        } else {
            document.exitFullscreen();
            fullscreenBtn.innerHTML = '<i class="fas fa-expand"></i>';
        }
    });
    
    // Favorite toggle
    favoriteBtn.addEventListener('click', function() {
        this.classList.toggle('active');
        const icon = this.querySelector('i');
        if (this.classList.contains('active')) {
            icon.className = 'fas fa-heart';
            this.innerHTML = '<i class="fas fa-heart"></i> Added to Favorites';
            showNotification('Added to favorites!', 'success');
        } else {
            icon.className = 'far fa-heart';
            this.innerHTML = '<i class="far fa-heart"></i> Add to Favorites';
            showNotification('Removed from favorites!', 'info');
        }
    });
    
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    
    function showNotification(message, type) {
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
        setTimeout(() => notification.remove(), 3000);
    }
    
    // Initialize
    updatePageDisplay();
    
    console.log('Comic reader loaded! 📖');
});