/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    data: function() {
        return {
            showModal: false,
            showAddVehicleModal: false,
            showAddWorkItemModal: false,
            showDeleteWorkItemConfirmModal: false,
            showWorkItemDetailsModal: false,
        }
    }
});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import ModalComponent from './components/ModalComponent.vue';
app.component('modal-component', ModalComponent);

import AddVehicleModalComponent from './components/AddVehicleModalComponent.vue';
app.component('add-vehicle-modal-component', AddVehicleModalComponent);

import AddWorkItemModalComponent from './components/AddWorkItemModalComponent.vue';
app.component('add-work-item-modal-component', AddWorkItemModalComponent);

import DeleteWorkItemModalComponent from './components/DeleteWorkItemModalComponent.vue';
app.component('delete-work-item-modal-component', DeleteWorkItemModalComponent);

import WorkItemDetailsModalComponent from './components/WorkItemDetailsModalComponent.vue';
app.component('work-item-details-modal-component', WorkItemDetailsModalComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
