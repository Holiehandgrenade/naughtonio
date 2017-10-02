<template>
    <div>
        <form action="/public/song-of-ice-and-fire-connector" method="post">
            <input type="hidden" v-model="token" name="_token">

            <input type="hidden" v-model="characterSelectedIdOne" name="first_character_id">
            <input type="text" v-model="characterSelectedOne" list="characterDataListOne" name="first_character_name">
            <datalist id="characterDataListOne">
                <option v-for="character in characters">{{ character }}</option>
            </datalist>


            <input type="hidden" v-model="characterSelectedIdTwo" name="second_character_id">
            <input type="text" v-model="characterSelectedTwo" list="characterDataListTwo" name="second_character_name">
            <datalist id="characterDataListTwo">
                <option v-for="character in characters">{{ character }}</option>
            </datalist>


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

        watch: {
            characterSelectedOne (character) {
                this.characterSelectedIdOne = this.findId(character);
            },
            characterSelectedTwo (character) {
                this.characterSelectedIdTwo = this.findId(character);
            }
        },

        methods: {
            findId (character) {
                for (var i in this.characters) {
                    if (this.characters[i] == character) {
                        return i;
                    }
                }
            },
        },
    }
</script>
