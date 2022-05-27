<template>
    <div>
        <h1 class="text-center">Gestionar Porcentajes de Notas</h1>

        <div class="my-4" style="background: white; padding: 2em;">
            
            <form @submit.prevent="guardar">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Individual</label><br>
                            <input type="number" v-model="formulario.individual" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Grupal</label><br>
                            <input type="number" v-model="formulario.grupal" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="">Actitudinal</label><br>
                            <input type="number" v-model="formulario.actitudinal" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <div class="form-group">
                            <label for="" style="color: white;">Individual</label><br>
                            <button class="btn btn-primary form-control">Actualizar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {

        formulario: {

            individual: 0,
            grupal: 0,
            actitudinal: 0,
        },
    };
  },

    mounted()
    {
        this.listar();
    },

    methods: {

        async listar()
        {
            const res = await axios.get('./api/porcentajes/');

            let porcentaje = res.data.porcentaje;

            this.formulario.individual  = porcentaje['porcentaje_individual'];
            this.formulario.grupal      = porcentaje['porcentaje_grupal']
            this.formulario.actitudinal = porcentaje['porcentaje_actitudinal']
        }, 
         
        async guardar()
        {
            let total = parseFloat(this.formulario.individual) + parseFloat(this.formulario.grupal) + parseFloat(this.formulario.actitudinal);

            if(total == 100.00)
            {
                const res = await axios.post('./api/porcentajes/', { 
                    
                    'porcentaje_individual': this.formulario.individual,
                    'porcentaje_grupal': this.formulario.grupal,
                    'porcentaje_actitudinal': this.formulario.actitudinal,
                });

                if(res.data.estado_accion)
                {
                    swal('Correcto!', 'Se actualizó los porcentajes de notas', 'success');

                    this.formulario.tipo_actividad = '';
                    this.formulario.descripcion = '';
                    this.formulario.fecent_plaeva = '';

                    this.listar_plan();
                }
            }
            else
            {
                swal('Atención!', 'La suma de los porcentajes: Individual, Grupal y Actitudinal debe sumar el 100%', 'warning');
            }
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