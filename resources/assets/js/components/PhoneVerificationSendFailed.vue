<template>
    <div>

    </div>
</template>
<style>

</style>
<script type="text/javascript">
    export default{
        mounted () {
            Echo.private(`phone-verify.1`)
                .listen('PhoneVerificationSendingFailed', (e) => {
                    console.log(e);
                });
        }
    }
</script>
