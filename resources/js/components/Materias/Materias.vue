<template>
  <div>
    <h1 class="text-center">Gestionar Materias</h1>

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
                                <label for="nombre">Nombre:</label>
                                <div v-if="message_validation.nom_mat != ''" v-text='message_validation.nom_mat' class="text-danger"></div>
                                <input v-model="materias.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre de la Materia" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="nhora">Detalle:</label>
                                <div v-if="message_validation.nhor_mat != ''" v-text='message_validation.nhor_mat' class="text-danger"></div>
                                <input v-model="materias.nhora" type="number" class="form-control" id="nhora" placeholder="Número de Horas" required>
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

   <div class="card">
  <div class="card-body">
       <table class="table table-striped table-hover table-condensed">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Ord</th>
          <th scope="col">Nombre</th>
          <th scope="col">Detalle</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mat in materias.data" :key="mat.id">
          <th scope="row">{{ mat.id }}</th>
          <td>{{ mat.nom_mat }}</td>
          <td>{{ mat.nhor_mat }}</td>
          <td class="text-center">
            <button  @click="modificar=true; abrirModal(mat);" class="btn btn-warning">Editar</button>
          </td>
          <td class="text-center">
            <button @click="eliminar(mat.id)" class="btn btn-danger">
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
      materias:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      mat: [ ],
      mate: [ ],

        message_validation: {

            nom_mat: '',
            nhor_mat: '',
        },
    };
  },
      methods: {
        async listar() {
          const res = await axios.get('./api/materia/');
          this.materias = res.data;

        },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/materia/' + this.id;

                axios.put(url, {
                    'id'     : this.id,
                    'nom_mat':  this.materias.nombre,
                    'nhor_mat': this.materias.nhora,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'La Materia fue actualizada', 'success');
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

                let url = './api/materia/';

                axios.post(url, {

                    'id': this.update,
                    'nom_mat':  this.materias.nombre,
                    'nhor_mat': this.materias.nhora,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Materia fue registrada', 'success');
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
                text: "Se eliminará la Materia!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/materia/' + id;

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
            this.message_validation.nom_mat = '';
            this.message_validation.nhor_mat = '';
        },

        abrirModal(data={}){
          this.modal=1;
          if(this.modificar){
            this.id=data.id;
            this.tituloModal="Modificar Materia";
            this.materias.nombre=data.nom_mat;
            this.materias.nhora=data.nhor_mat;
          }else{
            this.id=0;
            this.tituloModal="Crear Materia";
            this.materias.nombre='';
            this.materias.nhora='';
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
