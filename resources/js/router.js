import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomePage from "./pages/HomePage.vue";
import AboutPage from "./pages/AboutPage.vue";
import BlogPage from "./pages/BlogPage.vue";
import PostDetailsPage from "./pages/PostDetailsPage.vue";
import ErrorPage from "./pages/ErrorPage.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: HomePage
        },
        {
            path: "/about",
            name: "about",
            component: AboutPage
        },
        {
            path: "/blog",
            name: "blog",
            component: BlogPage
        },
        {
            path: "/blog/:slug",
            name: "post-details",
            component: PostDetailsPage
        },
        {
            path: "/*",
            name: "error",
            component: ErrorPage
        }
    ]
});

export default router;