<template>
    <section>
        <div class="container">
            <h2 class="mb-4">Posts List</h2>
            <div class="row row-cols-3">
                <div class="col" v-for="post in posts" :key="post.id">
                    <div class="card mb-4">
                        <!-- <img src="..." class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 class="card-title">
                                {{post.title}}
                            </h5>
                            <p class="card-text">
                                {{post.content.length > 80 ? post.content.slice(0, 80) + "..." : post.content}}
                            </p>
                            <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>

export default {
    name: "Post",
    data() {
        return {
            posts: [],
        }
    },
    methods: {
        getPostApi() {
            axios.get('/api/posts').then((response) => {
                console.log(response.data.response);
                this.posts = response.data.response;
            });
        }
    },
    mounted() {
        this.getPostApi();
    }
}
</script>
