<template>
    <div class="max-w-4xl mx-auto p-6 bg-gray-100">
      <h1 class="text-3xl font-bold text-center mb-4">Sucursal #1 - Operaciones</h1>
  
      <div class="grid grid-cols-2 gap-4">
        <button @click="abrirCaja" class="bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">Abrir Caja</button>
        <button @click="agregarBilletes" class="bg-green-500 text-white p-3 rounded-lg hover:bg-green-600">Agregar Billetes</button>
        <button @click="mostrarModal = true" class="bg-yellow-500 text-white p-3 rounded-lg hover:bg-yellow-600">Cambiar Cheque</button>
        <button class="bg-red-500 text-white p-3 rounded-lg hover:bg-red-600">Corte de Caja</button>
      </div>
  
      <!-- Modal -->
      <div v-if="mostrarModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <h3 class="text-lg font-semibold mb-2">Ingrese el importe</h3>
          <input type="number" v-model="importe" class="w-full p-2 border border-gray-300 rounded-lg">
          
          <div class="flex justify-between mt-4">
            <button @click="mostrarModal = false" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancelar</button>
            <button @click="cambiarCheque" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Aceptar</button>
          </div>
  
          <div v-if="Object.keys(resultado).length > 0" class="mt-4">
            <h3 class="text-lg font-semibold">Billetes Entregados:</h3>
            <ul>
              <li v-for="(cantidad, denom) in resultado" :key="denom">
                {{ denom }} : {{ cantidad }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        mostrarModal: false,
        importe: '',
        resultado: {}
      };
    },
    methods: {
      abrirCaja() {
        alert("Caja abierta");
      },
      agregarBilletes() {
        alert("Billetes agregados");
      },
      cambiarCheque() {
        fetch('/api/cambiar-cheque', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ importe: this.importe, sucursal: 1 })
        })
        .then(response => response.json())
        .then(data => this.resultado = data)
        .catch(error => alert('Error en la transacción'));
      }
    }
  };
  </script>
  
  <style>
  body {
    font-family: Arial, sans-serif;
  }
  </style>
  