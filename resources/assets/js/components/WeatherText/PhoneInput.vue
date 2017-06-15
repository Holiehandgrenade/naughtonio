<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="/weather-text/phone">
                    <label for="phone">
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
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    export default {
        data () {
            return {
                phone: '',
                csrf_token: csrf_token,
            }
        },
        components: {
          MaskedInput
        },
    }
</script>
