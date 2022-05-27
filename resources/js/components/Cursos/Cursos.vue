<template>
  <div>
    <h1 class="text-center">Gestionar Cursos</h1>

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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Código:</label>
                                <div v-if="message_validation.cod_cur != ''" v-text='message_validation.cod_cur' class="text-danger"></div>
                                <input v-model="curso.codigo" type="text" class="form-control" placeholder="Codigo del Curso" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="ejecurso">Area del Curso</label>
                                <div v-if="message_validation.narea_cur != ''" v-text='message_validation.narea_cur' class="text-danger"></div>
                                <v-select v-model="curso.areacurso" :items= "area" dense solo ></v-select>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="">Nombre:</label>
                                <div v-if="message_validation.nom_cur != ''" v-text='message_validation.nom_cur' class="text-danger"></div>
                                <input v-model="curso.nombre" type="text" class="form-control" placeholder="Nombre del Curso" required>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Eje Curso:</label>
                                <div v-if="message_validation.ejecurso_id  != ''" v-text='message_validation.ejecurso_id' class="text-danger"></div>
                                <select v-model="curso.ejecurso" class="form-control">
                                    <option v-for="(ejecurso, index) in eje" :key="ejecurso.id" :value="ejecurso.id">{{ejecurso.nom_ejecurso}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Tipo de Curso:</label>
                                <div v-if="message_validation.tipocurso_id  != ''" v-text='message_validation.tipocurso_id' class="text-danger"></div>
                                <select v-model="curso.tipocurso" class="form-control">
                                    <option v-for="(tipocurso, index) in tipo" :key="tipocurso.id" :value="tipocurso.id">{{tipocurso.nom_curso}}</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Materias:</label>
                                <div v-if="message_validation.materia_id  != ''" v-text='message_validation.materia_id' class="text-danger"></div>
                                <v-select  v-model="vectormaterias" :items=mate :menu-props="{ maxHeight: '400' }" item-text="nom_mat" item-value="id"  multiple chips style="padding-top: 0px;" @change="ChangeMaterias();"></v-select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Horas del Curso:</label>
                                <div v-if="message_validation.nhor_cur  != ''" v-text='message_validation.nhor_cur' class="text-danger"></div>
                                <input v-model="horas" type="text" class="form-control" placeholder="Hora del Curso" readonly>
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
          <th scope="col">Código</th>
          <th scope="col">Nombre</th>
          <th scope="col">Eje</th>
          <th scope="col">Area</th>
          <th scope="col">Tipo</th>
          <th scope="col">Materias</th>
          <th scope="col">Número de Horas</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(curs, index) in cursos.data" :key="curs.id">

               <td v-text="index + 1" style="padding-left: 5px;"></td>
          <td>{{ curs.cod_cur }}</td>
          <td>{{ curs.nom_cur }}</td>

          <td >
            <span v-for="(n,indice) in curs.ejecursos" :key="indice">
                {{n.nom_ejecurso}}
            </span>
          </td>
          <td>{{ curs.narea_cur }}</td>
          <td >
            <span v-for="(m,indice) in curs.tipocursos" :key="indice">
                {{m.nom_curso}}
            </span>
          </td>
           <td>
             <ul>

           <li v-for="(n,indice) in curs.materia" :key="indice">
              {{n.nom_mat}}
           </li>

           </ul>
          </td>
          <td>{{ curs.nhor_cur }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(curs);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(curs.id)" class="btn btn-danger">
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
      curso:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      cursos: [ ],
      eje: [ ],
      tipo: [ ],
      area: ['Sociales', 'Humana', 'Tecnología', 'Industrial'],
      mate: [ ],
      vectormaterias: [ ],

      horas: 0,

        message_validation: {

            nom_cur: '',
            cod_cur: '',
            narea_cur: '',
            nhor_cur: '',
            ejecurso_id: '',
            tipocurso_id: '',
            materia_id: '',
        },
    };
},


//******************************* */


  methods: {

    async ChangeMaterias()
    {
        let url = './api/materia/calcular-horas';

        await axios.post(url, {

            'vectormaterias': this.vectormaterias,
        })
        .then(response => {

            this.horas = response.data.total_horas;
        });
    },

    async listar() {
      const res = await axios.get('./api/curso');
      this.cursos = res.data;

      const resej = await axios.get('./api/ejecurso');
      this.eje = resej.data.data;

      const restip = await axios.get('./api/tipocurso');
      this.tipo = restip.data.data;

      //Carga las Materias
      const resmateria = await axios.get('./api/materia');
      this.mate = resmateria.data.data;

    },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/curso/'+ this.id;

                axios.put(url, {

                    'id'     : this.id,
                    'cod_cur'   : this.curso.codigo,
                    'nom_cur'   : this.curso.nombre,
                    'ejecurso_id'   : this.curso.ejecurso,
                    'tipocurso_id'  : this.curso.tipocurso,
                    'narea_cur' : this.curso.areacurso,
                    'nhor_cur'  : this.horas,
                    'materia_id': this.vectormaterias,
                 })
                .then(response => {

                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Curso fue actualizado', 'success');
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

                let url = './api/curso/';

                axios.post(url, {

                    'id'        : this.update,
                    'cod_cur'   : this.curso.codigo,
                    'nom_cur'   : this.curso.nombre,
                    'ejecurso_id'   : this.curso.ejecurso,
                    'tipocurso_id'  : this.curso.tipocurso,
                    'narea_cur' : this.curso.areacurso,
                    'nhor_cur'  : this.horas,
                    'materia_id': this.vectormaterias,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'El Curso fue registrado', 'success');
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
                text: "Se eliminará el Curso!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    var url = './api/curso/' + id;

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
            this.message_validation.nom_cur = '';
            this.message_validation.cod_cur = '';
            this.message_validation.narea_cur = '';
            this.message_validation.nhor_cur = '';
            this.message_validation.ejecurso_id = '';
            this.message_validation.tipocurso_id = '';
            this.message_validation.materia_id = '';
        },


    abrirModal(data=null){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Curso";
        this.curso.codigo=data.cod_cur;
        this.curso.nombre=data.nom_cur;
        this.curso.areacurso=data.narea_cur;
        this.horas=data.nhor_cur;
        this.curso.ejecurso=data.ejecurso_id;
        this.curso.tipocurso=data.tipocurso_id;
        this.vectormaterias=data.materia.map(function(materia) {
       return materia.id
       });
       }else{

        this.id=0;
        this.tituloModal="Nuevo Curso";
        this.curso.codigo='';
        this.curso.nombre='';
        this.curso.areacurso='';
        this.horas='';
        this.curso.ejecurso='';
        this.curso.tipocurso='';
        this.vectormaterias='';

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
