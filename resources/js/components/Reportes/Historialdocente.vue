<template>
    <div>
        <h1 class="text-center">Reporte de Historial Asignación Docente</h1>

        <div class="my-4" style="background: white; padding: 2em;">
            
            <form @submit.prevent="descargar('preview')">
                <div class="row">
                    <div class="col-lg-6 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Buscar Apellido <span class="text-danger" v-if="verTextoBuscando">(Buscando...)</span></label><br>
                            <input type="text" v-model="docente_ape_doc" class="form-control" @keyup="ChangeApellido()">
                            <div v-if="lista_docentes.length > 0" style="position: absolute; z-index: 1;  width:  95%; height: auto; background: #f4f6f9;">
                                <div v-for="docente in lista_docentes" :value="docente.id" class="resultado-hover" @click="ChangeIdDocente(docente.id, docente.ape_doc +' - '+ docente.nom_doc)">
                                    {{docente.ape_doc +' - '+ docente.nom_doc}}
                                </div>
                            </div>
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
            docente_id: 0,
            docente_ape_doc: '',

            lista_docentes: [],

            verTextoBuscando: false,
        };
    },

    mounted()
    {
        //this.listarFiltros();
    },

    methods: {

        async ChangeApellido() 
        {
            this.verTextoBuscando = false;

            this.lista_docentes = [];

            if(this.docente_ape_doc.length > 2)
            {
                this.verTextoBuscando = true;

                const res = await axios.get('/api/buscar/docente/'+ this.docente_ape_doc);
    
                if(res.status == 200)
                {
                    this.verTextoBuscando = false;

                    this.lista_docentes = res.data.lista_docentes;
                }
            }
        },

        ChangeIdDocente(id, estudiante)
        {
            this.docente_id     = id;
            this.docente_ape_doc = estudiante;

            this.lista_docentes = [];
        },

        async listarFiltros()
        { 
            const res = await axios.get('../reporte/listar/filtros');
 
            this.lista_docentes = res.data.lista_docentes;
        }, 
        
        async descargar(type)
        {
           // window.open(''+ this.curso_id +'/'+ this.docente_id);
            $('#viePDF').attr('src', '../reporte/historial-docente/descargar/'+ this.docente_id +'/'+ type);
        },
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