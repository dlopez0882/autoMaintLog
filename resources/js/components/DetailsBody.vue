<!-- a modal body used for displaying record-specific details -->
<!-- method in v-for loop may run twice. see https://github.com/vuejs/vue/issues/10558#issuecomment-534967376 -->
<template>
    <div v-for="field in fields" class="mb-3">{{ formatLabel(field.name) }}:
        <div v-if="details[field.type] == 'tinymce'" v-html="details[field.name]"></div>
        <div v-else v-html="formatter(details[field.name], field.format)"></div>
    </div>
</template>

<script>
    import numeral from 'numeral';
    import { uppercaseFirstLetterAndRemoveUnderscores } from '../modules/utilities'
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
            formatter(value, format) {
                if(format == 'currency') {
                    return numeral(value).format("$0,0.00");
                } else if(format == 'number') {
                    return numeral(value).format("0,0");
                } else {
                    return value;
                }
            },
            formatLabel(label) {
                return uppercaseFirstLetterAndRemoveUnderscores(label);
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