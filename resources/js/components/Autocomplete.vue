<template>
    <div>
        <input type="text" :placeholder='searchIcon' v-model="query" v-on:keyup="autoComplete" class="form-control fa" id="search" style="font-family: 'Font Awesome 5 Free', Nunito">
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group position-absolute" style="z-index: 1000;" id="search-results">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="result in results" style="min-width: 200px">
                    <div>
                        <a v-bind:href="'/profile/'+ result.id" >
                            <img :src="result.profile.image !== null ? '/storage/' + result.profile.image : '/storage/profile/default.png'" alt="" style="width: 50px;" class="rounded-circle">
                        </a>
                    </div>
                    <div class="m-auto">
                        <a v-bind:href="'/profile/'+ result.id" class="black-link">{{ result.username}}</a>
                        <div v-if="result.name.length < 10" class="small text-secondary" style="opacity: 0.7;">
                            {{ result.name }}
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                query: '',
                results: [],
                searchIcon: "\uf002",
            }
        },
        methods: {
            autoComplete(){
                this.results = [];
                if(this.query.length > 2){
                    axios.get('/api/search',{params: {query: this.query}}).then(response => {
                        this.results = response.data;
                    });
                }
            }
        }

    }

    $(document).ready(function () {
        $('#search').focusin(function(){
            $(this).removeAttr('placeholder');
        });
        $('#search').focusout(function(){
            $(this).attr('placeholder', '\uf002');
        });
    });

</script>
