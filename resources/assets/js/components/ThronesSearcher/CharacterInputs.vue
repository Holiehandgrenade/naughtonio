<template>
    <div>
        <form action="/public/song-of-ice-and-fire-connector" method="post">
            <input type="hidden" v-model="token" name="_token">



            <input type="hidden" v-model="characterSelectedIdOne" name="first_character_id">
            <v-select v-model="characterSelectedOne" :options="characters"></v-select>


            <input type="hidden" v-model="characterSelectedIdTwo" name="second_character_id">
            <v-select v-model="characterSelectedTwo" :options="characters"></v-select>


            <button type="submit">Search</button>
        </form>
    </div>
</template>
<style>

</style>
<script type="text/javascript">
    export default{
        props: ['characters', 'selectedOne', 'selectedTwo'],

        data: function() {
            return {
                characterSelectedOne: this.selectedOne? this.selectedOne : null, // i did this to not "edit a prop"
                characterSelectedTwo: this.selectedTwo? this.selectedTwo : null, // vue doesn't like that and i didn't feel like learning
                characterSelectedIdOne: null,
                characterSelectedIdTwo: null,
                token: $('meta[name="csrf-token"]').attr('content'),
            };
        },

        mounted() {console.log(this.selectedOne);},

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
