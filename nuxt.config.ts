// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: {enabled: true},
    css: [
        '~/assets/css/custom.css',
    ],
    ssr: true,
    app: {
        head: {
            link: [{rel: 'stylesheet', href: 'https://static.fontawesome.com/css/fontawesome-app.css'}],
        },
    },
    postcss: {
        plugins: {
            tailwindcss: {},
            autoprefixer: {},
        },
    },
    modules: [
        '@nuxtjs/google-fonts',
        '@vesp/nuxt-fontawesome',
    ],
    googleFonts: {
        families: {
            Poppins: [100,200,300,400,500,600,700,800,900],
        },
    },
    fontawesome: {
        icons: {
            solid: ['chevron-up', 'chevron-down'],
        },
    },
})
