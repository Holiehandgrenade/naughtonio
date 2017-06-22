<template>
    <input
        :id="id"
        :name="name"
        :type="finalType"
        :class="classes"
        :value="value"
        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
    />
</template>

<script>

    export default{
        props: ['id', 'name', 'type', 'classes', 'value'],
        data () {
            return {
                // allow for non default to use for tel or number inputs
                finalType: this.type ? this.type : "number",
            }
        }
    }
</script>
