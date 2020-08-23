<template>
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-book"></i> Mis Materias</div>
                    <div class="card-body">
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
                            <tr v-for="(item,index) in materias" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.curso}}</td>
                                <td>{{item.materia}}</td>
                                <td>
                                    <button @click="planselect(item)" class="btn btn-warning p-1 text-white"> <i class="fa fa-plus"></i> Planificar </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{teacher.name}} {{assignselect.curso}} {{assignselect.materia}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="updateAvatar">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" v-model="plan.nombre" class="form-control" id="nombre" placeholder="Nombre">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tipo">Tipo</label>
                                    <select name="tipo" v-model="plan.tipo" id="tipo"  required  class="form-control">
                                        <option value="">Seleccionar..</option>
                                        <option value="TEMA">TEMA</option>
                                        <option value="PRACTICA">PRACTICA</option>
                                        <option value="EXAMEN">EXAMEN</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label >Archivo </label>
                                    <input type="file" name="image" @change="getImage" accept="file/*" required>
                                </div>
                                <div class="col-md-3">
                                    <label >Agregar</label><br>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Agregar</button>
                                </div>
                            </div>
                        </form>
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descargar</th>
                                <th>tipo</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in plans" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.nombre}}</td>
                                <td><a target="_blank" v-bind:href="item.archivo">Descargar</a></td>
                                <td>{{item.tipo}}</td>
                                <td>{{item.estado}}</td>
                                <td>
                                    <button @click="eliminarplan(item)" class="btn btn-danger p-1"> <i class="fa fa-trash-o"></i> </button>
                                    <button v-if="item.tipo!='TEMA'" @click="ver(item)" class="btn btn-success p-1"> <i class="fa fa-android"></i> ver enviados </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-eye"></i>Ocultar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tareas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" >{{teacher.name}} {{tarea.nombre}} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descargar</th>
                                <th>Nota</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in tareas" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.name}}</td>
                                <td><a target="_blank" v-bind:href="item.archivo">Descargar</a></td>
                                <td>{{item.nota}}</td>
                                <td>
                                    <input type="text" @keyup="cambionota(item)" v-model="item.nota" width="25px">
<!--                                    <button v-if="item.nota=='ENVIADO'" @click="nota(item)" class="btn btn-success p-1"> <i class="fa fa-android"></i> ver enviados </button>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
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
        // this.datos();
        axios.get('/usuario').then(res=>this.teacher=res.data);

        axios.get('/materiasdocente').then(res=>this.materias=res.data);
    },
    data(){
        return {
            // teachers:[],
            assings:[],
            materias:[],
            plan:{tipo:''},
            // cursos:[],
            teacher:{},
            // curso:"",
            // materia:"",
            assignselect:{},
            imagen : null,
            plans:[],
            tareas:[],
            tarea:{},
        }
    },
    methods:{
        getImage(event){
            //Asignamos la imagen a  nuestra data
            this.imagen = event.target.files[0];
        },
        cambionota(item){
            console.log(item);
            axios.put('/tarea/'+item.id,item).then(res=>{

            });
        },
        updateAvatar(){
            //Creamos el formData
            var data = new  FormData();
            //Añadimos la imagen seleccionada
            data.append('avatar', this.imagen);
            data.append('nombre', this.plan.nombre);
            data.append('tipo', this.plan.tipo);
            data.append('assign_id', this.assignselect.id);
            //Añadimos el método PUT dentro del formData
            // Como lo hacíamos desde un formulario simple _(no ajax)_
            // data.append('_method', 'PUT');
            //Enviamos la petición
            axios.post('/plan',data)
                .then(response => {
                    // console.log(response)
                    this.datosplan(this.assignselect);
                })
        },
        datosplan(item){
            axios.get('/plan/'+item.id).then(res=>{
                // console.log(res.data);
                this.plans=res.data;
            })
        },
        ver(item){
            this.tarea=item;
            axios.get('/tarea/'+item.id).then(res=>{
                // console.log(res.data);
                this.tareas=res.data;
                $('#plan').modal('hide');
                $('#tareas').modal('show');
            })

        },
        eliminarplan(item){
            if(confirm('Seguro de elminar?'))
                axios.delete('/plan/'+item.id).then(res=>{
                    this.datosplan(this.assignselect);
                }).catch(res=>{
                    alert('No se puede borrar por que alumnos entregaron este tema')
                })
        },
        // eliminar(item){
        //     if(confirm('Seguro de elminar?'))
        //         axios.delete('/user/'+item.id).then(res=>{
        //             this.datos();
        //         })
        // },
        // datos(){
        //     axios.get('/user').then(res=>{
        //         this.teachers=[];
        //         res.data.forEach(r=>{
        //             if(r.tipo=='teacher'){
        //                 this.teachers.push(r);
        //             }
        //         });
        //     });
        // },
        planselect(item){
            this.assignselect=item;
            this.datosplan(this.assignselect);
            $('#plan').modal('show');
        },
        // assign(item) {
        //     this.assings = [];
        //     this.teacher=item;
        //     this.datassign(this.teacher.id);
        //     $('#assign').modal('show');
        // },
        // assigninsert(){
        //     axios.post('/assign',{user_id:this.teacher.id,curso_id:this.curso,materia_id:this.materia}).then(res=>{
        //         this.datassign(this.teacher.id);
        //     });
        // },
        // datassign(id){
        //     axios.get('/assign/'+id).then(res=>{
        //         console.log(res.data);
        //         this.assings=res.data;
        //     });
        // },
        // eliminarassings(item){
        //     if(confirm('Seguro de elminar?'))
        //         axios.delete('/assign/'+item.id).then(res=>{
        //             this.datassign(this.teacher.id);
        //         })
        // },
    }
}
</script>
