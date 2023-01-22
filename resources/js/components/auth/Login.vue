<template>
        <div class="wrapper">
            <div class="page-header header-filter">
                <div class="squares square1"></div>
                <div class="squares square2"></div>
                <div class="squares square3"></div>
                <div class="squares square4"></div>
                <div class="squares square5"></div>
                <div class="squares square6"></div>
                <div class="squares square7"></div>
                <div class="content-center">
                    <div class="col-lg-5 col-md-6 offset-lg-3 offset-md-0">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Login</h2>
                            </div>
                            <div class="card-body">
                                <form class="form" method="POST">
                                        <label for="">Email: admin@demo.com</label>
                                        <br>
                                        <label for="">Password: password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <i class="tim-icons icon-email-85"></i>
                                            </div>
                                        </div>
                                        <input type="text" v-model="email" placeholder="Email" class="form-control">
                                        <div class="invalid-feedback d-block">{{ errors.email }}</div>
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                            <i class="tim-icons icon-lock-circle"></i>
                                            </div>
                                        </div>
                                        <input type="text" v-model="password" class="form-control" placeholder="Password" >
                                        <div class="invalid-feedback d-block">{{ errors.password }}</div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" :disabled="isWorking" @click="login" class="btn btn-primary btn-block">
                                            {{ isWorking ? "Please wait" : "Login" }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script setup>
import { ref, watchEffect, computed } from 'vue';
import {useStore} from "vuex";
const store = useStore()
import { useRouter } from 'vue-router'
const router = useRouter()

const errorMessage = ref('')
let errors = ref({})
const isWorking = ref(false)
const email = ref(null)
const password = ref(null)

const auth = computed(() => store.getters['user/getAuth'])

watchEffect(() => {
    if (email.value) errorMessage.value = ''
    if (password.value) errorMessage.value = ''
})

const login = (e) => {
    e.preventDefault()
    if (/\s/g.test(password.value)){
        errorMessage.value = 'Password should not be null'
    }else
    if (email.value !== null && password.value !== null ) {
        isWorking.value = true
        store.dispatch('user/loginUser', { email: email.value , password: password.value })
            .then(response => {
                isWorking.value = false
                if (response.user == null) {
                    errorMessage.value = response.message
                } else {
                    router.go({name: 'dashboard'})
                }
            })
            .catch(error => {
                if (error.response !== undefined) {
                    errorMessage.value = error.response.data.message !== undefined ? error.response.data.message : ''
                    errors.value = error.response.data.errors
                }
                isWorking.value = false
            })
    }
}
</script>
