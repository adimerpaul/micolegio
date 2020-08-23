<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Materias del Curso : {{user.curso}}</div>
                    <div class="card-body">
                        <button @click="selectplan(item)" class="btn btn-success m-1" v-for="item in materias">{{item.materia}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" > {{assignselect.curso}} {{assignselect.materia}}</h5>
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
                                <th>Tipo</th>
                                <th>Nota</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in plans" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.nombre}}</td>
                                <td><a target="_blank" v-bind:href="item.archivo">Descargar</a></td>
                                <td>{{item.tipo}}</td>
                                <td>
                                    <template v-if="item.tipo!='TEMA'">
                                        <div v-if="item.tarea!='ENVIADO'" class="row">
                                            <div class="col-6">
                                                <input type="file" @change="enviartarea" >
                                            </div>
                                            <div class="col-6">
                                                <button @click="enviar(item)" class="btn btn-info p-1"> <i class="fa fa-file"></i> Enviar</button>
                                            </div>
                                        </div>
                                        <div v-else class="row">
                                            <div class="col-12">
                                                {{item.tarea}}
                                            </div>
                                        </div>
                                    </template>
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
    import $ from "jquery";

    export default {
        mounted() {
            // console.log('Component mounted.')
            axios.get('/assign').then(res=>{
                // console.log(res.data);
                this.materias=res.data;
            });
            axios.get('/usuario').then(res=>this.user=res.data);
        },
        data(){
            return {
                materias:[],
                user:{},
                assignselect:{},
                plans:[],
                imagen:null
            }
        },
        methods:{
            enviartarea(event){
                this.imagen = event.target.files[0];
            },
            enviar(item){
                let form=new FormData();
                form.append('archivo',this.imagen);
                form.append('plan_id',item.id);
                axios.post('/tarea',form).then(res=>{
                    // console.log(res);
                    this.datosplan(this.assignselect);
                });
            },
            selectplan(item){
                this.assignselect=item;
                this.datosplan(this.assignselect);
                $('#plan').modal('show');
            },
            datosplan(item){
                axios.get('/plan/'+item.id).then(res=>{
                    // console.log(res.data);
                    this.plans=res.data;
                })
            },
        }
    }
</script>
