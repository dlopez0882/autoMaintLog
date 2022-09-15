<!-- to be used as generic modal template -->
<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-container-form">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Record Details
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <!-- modal bodies will go here!! -->
                        </slot>
                        <div class="text-end">
                            <slot name="footer">
                                <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                    Close
                                </button>
                            </slot>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    mounted () {
        // console.log("Modal component loaded");
    }
}


</script>