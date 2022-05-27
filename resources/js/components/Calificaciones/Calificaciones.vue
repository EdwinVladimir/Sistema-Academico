<template>
  <div>
   <h1 class="text-center">Reporte de Calificaciones</h1>
    <div class="my-4">
        <label for="stock">Periodo:</label>
        <v-select v-model="reporte.plan" :items= "per" item-text="ano_per" item-value="id" dense solo id="periodo" ></v-select>
    </div>
    <div class="my-4">
      <label for="ejecurso">Reportes por:</label>
      <v-select v-model="reporte.por" :items= "por" dense solo id="por" ></v-select>
    </div>
    <div class="my-4">
      <label for="ejecurso">Condición:</label>
      <v-select v-model="reporte.criterio" :items= "criter" dense solo id="criter" ></v-select>
    </div>
    <div class="my-4">        
      <button  @click="imprime();" type="button" class="btn btn-success" data-dismiss="modal">Imprimir</button>
    </div>
   
      <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">DNI</th>
          <th scope="col">Tipo de Evaluaión</th>
          <th scope="col">Nota</th>
          <th scope="col">Peso</th>
          <th scope="col">Nota Ponderada</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="evalua in evaluacion.data" :key="evalua.id">
          <th scope="row">{{ evalua.id }}</th>
          <td>{{ evalua.dni_al }}</td>
          <td>{{ evalua.tipo_eva }}</td>
          <td>{{ evalua.nota_eva }}</td>
          <td>{{ evalua.peso_eva }}</td>
          <td>{{ evalua.nopond_eva }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      evaluacion:{   },
      reporte:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      evalua: [],
      per: [],
      por: ['Cursos', 'Modulos', 'Materias'],
      criter: ['Todos', 'Mayor', 'Menor'],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/evaluac/');
      this.evaluacion = res.data;
      const resper = await axios.get('./api/periodo');
      this.per = resper.data.data;
    },
          async imprime() {
    alert("Ya listo para imprimir");
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