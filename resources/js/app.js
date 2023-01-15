import './bootstrap';
import { createApp } from 'vue';

import router from './router'
import store from "./store"

const app = createApp({});

// import App from './components/App.vue';
// app.component('app-component', App);
app.config.compilerOptions.isCustomElement = (tag) => {
    return tag.startsWith('cente')
}

app.use(store);
app.use(router);
app.mount("#app");
