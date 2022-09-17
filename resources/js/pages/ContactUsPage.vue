<template>
    <section>
        <div class="container">
            <div v-if="emailSent" class="alert alert-success" role="alert">
                <span>Email Sent</span>
            </div>
            <form @submit.prevent="sendDataApi()">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input v-model="userName" type="text" class="form-control" id="name" placeholder="John Doe">
                    <div v-if="formErrors.name" class="alert alert-danger" role="alert">
                        <ul>
                            <li v-for="(error, index) in formErrors.name" :key="index">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input v-model="userEmail" type="email" class="form-control" id="email" placeholder="name@example.com">
                    <div v-if="formErrors.email" class="alert alert-danger" role="alert">
                        <ul>
                            <li v-for="(error, index) in formErrors.email" :key="index">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea v-model="userMessage" class="form-control" id="message" rows="3"></textarea>
                    <div v-if="formErrors.message" class="alert alert-danger" role="alert">
                        <ul>
                            <li v-for="(error, index) in formErrors.message" :key="index">
                                {{error}}
                            </li>
                        </ul>
                    </div>
                </div>
                <input class="btn btn-primary" type="submit" value="Send">
            </form>
        </div>
    </section>
</template>

<script>

export default {
    name: "ContactUsPage",
    components: {

    },
    props: {

    },
    data() {
        return {
            userName: "",
            userEmail: "",
            userMessage: "",
            emailSent: false,
            formErrors: {}
        }
    },
    methods: {
        sendDataApi() {
            axios.post('api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage
            }).then((response) => {
                this.userName = "";
                this.userEmail = "";
                this.userMessage = "";
                if(response.data.success) {
                    this.emailSent = true;
                    this.formErrors= {};
                } else {
                    this.emailSent = false;
                    this.formErrors = response.data.errors;
                }
                
                // !DEBUG
                // console.log(response.data);
                // console.log(this.formErrors);
                // console.log("name", this.formErrors.name);
                // console.log("email", this.formErrors.email);
                // console.log("message", this.formErrors.message);
            });
        }
    },
}
</script>

<style lang="scss" scoped>

</style>