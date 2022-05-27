<template>
  <div>
    <h1 class="text-center">Gestionar Secciones</h1>

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
                                <div v-if="message_validation.cod_sec != ''" v-text='message_validation.cod_sec' class="text-danger"></div>
                                <input v-model="seccion.codigo" type="text" class="form-control" id="codigo" placeholder="Codigo de sección" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Número de sección:</label>
                                <div v-if="message_validation.nom_sec != ''" v-text='message_validation.nom_sec' class="text-danger"></div>
                                <input v-model="seccion.nombre" type="text" class="form-control" id="nombre" placeholder="Número de sección" required>
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
          <th scope="col">Nombre</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sec in seccion.data" :key="sec.id">
          <th scope="row">{{ sec.id }}</th>
          <td>{{ sec.cod_sec }}</td>
          <td>{{ sec.nom_sec }}</td>
          <td class="text-center">
            <button  @click="modificar=true; abrirModal(sec);" class="btn btn-warning">Editar</button>
          </td>
          <td class="text-center">
            <button @click="eliminar(sec.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div> </div> </div>
</template>

<script>
export default {
  data() {
    return {
      seccion:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      seccions: [],

        message_validation: {

            cod_sec: '',
            nom_sec: '',
        },
    };
  },
      methods: {
        async listar() {
          const res = await axios.get('./api/seccion/');
          this.seccion = res.data;
        },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/seccion/'+ this.id;

                axios.put(url, {
                    'id'     : this.id,
                    'cod_sec': this.seccion.codigo,
                    'nom_sec': this.seccion.nombre,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'La Sección fue actualizada', 'success');
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

                let url = './api/seccion/';

                axios.post(url, {

                    'id': this.update,
                    'cod_sec': this.seccion.codigo,
                    'nom_sec': this.seccion.nombre,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Sección fue registrada', 'success');
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
                text: "Se eliminará la Sección!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/seccion/' + id;

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
            this.message_validation.cod_sec = '';
            this.message_validation.nom_sec = '';
        },

        abrirModal(data={}){
          this.modal=1;
          if(this.modificar){
            this.id=data.id;
            this.tituloModal="Modificar Seccion";
            this.seccion.codigo=data.cod_sec;
            this.seccion.nombre=data.nom_sec;
          }else{
            this.id=0;
            this.tituloModal="Crear Seccion";
            this.seccion.codigo='';
            this.seccion.nombre='';
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
