<template>
    <div>
        <button v-if="!isLoading" @click="click" class="btn btn-primary mt-2">{{ titulo }}</button>

        <button v-if="isLoading" class="btn btn-primary mt-2" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            {{ tituloLoading }}
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            tituloLoading: {
                type: String,
                required: true
            },

            titulo: {
                type: String,
                required: true
            }
        },

        watch: {
            isLoading() {}
        },

        methods: {
            click() {
                this.setLoading(true)
                this.$emit('evento')
            },

            setLoading(valor) {
                this.isLoading = valor
            }
        },

        data() {
            return {
                isLoading: false
            }
        },
    }
</script>

<style scoped>
    
</style>