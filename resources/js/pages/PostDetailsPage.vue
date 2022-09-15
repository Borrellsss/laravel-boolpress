<template>
    <div class="container">
        <div v-if="post">
            <h1 class="mb-3">{{post.title}}</h1>
            <div v-if="post.category" class="mb-3">
                <strong>Category:</strong>
                {{post.category.name}}
            </div>
            <div v-if="post.tags.length > 0" class="mb-3">
                <strong>Tags:</strong>
                <span v-for="tag in post.tags" :key="tag.id">{{post.tags[post.tags.length - 1] !== tag ? `${tag.name}, ` : tag.name}}</span>
            </div>
            <div v-if="post.cover" class="mb-3">
                <img class="w-50" :src="post.cover" :alt="post.title">
            </div>
            <p>{{post.content}}</p>
        </div>
        <div v-else>
            caricamento
        </div>
    </div>
</template>

<script>
export default {
    name: "PostDetailsPage",
    components: {

    },
    data() {
        return {
            post: null,
        }
    },
    methods: {
        
    },
    mounted() {
        axios.get(`/api/posts/${this.$route.params.slug}`).then((response) => {
            console.log(response.data.results);

            if(response.data.success) {
                this.post = response.data.results;
            } else {
                this.$router.push({name: 'error'});
            }
        });
    }
}
</script>
