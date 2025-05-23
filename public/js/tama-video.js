/*
 * TAMA EL PABLO Optimized Video Background Controller
 * Lightweight and performance-focused
 */

let videoEnabled = true;
let videoLoaded = false;
let isLowEndDevice = false;

// Device detection for optimization
function detectDevice() {
    const userAgent = navigator.userAgent.toLowerCase();
    const isMobile = /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
    const isOldBrowser = !window.requestAnimationFrame || !window.CSS || !CSS.supports;
    const hasLowRAM = navigator.deviceMemory && navigator.deviceMemory < 4;
    
    isLowEndDevice = isMobile || isOldBrowser || hasLowRAM;
    
    if (isLowEndDevice) {
        console.log('🔧 Low-end device detected, optimizing...');
        document.body.classList.add('low-end-device');
    }
}

// Lazy load video
function initVideo() {
    const videoContainer = document.getElementById('video-bg');
    const iframe = document.getElementById('bg-video');
    
    if (!videoContainer || !iframe) return;
    
    // Skip video on very low-end devices
    if (isLowEndDevice && (navigator.connection && navigator.connection.effectiveType === '2g')) {
        videoContainer.style.display = 'none';
        return;
    }
    
    // Intersection observer for lazy loading
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !videoLoaded) {
                loadVideo();
                observer.unobserve(entry.target);
            }
        });
    });
    
    observer.observe(videoContainer);
}

// Load video with optimization
function loadVideo() {
    const iframe = document.getElementById('bg-video');
    if (!iframe || videoLoaded) return;
    
    const src = iframe.getAttribute('data-src');
    
    // Add quality parameter based on device
    const optimizedSrc = isLowEndDevice 
        ? src + '&quality=small&hd=0' 
        : src + '&quality=medium&hd=0';
    
    iframe.src = optimizedSrc;
    videoLoaded = true;
    
    // Add loaded class after delay
    setTimeout(() => {
        iframe.classList.add('loaded');
    }, 1000);
    
    console.log('🎬 Video background loaded');
}

// Toggle video function
function toggleVideo() {
    const videoContainer = document.getElementById('video-bg');
    const toggleBtn = document.querySelector('.video-toggle');
    const icon = toggleBtn.querySelector('i');
    
    if (videoEnabled) {
        videoContainer.style.opacity = '0';
        icon.className = 'fa fa-eye-slash';
        videoEnabled = false;
        toggleBtn.title = 'Enable video background';
    } else {
        videoContainer.style.opacity = '1';
        icon.className = 'fa fa-eye';
        videoEnabled = true;
        toggleBtn.title = 'Disable video background';
        
        // Load video if not loaded
        if (!videoLoaded) {
            loadVideo();
        }
    }
}

// Performance monitoring
function monitorPerformance() {
    if (!window.performance) return;
    
    const observer = new PerformanceObserver((list) => {
        const entries = list.getEntries();
        entries.forEach(entry => {
            if (entry.duration > 100) {
                console.warn('🐌 Performance issue detected:', entry.name);
            }
        });
    });
    
    observer.observe({entryTypes: ['measure', 'navigation']});
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    detectDevice();
    initVideo();
    monitorPerformance();
    
    // Add performance hints
    if ('connection' in navigator) {
        const connection = navigator.connection;
        if (connection.effectiveType === '2g' || connection.effectiveType === 'slow-2g') {
            document.body.classList.add('slow-connection');
        }
    }
});

// Pause video when page is hidden (performance optimization)
document.addEventListener('visibilitychange', function() {
    const iframe = document.getElementById('bg-video');
    if (!iframe) return;
    
    if (document.hidden) {
        iframe.style.display = 'none';
    } else {
        iframe.style.display = 'block';
    }
});

// Global function for layout
window.toggleVideo = toggleVideo;
