<template>
    <div>


        <form action="/song-of-ice-and-fire-connector" method="post">

            <input type="" v-model="characterSelectedIdOne">
            <input type="text" v-model="characterSelectedOne" list="characterDataListOne">
            <datalist id="characterDataListOne">
                <option v-for="character in characters">{{ character }}</option>
            </datalist>


            <input type="" v-model="characterSelectedIdTwo">
            <input type="text" v-model="characterSelectedTwo" list="characterDataListTwo">
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
        props: ['characters'],

        data: function() {
            return {
                characterSelectedOne: null,
                characterSelectedTwo: null,
                characterSelectedIdOne: null,
                characterSelectedIdTwo: null,
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
