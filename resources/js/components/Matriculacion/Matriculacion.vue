<template>
  <div>
    <h1 class="text-center">Gestionar Matriculación</h1>

    <div class="my-4">
        <label for="buscar">Buscar:</label>
        <div class="input-group mb-3">

            <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombres y Apellidos o Dni (Presione enter)">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>

    <!-- Button to Open the Modal -->
    <button @click="modificar=false; vperiodo=true; abrirModal();" type="button" class="btn btn-primary my-4" style="display: none;">Nuevo</button>
    <div id="divListaEstudiantes" style="overflow-x: scroll;">
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
                <tr v-for="alm in alumnos.data" :key="alm.id">
                    <td>{{ alm.dni_al }}</td>
                    <td>{{ alm.nom_al }}</td>
                    <td>{{ alm.ape_al }}</td>
                    <th scope="col" class="text-center">
                        <button @click="modificar=false; abrirModal(alm);" type="button" class="btn btn-primary my-2">Asignar</button>
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

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div v-if="vperiodo">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <label for="bus">DNI: {{ matricula.dni }}</label>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <label for="bus">Alumno: {{ matricula.nomape }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label for="periodo">Periodo</label>
                                    <div v-if="message_validation.periodo_id != ''" v-text='message_validation.periodo_id' class="text-danger"></div>
                                    <select v-model="matricula.periodo" class="form-control">
                                        <option v-for="(periodo, index) in per" :key="periodo.id" :value="periodo.id">{{periodo.ano_per +'-'+ periodo.peri_per}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label for="seccion">Sección</label>
                                    <div v-if="message_validation.seccion_id != ''" v-text='message_validation.seccion_id' class="text-danger"></div>
                                    <select v-model="matricula.seccion" class="form-control">
                                        <option v-for="(seccion, index) in secc" :key="seccion.id" :value="seccion.id">{{seccion.nom_sec}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label for="curso">Curso</label>
                                    <div v-if="message_validation.curso_id != ''" v-text='message_validation.curso_id' class="text-danger"></div>
                                    <select v-model="matricula.curso" class="form-control">
                                        <option v-for="(curso, index) in cur" :key="curso.id" :value="curso.id">{{curso.nom_cur}}</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <label for="feins_matri">Fecha de Inscripción</label>
                                    <div v-if="message_validation.feins_matri != ''" v-text='message_validation.feins_matri' class="text-danger"></div>
                                    <input type="date" v-model="matricula.feins_matri" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <table class="table table-striped">
                                  <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Alumno</th>
                                      <th scope="col">Periodo</th>
                                      <th scope="col">Curso</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <tr v-for="vper in verperi.data" :key="vper.id">
                                      <td >
                                        <span v-for="(n,indice) in vper.alumno" :key="indice">
                                            {{n.nom_al}} {{n.ape_al}}
                                        </span>
                                      </td>
                                      <td >
                                        <span v-for="(n,indice) in vper.periodo" :key="indice">
                                            {{n.ano_per}}
                                        </span>
                                      </td>
                                      <td >
                                        <span v-for="(n,indice) in vper.curso" :key="indice">
                                            {{n.nom_cur}}
                                        </span>
                                      </td>
                                    </tr>
                                  </tbody>
                            </table>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button  v-if="vperiodo" @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

   <div class="card">
  <div class="card-body">
   <table class="table table-striped table-hover table-condensed">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Apellidos y Nombres</th>
          <th scope="col">Periodo</th>
          <th scope="col">Curso</th>
          <th scope="col">Sección</th>
          <th scope="col">Fecha de Matriculación</th>
          <th scope="col" colspan="3" class="text-center">Acción</th>
        </tr>
      </thead>
        <tbody>
            <tr v-for="matr in matricula.data" :key="matr.id">
              <td >
                <span v-for="(n,indice) in matr.alumno" :key="indice">
                    {{n.nom_al}} {{n.ape_al}}
                </span>
              </td>
              <td >
                <span v-for="(n,indice) in matr.periodo" :key="indice">
                    {{n.ano_per +' '+ n.peri_per}}
                </span>
              </td>
              <td >
                <span v-for="(n,indice) in matr.curso" :key="indice">
                    {{n.nom_cur}}
                </span>
              </td>
              <td >
                <span v-for="(n,indice) in matr.seccion" :key="indice">
                    {{n.cod_sec +' '+ n.nom_sec}}
                </span>
              </td>
              <td>{{ matr.feins_matri }}</td>
              <td>
                <button  @click="modificar=true; vperiodo=true; abrirModal(matr);" class="btn btn-warning">Cambiar</button>
              </td>
                <td>
                    <button @click="vperiodo=false; abrirModal(matr);" class="btn btn-primary" style="display: none;">Ver Periodos</button>
                </td>
              <td>
                <button v-if="matr.promedios_materias.length == 0" @click="eliminar(matr.id)" class="btn btn-danger">
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

            matricula:{   },
            verperi:{   },
            alumnos: [ ],
            id:0,
            modificar:true,
            vperiodo:true,
            modal:0,
            tituloModal:'',
            matr: [ ],
            alm: [ ],
            per: [ ],
            vper: [ ],
            cur: [ ],
            secc: [ ],
            dni: [ ],
            buscar:'',
            dnialu:'',
            dninomape:'',

            message_validation: {

                periodo_id: '',
                seccion_id: '',
                curso_id: '',
                feins_matri: '',
            },
        };
    },

  methods: {
    async listar() {

      const res = await axios.get('./api/matricula/');
      this.matricula = res.data;

      const resper = await axios.get('./api/listar/periodo');
      this.per = resper.data;

      const rescur = await axios.get('./api/curso/');
      this.cur = rescur.data.data;

      const ressecc = await axios.get('./api/seccion/');
      this.secc = ressecc.data.data;

    },

    async eliminar(id)
    {
        swal({
            title: "Eliminar la Matrícula",
            text: "Está seguro(a) de eliminar la Matricula",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {

            if (willDelete)
            {
                let url = './api/matricula/'+ id;

                axios.delete(url)
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Matrícula fue eliminada','success');
                    }

                    this.listar();
                })
                .catch(error => {

                    console.log(error);
                });
            }
        });
    },

     async verperiodo() {

      const resmatr = await axios.get('./api/matricula' , {
      params: {
        name: this.buscar
      }

    });

      this.verperi = resmatr.data;
      console.log(this.verperi);
    },

        async guardar()
        {
            if(this.modificar)
            {
                this.LimpiarMensajesErrores();

                let url = './api/matricula/' + this.id;

                axios.put(url, {
                    'id': this.id,
                    'alumno_id': this.matricula.id,
                    'periodo_id': this.matricula.periodo,
                    'curso_id': this.matricula.curso,
                    'seccion_id': this.matricula.seccion,
                    'feins_matri': this.matricula.feins_matri,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Matrícula fue actualizada', 'success');
                    }
                    else
                    {
                        swal('Atención!', 'El Alumno ya tiene la Matrícula', 'warning');
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

                let url = './api/matricula/';

                axios.post(url, {

                    'id': this.update,
                    'alumno_id': this.matricula.id,
                    'periodo_id': this.matricula.periodo,
                    'curso_id': this.matricula.curso,
                    'seccion_id': this.matricula.seccion,
                    'feins_matri': this.matricula.feins_matri,
                 })
                .then(response => {

                    if(response.data.estado_accion)
                    {
                        this.cerrarModal();
                        this.listar();

                        swal('Correcto!', 'La Matrícula fue registrada', 'success');
                    }
                    else
                    {
                        swal('Atención!', 'El Alumno ya tiene la Matrícula', 'warning');
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
            this.message_validation.periodo_id  = '';
            this.message_validation.seccion_id  = '';
            this.message_validation.curso_id    = '';
            this.message_validation.feins_matri = '';
        },

        abrirModal(data={})
        {
            this.LimpiarMensajesErrores();

            this.modal=1;

            if(this.vperiodo)
            {

                if(this.modificar)
                {
                    this.id=data.id;
                    this.tituloModal="Modificar Matricula";
                    this.dnialu = data.alumno.map(function(alumno) {
                    return alumno.dni_al
                    });
                    this.matricula.dni=this.dnialu.toString();
                    this.dninomape=data.alumno.map(function(alumno) {
                    return alumno.nom_al + " " + alumno.ape_al
                    });
                    this.matricula.nomape=this.dninomape.toString();
                    this.matricula.periodo=data.periodo_id;
                    this.matricula.id=data.alumno_id;
                    this.matricula.curso=data.curso_id;
                    this.matricula.seccion=data.seccion_id;
                    this.matricula.feins_matri=data.feins_matri;

                }
                else
                {
                    var fecha = new Date();
                    var mes = fecha.getMonth()+1;
                    var dia = fecha.getDate();
                    var ano = fecha.getFullYear();

                    if(dia<10)
                        dia='0'+dia;

                    if(mes<10)
                        mes='0'+mes;

                    this.id=0;
                    this.tituloModal="Crear Matricula";
                    this.matricula.id=data.id;
                    this.matricula.dni=data.dni_al;
                    this.matricula.nomape=data.nom_al + " " + data.ape_al;
                    this.matricula.periodo='';
                    this.matricula.curso='';
                    this.matricula.seccion='';
                    this.matricula.feins_matri=ano+"-"+mes+"-"+dia;
                }
            }
            else
            {
                this.tituloModal="Periodos";
                this.buscar = data.alumno_id

                this.verperiodo()

                console.log(this.buscar);
            }
        },

   async buscardata(){

        const resal = await axios.get('./api/alumno', {
            params: {
                name: this.buscar
            }
        });

        this.alumnos = resal.data;

        if(Object.keys(this.alumnos.data).length === 0)
        {
            $('#divListaEstudiantes').css('height', '0px');

            alert('El ALUMNO NO EXISTE');
        }
        else if(Object.keys(this.alumnos.data).length > 0 && Object.keys(this.alumnos.data).length < 3)
        {
            $('#divListaEstudiantes').css('height', '200px');
        }
        else if(Object.keys(this.alumnos.data).length > 3)
        {
            $('#divListaEstudiantes').css('height', '350px');
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
