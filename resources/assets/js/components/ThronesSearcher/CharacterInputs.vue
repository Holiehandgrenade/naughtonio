<template>

        <form action="/public/song-of-ice-and-fire-connector" method="post">
            <input type="hidden" v-model="token" name="_token">
            <input type="hidden" v-model="characterSelectedIdOne" name="first_character_id">
            <input type="hidden" v-model="characterSelectedIdTwo" name="second_character_id">

            <div class="row">
                <v-select
                        class="col-md-3"
                        v-model="characterSelectedOne" :options="characters"
                ></v-select>

                <v-select
                        class="col-md-3"
                        v-model="characterSelectedTwo" :options="characters"
                ></v-select>

                <button type="submit" class="btn btn-info">Search</button>
                <button type="submit" class="btn btn-info">Search</button>
            </div>
        </form>
</template>
<style>
    .open-indicator{
        /* overwrites the arrow icon for the v-select dropdown */
        right: 25px !important;
    }
</style>
<script type="text/javascript">
    export default{
        props: ['characters', 'selectedOne', 'selectedTwo'],

        data: function() {
            return {
                characterSelectedOne: this.selectedOne? JSON.parse(this.selectedOne).Name : null, // i did this to not "edit a prop"
                characterSelectedTwo: this.selectedTwo? JSON.parse(this.selectedTwo).Name : null, // vue doesn't like that and i didn't feel like learning
                characterSelectedIdOne: null,
                characterSelectedIdTwo: null,
                token: $('meta[name="csrf-token"]').attr('content'),
            };
        },

        mounted() {
            if(this.characterSelectedOne) {
                this.characterSelectedIdOne = JSON.parse(this.selectedOne).Id;
            }

            if(this.characterSelectedTwo) {
                this.characterSelectedIdTwo = JSON.parse(this.selectedTwo).Id;
            }
        },

        watch: {
            characterSelectedOne (character) {
                this.characterSelectedIdOne = character.value;
            },
            characterSelectedTwo (character) {
                this.characterSelectedIdTwo = character.value;
            }
        },
    }
</script>
