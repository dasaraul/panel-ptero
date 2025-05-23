/*
 * TAMA EL PABLO Video Background - Simple & Fast
 */

let videoEnabled = true;
let videoLoaded = false;

// Immediate video load function
function loadVideoNow() {
    const iframe = document.getElementById('bg-video');
    if (!iframe) {
        console.log('❌ Video iframe not found');
        return;
    }
    
    const dataSrc = iframe.getAttribute('data-src');
    if (dataSrc && !videoLoaded) {
        iframe.src = dataSrc;
        videoLoaded = true;
        console.log('🎬 Video loading...');
        
        // Show video after load
        setTimeout(() => {
            iframe.style.opacity = '1';
            console.log('✅ Video loaded successfully');
        }, 2000);
    }
}

// Toggle video function
function toggleVideo() {
    const videoContainer = document.getElementById('video-bg');
    const toggleBtn = document.querySelector('.video-toggle');
    const icon = toggleBtn.querySelector('i');
    
    if (!videoContainer) return;
    
    if (videoEnabled) {
        videoContainer.style.display = 'none';
        icon.className = 'fa fa-eye-slash';
        videoEnabled = false;
        console.log('👁️ Video disabled');
    } else {
        videoContainer.style.display = 'block';
        icon.className = 'fa fa-eye';
        videoEnabled = true;
        console.log('👁️ Video enabled');
        
        // Load video if not loaded
        if (!videoLoaded) {
            loadVideoNow();
        }
    }
}

// Initialize immediately when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 TAMA Video Background initializing...');
    
    // Check if elements exist
    const videoContainer = document.getElementById('video-bg');
    const iframe = document.getElementById('bg-video');
    const toggleBtn = document.querySelector('.video-toggle');
    
    console.log('📋 Elements check:');
    console.log('- Video container:', videoContainer ? '✅' : '❌');
    console.log('- Video iframe:', iframe ? '✅' : '❌');
    console.log('- Toggle button:', toggleBtn ? '✅' : '❌');
    
    // Load video immediately
    if (iframe) {
        loadVideoNow();
    }
});

// Global function
window.toggleVideo = toggleVideo;

// Debug function
window.debugVideo = function() {
    console.log('🔍 Video Debug Info:');
    console.log('- Video enabled:', videoEnabled);
    console.log('- Video loaded:', videoLoaded);
    console.log('- Container:', document.getElementById('video-bg'));
    console.log('- Iframe:', document.getElementById('bg-video'));
    console.log('- Toggle:', document.querySelector('.video-toggle'));
};

console.log('🎬 TAMA Video script loaded - type debugVideo() for info');
