<template>
    <div>
        <select style="padding: 3rem!important;" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" :id="id">
        </select>
    </div>
</template>

<script>
    import $ from 'jquery';

    export default {
        props: {
            id: {
                type: String,
                required: true
            },

            url: {
                type: String,
                required: true
            },

            queryParamsAjax: {
                type: Function,
                default: (params) => {
                    var query = {
                        search: params.term,
                        type: 'public'
                    }

                    return query;
                }
            },

            processResults: {
                type: Function,
                default: (data) => {
                    return {
                        results: data.data
                    };
                }
            }
        },

        data() {
            return {
                select2: null
            }
        },

        methods: {
            clear() {
                this.select2.val('');
                this.select2.change();
            }
        },

        mounted() {
            this.select2 = $("#"+this.id).select2({
                placeholder: 'Selecione',
                minimumInputLength: 4,
                ajax: {
                    delay: 500,
                    url: this.url,
                    data: this.queryParamsAjax,
                    processResults: this.processResults
                },
                language: {

                    noResults: function () {
                        return "Nenhum resultado encontrado"
                    },
                    
                    inputTooShort: function (data) {
                        let min = data.minimum;

                        return `Digite ${(min - data.input.length)} caracteres`;
                    }
                },

                templateResult: function (data) {
                    if (data.hasOwnProperty('loading')) {
                        return "Buscando..."
                    }

                    return $(`<option value="${data.id}">${data.text}</option>`)
                }
            });

            this.select2.data('select2').$selection.css('height', '40px');

            this.select2.on('select2:select', (e) => {
                this.$emit('selecionado', e.params.data);
            });
        },
    }
</script>

<style scoped>
    
</style>