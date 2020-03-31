<template>
    <div>
        <input type="text" placeholder="Search" v-model="query" v-on:keyup="autoComplete" class="form-control" id="search">
        <div class="panel-footer" v-if="results.length">
            <ul class="list-group position-absolute" style="z-index: 1000;" id="search-results">
                <li class="list-group-item d-flex justify-content-between align-items-center" v-for="result in results" style="min-width: 200px">
                    <div>
                        <a v-bind:href="'/profile/'+ result.id" >
                            <img :src="'/storage/' + result.profile.image" alt="" style="width: 50px;" class="rounded-circle">
                        </a>

                    </div>
                    <div class="m-auto">
                        <a v-bind:href="'/profile/'+ result.id" class="black-link">{{ result.username}}</a>
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
                results: []
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
</script>
