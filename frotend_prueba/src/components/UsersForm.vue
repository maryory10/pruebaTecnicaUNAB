<template>
  <div class="modal fade" ref="modalElement" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">
            Ingresar Horario
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">Correo docente</label>
              <input
                type="email"
                v-model="form.correo"
                class="form-control"
                aria-describedby="emailHelp"
                required
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Código asignatura</label>
              <input
                type="text"
                v-model="form.codigo_asignatura"
                class="form-control"
                required
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Día semana</label>
              <input
                type="text"
                v-model="form.dia_semana"
                class="form-control"
                required
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Hora inicio</label>
              <input
                type="time"
                v-model="form.hora_inicio"
                class="form-control"
                required
              />
            </div>
            <div class="mb-3">
              <label class="form-label">Hora fin</label>
              <input
                type="time"
                v-model="form.hora_fin"
                class="form-control"
                required
              />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="limpiar"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button class="btn btn-primary" @click="guardar">Registrar horario</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from "vue";

const emit = defineEmits(["guardar"]);
const form = ref({
  correo: "",
  codigo_asignatura: "",
  dia_semana: "",
  hora_inicio: "",
  hora_fin:""
});
const modalElement = ref(null);
let bsModal = null;

const guardar = () => {
    emit("guardar", form.value);
};
const limpiar = () => {
   form.value.correo= ""
  form.value.codigo_asignatura = ""
  form.value.dia_semana = "",
  form.value.hora_inicio ="",
  form.value.hora_fin =""
};
onMounted(() => {
  if (modalElement.value && window.bootstrap) {
    bsModal = new window.bootstrap.Modal(modalElement.value);
  }
});
const abrir = () => bsModal?.show();
const cerrar = () => bsModal?.hide();
defineExpose({ abrir, cerrar,limpiar });
</script>