<template>
  <div>
    <h1 class="text-center">Gestionar Asignación Docente</h1>
    <!-- Button to Open the Modal -->
    <div class="my-4">
        <label for="buscar">Buscar:</label>
        <div class="input-group mb-3">

            <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombres y Apellidos o Dni (Presione enter)">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>

    <div id="divListaDocentes" style="overflow-x: scroll;">

      <table class="table table-secondary">
        <thead class="thead-light">
          <tr>
            <th scope="col">DNI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col" class="text-center">Accion</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="doc in docentes.data" :key="doc.id">
            <td>{{ doc.dni_doc }}</td>
            <td>{{ doc.nom_doc }}</td>
            <td>{{ doc.ape_doc }}</td>
            <th class="text-center">
              <button @click="modificar=false; abrirModal(doc);" type="button" class="btn btn-primary my-2">Asignar</button>
            </th>
          </tr>
        </tbody>
        </table>
    </div>
    <!-- The Modal -->
    <div class="modal" :class="{mostrar: modal}">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{tituloModal}}</h4>
                    <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                </div>

                <!-- Modal body v-on:keyup.enter="buscarcedula();" @click="buscarcedula();" -->
                <form @submit.prevent="guardar()">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                <label for="bus">DNI: {{ asignadoc.dni }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                <label for="bus">Docente: {{ asignadoc.nomape }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="periodo">Periodo</label>
                                <div v-if="message_validation.periodo_id != ''" v-text='message_validation.periodo_id' class="text-danger"></div>
                                <select v-model="asignadoc.periodo" class="form-control">
                                    <option v-for="(periodo, index) in peri" :key="periodo.id" :value="periodo.id">{{periodo.ano_per +'-'+ periodo.peri_per}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="seccion">Sección</label>
                                <div v-if="message_validation.seccion_id != ''" v-text='message_validation.seccion_id' class="text-danger"></div>
                                <select v-model="asignadoc.seccion" class="form-control">
                                    <option v-for="(seccion, index) in sec" :key="seccion.id" :value="seccion.id">{{seccion.nom_sec}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="materia">Curso</label>
                                <div v-if="message_validation.curso_id != ''" v-text='message_validation.curso_id' class="text-danger"></div>
                                <select v-model="asignadoc.curso" class="form-control" @change="changedValue">
                                    <option v-for="(curso, index) in curso" :key="curso.id" :value="curso.id">{{curso.nom_cur}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="materia">Materia</label>
                                <div v-if="message_validation.materia_id != ''" v-text='message_validation.materia_id' class="text-danger"></div>
                                <select v-model="asignadoc.materia" class="form-control">
                                    <option v-for="(materia, index) in mate2" :key="materia.id" :value="materia.id">{{materia.nom_mat}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="seccion">Aula</label>
                                <div v-if="message_validation.aula_id != ''" v-text='message_validation.aula_id' class="text-danger"></div>
                                <select v-model="asignadoc.aula" class="form-control">
                                    <option v-for="(aula, index) in aula" :key="aula.id" :value="aula.id">{{aula.num_aul}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            </div>
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
                </form>
            </div>
        </div>
    </div>

   <div class="card">
  <div class="card-body">
   <table class="table table-striped table-hover table-condensed">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Docente</th>
          <th scope="col">Periodo</th>
          <th scope="col">Sección</th>
          <th scope="col">Curso / Materia</th>
          <th scope="col">Aula</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="asidoc in asignadoc" :key="asidoc.id">
          <td >
            <span v-for="(n,indice) in asidoc.docente" :key="indice">
                {{n.nom_doc}} {{n.ape_doc}}
            </span>
          </td>
          <td >
            <span v-for="(n,indice) in asidoc.periodo" :key="indice">
                {{n.ano_per +' '+ n.peri_per}}
            </span>
          </td>
          <td >
            <span v-for="(n,indice) in asidoc.seccion" :key="indice">
                {{n.cod_sec +' - '+ n.nom_sec}}
            </span>
          </td>
            <td >
                <span v-for="(n,indice) in asidoc.materia" :key="indice">
                    <span v-for="(curso,indice) in asidoc.curso" v-if="curso.id == asidoc.curso_id"  :key="indice">
                        <strong>{{curso.nom_cur}}</strong> / {{n.nom_mat}}
                    </span>
                </span>
            </td>
          <td >
            <span v-for="(n,indice) in asidoc.aula" :key="indice">
                {{n.num_aul}}
            </span>
          </td>
          <td>
            <button  @click="modificar=true; abrirModal(asidoc);" class="btn btn-warning">Cambiar</button>
          </td>
          <td>
            <button @click="eliminar(asidoc.id)" class="btn btn-danger">
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

            asignadoc:{   },
            docentes: [],
            id:0,
            modificar:true,
            modal:0,
            tituloModal:'',
            asidoc: [],
            docente: [],
            peri: [ ],
            cur: [ ],
            aula: [ ],
            sec: [ ],
            mate: [ ],
            mate2: [ ],
            curso: [ ],
            dni: [ ],
            buscar:'',
            buscarmate:'',
            dnidoc:'',
            dninomape:'',

            porcentaje_individual: 0,
            porcentaje_grupal: 0,
            porcentaje_actitudinal: 0,

            estado: 'Asignado',

            message_validation: {

                periodo_id: '',
                seccion_id: '',
                materia_id: '',
                curso_id: '',
                aula_id: '',
            },
        };
    },
  methods: {
        async listar() {

            const res = await axios.get('./api/asignadoc/');
            this.asignadoc = res.data.data;

            const resperi = await axios.get('./api/listar/periodo');
            this.peri = resperi.data;

            const resaula = await axios.get('./api/aula');
            this.aula = resaula.data.data;

            const ressec = await axios.get('./api/seccion');
            this.sec = ressec.data.data;

            const rescurso = await axios.get('./api/curso');
            this.curso = rescurso.data.data;

            const resporcentaje = await axios.get('./api/porcentajes');

            let porcentaje = resporcentaje.data.porcentaje;

            this.porcentaje_individual  = parseFloat(porcentaje['porcentaje_individual']);
            this.porcentaje_grupal      = parseFloat(porcentaje['porcentaje_grupal']);
            this.porcentaje_actitudinal = parseFloat(porcentaje['porcentaje_actitudinal']);
        },

        async listarmateria(id)
        {
            const resmate = await axios.get('./api/curso/' + id);

            this.mate = resmate.data.data;
            this.mate2 = this.mate.materia;
        },

    async eliminar(id)
    {
        swal({
            title: "Eliminar la Asignación",
            text: "Está seguro(a) de eliminar la Asignación",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {

            if (willDelete)
            {
                let url = './api/asignadoc/'+ id;

                axios.delete(url)
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Asignación fue eliminada','success');
                    }

                    this.listar();
                })
                .catch(error => {

                    console.log(error);
                });
            }
        });
    },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/asignadoc/'+ this.id;

                axios.put(url, {
                    'id': this.id,
                    'docente_id': this.asignadoc.id,
                    'periodo_id': this.asignadoc.periodo,
                    'seccion_id': this.asignadoc.seccion,
                    'materia_id': this.asignadoc.materia,
                    'curso_id': this.asignadoc.curso,
                    'aula_id': this.asignadoc.aula,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Asignación fue actualizada', 'success');
                    }
                    else
                    {
                        swal('Atención!', 'Otro Docente ya tiene la Asignación', 'warning');
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
            else
            {
                this.LimpiarMensajesErrores();

                let url = './api/asignadoc/';

                axios.post(url, {

                    'id': this.update,
                    'docente_id': this.asignadoc.id,
                    'periodo_id': this.asignadoc.periodo,
                    'seccion_id': this.asignadoc.seccion,
                    'materia_id': this.asignadoc.materia,
                    'curso_id': this.asignadoc.curso,
                    'aula_id': this.asignadoc.aula,
                    'porcentaje_individual': this.porcentaje_individual,
                    'porcentaje_grupal': this.porcentaje_grupal,
                    'porcentaje_actitudinal': this.porcentaje_actitudinal,
                    'estado': this.estado,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Asignación fue registrada', 'success');
                    }
                    else
                    {
                        swal('Atención!', 'El Docente ya tiene la Asignación', 'warning');
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

        ErrorMessages(errors)
        {
            for (const index in errors)
            {
                this.message_validation[index] = errors[index][0]
            }
        },

        LimpiarMensajesErrores()
        {
            this.message_validation.periodo_id = '';
            this.message_validation.seccion_id = '';
            this.message_validation.curso_id   = '';
            this.message_validation.materia_id = '';
            this.message_validation.aula_id    = '';
        },

        abrirModal(data={}){

            this.modal=1;

            if(this.modificar)
            {
                this.listarmateria(data.curso_id);

                this.id=data.id;
                this.tituloModal="Modificar Asignación";
                this.dnidoc = data.docente.map(function(docente) {
                return docente.dni_doc
                });
                this.asignadoc.dni=this.dnidoc.toString();
                this.dninomape=data.docente.map(function(docente) {
                return docente.nom_doc + " " + docente.ape_doc
                });
                this.asignadoc.nomape=this.dninomape.toString();
                this.asignadoc.id=data.docente_id;
                this.asignadoc.periodo=data.periodo_id;
                this.asignadoc.seccion=data.seccion_id;
                this.asignadoc.materia=data.materia_id;
                this.asignadoc.curso=data.curso_id;
                console.log(this.asignadoc.curso);
                this.asignadoc.aula=data.aula_id;
            }
            else
            {
                this.id=0;
                this.tituloModal="Crear Asignación";
                this.asignadoc.id=data.id;
                this.asignadoc.dni= data.dni_doc;
                this.asignadoc.nomape=data.nom_doc + " " + data.ape_doc;
                this.asignadoc.periodo='';
                this.asignadoc.seccion='';
                this.asignadoc.materia='';
                this.asignadoc.curso='';
                this.asignadoc.aula='';
            }
        },

    async buscardata(){

        const resdoc = await axios.get('./api/docente', {
            params: {
                name: this.buscar
            }
        });

        this.docentes = resdoc.data;

        if(Object.keys(this.docentes.data).length === 0)
        {
            $('#divListaDocentes').css('height', '0px');

            alert('El ALUMNO NO EXISTE');
        }
        else if(Object.keys(this.docentes.data).length > 0 && Object.keys(this.docentes.data).length < 3)
        {
            $('#divListaDocentes').css('height', '200px');
        }
        else if(Object.keys(this.docentes.data).length > 3)
        {
            $('#divListaDocentes').css('height', '350px');
        }
    },

    changedValue: function(value) {

        this.asignadoc.materia = '';

        this.listarmateria(this.asignadoc.curso);
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
