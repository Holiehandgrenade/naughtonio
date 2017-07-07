<template>
    <div>

    </div>
</template>
<style>

</style>
<script type="text/javascript">
    export default{
        props: ['verification'],

        mounted () {
            Echo.private("phone-verify." + this.verification.id)
                .listen('PhoneVerificationSendingFailed', (e) => {
                    console.log(e);
                });
        }
    }
</script>
