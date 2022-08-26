<script>

</script>

<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container3">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Service details
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <!-- <form action="submitForm" method="POST">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" v-model="date" ref="date">                           
                                </div>

                                <div class="mb-3">
                                    <label for="mileage">Mileage</label>
                                    <input type="number" name="mileage" id="mileage" class="form-control" v-model="mileage" ref="mileage">
                                </div>

                                <div class="mb-3">
                                    <label for="service_summary">Service summary</label>
                                    <input type="text" name="service_summary" id="service_summary" class="form-control" v-model="service_summary" ref="service_summary">                         
                                </div>

                                <div class="mb-3">
                                    <label for="service_details">Service details</label>
                                    <textarea name="service_details" id="service_details" class="form-control" rows="3" placeholder="Optional field - fill in to add more details about this service." v-model="service_details" ref="service_details"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="technician">Performed by</label>
                                    <input type="text" name="technician" id="technician" class="form-control" v-model="technician" ref="technician">  
                                </div>

                                <div class="mb-3">
                                    <label for="cost">Cost</label>
                                    <input type="number" step=0.01 name="cost" id="cost" class="form-control" v-model="cost" ref="cost"> 
                                </div> -->

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <!-- <button class="btn btn-primary" @click.prevent="submitForm"><i class="fa fa-plus"></i> Add Work Item</button> -->
                                    </slot>
                                </div>
                            <!-- </form> -->
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>