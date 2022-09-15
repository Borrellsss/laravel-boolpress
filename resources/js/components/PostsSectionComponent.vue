<template>
    <section>
        <div class="container">
            <h2 class="mb-4">Posts List</h2>
            <div class="row row-cols-2">
                <div class="col" v-for="singlePost in posts" :key="singlePost.id">
                    <PostCardComponent :post="singlePost"/>
                </div>
            </div>
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{'disabled': currentPaginationPage === 1}">
                        <a class="page-link" href="#" @click.prevent="getPostsApi(currentPaginationPage - 1)">Previous</a>
                    </li>
                    <li class="page-item" :class="{'active': pageNumber === currentPaginationPage}" v-for="pageNumber in lastPaginationPage" :key="pageNumber">
                        <a class="page-link" href="#" @click.prevent="getPostsApi(pageNumber)">{{pageNumber}}</a>
                    </li>
                    <li class="page-item" :class="{'disabled': currentPaginationPage === lastPaginationPage}">
                        <a class="page-link" href="#" @click.prevent="getPostsApi(currentPaginationPage + 1)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</template>

<script>
import PostCardComponent from "./PostCardComponent.vue"

export default {
    name: "PostsSectionComponent",
    components: {
        PostCardComponent
    },
    data() {
        return {
            posts: [],
            currentPaginationPage: null,
            lastPaginationPage: null
        }
    },
    methods: {
        getPostsApi(pageNumber) {
            axios.get('/api/posts', {
                params: {
                    page: pageNumber
                }
            }).then((response) => {
                // !DEBUG
                // console.log(response);

                this.posts = response.data.results.data;
                this.currentPaginationPage = response.data.results.current_page;
                this.lastPaginationPage = response.data.results.last_page;
            });
        }
    },
    mounted() {
        this.getPostsApi(1);
    }
}
</script>