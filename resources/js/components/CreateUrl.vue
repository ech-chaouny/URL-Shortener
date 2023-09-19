<template>
  <div class="my-3 d-flex justify-content-center">
    <h3>Paste the URL to be shortened</h3>
  </div>
  <form @submit.prevent="store.AddUrls(user_id)">
    <!-- Full URL input -->
    <div class="form-group mb-2">
      <input
        type="text"
        v-model="store.Url.data.full_link"
        class="form-control"
        placeholder="Enter The link here"
      />
      <span v-if="store.getErrors" class="text-danger mt-1" role="alert">
        <strong>{{ store.getErrors.full_link[0] }}</strong>
      </span>
    </div>
    <!-- Full Name input -->
    <div class="form-group mb-3">
      <input
        type="text"
        v-model="store.Url.data.name_link"
        class="form-control"
        placeholder="Enter The name of the link"
      />
      <span v-if="store.getErrors" class="text-danger mt-1" role="alert">
        <strong>{{ store.getErrors.name_link[0] }}</strong>
      </span>
    </div>
    <!-- Submit button -->
    <div class="col-md-12">
      <button type="submit" class="btn btn-dark text-white rounded-pill w-100">
        Shorten link
      </button>
    </div>
  </form>
</template>

<script setup>
import { inject } from "vue";
import { useUrlStore } from "@/stores/useUrlStore";

//get store from useURLsotre;
const store = useUrlStore();
//get user_id
const user_id = inject("user_id");
</script>
<style></style>
