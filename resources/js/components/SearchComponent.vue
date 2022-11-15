<template>
    <div :class="styleClass">
        <input type="search" name="search" class="form-control" @blur="submitSearch($event)" @keyup.enter="submitSearch($event)" :placeholder="placeholder" v-model="searchString">
    </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const props = defineProps({
    styleClass: String,
    placeholder: String,
})

const searchString = ref('')

const emit = defineEmits(['submitSearch'])

function submitSearch(event) {
    emit('submitSearch', event.target.value)
}
</script>