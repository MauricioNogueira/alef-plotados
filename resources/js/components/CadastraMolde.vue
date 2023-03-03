<template>
    <div>
        <div id="mensagem-cadastro-molde"></div>
        <form id="cadastra-molde">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="select-escala" class="mb-1 block font-medium text-sm text-gray-700">Escala <span class="danger">*</span></label>
                    <select2 ref="selectEscala" @selecionado="selectEscala" :url="urlFiltro" id="select-escala"></select2>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="nome-molde" class="block font-medium text-sm text-gray-700">Nome do Molde <span class="danger">*</span></label>
                    <input id="nome-molde" v-model="form.nome" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="distancia-base" class="block font-medium text-sm text-gray-700">Distância Base <span class="danger">*</span></label>
                    <textarea rows="10" id="distancia-base" v-model="form.distancia_base" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="circunferencia-base" class="block font-medium text-sm text-gray-700">Circunferência Base <span class="danger">*</span></label>
                    <textarea rows="10" id="circunferencia-base" v-model="form.circunferencia_base" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
                </div>
            </div>
            
            <botao ref="botaoCadastrarMolde" @evento="cadastrar" titulo="Salvar" titulo-loading="Salvando"></botao>
        </form>
    </div>
</template>

<script>
    import { ToastShow } from '../utils/toast.js';

    export default {
        props: {
            url: {
                required: true,
                type: String
            },

            urlFiltro: {
                required: true,
                type: String
            }
        },

        data() {
            return {
                form: {
                    nome: '',
                    escala: '',
                    distancia_base: '',
                    circunferencia_base: ''
                }
            }
        },

        methods: {
            cadastrar() {
                axios.post(this.url, this.form)
                .then(success => {
                    this.form.tipo = ''
                    // alert(success.data.message)
                    this.alertMessage('success', success.data.message)

                    this.form.circunferencia_base = '';
                    this.form.distancia_base = '',
                    this.form.escala = '';
                    this.form.nome = '';
                    
                    this.$refs.selectEscala.clear()
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.alertMessage('danger', "<span class='danegr'>*</span> Campos obrigatórios")
                    } else {
                        this.alertMessage('danger', "Não foi possível salvar o molde")
                    }
                })
                .finally(()=>{
                    this.$refs.botaoCadastrarMolde.setLoading(false)
                })
            },

            selectEscala(e) {
                this.form.escala = e.id
            },

            async alertMessage(type, message) {
                const wrapper = await document.getElementById('mensagem-cadastro-molde')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                    `   <div>${message}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')
            }
        }
    }
</script>

<style scoped>
    .danger {
        color: red;
    }
</style>