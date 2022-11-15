import { createApp } from "vue";
import App from "./App.vue";
import store from "./store";
import router from "./router";

//style
import "./index.css";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap/dist/js/bootstrap.min";

createApp(App).use(store).use(router).mount("#app");
