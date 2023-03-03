<template>
    <div>
        <div id="mensagem-cadastro-molde"></div>
        <form id="cadastra-molde">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <label for="escala" class="mb-1 block font-medium text-sm text-gray-700">Escala <span class="danger">*</span></label>
                    <select2 ref="escala" @selecionado="escalaSelecionada" :url="urlEscala" id="escala"></select2>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label for="molde" class="mb-1 block font-medium text-sm text-gray-700">Molde <span class="danger">*</span></label>
                    <select2 :query-params-ajax="customQueryParamsMolde" ref="molde" @selecionado="moldeSelecionado" :url="urlMolde" id="molde"></select2>
                </div>
            </div>

            <div id="campos-molde" v-if="camposMoldeVisivel" class="row">
                <div class="col-sm-12 col-md-4">
                    <label for="altura" class="block font-medium text-sm text-gray-700">Altura (cm) <span class="danger">*</span></label>
                    <input id="altura" v-model="form.altura" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="col-sm-12 col-md-4">
                    <label for="quantidade-gomo" class="block font-medium text-sm text-gray-700">Quantidade de gomos <span class="danger">*</span></label>
                    <input id="quantidade-gomo" v-model="form.quantidade_gomo" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="col-sm-12 col-md-4">
                    <label for="bainha" class="block font-medium text-sm text-gray-700">Bainha (cm) <span class="danger">*</span></label>
                    <input id="bainha" v-model="form.bainha" type="text" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
            </div>
            
            <botao ref="gerarMolde" @evento="gerarMolde" titulo="Gerar" titulo-loading="Gerando"></botao>
        </form>
    </div>
</template>

<script>
    import { saveAs } from 'file-saver';

    export default {
        props: {
            urlEscala: {
                type: String,
                required: true
            },

            urlMolde: {
                type: String,
                required: true
            },

            urlGeraMolde: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                escala: '',
                form: {
                    tipo: '',
                    quantidade_gomo: '',
                    altura: '',
                    bainha: ''
                },
                camposMoldeVisivel: false
            }
        },

        methods: {
            gerarMolde() {
                console.log(this.form)
                axios.post("/gerar-molde", this.form).then(success => {

                    let blob = new Blob([success.data.data.arquivo], {
                        type: 'image/x-coreldraw'
                    });

                    saveAs(blob, success.data.data.nome_arquivo + ".cdr");

                    this.limparCampos();
                }).catch(error => {
                    if (error.response.status == 422) {
                        this.alertMessage('danger', "<span class='danegr'>*</span> Campos obrigatórios")
                    } else {
                        this.alertMessage('danger', "Falha ao gerar o molde")
                    }
                }).finally(() => {
                    this.$refs.gerarMolde.setLoading(false)
                })
            },

            customQueryParamsMolde(params) {
                var query = {
                    search: params.term,
                    escala_id: this.escala,
                    type: 'public'
                }

                console.log(query)

                return query;
            },

            escalaSelecionada(escala) {
                this.escala = escala.id;
                this.form.tipo = '';
                this.$refs.molde.clear();
                this.camposMoldeVisivel = false;
            },

            moldeSelecionado(molde) {
                this.form.tipo = molde.id;
                this.camposMoldeVisivel = true;
            },

            limparCampos() {
                this.form.tipo = '';
                this.form.altura = '';
                this.form.bainha = '';
                this.form.quantidade_gomo = '';

                this.$refs.escala.clear();
                this.$refs.molde.clear();

                this.camposMoldeVisivel = false;
            }
        },
    }
</script>

<style scoped>
    .danger {
        color: red;
    }
</style>