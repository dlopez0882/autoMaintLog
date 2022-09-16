<!-- to be used as generic modal template -->
<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-container-form">
                <slot name="body"></slot>
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