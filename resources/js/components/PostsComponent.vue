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
            <nav class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item" :class="{'disabled': currentPaginationPage === 1}">
                        <a class="page-link" href="#" @click.prevent="getPostApi(currentPaginationPage - 1)">Previous</a>
                    </li>
                    <li class="page-item" :class="{'active': pageNumber === currentPaginationPage}" v-for="pageNumber in lastPaginationPage" :key="pageNumber">
                        <a class="page-link" href="#" @click.prevent="getPostApi(pageNumber)">{{pageNumber}}</a>
                    </li>
                    <li class="page-item" :class="{'disabled': currentPaginationPage === lastPaginationPage}">
                        <a class="page-link" href="#" @click.prevent="getPostApi(currentPaginationPage + 1)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
</template>

<script>

export default {
    name: "Post",
    data() {
        return {
            posts: [],
            currentPaginationPage: null,
            lastPaginationPage: null
        }
    },
    methods: {
        getPostApi(pageNumber) {
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
        this.getPostApi(1);
    }
}
</script>