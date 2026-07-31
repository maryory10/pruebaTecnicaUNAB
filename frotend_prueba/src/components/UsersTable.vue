<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Docente asignado</th>
        <th scope="col">Día de clase</th>
        <th scope="col">Hora inicio</th>
        <th scope="col">Hora fin</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="registro in registros" :key="registro.id">
        <td>{{ registro.docente?.correo }}</td>
        <td>{{ registro.dia_semana }}</td>
        <td>{{ registro.hora_inicio }}</td>
        <td>{{ registro.hora_fin }}</td>
        <td>
          <div class="d-flex gap-2">
            <button
              class="btn btn-danger"
              @click="$emit('eliminar', registro.id)"
            >
              Eliminar
            </button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script setup>
defineProps({
  registros: {
    type: Array,
    required: true,
  },
});

defineEmits(["eliminar"]);
</script>