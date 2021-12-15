import { Controller } from '@hotwired/stimulus';
import * as Axios from 'axios';

export default class extends Controller {

    static targets = ['content'];
    static values = {
        url: String,
    }

    /**
     * Actualizacion de la Lista
     * @param {*} event 
     */
    async refreshContent(event) {
        this.contentTarget.style.opacity = .5;
        const response = await Axios.get(this.urlValue, { params: { 'ajax': true } });
        this.contentTarget.innerHTML = await response.data;
        drawDataTable();
        this.contentTarget.style.opacity = 1;
    }
}