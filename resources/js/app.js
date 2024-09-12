import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import GuestLayout from './Layouts/GuestLayout.vue';
import store from './store';
import AdminLayout from './Layouts/AdminLayout.vue';
import { formatNumber } from './Helpers/formatNumber';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async(name) => {
       let page =  await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
       page = page.default;
       let defaultLayout = name.startsWith('Admin')
                ? AdminLayout
                : GuestLayout;
        if (page.layout === undefined) {
            page.layout = defaultLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(store)
            .provide('$formatNumber', formatNumber)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#0285FF',
    },
});
