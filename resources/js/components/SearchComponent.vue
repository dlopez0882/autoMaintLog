<template>
    <div :class="styleClass">
        <input type="search" name="search" class="form-control" @blur="submitSearch($event)" @keyup.enter="submitSearch($event)" :placeholder="placeholder" v-model="searchString">
    </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
    styleClass: String,
    placeholder: String,
})

const searchString = ref('')

function submitSearch(event) {
    console.log(event.target.value);
}
</script>