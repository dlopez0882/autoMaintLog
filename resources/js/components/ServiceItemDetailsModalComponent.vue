<script>
    import axios from 'axios';

    export default {
        data () {
            return {
                results: []
            }
            
        },
        mounted () {
            let serviceItemID = this.$attrs.data.serviceItemID;
            axios.get('../serviceitems/' + serviceItemID)
            .then(response => {
                // console.log(response)
                this.results = response.data
            })
            .catch(error => console.log(error));
        }
    }
</script>

<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-container-form">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Service Log Item Details
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <div class="mb-3">Date: {{ results.service_date }} </div>
                            <div class="mb-3">Mileage: {{ $filters.formatNumber(results.mileage) }}</div>
                            <div class="mb-3">Performed by: {{ results.technician }}</div>
                            <div class="mb-3">Cost: {{ $filters.currencyUSD(results.cost) }}</div>
                            <div class="mb-3">Service summary: {{ results.service_summary }}</div>
                            <div class="mb-3">Service details:
                                <div v-html="results.service_details"></div>
                            </div>


                            <div class="text-end">
                                <slot name="footer">
                                    <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                        Close
                                    </button>
                                </slot>
                            </div>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>