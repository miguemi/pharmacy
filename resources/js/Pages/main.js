import axios from "axios"

// vite assets
import.meta.glob(["../images/**"])

/* BASE CONFIGURATION FOR AXIOS */
axios.defaults.withCredentials = true
axios.defaults.withXSRFToken = true

/* GLOBAL EXPORTS */
window.axios = axios

/* UTILITIES */
window.fileDownloader = async function (url) {
    const response = await axios.get(url, {
        responseType: "blob",
    })

    const blobUrl = URL.createObjectURL(response.data)
    window.open(blobUrl, "_blank")
}

// handle colorscheme change
const isDark =
    localStorage.theme === "dark" ||
    (!("theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)

document.documentElement.setAttribute("data-theme", isDark ? "dark" : "light")
