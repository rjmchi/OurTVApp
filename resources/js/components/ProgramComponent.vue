<template>
<div>
    <p>TV Programs</p>
    <div class="programs" v-for="program in programs" v-bind:key="program.id">
        <span>{{program.program}}</span>
        <span>{{program.app}}</span>
        <span>
            {{program.season}}
            <button v-on:click="nextSeason(program)" class="btn-sm btn-info"><font-awesome-icon icon="angle-right" /></button>
        </span>
        <span>
            {{program.episode}}
            <button v-on:click="nextEpisode(program)" class="btn-sm btn-info"><font-awesome-icon icon="angle-right" /></button>
        </span>
        <button v-on:click="deleteProgram(program)" class="btn-sm btn-danger"><font-awesome-icon icon="trash" /></button>
    </div>
    <form @submit.prevent="addProgram">
        <div class="form-group">
            <label for="program">Program: </label>
            <input name="program" type="text" class="form-control" v-model="newProgram.program"> 
        </div>
        <div class="form-group">
            <label for="app">APP: </label>
            <input name="app" type="text" class="form-control" v-model="newProgram.app">
        </div>        
        <div class="form-group">
            <label for="season">Season: </label>
            <input name="season" type="text" class="form-control" v-model="newProgram.season">
        </div>
        <div class="form-group">
            <label for="episode">Episode: </label>
            <input name="episode" type="text" class="form-control" v-model="newProgram.episode">
        </div>        
        
        <button class="btn-sm btn-primary" type="submit">Add Program</button>

    </form>
</div>
</template>

<script>

    export default {
        data () {
            return {
                url:'/api/program',
                programs:[],
                newProgram: {
                    program:'',
                    season:1,
                    episode:1,
                    app:'',
                },
            }
        },
    methods: {
        async fetchPrograms() {
            try {
                let resp = await fetch(this.url , { method: "GET" });
                console.log(resp.status);
                if (resp.ok) {
                    resp = await resp.json();
                    this.programs= resp.data;
                }
                } catch (err) {
                    console.log(err);
            }
        },
        async addProgram() {
            try {
                let resp = await fetch(this.url , {
                    method: "POST",
                    body: JSON.stringify({
                        program: this.newProgram.program,
                        app: this.newProgram.app,
                        season: this.newProgram.season,
                        episode: this.newProgram.episode
                        }),
                    headers: {
                        "Content-type": "application/json"
                        }
                    });
                    if (resp.ok) {
                        resp = await resp.json();
                        console.log(resp);
                        this.clearFields();
                        this.fetchPrograms();
                    }
                } catch (err) {
                    console.log(err);
            }     
        },
        deleteProgram: async function(program) {
            try {
                let resp = await fetch(this.url+'/'+program.id, {
                    method: "DELETE",
                    headers: {
                        "Content-type": "application/json"
                    }
                });
                if (resp.ok) {
                    resp = await resp.json();
                    console.log(resp);
                    this.fetchPrograms();

                    // this.clearFields();
                }
            } catch (err) {
                console.log(err);
            }            
        },
        updateProgram: async function(program) {
            try {
                let resp = await fetch(this.url+'/'+program.id, {
                    method: "PUT",
                    body: JSON.stringify({
                        program: program.program,
                        season: program.season,
                        episode: program.episode,
                        app: program.app,
                    }),
                    headers: {
                        "Content-type": "application/json"
                    }
                });
                if (resp.ok) {
                    resp = await resp.json();
                    console.log(resp);
                    this.fetchPrograms();

                    // this.clearFields();
                }
            } catch (err) {
                console.log(err);
            }           
        },
        nextSeason(program) {
            program.season++;
            program.episode = 1;
            this.updateProgram(program);
        },
        nextEpisode(program) {
            program.episode++;
            this.updateProgram(program);
        },
        clearFields() {
            this.newProgram.program = '';
            this.newProgram.app = '';
            this.newProgram.season = 1;
            this.newProgram.episode = 1;
        },
    },
    created() {
        this.fetchPrograms();
    },
}
</script>

<style lang="scss" scoped>
.programs {
    display:flex;
    background-color:rgb(231, 213, 236);
    margin:10px;
    padding:10px;
    span {
        flex: 1 1 25%;
    }
}

</style>
