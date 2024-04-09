// src/store.js
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        userData: {
            name: '',
            surname: '',
            email: '',
            avatar: null
        }
    },
    mutations: {
        updateUserData(state, payload) {
            state.userData = { ...state.userData, ...payload };
        }
    },
    actions: {
        updateUserData({ commit }, payload) {
            commit('updateUserData', payload);
        }
    },
    getters: {
        getUserData(state) {
            return state.userData;
        }
    }
});
