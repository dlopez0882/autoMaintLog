<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container2">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Add a New Vehicle
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <form :action="`${data.postroute}`" method="POST">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="mb-3">
                                    <label for="mileage">Year</label>
                                    <input type="number" name="year" id="mileyearage" class="form-control" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="services">Make</label>
                                    <input type="text" name="make" id="make" class="form-control" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="technician">Model</label>
                                    <input type="text" name="model" id="model" class="form-control" value="">
                                </div>

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <button type="submit" class="btn btn-danger" @click="$emit('close')">
                                            OK
                                        </button>
                                    </slot>
                                </div>
                            </form>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: this.$attrs.data,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container2 {
    width: 800px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    /* font-family: Helvetica, Arial, sans-serif; */
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>