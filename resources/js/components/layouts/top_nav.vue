<template>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
            <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" :href="$router.resolve({name: 'dashboard'}).href" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom">
                <span>DKB •</span> Draggable Kanban Board
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
                <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                    <a>
                        DKB•
                    </a>
                    </div>
                    <div class="col-6 collapse-close text-right">
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
                    </div>
                </div>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-default d-none d-lg-block" href="javascript:void(0)" @click="logout">
                        <i class="tim-icons icon-lock-circle"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
            </div>
        </nav>
        <!-- End Navbar -->
</template>
<script setup>
import { computed, onMounted } from 'vue'
import {useStore} from "vuex";
const cl =  console.log;
import { useRouter } from 'vue-router'
const router = useRouter()
const store = useStore()

const logout = () => {
    store.dispatch('user/logout')
    .then(res => {
        router.push({ name: 'login'})
    })
    .catch(err => err)
}

</script>