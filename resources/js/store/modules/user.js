import { baseURL, http, Csrf, setUserDataToLocalStorage, setAuth, } from "../../boot";
import { useRouter } from 'vue-router'
import routes from '../../router/index'
const router = useRouter()
const state = () => ({
    currentUser: {},
    // currentUser: JSON.parse(localStorage.getItem('CurrentUser')) || {},
    userData: JSON.parse(localStorage.getItem('UserData')) || {},
    isAuthenticated: 'false',
})

const getters = {
    getAuth: state => state.isAuthenticated,
    getCurrentUser: state => state.currentUser,
    getUserData: state => state.userData,
}

const mutations = {
    updateAuth(state, data) {
        state.isAuthenticated = data
    },
}

const actions = {
    async registerUser(context, payload) {
        await Csrf.getCookie()
        return new Promise((resolve, reject) => {
                http.post(`${baseURL}/register`, payload)
                    .then(response => {
                        setUserDataToLocalStorage(response.data.user)
                        context.commit('updateUserDetails', response.data.user)
                        resolve(response.data.data)
                    })
                    .catch(error => reject(error))
            })

    },
    async loginUser(context, payload) {
        await Csrf.getCookie()
        return new Promise((resolve, reject) => {
            http.post(`${baseURL}/login`, payload)
            .then(response => {
                if (response.data.user !== null) {
                    // context.dispatch('fetchUserProfile')p
                    setAuth(true)
                    context.commit('updateAuth', true)
                    resolve(response.data)
                }else {
                    context.commit('updateAuth', false)
                    resolve(response.data)
                }
            }).catch(error => reject(error))
        })
    },
    logout(context, payload) {
        return new Promise((resolve, reject) => {
            http.get(`${baseURL}/logout`, payload)
                .then(response => {
                    localStorage.clear()
                    context.commit('updateAuth', false)
                    resolve(response)
                }).catch(error => {
                reject(error)
            })
        })
    },
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}
