<!-- a modal body used for displaying record-specific details -->
<!-- method in v-for loop may run twice. see https://github.com/vuejs/vue/issues/10558#issuecomment-534967376 -->
<template>
    <div class="modal-container modal-container-form">
        <div class="card">
            <div class="card-header">{{ uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores(table) }} details</div>
                <div class="card-body">
                    <div v-for="field in fields" class="mb-3">{{ uppercaseFirstLetterAndRemoveUnderscores(field.name) }}:
                        <div v-if="field.type == 'tinymce'" v-html="details.data[field.name]"></div>
                        <div v-else>{{ numberFormatter(details.data[field.name], field.format) }}</div>
                    </div>

                    <div class="text-end">
                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                            Close
                        </button>
                    </div>
                </div>
        </div>
    </div>
</template>

<script setup>
import { uppercaseFirstLetterAndRemoveUnderscores, numberFormatter, uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores } from '../modules/utilities'
import { reactive, onMounted } from 'vue';

const details = reactive({
    data: {}
})

const props = defineProps({
    fields: Object,
    itemId: [Number, String],
    table: String,
    axiosGetUrl: String,   
})

onMounted(() => {
    let itemId = props.itemId;
    axios.get(props.axiosGetUrl + itemId)
        .then(response => {
            details.data = response.data
        })
        .catch(error => console.log(error));
})
</script>