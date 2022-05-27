<template>
    <div>
        <h1 class="text-center">Reporte de Registro de Notas</h1>

        <div class="my-4" style="background: white; padding: 2em;">
            
            <form @submit.prevent="descargar('preview')">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Periodos</label><br>
                            <select v-model="periodo_id" class="form-control" @change="CargarCursos()" required>
                                <option v-for="periodo in lista_periodos" :value="periodo.id">{{periodo.ano_per +' - '+ periodo.peri_per}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Cursos</label><br>
                            <select v-model="curso_id" class="form-control" @change="CargarDocentes" required>
                                <option v-for='curso in lista_cursos' :value="curso.id">{{curso.nom_cur}}</option>
                            </select>
                        </div>
                    </div>
                    <div v-show="docente_id_aux == 0" class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Docentes</label><br>
                            <select v-model="docente_id"  class="form-control" @change="CargarMaterias(this)">
                                <option v-for="docente in lista_docentes" :value="docente.id">{{docente.nom_doc +' '+ docente.ape_doc}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Materías</label><br>
                            <select v-model="materia_id" class="form-control" required>
                                <option v-for='materia in lista_materias' :value="materia.id">{{materia.nom_mat}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="" style="color: white;">Individual</label><br>
                            <button class="btn btn-primary form-control"><i class="fa fa-eye"></i> Ver Reporte</button>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="" style="color: white;">Individual</label><br>
                            <button type="button" class="btn btn-primary form-control" style="color: white;" @click="descargar('descargar')"><i class="fa fa-file-pdf"></i> Descargar</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-12">
                    <iframe id="viePDF" src="" width="100%" height="680px"></iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {

        return {

            curso_id: 0,
            materia_id: 0,
            periodo_id: 0,
            docente_id: 0,
            docente_id_aux: 0,

            lista_cursos: [],
            lista_materias: [],
            lista_materias_auxiliar: [],
            lista_periodos: [],
            lista_docentes: [],
        };
    },

    mounted()
    {
        this.listarFiltros();
        this.docente_id_aux = docente_id;
        this.docente_id     = docente_id;
    },

    methods: {

        async listarFiltros()
        {
            const res = await axios.get('../reporte/listar/filtros');

            this.lista_periodos = res.data.lista_periodos;
        },
         
        async descargar(type)
        {
            if(this.docente_id_aux)
            {
                this.docente_id = this.docente_id_aux;
            }

            $('#viePDF').attr('src', '../reporte/registro-notas/descargar/'+ this.curso_id +'/'+ this.materia_id +'/'+ this.periodo_id +'/'+ this.docente_id +'/'+ type);
        },

        async CargarCursos()
        {
            const res = await axios.get('../reporte/listar/cursos/'+ this.periodo_id);

            this.lista_cursos = res.data.lista_cursos;
        },

        async CargarDocentes()
        {
            const res = await axios.get('../reporte/listar/docentes/'+ this.periodo_id +'/'+ this.curso_id);

            this.lista_docentes = res.data.lista_docentes;

            if(this.docente_id_aux)
            {
                this.CargarMaterias();
            }
        },

        async CargarMaterias()
        {
            const res = await axios.get('../reporte/listar/materias/'+ this.periodo_id +'/'+ this.curso_id +'/'+ this.docente_id);

            this.lista_materias = res.data.lista_materias;
        }
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