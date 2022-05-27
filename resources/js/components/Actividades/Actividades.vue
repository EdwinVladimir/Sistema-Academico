<template>
  <div>
    <h1 class="text-center">Gestionar Plan de Evaluación</h1>

    <div class="my-4">
   <div class="card">
  <div class="card-body">
   <table class="table table-striped table-hover table-condensed">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Aula</th>
                    <th scope="col">Sección</th>
                    <th scope="col">Curso/Materia</th>
                    <th scope="col">Porcentajes</th>
                    <th scope="col" class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
              <tr v-for="asidoc in asignadoc.data" :key="asidoc.id">
                <td>
                  <span v-for="(n,indice) in asidoc.docente" :key="indice">
                      {{n.dni_doc}}
                  </span>
                </td>
                <td>
                  <span v-for="(n,indice) in asidoc.docente" :key="indice">
                    {{n.nom_doc}}
                  </span>
                </td>
                <td>
                  <span v-for="(n,indice) in asidoc.docente" :key="indice">
                    {{n.ape_doc}}
                  </span>
                </td>
                <td>
                  <span v-for="(n,indice) in asidoc.periodo" :key="indice">
                    {{n.ano_per +' '+ n.peri_per}}
                  </span>
                </td>
                <td>
                  <span v-for="(n,indice) in asidoc.aula" :key="indice">
                    {{n.num_aul}}
                  </span>
                </td>
                <td>
                  <span v-for="(n,indice) in asidoc.seccion" :key="indice">
                    {{n.cod_sec +' '+ n.nom_sec}}
                  </span>
                </td>
                <td>
                    <span v-for="(n,indice) in asidoc.curso" v-if="n.id == asidoc.curso_id" :key="indice">
                        <strong>{{n.nom_cur}}:</strong>
                        <span v-for="(n,indice) in asidoc.materia" :key="indice">
                             {{n.nom_mat}}
                        </span>
                    </span>
                </td>
                <td>
                    <span v-text="'Individual: '+ asidoc.porcentaje_individual +' %'" :key="indice">
                    </span>
                    <span v-text="'Grupal: '+ asidoc.porcentaje_grupal +' %'" :key="indice">
                    </span>
                    <span v-text="'Actitudinal: '+ asidoc.porcentaje_actitudinal +' %'" :key="indice">
                    </span>
                </td>

                <td class="text-center">
                    <button v-if="asidoc.estado == 'Asignado'" @click="modificar=false; abrirModal(asidoc);" type="button" class="btn btn-primary">Planificar</button>
                    <button v-if="asidoc.estado == 'Planificado'" @click="modificar=false; abrirModal(asidoc);" type="button" class="btn btn-success">Ver planificación</button>
                    <br><br>
                    <button v-if="asidoc.estado == 'Planificado'" @click="modificar=false; abrirRegistro(asidoc);" type="button" class="btn btn-success">Ver Registro</button>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
     </div>
      </div>
