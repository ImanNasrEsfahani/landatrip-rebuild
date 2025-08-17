import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import React from 'react'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./public/**/*.jsx', { eager: true })
        return pages[`./public/profile-page/App.jsx`]
    },
    setup({ el, App, props }) {
        createRoot(el).render(<App {...props} />)
    },
})
