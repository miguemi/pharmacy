import { StrictMode } from "react"
import { createInertiaApp } from "@inertiajs/react"
import { createRoot } from "react-dom/client"
import Layout from "./Layouts/Layout"

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.jsx", { eager: true })
        const page = pages[`./Pages/${name}.jsx`]
        page.default.layout =
            page.default.layout || ((page) => <Layout children={page} />)
        return page
    },
    setup({ el, App, props }) {
        createRoot(el).render(
            <StrictMode>
                <App {...props}></App>
            </StrictMode>,
        )
    },
})
