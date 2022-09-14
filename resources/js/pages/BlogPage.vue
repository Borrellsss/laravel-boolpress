<template>
    <section>
        <PostsSectionComponent/>
    </section>
</template>

<script>
import PostsSectionComponent from "../components/PostsSectionComponent.vue";

export default {
    name: "BlogPage", 
    components: {
        PostsSectionComponent
    }
}
</script>