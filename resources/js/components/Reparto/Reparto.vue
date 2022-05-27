<template>
  <div>
     <h1 class="text-center">Gestionar Reparto</h1>
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
                                <label for="">Nombres:</label>
                                <div v-if="message_validation.nom_reparto != ''" v-text='message_validation.nom_reparto' class="text-danger"></div>
                                <input v-model="reparto.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del reparto" required>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Descripcion:</label>
                                <div v-if="message_validation.desc_reparto != ''" v-text='message_validation.desc_reparto' class="text-danger"></div>
                                <input v-model="reparto.descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripción del reparto" required>
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
    <div class="row">
        <div class="col-lg-1 form-group">
            <label for="">Lista:</label>
            <select v-model="cantidadVer" class="form-control" @change="listar(1)">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>
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
        <tr v-for="repart in reparto.data" :key="repart.id">
          <th scope="row">{{ repart.id }}</th>
          <td>{{ repart.nom_reparto }}</td>
          <td>{{ repart.desc_reparto }}</td>
          <td class="text-center">
            <button @click="modificar=true; abrirModal(repart);" class="btn btn-warning">Editar</button>
          </td>
          <td class="text-center">
            <button @click="eliminar(repart.id)" class="btn btn-danger">
              Eliminar
            </button>
            </td>
        </tr>
      </tbody>
    </table>
      </div>
        </div>
    <div class="card-body">
        <div class="m-0 float-left">
            <span>Mostrando del <b>{{ paginacion.from }}</b> al <b>{{ paginacion.to }}</b> de <b> {{  paginacion.total }} </b> registros</span>
        </div>
        <ul class="pagination  m-0 float-right">
            <li class="page-item"   :class="[paginacion.currentPage == 1 ? 'disabled' : '']" >
                <a href="#" class="page-link" @click.prevent="SelectPage(paginacion.currentPage - 1)" ><i class="fe-chevron-left"></i>Anterior</a>
            </li>
            <el-select v-model="paginacion.currentPage" @change="SelectPage(paginacion.currentPage)" class="page-item" filterable placeholder="Select">
                <el-option
                    v-for="item in linksList"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
            <li class="page-item" :class="[paginacion.currentPage < paginacion.lastPage ? '' : 'disabled']" >
                <a href="#" class="page-link" @click.prevent="SelectPage(paginacion.currentPage + 1)">Siguiente<i class="fe-chevron-right"></i></a>
            </li>
        </ul>
    </div><!-- end clearfix -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      reparto:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',

      cantidadVer: 10,

      repart: [],

        message_validation: {

            nom_reparto: '',
            desc_reparto: '',
        },

        page: 1,

        paginacion: {

            currentPage: 0,
            lastPage:0,
            perPage:0,
            from:0,
            to:0,
            total:0,
        },
    };
  },
  methods: {
    async listar(page) {
      const res = await axios.get('./api/reparto?cantidadVer='+ this.cantidadVer +'&page='+ page);

        this.reparto = res.data.listaReparto;

        this.DataPagination(this.reparto);
    },

    async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/reparto/' + this.id;

                axios.put(url, {
                    'id'     : this.id,
                    'nom_reparto': this.reparto.nombre,
                    'desc_reparto': this.reparto.descripcion,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Reparto fue actualizado', 'success');
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

                let url = './api/reparto/';

                axios.post(url, {

                    'id': this.update,
                    'nom_reparto': this.reparto.nombre,
                    'desc_reparto': this.reparto.descripcion,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'El Reparto fue registrado', 'success');
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
                text: "Se eliminará el Reparto!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/reparto/' + id

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
            this.message_validation.nom_reparto  = '';
            this.message_validation.desc_reparto = '';
        },

    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Reparto";
        this.reparto.nombre=data.nom_reparto;
        this.reparto.descripcion=data.desc_reparto;
      }else{
        this.id=0;
        this.tituloModal="Crear Reparto";
        this.reparto.nombre='';
        this.reparto.descripcion='';
      }
    },
    cerrarModal(){
      this.modal=0;
    },

    SelectPage(page)
    {
        this.paginacion.currentPage = page;

        this.listar(page)
    },

    DataPagination(listaReparto)
    {
        console.log(listaReparto.to);
        this.listaReparto = listaReparto.data;

        this.paginacion.to          = listaReparto.to
        this.paginacion.from        = listaReparto.from
        this.paginacion.total       = listaReparto.total
        this.paginacion.perPage     = listaReparto.per_page
        this.paginacion.lastPage    = listaReparto.last_page
        this.paginacion.currentPage = listaReparto.current_page
    },
  },
  created() {
    this.listar(this.page);
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
