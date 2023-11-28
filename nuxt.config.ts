// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    devtools: { enabled: true },
    extends: ["./client_admin", "./client_guest"],
    srcDir: "./client",
});
