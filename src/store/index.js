import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    msg: "I think Vue CLI is wonderful. " +
    "It builds the whole package for your application which saves you time and also minimizes mistakes you would have made creating the structure of your application." +
    " It reminds me of express cli that we used last semester in mobile development. I have also seen a lot of Vue projects and they were build like these which I was confused at first" +
    " but makes sense now.",
    student: [],
    auth: false,
    username: ""
  },
  getters: {
    deansList: function (state) {
      return state.student.filter(function (stu) {
        return stu.gpa > 3.5;
      });
    },
    deansListCount: function (state, getters) {
      return getters.deansList.length;
    },
    setGPAColor: function (state) {
      return state.student.filter(function (stu) {
        return stu.gpa;
      });
    },
  },
  mutations: {
    setNewStudent: function (state, payload) {
      state.student.push(Object.assign({}, payload));
    },
    clearData: function (state) {
      state.student = [];
      state.student.registeration = [];
      state.student.newStudent = [];
      state.student.newStudent.registerations = [];
      state.student.registeration.bookFormat = [];
    },
  },
  actions: {
    clearData: function (context) {
      context.commit("clearData");
    },
  },
  modules: {
  }
})
