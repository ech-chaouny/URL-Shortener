import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler.js";
import { createPinia } from "pinia";
import Home from "@/components/Home.vue";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

const app = createApp({});
const pinia = createPinia();
app.component("home-component", Home);

app.use(Toast);
app.use(pinia);
app.mount("#app");
