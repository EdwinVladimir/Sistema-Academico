<template>
    <div>
        <h1 class="text-center">Configurar Pie Reporte</h1>

        <div class="my-4" style="background: white; padding: 2em;">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Nombre Completo</label><br>
                        <input type="text" v-model="nombre_completo1" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Grado</label><br>
                        <input type="text" v-model="grado1" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Cargo</label><br>
                        <input type="text" v-model="cargo1" class="form-control" readonly required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="" style="color: white;">Individual</label><br>
                        <button class="btn btn-primary form-control" @click="Actualizar('data1')">Actualizar</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Nombre Completo</label><br>
                        <input type="text" v-model="nombre_completo2" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Grado</label><br>
                        <input type="text" v-model="grado2" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Cargo</label><br>
                        <input type="text" v-model="cargo2" class="form-control" readonly required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="" style="color: white;">Individual</label><br>
                        <button class="btn btn-primary form-control" @click="Actualizar('data2')">Actualizar</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Nombre Completo</label><br>
                        <input type="text" v-model="nombre_completo3" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Grado</label><br>
                        <input type="text" v-model="grado3" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="">Cargo</label><br>
                        <input type="text" v-model="cargo3" class="form-control" readonly required>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <div class="form-group">
                        <label for="" style="color: white;">Individual</label><br>
                        <button class="btn btn-primary form-control" @click="Actualizar('data3')">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {

        id1: '',
        nombre_completo1: '',
        grado1: '',
        cargo1: '',

        id2: '',
        nombre_completo2: '',
        grado2: '',
        cargo2: '',

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
            const res = await axios.get('../api/reporte-pie/');

            let reporte_pie = res.data.pie_reporte;

            this.id1              = reporte_pie[0]['id'];
            this.nombre_completo1 = reporte_pie[0]['nombre_completo'];
            this.grado1           = reporte_pie[0]['grado'];
            this.cargo1           = reporte_pie[0]['cargo'];

            this.id2              = reporte_pie[1]['id'];
            this.nombre_completo2 = reporte_pie[1]['nombre_completo'];
            this.grado2           = reporte_pie[1]['grado'];
            this.cargo2           = reporte_pie[1]['cargo'];

            this.id3              = reporte_pie[2]['id'];
            this.nombre_completo3 = reporte_pie[2]['nombre_completo'];
            this.grado3           = reporte_pie[2]['grado'];
            this.cargo3           = reporte_pie[2]['cargo'];
        },
         
        async Actualizar(data)
        {
            let total = parseFloat(this.formulario.individual) + parseFloat(this.formulario.grupal) + parseFloat(this.formulario.actitudinal);

            if(data == 'data1')
            {
                const res = await axios.get('../api/reporte-pie/actualizar', { 

                    params: {

                        'id': this.id1,
                        'nombre_completo': this.nombre_completo1,
                        'grado': this.grado1,
                        'cargo': this.cargo1,
                    }
                });

                if(res.data.estado_accion)
                {
                    swal('Correcto!', 'Se actualizaron los datos correctamente', 'success');
                }
            }
            else if(data == 'data2')
            {
                const res = await axios.get('../api/reporte-pie/actualizar', { 

                    params: {
                        
                        'id': this.id2,
                        'nombre_completo': this.nombre_completo2,
                        'grado': this.grado2,
                        'cargo': this.cargo2,
                    }
                });

                if(res.data.estado_accion)
                {
                    swal('Correcto!', 'Se actualizaron los datos correctamente', 'success');
                }
            }
            else
            {
                const res = await axios.get('../api/reporte-pie/actualizar', { 

                    params: {
                        
                        'id': this.id3,
                        'nombre_completo': this.nombre_completo3,
                        'grado': this.grado3,
                        'cargo': this.cargo3,
                    }
                });

                if(res.data.estado_accion)
                {
                    swal('Correcto!', 'Se actualizaron los datos correctamente', 'success');
                }
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