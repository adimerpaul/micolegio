require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('teacher-component', require('./components/TeacherComponent.vue').default);
Vue.component('materia-component', require('./components/MateriaComponent.vue').default);
Vue.component('curso-component', require('./components/CursoComponent.vue').default);
Vue.component('alumno-component', require('./components/AlumnoComponent.vue').default);
Vue.component('planificaciondocente-component', require('./components/PlanificacionDocenteComponent.vue').default);

const app = new Vue({
    el: '#app',
});
