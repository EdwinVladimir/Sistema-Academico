<template>
  <div>
    <h1 class="text-center">Gestionar Tipo de Cursos</h1>

    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

    <!-- The Modal -->
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
                                <div v-if="message_validation.nom_curso != ''" v-text='message_validation.nom_curso' class="text-danger"></div>
                                <input v-model="tipocurso.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Tipo de Curso" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="descripcion">Descripción:</label>
                                <div v-if="message_validation.desc_curso != ''" v-text='message_validation.desc_curso' class="text-danger"></div>
                                <input v-model="tipocurso.descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripción del Tipo de Curso" required>
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
          <th scope="col">Ord</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
           <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tpcur in tipocurso.data" :key="tpcur.id">
          <th scope="row">{{ tpcur.id }}</th>
          <td>{{ tpcur.nom_curso }}</td>
          <td>{{ tpcur.desc_curso }}</td>
          <td class="text-center">
            <button  @click="modificar=true; abrirModal(tpcur);" class="btn btn-warning">Editar</button>
          </td>
          <td class="text-center">
            <button @click="eliminar(tpcur.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>  </div>  </div>
</template>

<script>
export default {
  data() {
    return {
      tipocurso:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      tpcur: [],

        message_validation: {

            nom_curso: '',
            desc_curso: '',
        },
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/tipocurso');
      this.tipocurso = res.data;
    },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/tipocurso/'+ this.id;

                axios.put(url, {
                    'id'     : this.id,
                    'nom_curso': this.tipocurso.nombre,
                    'desc_curso': this.tipocurso.descripcion,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Tipo de Curso fue actualizado', 'success');
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

                let url = './api/tipocurso/';

                axios.post(url, {

                    'id': this.update,
                    'nom_curso': this.tipocurso.nombre,
                    'desc_curso': this.tipocurso.descripcion,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'El Tipo de Curso fue registrado', 'success');
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
                text: "Se eliminará el Tipo de Curso!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/tipocurso/' + id;

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
            this.message_validation.nom_curso  = '';
            this.message_validation.desc_curso = '';
        },

    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Tipo Curso";
        this.tipocurso.nombre=data.nom_curso;
        this.tipocurso.descripcion=data.desc_curso;
      }else{
        this.id=0;
        this.tituloModal="Crear Tipo Curso";
        this.tipocurso.nombre='';
        this.tipocurso.descripcion='';
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
