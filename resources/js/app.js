import './bootstrap';

import Alpine from 'alpinejs';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import 'select2/dist/css/select2.min.css'
import 'select2/dist/js/select2.min.js';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import CadastraEscala from './components/CadastraEscala.vue';
import CadastraMolde from './components/CadastraMolde.vue';
import GeraArquivoMolde from './components/GeraArquivoMolde.vue';
import Botao from './components/Botao.vue';
import Select2 from './components/Select2.vue';

app.component('example-component', ExampleComponent);
app.component('cadastra-escala', CadastraEscala);
app.component('cadastra-molde', CadastraMolde);
app.component('gera-arquivo-molde', GeraArquivoMolde);
app.component('botao', Botao);
app.component('select2', Select2);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
