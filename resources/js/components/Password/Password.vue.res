<template>
  <div>
    <h1 class="text-center">Cambio de Password</h1>
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
              <label for="nombre">Nombre: </label>
              <input v-model="user.name" type="text" class="form-control" id="name" placeholder="Nombre del Usuario">
            </div>

            <div class="my-4">
              <label for="numero">E-mail: </label>
              <input v-model="user.mail" type="text" class="form-control" id="mail" placeholder="Correo del Usuario">
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
          <th scope="col">Nombre</th>
          <th scope="col">Correo</th>
          <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="usr in user.data" :key="usr.id">
          <td scope="row">{{ usr.id }}</td>
          <td>{{ usr.name }}</td>
          <td>{{ usr.email }}</td>
          <td>
            <button  @click="modificar=true; abrirModal(usr);" class="btn btn-warning">Editar</button>
          </td>
          <td>
            <button @click="eliminar(usr.id)" class="btn btn-danger">
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
      user:{  },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      usr: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('http://127.0.0.1:8000/api/user');
      this.user = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete('http://127.0.0.1:8000/api/user/' + id);
      this.listar();
    },
    async guardar() {
      if(this.modificar){
        const res = await axios.put('http://127.0.0.1:8000/api/user/'+ this.id, { 
          
          'name': this.user.name,
          'email': this.user.email,

         });

      }else{
        const res = await axios.post('http://127.0.0.1:8000/api/user/', { 
         
          'id': this.update,
          'name': this.user.name,
          'email': this.user.enail,
         
         });
      }
      this.cerrarModal();
      this.listar();
    },
    abrirModal(data={}){
      this.modal=1;
      if(this.modificar){
        this.id=data.id;
        this.tituloModal="Modificar Usuario";
        this.user.codigo=data.name;
        this.user.numero=data.email;
      }else{
        this.id=0;
        this.tituloModal="Crear Usuario";
        this.user.nombre='';
        this.user.correo='';
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