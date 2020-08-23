<template>
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Administrar cursos</div>

                    <div class="card-body">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Abreviatura</th>
                                <th>Encargado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in cursos" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.nombre}}</td>
                                <td>{{item.abreviatura}}</td>
                                <td>{{item.encargado}}</td>
                                <td>
                                    <button @click="eliminar(item)" class="btn p-1 btn-danger"> <i class="fa fa-trash-o"></i> </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        // console.log('Component mounted.')
        this.datos();
    },
    data(){
        return {
            cursos:[],
        }
    },
    methods:{
        datos(){
            axios.get('/curso').then(res=>{
                console.log(res.data);
                this.cursos= res.data;
            });
        },
        eliminar(item){
            if (confirm('Seguro de eliminar?'))
                axios.delete('/curso/'+item.id).then(res=>{
                    this.datos();
                });
        }
    }
}
</script>
