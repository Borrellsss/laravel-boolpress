<template>
    <div class="error">
        <div class="error-code">
            <span>404</span>
            <div class="error-text">
                PAGE NOT FOUND
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "ErrorPage",
    components: {
        
    },
    data() {
        return {
            
        }
    }
}
</script>

<style lang="scss" scoped>
.error {
    width: 100%;
    height: 80vh;
    position: relative;

    > .error-code {
        position: absolute;
        top: 50%;
        left: 50%;
        translate: -50% -50%;
        text-align: center;
        
        > span {
            font-size: 5rem;
            color: #d90000;
        }
        > .error-text {
            font-size: 1.3rem;
        }
    }
}
</style>