<template>
    <div>
        <a @click="likePost" style="cursor:pointer;"><i v-bind:class="{ 'like-icon-liked' : liked, 'like-icon-unliked' : !liked }" class="fas fa-heart mt-1"></i></a>
    </div>
</template>

<script>

    export default {

        props: ['postId', 'liked'],

        data: function() {
            return {
                liked: this.liked,
            }
        },

        methods: {
            likePost() {
                axios.post('/like/' + this.postId).then(response=>{
                    this.liked = !this.liked;
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
