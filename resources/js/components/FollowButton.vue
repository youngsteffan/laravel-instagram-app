<template>
    <div>
        <button v-bind:class="{ 'btn-light' : status, 'btn-primary' : !status }" class="btn ml-4" id="followBtn"
                @click="followUser" v-text="buttonText">Follow
        </button>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follows'],

        data: function () {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId).then(response => {
                    $('#followers').text(response.data.followers_count);
                    this.status = !this.status;
                }).catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }
                })
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
