// =============================================
// validacion.js — Validación del formulario
// =============================================

(function () {
    'use strict';

    const form = document.getElementById('formProducto');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        let valido = true;

        // Obtener campos
        const nombre      = document.getElementById('nombre');
        const categoria   = document.getElementById('categoria');
        const precio      = document.getElementById('precio');
        const descripcion = document.getElementById('descripcion');

        // Validar nombre
        if (!nombre.value.trim()) {
            nombre.classList.add('is-invalid');
            valido = false;
        } else {
            nombre.classList.remove('is-invalid');
            nombre.classList.add('is-valid');
        }

        // Validar categoría
        if (!categoria.value) {
            categoria.classList.add('is-invalid');
            valido = false;
        } else {
            categoria.classList.remove('is-invalid');
            categoria.classList.add('is-valid');
        }

        // Validar precio
        const precioVal = parseFloat(precio.value);
        if (!precio.value.trim() || isNaN(precioVal) || precioVal < 0) {
            precio.classList.add('is-invalid');
            valido = false;
        } else {
            precio.classList.remove('is-invalid');
            precio.classList.add('is-valid');
        }

        // Validar descripción
        if (!descripcion.value.trim()) {
            descripcion.classList.add('is-invalid');
            valido = false;
        } else {
            descripcion.classList.remove('is-invalid');
            descripcion.classList.add('is-valid');
        }

        // Bloquear envío si hay errores
        if (!valido) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
})();
