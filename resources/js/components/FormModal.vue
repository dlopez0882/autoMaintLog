<template>
      <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container modal-container-confirm">
            <div class="modal-header">
                <slot name="header">
                    Form modal
                </slot>
                </div>  

                <div class="modal-body">
                <slot name="body">
                    {{ message }}
                    <form action="#" method="POST">
                    <div v-for="field in fields" class="mb-3">
                        <label :for="field">{{ field }}</label>
                        <input
                            type="text" 
                            :name="field" 
                            :id="field"
                            class="form-control" 
                            value=""
                        >
                        <!-- <div class="text-danger" v-if="v$.year.$error">Year field is required and must be between {{ yearMin }} and {{ yearMax }}.</div>  -->
                    </div>
                    </form>
                </slot>
                </div>

                <div class="modal-footer">
                <slot name="footer">
                    <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                        Cancel
                    </button>
                    
                    <button type="submit" class="btn btn-danger" @click="$emit('close')">
                        OK
                    </button>
                </slot>
            </div>
        </div>


      </div>
    </div>
</template>

<script>
    export default {
        props: {
            message: String,
            fields: Array,
        },
        data() {
            return {
                // message: ''
            }
            
        }
     }
</script>