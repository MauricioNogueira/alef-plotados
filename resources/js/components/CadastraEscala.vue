<template>
    <div>
        <div id="mensagem-cadastro-escala"></div>
        <form id="cadastra-escala">
            <div class="row">
                <div class="col-12">
                    <label for="tipo" class="block font-medium text-sm text-gray-700">Nome da escala <span class="danger">*</span></label>
                    <input id="tipo" v-model="form.tipo" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>
            <!-- <select2 :url="urlFiltro" id="teste"></select2> -->
            <botao ref="botaoCadastrarEscala" @evento="cadastrar" titulo="Salvar" titulo-loading="Salvando"></botao>
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
            }
        },

        data() {
            return {
                form: {
                    tipo: ''
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
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.alertMessage('danger', "<span class='danegr'>*</span> Campos obrigatórios")
                    } else {
                        this.alertMessage('danger', "Não foi possível salvar a escala")
                    }
                })
                .finally(()=>{
                    this.$refs.botaoCadastrarEscala.setLoading(false)
                })
            },

            async alertMessage(type, message) {
                const wrapper = await document.getElementById('mensagem-cadastro-escala')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                    `   <div>${message}</div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('')

                // alertPlaceholder.append(wrapper)
            }
        }
    }
</script>

<style scoped>
    .danger {
        color: red;
    }
</style>