<!-- Button to Open the Modal -->

    <div class="modal" :class="{mostrar: modalRegistro}">
        <div class="modal-dialog" style="width: 100%; max-width: 1300px;">
            <div class="modal-content" style="height: 700px; overflow: scroll; max-width: 1300px;">
                <form @submit.prevent="guardar()">
                    <div class="modal-header">
                        <h4 class="modal-title">{{tituloModal}}</h4>
                        <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
                          &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-primary text-center">CENTRO DE OPERACIONES SECTORIAL</h5>
                                <h5 class="text-primary text-center">REPORTE DE CALIFICACIONES BAJO EL MODELO EDUCATIVO POR COMPETENCIAS</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="dni">Docente: {{ nomape }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="periodo">Periodo: {{ periodo }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="materia">Curso: {{ curso }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="materia">Materia: {{ materia }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-danger">"Las calificaciones de las actividades se evaluan con notas de 0 a 20."</h4>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <table border="1" style="width: 100%;" class="table-hover">
                                        <thead>
                                            <tr>
                                                <th style="padding-left: 5px;">N°</th>
                                                <th style="padding-left: 5px;">GRADO</th>
                                                <th class="text-center" style="width: 300px;">NOMINA DE ALUMNOS</th>
                                                <th class="text-center"  :colspan="cantidad_individual + 1">INDIVIDUAL</th>
                                                <th class="text-center" >PROMEDIO</th>
                                                <th class="text-center"  :colspan="cantidad_grupal + 1">GRUPAL</th>
                                                <th class="text-center" >PROMEDIO</th>
                                                <th class="text-center"  :colspan="cantidad_actitudinal + 1">ACTITUDINAL</th>
                                                <th class="text-center" >PROMEDIO</th>
                                                <th class="text-center"> PROMEDIO FINAL</th>
                                            </tr>
                                            <tr>
                                                <td v-for="enca in encabezado" class="text-center">{{enca}}</td>
                                            </tr>
                                        </thead>
                                        <tbody id="tabla_alumnos">
                                            <tr v-for="(matricula, index) in lista_matriculas">
                                                <input type="hidden" :name="'ids_alumnos[]'" :value="matricula.alumno_id">
                                                <td v-text="index + 1" style="padding-left: 5px;"></td>
                                                <td v-text="matricula.alumnos.tipogrado.nom_grado" style="padding-left: 5px;"></td>
                                                <td v-text="matricula.alumnos.ape_al +' '+ matricula.alumnos.nom_al" style="padding-left: 5px;"></td>
                                                <td
                                                    v-for="plan in lista_planes"
                                                    v-if="plan.detalplanevas[0].tipoact_acti == 'Aporte individual'">

                                                    <input type="hidden" :name="'ids_nota_individual[]'" :value="matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id"/>

                                                    <input
                                                        type="text"
                                                        :id="'nota_'+ matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id" v-for="evaluacion in matricula.periodos.evaluaciones"
                                                        v-if="matricula.periodos.evaluaciones.length > 0 && evaluacion.alumno_id == matricula.alumno_id && evaluacion.periodo_id == matricula.periodo_id && evaluacion.materia_id == materia_id && evaluacion.detalplaneva_id == plan.detalplanevas[0].id"
                                                        @keyup.enter="GuardarNota(matricula.alumno_id, matricula.periodo_id, materia_id, plan.detalplanevas[0].id, $event.target.value);"
                                                        :value="evaluacion.nota_deteva"
                                                        class="form-control tex-right"
                                                    />
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_individual_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_individual_porcentaje_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>

                                                <td
                                                    v-for="plan in lista_planes"
                                                    v-if="plan.detalplanevas[0].tipoact_acti == 'Aporte grupal'">

                                                    <input type="hidden" :name="'ids_nota_grupal[]'" :value="matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id"/>

                                                    <input
                                                        type="text"
                                                        :id="'nota_'+ matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id"
                                                        v-for="evaluacion in matricula.periodos.evaluaciones"
                                                        v-if="matricula.periodos.evaluaciones.length > 0 && evaluacion.alumno_id == matricula.alumno_id && evaluacion.periodo_id == matricula.periodo_id && evaluacion.materia_id == materia_id && evaluacion.detalplaneva_id == plan.detalplanevas[0].id"
                                                        @keyup.enter="GuardarNota(matricula.alumno_id, matricula.periodo_id, materia_id, plan.detalplanevas[0].id, $event.target.value);"
                                                        :value="evaluacion.nota_deteva"
                                                        class="form-control tex-right"
                                                    />
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_grupal_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_grupal_porcentaje_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>

                                                <td
                                                    v-for="plan in lista_planes"
                                                    v-if="plan.detalplanevas[0].tipoact_acti == 'Aporte actitudinal'">

                                                    <input type="hidden" :name="'ids_nota_actitudinal[]'" :value="matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id"/>

                                                    <input
                                                        type="text"
                                                        :id="'nota_'+ matricula.alumno_id +''+ matricula.periodo_id +''+ materia_id +''+ plan.detalplanevas[0].id"
                                                        v-for="evaluacion in matricula.periodos.evaluaciones"
                                                        v-if="matricula.periodos.evaluaciones.length > 0 && evaluacion.alumno_id == matricula.alumno_id && evaluacion.periodo_id == matricula.periodo_id && evaluacion.materia_id == materia_id && evaluacion.detalplaneva_id == plan.detalplanevas[0].id"
                                                        @keyup.enter="GuardarNota(matricula.alumno_id, matricula.periodo_id, materia_id, plan.detalplanevas[0].id, $event.target.value);"
                                                        :value="evaluacion.nota_deteva"
                                                        class="form-control tex-right"
                                                    />
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_actitudinal_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_actitudinal_porcentaje_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" :id="'promedio_final_'+ matricula.alumno_id" class="form-control" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal" :class="{mostrar: modal}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-lg">
                <form @submit.prevent="guardar()">
                    <div class="modal-header">
                        <h4 class="modal-title">{{tituloModal}}</h4>
                        <button @click="cerrarModal();"  type="button" class="close" data-dismiss="modal">
                          &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="materia">Curso: {{ curso }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="materia">Materia: {{ materia }}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="dni">Docente: {{ nomape }}</label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="periodo">Periodo: {{ periodo }}</label>
                            </div>
                        </div>
                        <div class="row" v-show='mostrar_formulario'>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="tipactividad">Tipo de Actividad:</label>
                                <select v-model="formulario.tipo_actividad" class="form-control" required>
                                    <option v-for='actividad in lista_actividades' :value="actividad">{{actividad}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label for="descripcion">Descripción</label>
                                <input v-model="formulario.descripcion" type="text" class="form-control" id="descripcion" required>
                            </div>
                        </div>

                        <div class="row" v-show='mostrar_formulario'>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="tipactividad">Fecha de evaluación:</label>
                                    <input type="date" v-model="formulario.fecent_plaeva" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label style="color: white;">-</label>
                                    <button v-text="titulo_button_save" class="btn btn-success form-control"></button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <table class="table table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Tipo Actividad</th>
                                                <th>Descripción</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="plan in lista_planes">
                                                <td v-text=plan.fecent_plaeva></td>
                                                <td v-text=plan.detalplanevas[0].tipoact_acti></td>
                                                <td v-text=plan.detalplanevas[0].descrip_detac></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" v-show='mostrar_formulario' @click="editar(plan.id)">Editar</button>
                                                    <button type="button" class="btn btn-danger btn-xs" v-show='mostrar_formulario' @click="eliminar(plan.id)">Eliminar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                                Cerrar
                            </button>
                            <button v-show="mostrar_formulario" @click="guardarPlanificacion()" type="button" class="btn btn-success" data-dismiss="modal">
                                Guardar Planificación
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {

        formulario: {

            id_plan: '',
            asignadocs_id: '',
            docente_id: '',
            periodo_id: '',
            materia_id: '',
            tipo_actividad: '',
            descripcion: '',
            fecent_plaeva: '',
        },

        actividadeva:{ },

        docentesci:{ },
        asignadoc:{ },
        asidoc: [],
        peri: [],
        cur: [],
        mate: [ ],
        mate2: [],
        id:0,
        modificar:true,
        modal:0,
        modalRegistro: 0,
        tituloModal:'',
        nomape:'',
        periodo: '',
        aula:'',
        curso:'',
        materia:'',
        aceva: [],
        buscar:'',
        periodo_id:'',
        curso_id:'',

        lista_actividades: ['Aporte actitudinal', 'Aporte individual', 'Aporte grupal'],

        lista_planes: [],



        titulo_button_save: '',

        mostrar_formulario: false,

        docente_id: 0,
    };
  },

    mounted()
    {
        this.docente_id = docente_id;

        this.buscardata();
    },

  methods: {

    async listar_plan()
    {
        this.titulo_button_save = 'Añadir';
        this.formulario.id_plan = '';

        this.lista_planes = [];

        const res = await axios.get('/api/planeva/', {

            params:{

                'docente_id': this.formulario.docente_id,
                'periodo_id': this.formulario.periodo_id,
                'materia_id': this.formulario.materia_id,
            }
        });

        this.lista_planes = res.data.lista_planes;
    },

    async listar() {

     //Consulta Plan de Evaluación
     const res = await axios.get('./api/planeva/');
     this.actividadeva = res.data;

    //Consulta Periodo
     const resperi = await axios.get('./api/periodo/');
     this.peri = resperi.data.data;

     //Consulta Curso
     const rescur = await axios.get('./api/curso/');
     this.cur = rescur.data.data;

    },

    /*async eliminar(id) {
      const res = await axios.delete('./api/planeva/' + id);
      this.listar();
    },*/

    async guardar()
    {
        if(this.formulario.id_plan)
        {
            const res = await axios.put('./api/planeva/' + this.formulario.id_plan, {

                'id': this.formulario.id_plan,
                'docente_id': this.formulario.docente_id,
                'periodo_id': this.formulario.periodo_id,
                'materia_id': this.formulario.materia_id,
                'descrip_detac': this.formulario.descripcion,
                'tipoact_acti': this.formulario.tipo_actividad,
                'fecent_plaeva': this.formulario.fecent_plaeva,
             });

            if(res.data.estado_accion)
            {
                swal('Correcto!', 'Se actualizó la tarea actividad al Plan', 'success');

                this.formulario.id_plan = '';
                this.formulario.tipo_actividad = '';
                this.formulario.descripcion = '';
                this.formulario.fecent_plaeva = '';

                this.titulo_button_save = 'Añadir';

                this.listar_plan();
            }
            else
            {
                swal('Alerta!', 'Ya existe una tarea para la fecha asignada', 'warning');
            }
        }
        else
        {
            const res = await axios.post('./api/planeva/', {

                //'id': this.update,
                'docente_id': this.formulario.docente_id,
                'periodo_id': this.formulario.periodo_id,
                'materia_id': this.formulario.materia_id,
                'descrip_detac': this.formulario.descripcion,
                'tipoact_acti': this.formulario.tipo_actividad,
                'fecent_plaeva': this.formulario.fecent_plaeva,
            });

            if(res.data.estado_accion)
            {
                swal('Correcto!', 'Se añadio la actividad al Plan', 'success');

                this.formulario.tipo_actividad = '';
                this.formulario.descripcion = '';
                this.formulario.fecent_plaeva = '';

                this.listar_plan();
            }
            else
            {
                swal('Alerta!', 'Ya existe una actividad para la fecha asignada', 'warning');
            }
        }
    },

    abrirModal(data={})
    {
        this.modal=1;

        this.formulario.asignadocs_id = data.id;
        this.formulario.docente_id    = data.docente_id;
        this.formulario.periodo_id    = data.periodo_id;
        this.formulario.materia_id    = data.materia_id;

        this.nomape=data.docente[0].nom_doc + " " + data.docente[0].ape_doc;
        this.periodo=data.periodo[0].ano_per +' : '+ data.periodo[0].peri_per;

        data.curso.forEach( curso => {

            if(curso.id == data.curso_id)
            {
                this.curso = curso.nom_cur;
            }
        });

        this.materia=data.materia[0].nom_mat;

        this.mostrar_formulario = (data.estado != 'Planificado' ? true : false);

        if(data.estado == 'Asignado')
        {
            this.tituloModal        = 'Crear Plan de Evaluación';
            this.mostrar_formulario = true;
        }
        else if(data.estado == 'Planificado')
        {
            this.tituloModal        = 'Planificación Creada';
            this.mostrar_formulario = false;
        }

        this.listar_plan();
    },

    async buscardata()
    {

        const resdoc = await axios.get('./api/asignadoc', {
            params: {
                periodo_id: this.actividadeva.periodo,
                id_curso: this.actividadeva.curso,
                docente_id: this.docente_id,
                name: this.buscar
            }
        });

        this.asignadoc = resdoc.data;
    },

    editar(id)
    {
        let url = './api/planeva/'+ id;

        axios.get(url)
        .then(response => {

            this.titulo_button_save = 'Actualizar';

            let plan = response.data.plan;

            this.formulario.id_plan        = plan.id;
            this.formulario.tipo_actividad = plan.detalplanevas[0].tipoact_acti;
            this.formulario.descripcion    = plan.detalplanevas[0].descrip_detac;
            this.formulario.fecent_plaeva  = plan.fecent_plaeva;
        })
        .catch(error => {

            console.log(error);
        })
        .finally(() => LoadingHide());
    },

    eliminar(id)
    {
        if(confirm('¿Quiere eliminar la actividad?'))
        {
            let url = './api/planeva/'+ id;

            axios.delete(url)
            .then(response => {

                alert('Actividad eliminada');

                this.listar_plan();
            })
            .catch(error => {

                console.log(error);
            })
            .finally(() => LoadingHide());
        }
    },

    guardarPlanificacion()
    {
        if(this.lista_planes.length == 0)
        {
            swal('Atención' ,'Debe tener al menos una actividad para poder guardar la planificación', 'warning');
        }
        else
        {
            swal({
                title: "¿Esta seguro de guardar la planificación?",
                text: "Una vez guardado la planificación no se podra modificar!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((response) => {

                if(response)
                {
                    let url = './api/asignadoc/planificar/'+ this.formulario.asignadocs_id;

                    axios.get(url)
                    .then(response => {

                        swal('Correcto', 'El plan se guardó correctamente', 'success');

                        this.mostrar_formulario = false;

                        this.buscardata();
                    })
                    .catch(error => {

                        console.log(error);
                    })
                    .finally(() => LoadingHide());
                }
            });
        }
    },

    async abrirRegistro(asignadoc)
    {
        this.nomape   = asignadoc.docente[0].nom_doc + " " + asignadoc.docente[0].ape_doc;
        this.periodo  = asignadoc.periodo[0].ano_per +' '+ asignadoc.periodo[0].peri_per;
        this.curso    = asignadoc.curso[0].nom_cur;
        this.curso_id = asignadoc.curso[0].id;
        this.materia  = asignadoc.materia[0].nom_mat;

        this.tituloModal = 'REGISTRO DE NOTAS';

        let parametros = asignadoc.docente_id +'/'+ asignadoc.periodo_id +'/'+ asignadoc.curso_id +'/'+ asignadoc.materia_id +'/'+ asignadoc.seccion_id +'/'+ asignadoc.aula_id;

        let url = './api/evaluacion/planificacion/'+ parametros;

        axios.get(url, {

            params:{

                'docente_id': asignadoc.docente_id,
                'periodo_id': asignadoc.periodo_id,
                'curso_id'  : asignadoc.curso_id,
                'materia_id': asignadoc.materia_id,
                'seccion_id': asignadoc.seccion_id,
            }
        })
        .then(response => {

            this.lista_matriculas = response.data.lista_matriculas;
            this.lista_planes     = response.data.lista_planes;

            this.materia_id = asignadoc.materia_id;

            this.encabezado = [];

            this.encabezado.push('');
            this.encabezado.push('');
            this.encabezado.push('');

            this.modalRegistro = 1;

            //porcentaje de asignación
            this.porcentaje_individual  = asignadoc.porcentaje_individual;
            this.porcentaje_grupal      = asignadoc.porcentaje_grupal;
            this.porcentaje_actitudinal = asignadoc.porcentaje_actitudinal;

            //cantidad de actividades registradas por aporte
            this.cantidad_individual  = 0;
            this.cantidad_grupal      = 0;
            this.cantidad_actitudinal = 0;

            //listar planes para armar solo las filas de los encabezados de las actividades
            this.lista_planes.forEach( plan => {

                if(plan.detalplanevas[0].tipoact_acti == 'Aporte individual')
                {
                    this.encabezado.push(plan.detalplanevas[0].descrip_detac);

                    this.cantidad_individual++;
                }
            });

            this.encabezado.push('NOTA');
            this.encabezado.push(this.porcentaje_individual +' %');

            this.lista_planes.forEach( plan => {

                if(plan.detalplanevas[0].tipoact_acti == 'Aporte grupal')
                {
                    this.encabezado.push(plan.detalplanevas[0].descrip_detac);

                    this.cantidad_grupal++;
                }
            });

            this.encabezado.push('NOTA');
            this.encabezado.push(this.porcentaje_grupal +' %');

            this.lista_planes.forEach( plan => {

                if(plan.detalplanevas[0].tipoact_acti == 'Aporte actitudinal')
                {
                    this.encabezado.push(plan.detalplanevas[0].descrip_detac);

                    this.cantidad_actitudinal++;
                }
            });

            this.encabezado.push('NOTA');
            this.encabezado.push(this.porcentaje_actitudinal +' %');
            this.encabezado.push('');

            this.CalcularPromedio();
            let calcular_promedio = setTimeout( () => this.CalcularPromedio(), 1000);
        });
    },

    GuardarNota(alumno_id, periodo_id, materia_id, detalplaneva_id, nota_deteva)
        {
            this.alumno_id = alumno_id;
            this.periodo_id = periodo_id;
            this.materia_id = materia_id;
            this.detalplaneva_id = detalplaneva_id;

            let data = new FormData();

            data.append('alumno_id', alumno_id);
            data.append('periodo_id', periodo_id);
            data.append('materia_id', materia_id);
            data.append('detalplaneva_id', detalplaneva_id);
            data.append('nota_deteva', nota_deteva);


            let url = "./api/evaluacion/guadar/nota";

            axios.post(url, data)
            .then(response => {

                this.CalcularPromedio();
            })
            .catch(error => {

            });
        },

        CalcularPromedio()
        {
            let ids_alumnos          = document.getElementsByName('ids_alumnos[]');
            let ids_nota_individual  = document.getElementsByName('ids_nota_individual[]');
            let ids_nota_grupal      = document.getElementsByName('ids_nota_grupal[]');
            let ids_nota_actitudinal = document.getElementsByName('ids_nota_actitudinal[]');

            let cantidad_individual  = this.cantidad_individual;
            let cantidad_grupal      = this.cantidad_grupal;
            let cantidad_actitudinal = this.cantidad_actitudinal;

            let promedio_individual  = 0;
            let promedio_grupal      = 0;
            let promedio_actitudinal = 0;

            let porcentaje_individual  = this.porcentaje_individual / 100;
            let porcentaje_grupal      = this.porcentaje_grupal / 100;
            let porcentaje_actitudinal = this.porcentaje_actitudinal / 100;

            let notas_individuales  = [];
            let notas_grupales      = [];
            let notas_actitudinales = [];

            let contador_individual = 1;

            let posicion_alumno = 0;

            for(var i = 0; i < ids_nota_individual.length; i++)
            {
                if(contador_individual <= cantidad_individual)
                {
                    promedio_individual = parseFloat(promedio_individual) + parseFloat(($('#nota_'+ ids_nota_individual[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_individual[i].value).val()));

                    contador_individual++;
                }

                if(contador_individual > cantidad_individual)
                {
                    promedio_individual = promedio_individual / cantidad_individual;

                    $('#promedio_individual_'+ ids_alumnos[posicion_alumno].value).val(promedio_individual);
                    $('#promedio_individual_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_individual) * porcentaje_individual);

                    notas_individuales.push(promedio_individual);

                    promedio_individual = 0;
                    contador_individual = 1;

                    posicion_alumno++;
                }
            }

            let contador_grupal = 1;

            posicion_alumno = 0;

            for(var i = 0; i < ids_nota_grupal.length; i++)
            {
                if(contador_grupal <= cantidad_grupal)
                {
                    promedio_grupal = parseFloat(promedio_grupal) + parseFloat(($('#nota_'+ ids_nota_grupal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_grupal[i].value).val()));

                    contador_grupal++;
                }

                if(contador_grupal > cantidad_grupal)
                {
                    promedio_grupal = promedio_grupal / cantidad_grupal;

                    $('#promedio_grupal_'+ ids_alumnos[posicion_alumno].value).val(promedio_grupal);
                    $('#promedio_grupal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_grupal) * porcentaje_grupal);

                    notas_grupales.push(promedio_grupal);

                    promedio_grupal = 0;
                    contador_grupal = 1;

                    posicion_alumno++;
                }
            }

            let contador_actitudinal = 1;

            posicion_alumno = 0;

            for(var i = 0; i < ids_nota_actitudinal.length; i++)
            {
                if(contador_actitudinal <= cantidad_actitudinal)
                {
                    promedio_actitudinal = parseFloat(promedio_actitudinal) + parseFloat(($('#nota_'+ ids_nota_actitudinal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_actitudinal[i].value).val()));

                    contador_actitudinal++;
                }

                if(contador_actitudinal > cantidad_actitudinal)
                {
                    promedio_actitudinal = promedio_actitudinal / cantidad_actitudinal;

                    $('#promedio_actitudinal_'+ ids_alumnos[posicion_alumno].value).val(promedio_actitudinal);
                    $('#promedio_actitudinal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_actitudinal) * porcentaje_actitudinal);

                    notas_actitudinales.push(promedio_actitudinal);

                    promedio_actitudinal = 0;
                    contador_actitudinal = 1;

                    let promedio_final = ((notas_individuales[posicion_alumno] * porcentaje_individual) + (notas_grupales[posicion_alumno] * porcentaje_grupal) + (notas_actitudinales[posicion_alumno] * porcentaje_actitudinal));

                    $('#promedio_final_'+ ids_alumnos[posicion_alumno].value).val(promedio_final.toFixed(2));

                    this.guardarPromedio(ids_alumnos[posicion_alumno].value, promedio_final.toFixed(2));

                    posicion_alumno++;
                }
            }
        },

        guardarPromedio(alumno_id, promedio_materia)
        {
            let data = new FormData();

            data.append('alumno_id', alumno_id);
            data.append('periodo_id', this.periodo_id);
            data.append('materia_id', this.materia_id);
            data.append('detalplaneva_id', this.detalplaneva_id);
            data.append('curso_id', this.curso_id);
            data.append('promedio_materia', promedio_materia);

            let url = "./api/evaluacion/guadar/promedio";

            axios.post(url, data)
            .then(response => {

                //this.CalcularPromedio();
            })
            .catch(error => {

            });
        },

        GuardarNota(alumno_id, periodo_id, materia_id, detalplaneva_id, nota_deteva)
        {
            this.alumno_id = alumno_id;
            this.periodo_id = periodo_id;
            this.materia_id = materia_id;
            this.detalplaneva_id = detalplaneva_id;

            let data = new FormData();

            data.append('alumno_id', alumno_id);
            data.append('periodo_id', periodo_id);
            data.append('materia_id', materia_id);
            data.append('detalplaneva_id', detalplaneva_id);
            data.append('nota_deteva', nota_deteva);


            let url = "./api/evaluacion/guadar/nota";

            axios.post(url, data)
            .then(response => {

                this.CalcularPromedio();
            })
            .catch(error => {

            });
        },

        CalcularPromedio()
        {
            let ids_alumnos          = document.getElementsByName('ids_alumnos[]');
            let ids_nota_individual  = document.getElementsByName('ids_nota_individual[]');
            let ids_nota_grupal      = document.getElementsByName('ids_nota_grupal[]');
            let ids_nota_actitudinal = document.getElementsByName('ids_nota_actitudinal[]');

            let cantidad_individual  = this.cantidad_individual;
            let cantidad_grupal      = this.cantidad_grupal;
            let cantidad_actitudinal = this.cantidad_actitudinal;

            let promedio_individual  = 0;
            let promedio_grupal      = 0;
            let promedio_actitudinal = 0;

            let porcentaje_individual  = this.porcentaje_individual / 100;
            let porcentaje_grupal      = this.porcentaje_grupal / 100;
            let porcentaje_actitudinal = this.porcentaje_actitudinal / 100;

            let notas_individuales  = [];
            let notas_grupales      = [];
            let notas_actitudinales = [];

            let contador_individual = 1;

            let posicion_alumno = 0;

            for(var i = 0; i < ids_nota_individual.length; i++)
            {
                if(contador_individual <= cantidad_individual)
                {
                    promedio_individual = parseFloat(promedio_individual) + parseFloat(($('#nota_'+ ids_nota_individual[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_individual[i].value).val()));

                    contador_individual++;
                }

                if(contador_individual > cantidad_individual)
                {
                    promedio_individual = promedio_individual / cantidad_individual;

                    $('#promedio_individual_'+ ids_alumnos[posicion_alumno].value).val(promedio_individual);
                    $('#promedio_individual_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_individual) * porcentaje_individual);

                    notas_individuales.push(promedio_individual);

                    promedio_individual = 0;
                    contador_individual = 1;

                    posicion_alumno++;
                }
            }

            let contador_grupal = 1;

            posicion_alumno = 0;

            for(var i = 0; i < ids_nota_grupal.length; i++)
            {
                if(contador_grupal <= cantidad_grupal)
                {
                    promedio_grupal = parseFloat(promedio_grupal) + parseFloat(($('#nota_'+ ids_nota_grupal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_grupal[i].value).val()));

                    contador_grupal++;
                }

                if(contador_grupal > cantidad_grupal)
                {
                    promedio_grupal = promedio_grupal / cantidad_grupal;

                    $('#promedio_grupal_'+ ids_alumnos[posicion_alumno].value).val(promedio_grupal);
                    $('#promedio_grupal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_grupal) * porcentaje_grupal);

                    notas_grupales.push(promedio_grupal);

                    promedio_grupal = 0;
                    contador_grupal = 1;

                    posicion_alumno++;
                }
            }

            let contador_actitudinal = 1;

            posicion_alumno = 0;

            for(var i = 0; i < ids_nota_actitudinal.length; i++)
            {
                if(contador_actitudinal <= cantidad_actitudinal)
                {
                    promedio_actitudinal = parseFloat(promedio_actitudinal) + parseFloat(($('#nota_'+ ids_nota_actitudinal[i].value).val() == '' ? 0 : $('#nota_'+ ids_nota_actitudinal[i].value).val()));

                    contador_actitudinal++;
                }

                if(contador_actitudinal > cantidad_actitudinal)
                {
                    promedio_actitudinal = promedio_actitudinal / cantidad_actitudinal;

                    $('#promedio_actitudinal_'+ ids_alumnos[posicion_alumno].value).val(promedio_actitudinal);
                    $('#promedio_actitudinal_porcentaje_'+ ids_alumnos[posicion_alumno].value).val((promedio_actitudinal) * porcentaje_actitudinal);

                    notas_actitudinales.push(promedio_actitudinal);

                    promedio_actitudinal = 0;
                    contador_actitudinal = 1;

                    let promedio_final = ((notas_individuales[posicion_alumno] * porcentaje_individual) + (notas_grupales[posicion_alumno] * porcentaje_grupal) + (notas_actitudinales[posicion_alumno] * porcentaje_actitudinal));

                    $('#promedio_final_'+ ids_alumnos[posicion_alumno].value).val(promedio_final.toFixed(2));

                    this.guardarPromedio(ids_alumnos[posicion_alumno].value, promedio_final.toFixed(2));

                    posicion_alumno++;
                }
            }
        },

        guardarPromedio(alumno_id, promedio_materia)
        {
            let data = new FormData();

            data.append('alumno_id', alumno_id);
            data.append('periodo_id', this.periodo_id);
            data.append('materia_id', this.materia_id);
            data.append('detalplaneva_id', this.detalplaneva_id);
            data.append('curso_id', this.curso_id);
            data.append('promedio_materia', promedio_materia);

            let url = "./api/evaluacion/guadar/promedio";

            axios.post(url, data)
            .then(response => {

                //this.CalcularPromedio();
            })
            .catch(error => {

            });
        },

    cerrarModal(){
      this.modal=0;
      this.modalRegistro = 0;
    },
  },
  created() {
    //this.listar();
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
