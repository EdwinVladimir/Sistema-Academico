<template>
  <div>
    <h1 class="text-center">Gestionar Planes de Estudios</h1>
    
    <!-- Button to Open the Modal -->
    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>

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
            <div class="my-4">
              <label for="titulo">Codigo del Plan</label>
              <input v-model="planestudio.titulo" type="text" class="form-control" id="titulo" placeholder="Titulo del Plan">
            </div>
            
            <div class="my-4">
              <label for="descripcion">Descripcion</label>
              <input v-model="planestudio.descripcion" type="text" class="form-control" id="descripcion" placeholder="Descripcion del Plan">
            </div>
            
            <div class="my-4">
              <label for="curso">Curso</label>
              <v-select v-model="planestudio.curso" :items=pcur :menu-props="{ maxHeight: '400' }" item-text="nom_cur" item-value="id" dense solo id="curso" ></v-select>              
            </div>
   
            <div class="my-4">
              <label for="archivo">Contenido</label>
              <v-textarea v-model="planestudio.archivo" name="archivo"></v-textarea>              
              <!--<input v-model="planestudio.archivo" type="text" class="form-control" id="archivo" placeholder="Archivo del Plan">-->
            </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
              Cancelar
            </button>
            <button  @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">
              Guardar
            </button>
            </div>
        </div>
      </div>
    </div>
  </div>

    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Codigo</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Curso</th>
          <th scope="col">Contenido</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="pla in planestudio.data" :key="pla.id">
          <th scope="row">{{ pla.id }}</th>
          <td>{{ pla.tit_pla }}</td>
          <td>{{ pla.descrip_pla }}</td>
           <td >
            <span v-for="(n,indice) in pla.curso_id" :key="indice">
                {{n}} 
            </span>  
          </td>
          <td>{{ pla.archi_pla }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(pla);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(pla.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
 </div>
</template>
<script>
export default {
  data() {
    return {
      planestudio:{ },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      pla: [],
      pcur: [ ],

    };
    
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/planestudio');
      this.planestudio = res.data;

      const rescur = await axios.get('./api/curso');
      this.pcur = rescur.data.data;

    },
    async eliminar(id) {
      const res = await axios.delete('./api/planestudio/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('./api/planestudio/' + this.id, { 
          
          'tit_pla': this.planestudio.titulo,
          'descrip_pla': this.planestudio.descripcion,
          'curso_id': this.planestudio.curso,
          'archi_pla': this.planestudio.archivo,

         });

      }else{
        const res = await axios.post('/api/planestudio/', { 
         
          'id': this.update,
          'tit_pla': this.planestudio.titulo,
          'descrip_pla': this.planestudio.descripcion,
          'curso_id': this.planestudio.curso,
           'archi_pla': this.planestudio.archivo,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar planestudio";
        this.planestudio.titulo=data.tit_pla;
        this.planestudio.descripcion=data.descrip_pla;
        this.planestudio.curso=data.curso_id;
        this.planestudio.archivo=data.archi_pla;
      }else{
        this.id=0;
        this.tituloModal="Crear planestudio";
        this.planestudio.titulo='';
        this.planestudio.descrip_pla='';
        this.planestudio.curso='';
        this.planestudio.archivo='';
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