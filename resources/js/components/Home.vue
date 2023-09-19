<template>
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-md-6">
      <CreateUrl />
    </div>
    <div class="col-md-10">
      <DisplayUrls />
    </div>
    <div class="col-md-10">
      <MostUrlsVisits />
    </div>
  </div>
</template>

<script setup>
import { provide } from "vue";
import CreateUrl from "./CreateUrl.vue";
import DisplayUrls from "./DisplayUrls.vue";
import MostUrlsVisits from "./MostUrlsVisits.vue";

provide("user_id", props.user_id);
const props = defineProps({
  user_id: {
    type: Number,
    required: true,
  },
});
</script>
<style>
</style>
