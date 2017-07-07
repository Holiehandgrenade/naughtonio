<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="errorModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body" style="text-align: center;">
                        <p>There was an error in sending the verification code</p>
                        <a href="/phone">Please try submitting again</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<style>

</style>
<script type="text/javascript">
    export default{
        props: ['verification'],

        mounted () {
            $("#errorModal").modal()
            Echo.private("Phone.Verify." + this.verification.id)
                .listen('PhoneVerificationSendingFailed', (e) => {
                    this.displayErrorModal();
                });
        },

        methods: {
            displayErrorModal () {
                $("#errorModal").modal()
            },
        },
    }
</script>
