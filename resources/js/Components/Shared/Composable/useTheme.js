import { ref, watchEffect } from 'vue';

const theme = ref(localStorage.getItem('theme') || 'light');

export function useTheme() {
    const setTheme = (value) => {
        theme.value = value;
        localStorage.setItem('theme', value);
    }

    const toggleTheme = () => {
        if (theme.value === 'light') {
            setTheme('dark');
            document.documentElement.classList.add('dark');
        } else {
            setTheme('light');
            document.documentElement.classList.remove('dark');
        }
    }

    return { theme, setTheme, toggleTheme }
}