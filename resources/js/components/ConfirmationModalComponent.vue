<template>
    <div class="modal-container modal-container-confirm">
        <div class="modal-header">
            <h3>Confirm</h3>
        </div>

        <div class="modal-body">
            <slot name="body">
                Are you sure that you want to delete this {{ makeSingularAndRemoveUnderscores(table) }}?
            </slot>
        </div>

        <div class="modal-footer">
            <slot name="footer">
                <form id="confirmationModal" :action="confirmPostUrl" method="POST">
                    <input type="hidden" name="_token" :value="csrfToken">
                    <input type="hidden" name="_method" :value="method">
                    <slot name="hiddenfields"></slot>

                    <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-danger" @click="$emit('close')">
                        OK
                    </button>
                </form>
            </slot>
        </div>
    </div>
</template>

<script setup>
import { makeSingular, removeUnderscores } from '../modules/utilities'
import { ref } from 'vue';

const csrfToken = ref(document.querySelector('meta[name="csrf-token"]').getAttribute('content'))

const props = defineProps({
    table: String,
    method: String,
    confirmPostUrl: String,
})

const emit = defineEmits(['close'])

function makeSingularAndRemoveUnderscores(string) {
    return removeUnderscores(makeSingular(string));
}
</script>