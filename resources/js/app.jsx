import './bootstrap';
import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'
import DashboardLayout from '@/layout/DashboardLayout.jsx'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.jsx', { eager: true })
        let page = pages[`./Pages/${name}.jsx`]
        page.default.layout = page.default.layout || ((page) => <DashboardLayout children={page} />)
        return page
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />)
    },
})
