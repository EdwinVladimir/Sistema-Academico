<template>
    <div>
        <h1 class="text-center">Análisis de Datos - Materias</h1>

        <div class="my-4" style="background: white; padding: 2em;">
            
            <form @submit.prevent="descargar">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row div-a">
                            <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="">Periodo A</label><br>
                                    <select v-model="periodo_id_a" class="form-control" @change="ChangePeriodo($event.target.value, 'a')" required>
                                        <option v-for="periodo in lista_periodos" :value="periodo.id">{{periodo.peri_per}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="">Curso A</label><br>
                                    <select v-model="curso_id_a" class="form-control" @change="ChangeCurso($event.target.value, 'a')" required>
                                        <option v-for='curso in lista_cursos_a' :value="curso.id">{{curso.nom_cur}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row div-b">
                            <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="">Periodo B</label><br>
                                    <select v-model="periodo_id_b" class="form-control" @change="ChangePeriodo($event.target.value, 'b')" required>
                                        <option v-for="periodo in lista_periodos" :value="periodo.id">{{periodo.peri_per}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-4 col-12">
                                <div class="form-group">
                                    <label for="">Curso B</label><br>
                                    <select v-model="curso_id_b" class="form-control" @change="ChangeCurso($event.target.value, 'b')" required>
                                        <option v-for='curso in lista_cursos_b' :value="curso.id">{{curso.nom_cur}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                        <button class="btn btn-primary form-control"><i class="fas fa-chart-line"></i>  Analizar</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="comparacion-a-b"></div>
                    </figure>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="aprobado-desaprobado-a"></div>
                    </figure>
                </div>
                <div class="col-lg-6">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="aprobado-desaprobado-b"></div>
                    </figure>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="comparacion-alumnos-a-b"></div>
                    </figure>
                </div>
            </div>

            <div class="row" v-show="escalaPromedio">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group text-center">
                                <label for="">SELECCIONAR QUE TIPO DE RANGO DE CALIFICACIONES REQUIERE SABER</label><br>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center" v-for='rango in lista_rangos'>
                            <label for="">{{rango.nombre}}</label><br>
                            <span for="">[{{rango.nota_minima}}, {{rango.nota_maxima}}]</span><br><br>
                            <input type="checkbox" class="form-check-input" :name="'rangos_ids[]'" :value="rango.id" @change="ChangeRango()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="rango-alumnos-a-b"></div>
                    </figure>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="row div-a">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="">Materias A</label><br>
                                <div v-for="materia in lista_materias_a" class="form-check">
                                    <input type="checkbox" class="form-check-input" :name="'materias_ids_a[]'" :value="materia.id" @change="ChangeMateria()">
                                    <label class="form-check-label">{{materia.nom_mat}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row div-b">
                        <div class="col-lg-12 col-md-12 col-sm-4 col-12">
                            <div class="form-group">
                                <label for="">Materias B</label><br>
                                <div v-for="materia in lista_materias_b" class="form-check">
                                    <input type="checkbox" class="form-check-input" :name="'materias_ids_b[]'" :value="materia.id" @change="ChangeMateria()">
                                    <label class="form-check-label">{{materia.nom_mat}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <figure class="highcharts-figure">
                        <div id="comparacion-promedios-materias-a-b"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {

        return {

            curso_id_a: 0,
            curso_id_b: 0,

            curso_a: '',
            curso_b: '',

            periodo_id_a: 0,
            periodo_id_b: 0,

            rangos_ids: [],

            materia_ids_a: [],
            materia_ids_b: [],

            lista_cursos_a: [],
            lista_cursos_b: [],
            lista_periodos: [],

            lista_materias_a: [],
            lista_materias_b: [],

            lista_rangos: [],

            lista_promedios_a_b: [],

            rango: 0,

            escalaPromedio: false,
        };
    },

    mounted()
    {
        this.listarFiltros();
    },

    methods: {

        async listarFiltros()
        {
            const res = await axios.get('./reporte/listar/filtros');

            this.lista_periodos = res.data.lista_periodos;  
            this.lista_rangos   = res.data.lista_rangos;
        },
         
        ChangeRango(rango)
        {
            let rangos_ids = document.getElementsByName('rangos_ids[]');

            this.rangos_ids = [];

            for(var i = 0; i < rangos_ids.length; i++)
            {
                if(rangos_ids[i].checked)
                {
                    this.rangos_ids.push(rangos_ids[i].value);
                }
            }

            let url = './analisis-de-datos/analizar/rangos';

            axios.post(url, { 
                'periodo_id_a': this.periodo_id_a,
                'curso_id_a': this.curso_id_a,
                'periodo_id_b': this.periodo_id_b,
                'curso_id_b': this.curso_id_b,
                'rangos_ids': this.rangos_ids,
             })
            .then(response => {

                //información gráfico comparación alumnos A y B
                let promedio_rango_alumnos_a = response.data.promedio_rango_alumnos_a;
                let promedio_rango_alumnos_b = response.data.promedio_rango_alumnos_b;
                let lista_rangos_check       = response.data.lista_rangos_check;

                let lista_promedios_rango_a_b = [];

                promedio_rango_alumnos_a.forEach(promedio => {

                    lista_rangos_check.forEach( rango => {

                        if(rango.nombre == promedio[0])
                        {
                            let promedio_alumnos_a = {};

                            promedio_alumnos_a.name      =  promedio[0] +' (A)';
                            promedio_alumnos_a.y         =  promedio[1];
                            promedio_alumnos_a.drilldown =  promedio[0] +' (A)';

                            lista_promedios_rango_a_b.push(promedio_alumnos_a);
                        }
                    });
                });

                promedio_rango_alumnos_b.forEach(promedio => {

                    lista_rangos_check.forEach( rango => {

                        if(rango.nombre == promedio[0])
                        {
                            let promedio_alumnos_b = {};

                            promedio_alumnos_b.name      =  promedio[0] +' (B)';
                            promedio_alumnos_b.y         =  promedio[1];
                            promedio_alumnos_b.drilldown =  promedio[0] +' (B)';

                            lista_promedios_rango_a_b.push(promedio_alumnos_b);
                        }
                    });
                });

                Highcharts.chart('rango-alumnos-a-b', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Comparación de Cursos de rango '+ rango +' ( '+ this.curso_a +' - '+ this.curso_b +')'
                    },
                    subtitle: {
                        text: 'Se realizó una comparación de los promedios de los cursos'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total Promedio'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                    },

                    series: [
                        {
                            name: "",
                            colorByPoint: true,
                            data: lista_promedios_rango_a_b,
                        }
                    ],
                    drilldown: {
                        breadcrumbs: {
                            position: {
                                align: 'right'
                            }
                        },
                        series: [
                            {
                                name: this.curso_a,
                                id: this.curso_a,
                            },
                            {
                                name: this.curso_b,
                                id: this.curso_b,
                                
                            }
                        ]
                    }
                });
            });
        },

        async ChangePeriodo(periodo_id, lado)
        {
            const res = await axios.get('./analisis-de-datos/mostrarCursos/'+ periodo_id);

            if(lado == 'a')
            {
                this.lista_cursos_a   = res.data.lista_cursos;
            }
            else
            {
                this.lista_cursos_b   = res.data.lista_cursos;
            }
        },

        async ChangeCurso(curso_id, lado)
        {
            const res = await axios.get('./analisis-de-datos/mostrarMaterias/'+ curso_id);

            if(lado == 'a')
            {
                this.lista_materias_a = res.data.lista_materias;
            }
            else
            {                
                this.lista_materias_b = res.data.lista_materias;
            }
        },

        async descargar()
        {
            this.escalaPromedio = false;

            let url = './analisis-de-datos/analizar';

            axios.post(url, { 
                'periodo_id_a': this.periodo_id_a,
                'curso_id_a': this.curso_id_a,
                'periodo_id_b': this.periodo_id_b,
                'curso_id_b': this.curso_id_b,
             })
            .then(response => {

                //información gráfico comparación de promedios
                this.curso_a = response.data.curso_a;
                this.curso_b = response.data.curso_b;

                let promedio_a = response.data.promedio_a;
                let promedio_b = response.data.promedio_b;

                let promedio_procentaje_a = (promedio_a * 100) / 20;
                let promedio_procentaje_b = (promedio_b * 100) / 20;

                Highcharts.chart('comparacion-a-b', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Comparación de Cursos ( '+ this.curso_a +' - '+ this.curso_b +')'
                    },
                    subtitle: {
                        text: 'Se realizó una comparación de los promedios de los cursos'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total Promedio'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                    },

                    series: [
                        {
                            name: "",
                            colorByPoint: true,
                            data: [
                                {
                                    name: this.curso_a +' (A) '+ promedio_procentaje_a +' %',
                                    y: promedio_a,
                                    drilldown: "Chrome"
                                },
                                {
                                    name: this.curso_b +' (B) '+ promedio_procentaje_b +' %',
                                    y: promedio_b,
                                    drilldown: "Firefox"
                                },
                            ]
                        }
                    ],
                    drilldown: {
                        breadcrumbs: {
                            position: {
                                align: 'right'
                            }
                        },
                        series: [
                            {
                                name: this.curso_a,
                                id: this.curso_a,
                                data: [
                                    [
                                        "v65.0",
                                        0.1
                                    ],
                                    [
                                        "v64.0",
                                        1.3
                                    ],
                                    [
                                        "v63.0",
                                        53.02
                                    ],
                                    [
                                        "v62.0",
                                        1.4
                                    ],
                                    [
                                        "v61.0",
                                        0.88
                                    ],
                                    [
                                        "v60.0",
                                        0.56
                                    ],
                                    [
                                        "v59.0",
                                        0.45
                                    ],
                                    [
                                        "v58.0",
                                        0.49
                                    ],
                                    [
                                        "v57.0",
                                        0.32
                                    ],
                                    [
                                        "v56.0",
                                        0.29
                                    ],
                                    [
                                        "v55.0",
                                        0.79
                                    ],
                                    [
                                        "v54.0",
                                        0.18
                                    ],
                                    [
                                        "v51.0",
                                        0.13
                                    ],
                                    [
                                        "v49.0",
                                        2.16
                                    ],
                                    [
                                        "v48.0",
                                        0.13
                                    ],
                                    [
                                        "v47.0",
                                        0.11
                                    ],
                                    [
                                        "v43.0",
                                        0.17
                                    ],
                                    [
                                        "v29.0",
                                        0.26
                                    ]
                                ]
                            },
                            {
                                name: this.curso_b,
                                id: this.curso_b,
                                data: [
                                    [
                                        "v58.0",
                                        1.02
                                    ],
                                    [
                                        "v57.0",
                                        7.36
                                    ],
                                    [
                                        "v56.0",
                                        0.35
                                    ],
                                    [
                                        "v55.0",
                                        0.11
                                    ],
                                    [
                                        "v54.0",
                                        0.1
                                    ],
                                    [
                                        "v52.0",
                                        0.95
                                    ],
                                    [
                                        "v51.0",
                                        0.15
                                    ],
                                    [
                                        "v50.0",
                                        0.1
                                    ],
                                    [
                                        "v48.0",
                                        0.31
                                    ],
                                    [
                                        "v47.0",
                                        0.12
                                    ]
                                ]
                            }
                        ]
                    }
                });
                
                //información gráfico aprobados y desaprobados
                let cantidad_aprobado_a    = response.data.cantidad_aprobado_a;
                let cantidad_desaprobado_a = response.data.cantidad_desaprobado_a;

                let cantidad_aprobado_b    = response.data.cantidad_aprobado_b;
                let cantidad_desaprobado_b = response.data.cantidad_desaprobado_b;

                //gráfico aprobados y desaprobados curso A y B
                this.GraficarAprobadosDesaprobados('aprobado-desaprobado-a', this.curso_a, cantidad_aprobado_a, cantidad_desaprobado_a);
                this.GraficarAprobadosDesaprobados('aprobado-desaprobado-b', this.curso_b, cantidad_aprobado_b, cantidad_desaprobado_b);

                //información gráfico comparación alumnos A y B
                let promedios_alumnos_a    = response.data.promedios_alumnos_a;
                let promedios_alumnos_b = response.data.promedios_alumnos_b;

                this.lista_promedios_a_b = [];

                let poncentaje_nota = 0

                promedios_alumnos_a.forEach(promedio => {

                    poncentaje_nota = (promedio.nota * 100) / 20;

                    let promedio_alumnos_a = {};

                    promedio_alumnos_a.name      =  promedio.estudiante +' (A) '+ poncentaje_nota +' %';
                    promedio_alumnos_a.y         =  promedio.nota;
                    promedio_alumnos_a.drilldown =  promedio.estudiante +' (A) '+ poncentaje_nota +' %';

                    this.lista_promedios_a_b.push(promedio_alumnos_a);
                });

                promedios_alumnos_b.forEach(promedio => {

                    poncentaje_nota = (promedio.nota * 100) / 20;

                    let promedio_alumnos_b = {};

                    promedio_alumnos_b.name      =  promedio.estudiante +' (B) '+ poncentaje_nota +' %';
                    promedio_alumnos_b.y         =  promedio.nota;
                    promedio_alumnos_b.drilldown =  promedio.estudiante +' (B) '+ poncentaje_nota +' %';

                    this.lista_promedios_a_b.push(promedio_alumnos_b);
                });

                this.escalaPromedio = true;

                //grafico comparación alumnos A y B
                Highcharts.chart('comparacion-alumnos-a-b', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Comparación de Cursos: Alumos Destacados con Mayor Nota ( '+ this.curso_a +' - '+ this.curso_b +')'
                    },
                    subtitle: {
                        text: 'Se realizó una comparación de los promedios de los cursos'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total Promedio'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                    },

                    series: [
                        {
                            name: "",
                            colorByPoint: true,
                            data: this.lista_promedios_a_b,
                        }
                    ],
                    drilldown: {
                        breadcrumbs: {
                            position: {
                                align: 'right'
                            }
                        },
                        series: [
                            {
                                name: this.curso_a,
                                id: this.curso_a,
                            },
                            {
                                name: this.curso_b,
                                id: this.curso_b,
                                
                            }
                        ]
                    }
                });
            })
        },

        ChangeMateria()
        {
            let lista_materias_id_a = document.getElementsByName('materias_ids_a[]');
            let lista_materias_id_b = document.getElementsByName('materias_ids_b[]');

            let url = './analisis-de-datos/analizar/promedio-materias';

            this.materia_ids_a = [];
            this.materia_ids_b = [];

            for(var i = 0; i < lista_materias_id_a.length; i++)
            {
                if(lista_materias_id_a[i].checked)
                {
                    this.materia_ids_a.push(lista_materias_id_a[i].value);
                }
            }

            for(var i = 0; i < lista_materias_id_b.length; i++)
            {
                if(lista_materias_id_b[i].checked)
                {
                    this.materia_ids_b.push(lista_materias_id_b[i].value);
                }
            }

            axios.post(url, { 
                'periodo_id_a': this.periodo_id_a,
                'curso_id_a': this.curso_id_a,
                'periodo_id_b': this.periodo_id_b,
                'curso_id_b': this.curso_id_b,
                'materia_ids_a': this.materia_ids_a,
                'materia_ids_b': this.materia_ids_b,
             })
            .then(response => {

                let curso_a = response.data.curso_a;
                let curso_b = response.data.curso_b;

                let promedios_materia_a = response.data.promedios_materia_a;
                let promedios_materia_b = response.data.promedios_materia_b;

                let lista_promedios_a_b = [];

                let poncentaje_nota = 0;

                promedios_materia_a.forEach(promedio => {

                    poncentaje_nota = (promedio.promedio * 100) / 20;

                    let promedio_materia_a = {};

                    promedio_materia_a.name      =  promedio.materia +' (A) '+ poncentaje_nota +' %';
                    promedio_materia_a.y         =  promedio.promedio;
                    promedio_materia_a.drilldown =  promedio.materia +' (A) '+ poncentaje_nota +' %';

                    lista_promedios_a_b.push(promedio_materia_a);
                });

                promedios_materia_b.forEach(promedio => {

                    let promedio_materia_b = {};

                    promedio_materia_b.name      =  promedio.materia +' (B) '+ poncentaje_nota +' %';
                    promedio_materia_b.y         =  promedio.promedio;
                    promedio_materia_b.drilldown =  promedio.materia +' (B) '+ poncentaje_nota +' %';

                    lista_promedios_a_b.push(promedio_materia_b);
                });

                //grafico comparación promedios materias A y B
                Highcharts.chart('comparacion-promedios-materias-a-b', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Comparación de Materias: Promedios Por Materia Seleccionada ( '+ curso_a +' - '+ curso_b +')'
                    },
                    subtitle: {
                        text: 'Se realizó una comparación de los promedios de los cursos'
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total Promedio'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                    },

                    series: [
                        {
                            name: "",
                            colorByPoint: true,
                            data: lista_promedios_a_b,
                        }
                    ],
                    drilldown: {
                        breadcrumbs: {
                            position: {
                                align: 'right'
                            }
                        },
                        series: [
                            {
                                name: curso_a,
                                id: curso_a,
                            },
                            {
                                name: curso_b,
                                id: curso_b,
                                
                            }
                        ]
                    }
                });
            });
        },

        GraficarAprobadosDesaprobados(idFigure, curso, cantidad_aprobado, cantidad_desaprobado)
        {
            let total_aprobado_desaprobado = cantidad_aprobado + cantidad_desaprobado;

            let porcentaje_aprobado    = (cantidad_aprobado * 100) / total_aprobado_desaprobado;
            let porcentaje_desaprobado = (cantidad_desaprobado * 100) / total_aprobado_desaprobado;

            Highcharts.chart(idFigure, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: curso +' ( Aprobados y Desaprobados )'
                },
                subtitle: {
                    text: 'Se muestra la cantidad de aprobados y desaprobados de este curso'
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total Aprobados y Desaprobados'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                },

                series: [
                    {
                        name: "",
                        colorByPoint: true,
                        data: [
                            {
                                name: 'Aprobados ('+ porcentaje_aprobado.toFixed(2) +' %)',
                                y: cantidad_aprobado,
                                drilldown: "Aprobados"
                            },
                            {
                                name: 'Desaprobados ('+ porcentaje_desaprobado.toFixed(2) +' %)',
                                y: cantidad_desaprobado,
                                drilldown: "Desaprobados"
                            },
                        ]
                    }
                ],
                drilldown: {
                    breadcrumbs: {
                        position: {
                            align: 'right'
                        }
                    },
                    series: [
                        {
                            name: 'aprobado',
                            id: 'aprobado',
                            data: [
                                [
                                    "v65.0",
                                    0.1
                                ],
                                [
                                    "v64.0",
                                    1.3
                                ],
                                [
                                    "v63.0",
                                    53.02
                                ],
                                [
                                    "v62.0",
                                    1.4
                                ],
                                [
                                    "v61.0",
                                    0.88
                                ],
                                [
                                    "v60.0",
                                    0.56
                                ],
                                [
                                    "v59.0",
                                    0.45
                                ],
                                [
                                    "v58.0",
                                    0.49
                                ],
                                [
                                    "v57.0",
                                    0.32
                                ],
                                [
                                    "v56.0",
                                    0.29
                                ],
                                [
                                    "v55.0",
                                    0.79
                                ],
                                [
                                    "v54.0",
                                    0.18
                                ],
                                [
                                    "v51.0",
                                    0.13
                                ],
                                [
                                    "v49.0",
                                    2.16
                                ],
                                [
                                    "v48.0",
                                    0.13
                                ],
                                [
                                    "v47.0",
                                    0.11
                                ],
                                [
                                    "v43.0",
                                    0.17
                                ],
                                [
                                    "v29.0",
                                    0.26
                                ]
                            ]
                        },
                        {
                            name: 'desaprobado',
                            id: 'desaprobado',
                            data: [
                                [
                                    "v58.0",
                                    1.02
                                ],
                                [
                                    "v57.0",
                                    7.36
                                ],
                                [
                                    "v56.0",
                                    0.35
                                ],
                                [
                                    "v55.0",
                                    0.11
                                ],
                                [
                                    "v54.0",
                                    0.1
                                ],
                                [
                                    "v52.0",
                                    0.95
                                ],
                                [
                                    "v51.0",
                                    0.15
                                ],
                                [
                                    "v50.0",
                                    0.1
                                ],
                                [
                                    "v48.0",
                                    0.31
                                ],
                                [
                                    "v47.0",
                                    0.12
                                ]
                            ]
                        }
                    ]
                }
            });
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