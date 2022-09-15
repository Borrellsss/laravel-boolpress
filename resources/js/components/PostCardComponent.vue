<template>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">
                {{post.title}}
            </h5>
            <div v-if="post.cover">
                <img class="w-100" :src="post.cover" :alt="post.title">
            </div>
            <p class="card-text">
                {{post.content.length > 80 ? post.content.slice(0, 80) + "..." : post.content}}
            </p>
            <router-link :to="{name: 'post-details', params: {slug: post.slug}}" class="btn btn-primary">
                Read More
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "PostCardComponent",
    props: {
        post: Object,
    },
    data() {
        return {

        }
    }
}
</script>