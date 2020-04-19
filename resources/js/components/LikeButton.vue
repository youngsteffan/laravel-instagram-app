<template>
    <div>
        <a @click="likePost" style="cursor:pointer;">
            <i v-bind:class="getClass()" class="fas fa-heart mt-1"></i>
        </a>
    </div>
</template>

<script>

    export default {

        props: ['postId', 'liked'],

        data: function() {
            return {
                status: this.liked,
            }
        },

        methods: {

            getClass() {
                return {
                    'like-icon-liked': this.status,
                    'like-icon-unliked': !this.status}
            },

            likePost() {
                axios.post('/like/' + this.postId).then(response=>{
                    this.status = !this.status;
                    $('#js-like-counter').text(`${response.data.likes_count} likes`);
                }).catch(errors => {
                    if (errors.response.status == 401)  {
                        window.location = '/login';
                    }
                })
            }
        },

    }

</script>
