<template>
    <div>


        <form action="/song-of-ice-and-fire-connector" method="post">

            <input type="text" v-model="characterSelectedOne" list="characterDataListOne">
            <datalist id="characterDataListOne">
                <option v-for="character in characters">{{ character }}</option>
            </datalist>



            <input type="text" v-model="characterSelectedTwo" list="characterDataListTwo">
            <datalist id="characterDataListTwo">
                <option v-for="character in characters">{{ character }}</option>
            </datalist>


            <button type="submit" @click="submit">Search</button>
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

        methods: {
            submit(e) {
                e.preventDefault();

                // get character ids
                for (var i in this.characters) {
                    if (this.characters[i] == this.characterSelectedOne) {
                        this.characterSelectedIdOne = i;
                    }

                    if (this.characters[i] == this.characterSelectedTwo) {
                        this.characterSelectedIdTwo = i;
                    }
                }

                console.log(this.characterSelectedIdOne);

            }
        },
    }
</script>
