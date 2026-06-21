import { ref, onMounted, onUnmounted } from 'vue';

const isMobile = ref(false);
let listenerCount = 0;
let lastWidth = 0;

const checkBreakpoint = () => {
    if (window.innerWidth === lastWidth) return;
    lastWidth = window.innerWidth;
    isMobile.value = window.innerWidth < 1024;
};

export function useBreakpoint() {
    onMounted(() => {
        if (listenerCount === 0) {
            lastWidth = window.innerWidth;
            isMobile.value = window.innerWidth < 1024;
            window.addEventListener('resize', checkBreakpoint);
        }
        listenerCount++;
    });

    onUnmounted(() => {
        listenerCount--;
        if (listenerCount === 0) {
            window.removeEventListener('resize', checkBreakpoint);
        }
    });

    return { isMobile };
}
