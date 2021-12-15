import { Controller } from '@hotwired/stimulus';
import { Modal } from 'bootstrap';
import * as Axios from 'axios';
import './../app';

export default class extends Controller {

    static targets = ['modal', 'modalBody'];
    static values = {
        formUrl: String,
    }
    modal = null;

    /**
     * Método de Apertura de Modal donde se Carga el Formulario via Axios (Funciona como Fetch o el antiguo Ajax) desde el BackEnd   
     * @param {*} event 
     */
    async openModal(event) {
        this.modalBodyTarget.innerHTML = 'Loading...';
        this.modal = new Modal(this.modalTarget);
        this.modal.show();
        const response = await Axios.get(this.formUrlValue);
        this.modalBodyTarget.innerHTML = response.data;
        /** see app.js */
        refreshFormModal(this.modalBodyTarget);
    }

    /**
     * Subida de Formulario al Backend vía Axios
     * @param {*} event 
     */
    async submitForm(event) {
        event.preventDefault();
        const form = this.modalBodyTarget.querySelector('form');
        try {
            await Axios.post(this.formUrlValue, new URLSearchParams(Array.from(new FormData(form))).toString());
            console.log('success!');
            this.modal.hide();
            this.dispatch('success');
        } catch (e) {
            this.modalBodyTarget.innerHTML = e.response.data;
            refreshFormModal(this.modalBodyTarget);
        }
    }

    /**
     * Evento de Ocultamiento del Formulario
     */
    modalHidden() {
        console.log('it was hidden!');
    }

}