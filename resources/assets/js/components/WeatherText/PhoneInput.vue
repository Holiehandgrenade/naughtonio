<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="/weather-text/phone">
                    <input type="hidden" name="_token" v-model="csrf_token">

                    <label>
                        Phone
                    </label>

                    <masked-input
                        id="phone"
                        name="phone"
                        mask="(111) 111-1111"
                        placeholder="Please input"
                        @input="phone = arguments[1]"
                    />
                    <button type="submit">Submit</button>
                </form>
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
                csrf_token: $('meta[name="csrf-token"]').attr('content'),
            }
        },
        components: {
          MaskedInput
        },
    }
</script>
