require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'The Message';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ 
                methods: {
                    route,
                    $can(permissionName) {
                        return this.$page.props.permissions.indexOf(permissionName) !== -1;
                    },
                    $defaultImage(event) {
                        // return event.target.src = "/images/default.png";
                    }
                } 
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
