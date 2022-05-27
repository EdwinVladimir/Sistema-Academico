<template>
  <div>
   <h1 class="text-center">GENERAL</h1>
    <div class="my-4">
        <label for="stock">Periodo:</label>
        <v-select v-model="reporte.plan" :items= "per" item-text="ano_per" item-value="id" dense solo id="periodo" ></v-select>
    </div>
    <div class="my-4">
      <label for="ejecurso">Reportes por:</label>
      <v-select v-model="reporte.por" :items= "por" dense solo id="por" ></v-select>
    </div>
    <div class="my-4">        
      <button  @click="imprime();" type="button" class="btn btn-success" data-dismiss="modal">Imprimir</button>
    </div>
   <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">DNI</th>
          <th scope="col">Periodo</th>
          <th scope="col">Curso</th>
          <th scope="col">Docente</th>
          <th scope="col">Sección</th>
          <th scope="col">Modulo</th>  
          <th scope="col">Aulas</th>                    
          <th scope="col">Materia</th>
          <th scope="col">Día</th>
          <th scope="col">Hora de Inicio</th>
          <th scope="col">Hora de Finalizar</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="hor in horario.data" :key="hor.id">
          <th scope="row">{{ hor.id }}</th>
          <td>{{ hor.dni_al }}</td>
          <td>{{ hor.cod_per }}</td>
          <td>{{ hor.cod_cur }}</td>
          <td>{{ hor.dni_doc }}</td>
          <td>{{ hor.cod_sec }}</td>
          <td>{{ hor.cod_mod }}</td>
          <td>{{ hor.cod_aul }}</td>
          <td>{{ hor.cod_mat }}</td>
          <td>{{ hor.dia_hor }}</td>
          <td>{{ hor.inic_hor }}</td>
          <td>{{ hor.ter_hor }}</td>
        </tr>
      </tbody>
    </table>
 </div>
</template>

<script>
export default {
  data() {
    return {
      horario:{   },
      reporte:{   },
      id:0,
      modificar:true,
      modal:0,
      tituloModal:'',
      hor: [],
      per: [],
      por: ['Estudiantes', 'Docentes', 'Cursos', 'Horarios'],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get('./api/horario');
      this.horario = res.data;
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