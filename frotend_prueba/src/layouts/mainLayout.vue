<template>
  <div>
    <Menu />

    <div>
      <router-view />
    </div>
  </div>
</template>
<script setup>
import Menu from "../components/Menu.vue";
</script>