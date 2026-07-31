<template>
  <div class="container">
    <h1>Prueba registro horarios</h1>
    <div class="input-group mb-3">
      <input
        type="text"
        v-model="busqueda"
        class="form-control"
        placeholder="Buscar por correo del docente"
        aria-label="Recipient's username"
        aria-describedby="button-addon2"
      />
      <button
        class="btn btn-outline-secondary"
        type="button"
        @click="fetchHorarios()"
      >
        Buscar
      </button>
    </div>
    <button @click="abrirModal()" class="btn btn-primary">
      Agregar horario
    </button>
    <UserForm ref="refUserForm" @guardar="guardar" />
    <UserTable :registros="lista" @eliminar="eliminar($event)" />
    <div class="alert alert-danger d-flex align-items-center" role="alert" id= "alertaError" style="display: none">
      <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="Danger:"
      >
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>{{mensaje}}</div>
    </div>
    <div class="alert alert-success d-flex align-items-center" role="alert" id="succesError" style="display: none">
      <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="Danger:"
      >
        <use xlink:href="#exclamation-triangle-fill" />
      </svg>
      <div>{{mensajeSucces}}</div>
    </div>
  </div>
</template>
<script setup>
import UserForm from "../components/UsersForm.vue";
import UserTable from "../components/UsersTable.vue";
import horariosService from "../services/horariosSevice";
import { onMounted, ref } from "vue";

const userForm = ref(false);
const refUserForm = ref(null);
const userSeleccionado = ref([]);
const lista = ref([]);
const busqueda = ref("");
const mensaje = ref("");
const mensajeSucces = ref("");

async function abrirModal(userId = null, flag = 1) {
  if (flag == 1) {
    document.getElementById("succesError").style.display = "none";
    document.getElementById("alertaError").style.display = "none";
    userSeleccionado.value = null;
    refUserForm.value.limpiar();
    refUserForm.value?.abrir();
  }
}
onMounted(async () => {
  await fetchHorarios();
});

async function fetchHorarios() {
  try {
    const params = {
      id_docente: busqueda.value,
    };
    const res = await horariosService.getAll(params);
    lista.value = res;
  } catch (error) {
    console.error("Error al cargar horarios:", error);
  }
}

async function guardar(horario) {
  try {
    console.log(horario);
    await horariosService.createHorario(horario);
    refUserForm.value?.cerrar();
    mensajeSucces.value = "Horario guardado exitosamente"
    document.getElementById("succesError").style.display = "block";
    document.getElementById("alertaError").style.display = "none";
    fetchHorarios();
  } catch (error) {
    refUserForm.value?.cerrar();
    mensaje.value = "Error al guardar el horario"
    document.getElementById("alertaError").style.display = "block";
    document.getElementById("succesError").style.display = "none";

    console.error("Error al guardar el horario:", error);
  }
}
async function eliminar(horarioId) {
  try {
    console.log("Eliminando horario con ID:", horarioId);
    await horariosService.deleteHorario(horarioId);
    fetchHorarios();
  } catch (error) {
    console.error("Error al eliminar el horario:", error);
  }
}
</script>