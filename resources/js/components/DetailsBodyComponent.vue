<!-- a modal body used for displaying record-specific details -->
<!-- method in v-for loop may run twice. see https://github.com/vuejs/vue/issues/10558#issuecomment-534967376 -->
<template>
    <div v-for="field in fields" class="mb-3">{{ uppercaseFirstLetterAndRemoveUnderscores(field.name) }}:
        <div v-if="field.type == 'tinymce'" v-html="details[field.name]"></div>
        <div v-else>{{ numberFormatter(details[field.name], field.format) }}</div>
    </div>
</template>

<script>
    import { uppercaseFirstLetterAndRemoveUnderscores, numberFormatter } from '../modules/utilities'
    export default {
        data () {
            return {
                details: {}
            }
        },
        props: {
            fields: Object,
            itemId: [Number, String]
        },
        methods: {
            numberFormatter(value, format) {
                return numberFormatter(value, format);
            },
            uppercaseFirstLetterAndRemoveUnderscores(string) {
                return uppercaseFirstLetterAndRemoveUnderscores(string);
            }
        },
        mounted() {
            let itemId = this.itemId;
            axios.get('../serviceitems/' + itemId)
                .then(response => {
                    this.details = response.data
                })
                .catch(error => console.log(error));
        }
    }

</script>