<template>
    <header>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <router-link :to="{'name': home}" class="nav-link">
                            <i class="fa-solid fa-house"></i>
                        </router-link>
                    </li> -->
                    <li v-for="(link,index) in headerLinks" :key="index" class="nav-item">
                        <router-link :to="{'name': link.name}" class="nav-link">
                            {{link.label.toUpperCase()}}
                        </router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</template>

<script>

export default {
    name: "HeaderComponent",
    components: {
        
    },
    data() {
        return {
            headerLinks: [
                {
                    name: 'home',
                    label: 'home',
                },
                {
                    name: 'about',
                    label: 'about',
                },
                {
                    name: 'blog',
                    label: 'blog',
                },
                {
                    name: 'contact-us',
                    label: 'contact us',
                },
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
header {
    margin-bottom: 2rem;
    box-shadow: 0 0 5px #000;

    > nav {
        background-color: #e3e3e3;
    }
}
.nav-link {
    color: #181818;

    &:hover {
        color: #006eff;
    }
}
</style>