/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import 'bootstrap';
import * as DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';
import Swal from 'sweetalert2';
window.bootstrap = require('bootstrap');

/**
 * Método para Levantar Modal de Eliminación de Elemento
 */
document.addEventListener('DOMContentLoaded', function () {    
    var inputs = document.querySelectorAll('a.btn-delete');
    inputs.forEach(element => {
        element.addEventListener('click', function () {
            var parent = this.parentElement;         
            Swal.fire({
                title: '¿Está Seguro de Eliminar?',
                showDenyButton: false,
                showCancelButton: true,
                icon: 'question',
                confirmButtonText: `Si`,
                cancelButtonText: `No`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    parent.submit();
                }
            })
        });
    });
    drawDataTable();
});

/**
 * Dibujado de Datatable
 */
window.drawDataTable = function () {
    new DataTable(document.querySelector('table[data-widget="datatable"]'), {
        ordering: true,
        order: [[0, 'desc']],
        paging: true,
        pagingType: 'full_numbers',
        lengthMenu: [[15, 30, 50, 100], [15, 30, 50, 100]],
        info: true,
        responsive: true,
        language: {
            sProcessing: "Procesando...",
            sLoadingRecords: "Cargando...",
            sZeroRecords: "No se Encontraron Resultados",
            sEmptyTable: "Ningún Dato Disponible",
            sInfo: '<span class="text-primary"> _START_ al _END_ de  _TOTAL_ </span>',
            sInfoEmpty: '<span class="text-primary"> 0 al 0 de 0 </span>',
            sInfoFiltered: '<span class="text-secondary"> (Total _MAX_) </span>',
            sSearch: '<span class="material-icons text-secondary font-weight-bold">manage_search</span>',
            sLengthMenu: '<span class="material-icons text-secondary font-weight-bold">filter_list</span> _MENU_',
            sInfoPostFix: "",
            sUrl: "",
            sInfoThousands: ",",
            decimal: ",",
            thousands: ".",
            oPaginate: {
                sFirst: '<span class="material-icons">first_page</span>',
                sLast: '<span class="material-icons">last_page</span>',
                sPrevious: '<span class="material-icons">arrow_left</span>',
                sNext: '<span class="material-icons">arrow_right</span>'
            },
            oAria: {
                sSortAscending: "Orden Ascendente",
                sSortDescending: "Orden Descendente"
            }
        }
    });
}

/**
 * Refrescamiento de Estados del Formulario
 * @param {*} form 
 */
window.refreshFormModal = function (form) {
    var inputs = form.querySelectorAll('input.form-control');
    inputs.forEach(element => {
        if (element.value) {
            element.parentNode.classList.add("is-focused");
        }
        element.addEventListener('focus', function () {
            element.parentNode.classList.add("is-focused");
        });
        element.addEventListener('blur', function () {
            if (!element.value) {
                element.parentNode.classList.remove("is-focused");
            }
        });
    });
}
