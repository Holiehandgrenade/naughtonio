<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <masked-input
                    name="phone"
                    mask="(111) 111-1111"
                    placeholder="Please input"
                    @input="phone = arguments[1]"
                />
                <button @click="log(phone)"></button>
            </div>
        </div>
    </div>
</template>

<script>
    import MaskedInput from 'vue-masked-input';

    export default {
        data () {
            return {
                phone: '',
            }
        },
        components: {
          MaskedInput
        },
        methods: {
            log (v) {
                console.log(v);
            }
        }
    }
</script>
