<template>

  <div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Gestionar Estudiantes</h1>
        </div>
    </div>

    <div class="my-4">
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-success btn-sm my-2" style="display: none;"><i class="fa fa-plus"></i> Agregar</button><br>
        <label for="buscar">Buscar:</label>
        <div class="input-group mb-3">
            <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombre y Apellido o Dni (Presione enter)">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="my-4">

    </div>
    <!-- Button to Open the Modal -->


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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="dni">DNI:</label>
                                <div v-if="message_validation.dni_al != ''" v-text='message_validation.dni_al' class="text-danger"></div>
                                <div class="input-group mb-3">
                                    <input v-model="alumno.dni" type="text" class="form-control" id="dni" placeholder="Dni del alumno" readonly required>
                                    <div class="input-group-append" @click="buscarcedula();" style="cursor: pointer;">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="fnacimiento">Fecha de Nacimiento</label>
                                <span v-if="message_validation.fnac_al != ''" v-text='message_validation.fnac_al' class="text-danger"></span>
                                <input v-model="alumno.fnacimiento" type="date" class="form-control" id="fnacimiento" placeholder="Fecha de Nacimiento del Alumno" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="nombre">Nombre:</label>
                                <span v-if="message_validation.nom_al != ''" v-text='message_validation.nom_al' class="text-danger"></span>
                                <input v-model="alumno.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Alumno" readonly required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="apellido">Apellido:</label>
                                <span v-if="message_validation.ape_al != ''" v-text='message_validation.ape_al' class="text-danger"></span>
                                <input v-model="alumno.apellido" type="text" class="form-control" id="apellido" placeholder="Apellido del Alumno" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="lnacimiento">Lugar de Nacimiento:</label>
                                <span v-if="message_validation.lnac_al != ''" v-text='message_validation.lnac_al' class="text-danger"></span>
                                <input v-model="alumno.lnacimiento" type="text" class="form-control" id="lnacimiento" placeholder="Lugar de Nacimiento del Alumno" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Especialidad:</label>
                                <div v-if="message_validation.especialidad_id != ''" v-text='message_validation.especialidad_id' class="text-danger"></div>
                                <select v-model="alumno.especialidad" class="form-control">
                                    <option v-for="(especialidad, index) in espe" :key="especialidad.id" :value="especialidad.id">{{especialidad.nom_especialidad}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Reparto:</label>
                                <div v-if="message_validation.reparto_id != ''" v-text='message_validation.reparto_id' class="text-danger"></div>
                                <select v-model="alumno.reparto" class="form-control">
                                    <option v-for="(reparto, index) in repa" :key="reparto.id" :value="reparto.id">{{reparto.nom_reparto}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Grado:</label>
                                <div v-if="message_validation.tipogrado_id != ''" v-text='message_validation.tipogrado_id' class="text-danger"></div>
                                <select v-model="alumno.grado" class="form-control">
                                    <option v-for="(grado, index) in grad" :key="grado.id" :value="grado.id">{{grado.nom_grado}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Tipo de Sangre</label>
                                <div v-if="message_validation.tiposangre_id != ''" v-text='message_validation.tiposangre_id' class="text-danger"></div>
                                <select v-model="alumno.sangre" class="form-control">
                                    <option v-for="(sangre, index) in sang" :key="sangre.id" :value="sangre.id">{{sangre.nom_sangre}}</option>
                                </select>
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

            <th scope="col">DNI</th>
            <th scope="col">Grado</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Reparto</th>
            <th scope="col">Tipo de Sangre</th>
            <th scope="col">Lugar de Nacimiento</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col" colspan="2" class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(alm, index) in alumno.data" :key="alm.id">

               <td v-text="index + 1" style="padding-left: 5px;"></td>

            <td>{{ alm.dni_al }}</td>
            <td>
                <span v-for="(n,indice) in alm.tipogrado_nom" :key="indice">
                    {{n.nom_grado}}
                </span>
            </td>
            <td>{{ alm.nom_al }}</td>
            <td>{{ alm.ape_al }}</td>
            <td>
                <span v-for="(n,indice) in alm.especialidad_nom" :key="indice">
                    {{n.nom_especialidad}}
                </span>
            </td>
            <td>
                <span v-for="(n,indice) in alm.reparto_nom" :key="indice">
                    {{n.nom_reparto}}
                </span>
            </td>
            <td>
                <span v-for="(n,indice) in alm.tiposangre_nom" :key="indice">
                    {{n.nom_sangre}}
                </span>
            </td>
            <td>{{ alm.lnac_al }}</td>
            <td>{{ alm.fnac_al }}</td>
        <td>
            <button  @click="modificar=true; abrirModal(alm);" title="Editar" class="btn btn-warning">
                Editar
            </button>
          </td>
          <td>
            <button @click="eliminar(alm.id)" v-if="alm.matricula.length == 0" class="btn btn-danger">
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
  data(){
    return{
      alumno: { },
      alumnoci: { },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      buscar:'',
      alm: [ ],
      aul: [ ],
      repart: [ ],
      espe: [ ],
      repa: [ ],
      grad: [ ],
      sang: [ ],

        message_validation: {

            dni_al: '',
            nom_al: '',
            ape_al: '',
            especialidad_id: '',
            reparto_id: '',
            tipogrado_id: '',
            tiposangre_id: '',
            lnac_al: '',
            fnac_al: '',
            email: '',
        },
    };

  },

  methods: {
    async listar() {
      const res = await axios.get('./api/alumno', {
      params: {
        name: this.buscar
      }
    });
      this.alumno = res.data;

      const resespe = await axios.get('./api/especialidad');
      this.espe = resespe.data.data;

      const resrepa = await axios.get('./api/reparto');
      this.repa = resrepa.data.data;

      const resgrad = await axios.get('./api/tipogrado');
      this.grad = resgrad.data.data;

      const ressang = await axios.get('./api/tiposangre');
      this.sang = ressang.data.data;
    },


    async buscarci() {

        if(this.alumno.dni)
        {
            const res = await axios.get('./api/alumno', {
                    params: {
                    name: this.alumno.dni
                }
            });

                this.alumnoci = res.data;
            if(Object.keys(this.alumnoci.data).length === 1)
            {
                swal('Atención', 'El DNI ya se encuentra registrado', 'warning');
            }else{
                swal('Correcto', 'El DNI se encuentra autorizado para registrar al Estudiante', 'success');
            }
        }
        else
        {
            swal('Atención', 'El campo no puede estar vacío', 'warning');
        }
    },

    async eliminar(id)
    {
        swal({
            title: "Eliminar el Alumno",
            text: "Está seguro(a) de eliminar el Alumno",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {

            if (willDelete)
            {
                let url = './api/alumno/'+ id;

                axios.delete(url)
                .then(response => {

                    swal('Correcto!', 'El Alumno fue eliminado','success');

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

            let url = './api/alumno/'+ this.id;

            axios.put(url, {
                'id': this.id,
                'dni_al': this.alumno.dni,
                'nom_al': this.alumno.nombre,
                'ape_al': this.alumno.apellido,
                'especialidad_id': this.alumno.especialidad,
                'reparto_id': this.alumno.reparto,
                'tipogrado_id': this.alumno.grado,
                'tiposangre_id': this.alumno.sangre,
                'lnac_al': this.alumno.lnacimiento,
                'fnac_al': this.alumno.fnacimiento,
             })
            .then(response => {

                this.cerrarModal();
                this.listar();

                swal('Correcto!', 'El Estudiante fue actualizado', 'success');
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

            let url = './api/alumno/';

            axios.post(url, {

                'id': this.update,
                'dni_al': this.alumno.dni,
                'nom_al': this.alumno.nombre,
                'ape_al': this.alumno.apellido,
                'especialidad_id': this.alumno.especialidad,
                'reparto_id': this.alumno.reparto,
                'tipogrado_id': this.alumno.grado,
                'tiposangre_id': this.alumno.sangre,
                'lnac_al': this.alumno.lnacimiento,
                'fnac_al': this.alumno.fnacimiento,
                'email': this.alumno.email,
             })
            .then(response => {

                if(response.data.estado_accion)
                {
                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Estudiante fue registrado', 'success');
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
        this.message_validation.dni_al          = '';
        this.message_validation.nom_al          = '';
        this.message_validation.ape_al          = '';
        this.message_validation.especialidad_id = '';
        this.message_validation.reparto_id      = '';
        this.message_validation.tipogrado_id    = '';
        this.message_validation.tiposangre_id   = '';
        this.message_validation.lnac_al         = '';
        this.message_validation.fnac_al         = '';
        this.message_validation.email           = '';
    },

    abrirModal(data={}){

        this.LimpiarMensajesErrores();

      this.modal=1;
      if(this.modificar){

        $('#email').attr('readonly', true);

        this.id=data.id;
        this.tituloModal="Modificar Alumno";
        this.alumno.dni=data.dni_al;
        this.alumno.nombre=data.nom_al;
        this.alumno.apellido=data.ape_al;
        this.alumno.especialidad=data.especialidad_id;
        this.alumno.reparto=data.reparto_id;
        this.alumno.grado=data.tipogrado_id;
        this.alumno.sangre=data.tiposangre_id;
        this.alumno.lnacimiento=data.lnac_al;
        this.alumno.fnacimiento=data.fnac_al;
        this.alumno.email=data.email;

      }else{

        $('#email').removeAttr('readonly');

        this.id=0;
        this.tituloModal="Crear Alumno";
        this.alumno.dni='';
        this.alumno.nommbre='';
        this.alumno.apellido='';
        this.alumno.especialidad='';
        this.alumno.reparto='';
        this.alumno.grado='';
        this.alumno.sangre='';
        this.alumno.lnacimiento='';
        this.alumno.fnacimiento=' ';
        this.alumno.email='';
      }
    },

    buscardata(){
      this.listar();
    },

    buscarcedula(){

      this.buscarci();
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



