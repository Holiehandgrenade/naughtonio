<template>
    <div>
        <form action="/public/song-of-ice-and-fire-connector" method="post" id="characterSearchForm">
            <input type="hidden" v-model="token" name="_token">
            <input type="hidden" v-model="characterSelectedIdOne" name="first_character_id">
            <input type="hidden" v-model="characterSelectedIdTwo" name="second_character_id">

            <div class="row">
                <v-select
                        class="col-md-6"
                        v-model="characterSelectedOne" :options="characters"
                ></v-select>

                <v-select
                        class="col-md-3"
                        v-model="characterSelectedTwo" :options="characters"
                ></v-select>

                <button type="submit" class="btn btn-info">Search</button>
                <button @click="randomize" class="btn btn-info">Random</button>
            </div>
        </form>
        </div>
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
                characterSelectedOne: this.selectedOne ? JSON.parse(this.selectedOne).Name : null, // i did this to not "edit a prop"
                characterSelectedTwo: this.selectedTwo ? JSON.parse(this.selectedTwo).Name : null, // vue doesn't like that and i didn't feel like learning
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

        methods: {
            randomize(e) {
                // I had to use jquery instead of updating the v-model values
                // since the form was not aware of the changes due only to the javascript
                // Weird, but I'm sure if I understood the vue resolution cycle it would make more sense
                $('input[name="first_character_id"]').val(null);
                $('input[name="second_character_id"]').val(null);

                document.getElementById("characterSearchForm").submit();
            },
        },
    }
</script>
