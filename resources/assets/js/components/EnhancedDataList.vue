<template>
    <div>
        <input type="text"v-model="textSelected"list="{{id}}">
        <datalist id="{{id}}">
            <option v-for="option in options">{{option}}</option>
        </datalist>
    </div>
</template>
<style>

</style>
<script>
    export default{
        props: ['valueSelected', 'options'],
        data: function() {
            return { id: _id };
        },
        computed: {
            textSelected: {
                get: function() {
                    return this.options[this.valueSelected];
                },
                set: function(val) {
                    for (var i in this.options) {
                        if (this.options[i] == val) {
                            this.$set('valueSelected', i);
                            break;
                        }
                    }
                }
            }
        }
    }
</script>
