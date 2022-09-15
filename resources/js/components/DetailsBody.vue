<!-- a modal body used for displaying record-specific details -->
<template>
    <div v-for="field in fields" class="mb-3">{{ field.name }}:
        <div v-html="details[field.name]"></div>
    </div>

    <!-- <div class="mb-3">Date: {{ results.service_date }} </div> -->
    <!-- <div class="mb-3">Mileage: {{ $filters.formatNumber(results.mileage) }}</div> -->
    <!-- <div class="mb-3">Performed by: {{ results.technician }}</div> -->
    <!-- <div class="mb-3">Cost: {{ $filters.currencyUSD(results.cost) }}</div> -->
    <!-- <div class="mb-3">Service summary: {{ results.service_summary }}</div> -->

    <!-- <div class="mb-3">Service details: -->
        <!-- <div v-html="results.service_details"></div> -->
    <!-- </div> -->

    <!-- <div class="text-end">
        <slot name="footer">
            <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                Close
            </button>
        </slot>
    </div> -->
</template>

<script>
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
        mounted() {
            let itemId = this.itemId;
            axios.get('../serviceitems/' + itemId)
                .then(response => {
                    console.log(response.data)
                    this.details = response.data
                })
                .catch(error => console.log(error));
        }
    }

</script>