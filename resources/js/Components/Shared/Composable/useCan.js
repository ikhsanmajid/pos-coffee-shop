import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useCan() {
    const page = usePage();

    // 🛠️ UBAH DI SINI: Bungkus dengan Object.values()
    // Ini menjamin data yang dianalisis selalu berbentuk Array murni [['users:view', 'users:edit', ...]]
    const userPermissions = computed(() => {
        const permissions = page.props.auth?.permissions || [];
        return Array.isArray(permissions) ? permissions : Object.values(permissions);
    });

    const can = (permission) => {
        if (Array.isArray(permission)) {
            return permission.some(p => userPermissions.value.includes(p));
        }

        return userPermissions.value.includes(permission);
    };

    return {
        can
    };
}