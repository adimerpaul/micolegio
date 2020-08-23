<template>
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Administrar Materia</div>

                    <div class="card-body">
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item,index) in materias" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.nombre}}</td>
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
            materias:[],
        }
    },
    methods:{
        datos(){
            axios.get('/materia').then(res=>{
                this.materias= res.data;
            });
        },
        eliminar(item){
            if (confirm('Seguro de eliminar?'))
            axios.delete('/materia/'+item.id).then(res=>{
                this.datos();
            });
        }
    }
}
</script>
