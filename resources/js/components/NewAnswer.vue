<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Your Answer</h3>
                    </div>
                    <hr>
                    
                    <form @sumbit.prevent="create">
                        <div class="form-group">
                            <textarea name="body" rows="7" class="form-control" v-model="body" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="sumbit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['questionId'],

    methods: {
        create () {
            axios.post(`/questions/${this.questionId}/answers`, {
                body: this.body
            })
            .then(({data}) => {
                this.$toast.success(data.message, "Success");
                this.body = '';
                this.$emit('created', data.answer);
            })
            .catch(error => {
                this.$toast.error(error.response.data.message, "Error");
            })
        }
    },

    data () {
        return {
            body: '',

        }
    },

    computed: {
        isInvalid () {
            return !this.signedIn || this.body.length < 10;
        }
    }
}
</script>