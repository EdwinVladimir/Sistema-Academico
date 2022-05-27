<template>
  <div>
    <h1 class="text-center">Gestionar Aula</h1>
    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

    <div class="modal" :class="{mostrar: modal}">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{tituloModal}}</h4>
                    <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <!-- Modal body -->
                <form @submit.prevent="guardar()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Codigo:</label>
                                <div v-if="message_validation.cod_aul != ''" v-text='message_validation.cod_aul' class="text-danger"></div>
                                <input v-model="aula.codigo" type="text" class="form-control" id="codigo" placeholder="Codigo del Aula" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Número del Aula:</label>
                                <div v-if="message_validation.num_aul != ''" v-text='message_validation.num_aul' class="text-danger"></div>
                                <input v-model="aula.numero" type="text" class="form-control" id="numero" placeholder="Número del Aula" required>
                            </div>
                        </div>
                          <!-- Modal footer -->
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button class="btn btn-success" data-dismiss="modal">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- The Modal -->
   <div class="card">
  <div class="card-body">
       <table class="table table-striped table-hover table-condensed">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Código</th>
          <th scope="col">Número</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="aul in aula.data" :key="aul.id">
          <td scope="row">{{ aul.id }}</td>
          <td>{{ aul.cod_aul }}</td>
          <td>{{ aul.num_aul }}</td>
          <td class="text-center">
            <button  @click="modificar=true; abrirModal(aul);" class="btn btn-warning">Editar</button>
          </td >
          <td class="text-center">
            <button @click="eliminar(aul.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
 </div>
  </div>
   </div>
</template>

<script>
  export default {
  data() {
    return {
      aula:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      aul: [],

        message_validation: {

            cod_aul: '',
            num_aul: '',
        },
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/aula');
      this.aula = res.data;
    },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/aula/'+ this.id;

                axios.put(url, {
                    'id'     : this.id,
                    'cod_aul': this.aula.codigo,
                    'num_aul': this.aula.numero,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Aula fue actualizado', 'success');
                })
                .catch(error => {

                    if(error.response.status == 422)
                    {
                        let errors = error.response.data.errors

                        this.ErrorMessages(errors);

                        swal('Error!', 'Revise el formulario y corrija los campos de color rojo', 'error');
                    }
                });

            }
            else
            {
                this.LimpiarMensajesErrores();

                let url = './api/aula/';

                axios.post(url, {

                    'id': this.update,
                    'cod_aul': this.aula.codigo,
                    'num_aul': this.aula.numero,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'El Aula fue registrado', 'success');
                    }
                })
                .catch(error => {

                    if(error.response.status == 422)
                    {
                        let errors = error.response.data.errors

                        this.ErrorMessages(errors);

                        swal('Error!', 'Revise el formulario y corrija los campos de color rojo', 'error');
                    }
                });
            }
        },

        eliminar(id)
        {
            swal({
                title: "¿Esta seguro de eliminar?",
                text: "Se eliminará el Aula!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/aula/' + id

                    axios.delete(url)
                    .then(response => {

                        swal('Correcto!', 'Eliminación correcta', 'success');

                        this.listar();
                    })
                    .catch(error => {

                        console.log(error);
                    });
                }
            });
        },

        ErrorMessages(errors)
        {
            for (const index in errors)
            {
                this.message_validation[index] = errors[index][0]
            }
        },

        LimpiarMensajesErrores()
        {
            this.message_validation.cod_aul = '';
            this.message_validation.num_aul = '';
        },

    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Aula";
        this.aula.codigo=data.cod_aul;
        this.aula.numero=data.num_aul;
      }else{
        this.id=0;
        this.tituloModal="Crear Aula";
        this.aula.codigo='';
        this.aula.numero='';
      }
    },
    cerrarModal(){
      this.modal=0;
    },
  },
  created() {
    this.listar();
  },
};
</script>

<style>
  .mostrar{
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
  }
</style>
