<template>
  <div>
    <h1 class="text-center">Gestionar Docentes</h1>

    <div class="my-4">
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-success btn-sm my-2" style="display: none;"><i class="fa fa-plus"></i> Agregar</button><br>
        <label for="buscar">Buscar:</label>
        <div class="input-group mb-3">
            <input v-model="buscar" type="text" v-on:keyup.enter="buscardata();" class="form-control" id="buscar" placeholder="Buscar Nombres y Apellidos o Dni (Presione enter)">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>

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
                                <div v-if="message_validation.dni_doc != ''" v-text='message_validation.dni_doc' class="text-danger"></div>
                                <div class="input-group mb-3">
                                    <input v-model="docentes.dni" type="text" class="form-control" id="dni" placeholder="Dni del docente" readonly required>
                                    <div class="input-group-append" @click="buscarcedula();" style="cursor: pointer;">
                                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="fnacimiento">Fecha de Nacimiento</label>
                                <div v-if="message_validation.fnac_doc != ''" v-text='message_validation.fnac_doc' class="text-danger"></div>
                                <input v-model="docentes.fnacimiento" type="date" class="form-control" id="fnacimiento" placeholder="Fecha de Nacimiento del Docente" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="nombre">Nombre:</label>
                                <div v-if="message_validation.nom_doc != ''" v-text='message_validation.nom_doc' class="text-danger"></div>
                                <input v-model="docentes.nombre" type="text" class="form-control" id="nombre" placeholder="Nombre del Docente" readonly required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="apellido">Apellido:</label>
                                <div v-if="message_validation.ape_doc != ''" v-text='message_validation.ape_doc' class="text-danger"></div>
                                <input v-model="docentes.apellido" type="text" class="form-control" id="apellido" placeholder="Apellido del Docente" readonly required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="lnacimiento">Lugar de Nacimiento:</label>
                                <div v-if="message_validation.lnac_doc != ''" v-text='message_validation.lnac_doc' class="text-danger"></div>
                                <input v-model="docentes.lnacimiento" type="text" class="form-control" id="lnacimiento" placeholder="Lugar de Nacimiento del Docente" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Especialidad:</label>
                                <div v-if="message_validation.especialidad_id != ''" v-text='message_validation.especialidad_id' class="text-danger"></div>
                                <select v-model="docentes.especialidad" class="form-control">
                                    <option v-for="(especialidad, index) in espe" :key="especialidad.id" :value="especialidad.id">{{especialidad.nom_especialidad}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Reparto:</label>
                                <div v-if="message_validation.reparto_id != ''" v-text='message_validation.reparto_id' class="text-danger"></div>
                                <select v-model="docentes.reparto" class="form-control">
                                    <option v-for="(reparto, index) in repa" :key="reparto.id" :value="reparto.id">{{reparto.nom_reparto}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Grado:</label>
                                <div v-if="message_validation.tipogrado_id != ''" v-text='message_validation.tipogrado_id' class="text-danger"></div>
                                <select v-model="docentes.grado" class="form-control">
                                    <option v-for="(grado, index) in grad" :key="grado.id" :value="grado.id">{{grado.nom_grado}}</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="">Tipo de Sangre</label>
                                <div v-if="message_validation.tiposangre_id != ''" v-text='message_validation.tiposangre_id' class="text-danger"></div>
                                <select v-model="docentes.sangre" class="form-control">
                                    <option v-for="(sangre, index) in sang" :key="sangre.id" :value="sangre.id">{{sangre.nom_sangre}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="instituto">Institución Educativa:</label>
                                <div v-if="message_validation.instt_docp != ''" v-text='message_validation.instt_docp' class="text-danger"></div>
                                <input v-model="docentes.instituto" type="text" class="form-control" id="instituto" placeholder="Instituto Educativo" required>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                <label for="certificacion">Certificación Obtenida</label>
                                <div v-if="message_validation.cobt_doc != ''" v-text='message_validation.cobt_doc' class="text-danger"></div>
                                <input :id="certificado" v-model="docentes.certificado" type="text" class="form-control" id= "certificacion" placeholder="Certificación Obtenida" required>
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
          <th scope="col">Nombre</th>
          <th scope="col">Apellidos</th>
          <th scope="col">Especialidad</th>
          <th scope="col">Reparto</th>
          <th scope="col">Tipo de Sangre</th>
          <th scope="col">Lugar de Nacimiento</th>
          <th scope="col">Fecha de Nacimiento</th>
          <th scope="col">Institución Educativa</th>
          <th scope="col">Certificación Obtenida</th>
          <th scope="col" colspan="2" class="text-center">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(doc, index) in docentes.data" :key="doc.id">

               <td v-text="index + 1" style="padding-left: 5px;"></td>
          <td>{{ doc.dni_doc }}</td>
          <td>
              <span v-for="(n,indice) in doc.tipogrado_nom" :key="indice">
                  {{n.nom_grado}}
              </span>
          </td>
          <td>{{ doc.nom_doc }}</td>
          <td>{{ doc.ape_doc }}</td>
          <td>
              <span v-for="(n,indice) in doc.especialidad_nom" :key="indice">
                  {{n.nom_especialidad}}
              </span>
          </td>
          <td>
              <span v-for="(n,indice) in doc.reparto_nom" :key="indice">
                  {{n.nom_reparto}}
              </span>
          </td>
          <td>
              <span v-for="(n,indice) in doc.tiposangre_nom" :key="indice">
                  {{n.nom_sangre}}
              </span>
          </td>
          <td>{{ doc.lnac_doc }}</td>
          <td>{{ doc.fnac_doc }}</td>
          <td>{{ doc.instt_docp }}</td>
          <td>{{ doc.cobt_doc }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(doc);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(doc.id)" v-if="doc.asignadoc.length == 0" class="btn btn-danger">Eliminar</button>
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

        docentes:{ },
        docentesci:{ },
        id:0,
        modificar:true,
        modal:0,
        tituloModal:'',
        buscar:'',
        doc: [],
        espe: [ ],
        repa: [ ],
        grad: [ ],
        sang: [ ],

        message_validation: {

            dni_doc: '',
            nom_doc: '',
            ape_doc: '',
            especialidad_id: '',
            reparto_id: '',
            tipogrado_id: '',
            tiposangre_id: '',
            lnac_doc: '',
            fnac_doc: '',
            instt_docp: '',
            cobt_doc: '',
        },
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/docente', {
      params: {
        name: this.buscar
      }
    });

      this.docentes = res.data;

      const resespe = await axios.get('./api/especialidad');
      this.espe = resespe.data.data;

      const resrepa = await axios.get('./api/reparto');
      this.repa = resrepa.data.data;

      const resgrad = await axios.get('./api/tipogrado');
      this.grad = resgrad.data.data;

      const ressang = await axios.get('./api/tiposangre');
      this.sang = ressang.data.data;

    },

    async eliminar(id)
    {
        swal({
            title: "Eliminar el Docente",
            text: "Está seguro(a) de eliminar al Docente",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {

            if (willDelete)
            {
                let url = './api/docente/'+ id;

                axios.delete(url)
                .then(response => {

                    swal('Correcto!', 'El Docente fue eliminado','success');

                    this.listar();
                })
                .catch(error => {

                    console.log(error);
                });
            }
        });
    },

    async buscarci()
    {
        if(this.docentes.dni)
        {
            const res = await axios.get('./api/docente', {
                    params: {
                    name: this.docentes.dni
                }
            });

            this.docentesci = res.data;

            if(Object.keys(this.docentesci.data).length === 1)
            {
                swal('Atención', 'El DNI ya se encuentra registrado', 'warning');
            }else{
                swal('Correcto', 'El DNI se encuentra autorizado para registrar al Docente', 'success');
            }
        }
        else
        {
            swal('Atención', 'El campo no puede estar vacío', 'warning');
        }
    },

    async guardar()
    {
        if(this.modificar)
        {
            this.LimpiarMensajesErrores();

            let url = './api/docente/'+ this.id;

            axios.put(url, {
                'id': this.id,
                'dni_doc'   : this.docentes.dni,
                'nom_doc'   : this.docentes.nombre,
                'ape_doc'   : this.docentes.apellido,
                'especialidad_id': this.docentes.especialidad,
                'reparto_id': this.docentes.reparto,
                'tipogrado_id': this.docentes.grado,
                'tiposangre_id': this.docentes.sangre,
                'lnac_doc': this.docentes.lnacimiento,
                'fnac_doc': this.docentes.fnacimiento,
                'instt_docp': this.docentes.instituto,
                'cobt_doc': this.docentes.certificado,
             })
            .then(response => {

                this.cerrarModal();
                this.listar();

                swal('Correcto!', 'El Docente fue actualizado', 'success');
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

            let url = './api/docente/';

            axios.post(url, {

                'id': this.update,
                'dni_doc'   : this.docentes.dni,
                'nom_doc'   : this.docentes.nombre,
                'ape_doc'   : this.docentes.apellido,
                'especialidad_id': this.docentes.especialidad,
                'reparto_id': this.docentes.reparto,
                'tipogrado_id': this.docentes.grado,
                'tiposangre_id': this.docentes.sangre,
                'lnac_doc': this.docentes.lnacimiento,
                'fnac_doc': this.docentes.fnacimiento,
                'instt_docp': this.docentes.instituto,
                'cobt_doc': this.docentes.certificado,
             })
            .then(response => {

                if(response.data.estado_accion)
                {
                    this.cerrarModal();
                    this.listar();

                    swal('Correcto!', 'El Docente fue registrado', 'success');
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
        this.message_validation.dni_doc          = '';
        this.message_validation.nom_doc          = '';
        this.message_validation.ape_doc          = '';
        this.message_validation.especialidad_id = '';
        this.message_validation.reparto_id      = '';
        this.message_validation.tipogrado_id    = '';
        this.message_validation.tiposangre_id   = '';
        this.message_validation.lnac_doc         = '';
        this.message_validation.fnac_doc         = '';
        this.message_validation.instt_docp      = '';
        this.message_validation.cobt_doc        = '';
    },

    abrirModal(data={}){

        this.LimpiarMensajesErrores();

      this.modal=1;
     if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Docentes";
        this.docentes.dni=data.dni_doc;
        this.docentes.nombre=data.nom_doc;
        this.docentes.apellido=data.ape_doc;
        this.docentes.especialidad=data.especialidad_id;
        this.docentes.reparto=data.reparto_id;
        this.docentes.grado=data.tipogrado_id;
        this.docentes.sangre=data.tiposangre_id;
        this.docentes.lnacimiento=data.lnac_doc;
        this.docentes.fnacimiento=data.fnac_doc;
        this.docentes.instituto=data.instt_docp;
        this.docentes.certificado=data.cobt_doc;

      }else{
        this.id=0;
        this.tituloModal="Crear Docentes";
        this.docentes.dni_doc=' ';
        this.docentes.nom_doc=' ';
        this.docentes.ape_doc=' ';
        this.docentes.especialidad=' ';
        this.docentes.reparto=' ';
        this.docentes.grado=' ';
        this.docentes.sangre=' ';
        this.docentes.lnacimiento=' ';
        this.docentes.fnacimiento=' ';
        this.docentes.instituto=' ';
        this.docentes.certificado=' ';
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
