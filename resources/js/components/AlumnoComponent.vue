<template>
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Administrar Alumnos</div>

                    <div class="card-body">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Curso</th>
                                <th>Curreo</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in alumnos" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.curso}}</td>
                                <td>{{item.email}}</td>
                                <td>
                                    <button @click="eliminar(item)" class="btn btn-danger p-1"> <i class="fa fa-trash-o"></i> </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="assign" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{teacher.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="assigninsert">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="curso">Curso</label>
                                    <!--                                    <input type="email" class="form-control" id="curso" placeholder="Email">-->
                                    <select name="curso" id="curso" v-model="curso" required class="form-control">
                                        <option value="">Seleccionar..</option>
                                        <option v-for="item in cursos" v-bind:value="item.id" >{{item.nombre}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="materia">Materia</label>
                                    <!--                                    <input type="text" class="form-control" id="inputPassword4" placeholder="Password">-->
                                    <select name="materia" id="materia" required v-model="materia" class="form-control">
                                        <option value="">Seleccionar..</option>
                                        <option v-for="item in materias" v-bind:value="item.id" >{{item.nombre}}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="materia">Agregar</label><br>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Agregar</button>
                                </div>
                            </div>
                        </form>
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Curso</th>
                                <th>Materia</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in assings" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.curso}}</td>
                                <td>{{item.materia}}</td>
                                <td>
                                    <button @click="eliminarassings(item)" class="btn btn-danger p-1"> <i class="fa fa-trash-o"></i> </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-eye"></i>Ocultar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import $ from 'jquery';
export default {
    mounted() {
        this.datos();
        axios.get('/curso').then(res=>this.cursos=res.data);
        axios.get('/materia').then(res=>this.materias=res.data);
    },
    data(){
        return {
            alumnos:[],
            assings:[],
            materias:[],
            cursos:[],
            teacher:{},
            curso:"",
            materia:"",
        }
    },
    methods:{
        eliminar(item){
            if(confirm('Seguro de elminar?'))
                axios.delete('/user/'+item.id).then(res=>{
                    this.datos();
                })
        },
        datos(){
            axios.get('/user').then(res=>{
                this.alumnos=[];
                res.data.forEach(r=>{
                    if(r.tipo=='alumno'){
                        this.alumnos.push(r);
                    }
                });
            });
        },
        assign(item){
            this.assings=[];
            this.teacher=item;
            this.datassign(this.teacher.id);
            $('#assign').modal('show');
        },
        assigninsert(){
            axios.post('/assign',{user_id:this.teacher.id,curso_id:this.curso,materia_id:this.materia}).then(res=>{
                this.datassign(this.teacher.id);
            });
        },
        datassign(id){
            axios.get('/assign/'+id).then(res=>{
                // console.log(res.data);
                this.assings=res.data;

            });
        },
        eliminarassings(item){
            if(confirm('Seguro de elminar?'))
                axios.delete('/assign/'+item.id).then(res=>{
                    this.datassign(this.teacher.id);
                })
        },
    }
}
</script>
