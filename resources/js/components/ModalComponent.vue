<!-- to be used as generic modal template -->
<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <slot name="body"></slot>
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