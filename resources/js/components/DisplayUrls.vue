<template>
  <div class="card mt-5" style="border-radius: 1rem">
    <div class="card-body p-4">
      <div class="my-3 d-flex justify-content-center">
        <h3>List of shortened URLs</h3>
      </div>
      <table class="table">
        <thead>
          <tr class="text-center">
            <th scope="col">Name URL</th>
            <th scope="col">Short URL</th>
            <th scope="col">Original URL</th>
            <!-- It increases when someone copies the link and clicks on the copied link -->
            <th scope="col">Visits</th>
            <th scope="col">Created</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="url in store.getUrls" :key="url.id">
            <td>{{ url.name_link }}</td>
            <td>
              <a
                :href="url.full_link"
                class="text-dark text-decoration-none"
                target="_blank"
              >
                {{ url.shortner_link }}
              </a>
            </td>
            <td class="col-md-4">
              <a
                :href="url.full_link"
                class="text-dark text-decoration-none"
                target="_blank"
                >{{ limitCharacters(url.full_link, 37) }}
              </a>
            </td>
            <!-- It increases when someone copies the link and clicks on the copied link -->
            <td class="text-center">{{ url.visits }}</td>
            <td class="text-center">
              <small>{{ url.created_at }}</small>
            </td>
            <td>
              <div class="d-flex flex-row align-items-center">
                <a
                  :href="url.full_link"
                  target="_blank"
                  class="btn btn-outline-secondary btn-sm"
                >
                  <i class="fa fa-eye"></i>
                </a>
                <a
                  type="submit"
                  @click="copyUrl(url.shortner_link)"
                  class="btn btn-outline-primary btn-sm mx-2"
                >
                  <i class="fa-solid fa-copy"></i>
                </a>
                <a
                  type="submit"
                  @click="store.deleteUrl(url.id, user_id)"
                  class="btn btn-outline-danger btn-sm"
                >
                  <i class="fa fa-trash"></i>
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { inject, onMounted } from "vue";
import { useUrlStore } from "@/stores/useUrlStore";
import { useToast } from "vue-toastification";

const toast = useToast();

//get store from useURLsotre;
const store = useUrlStore();
const user_id = inject("user_id");

const limitCharacters = (str, limit) => {
  if (str.length > limit) {
    return str.slice(0, limit) + "..."; // Display ellipsis (...) if the string is longer than the limit
  }
  return str;
};
const copyUrl = (shortner_link) => {
  navigator.clipboard.writeText(`127.0.0.1:8000/visit/${shortner_link}`);
  toast.info("The url was copied successfully ");
};
onMounted(() => store.fetchUrls(user_id));
</script>

<style></style>
