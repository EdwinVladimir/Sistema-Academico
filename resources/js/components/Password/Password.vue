<template>
    <div class="container">
        <form @submit.prevent="guardar()">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Cambio de Password</h1>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3">
                            DNI:
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control" :id="'input_dni'" v-model="dni" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            Contraseña actual:
                        </div>
                        <div class="col-lg-3">
                            <input type="password" class="form-control" :id="'input_now_password'" v-model="now_password" required>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" :id="'type_now_password'" @change="changeTypeInput('now_password')">
                                <label class="form-check-label" for="defaultCheck1">
                                    Ver texto
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            Nueva contraseña:
                        </div>
                        <div class="col-lg-3">
                            <input type="password" class="form-control" :id="'input_new_password'" v-model="new_password" required>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" :id="'type_new_password'" @change="changeTypeInput('new_password')">
                                <label class="form-check-label" for="defaultCheck1">
                                    Ver texto
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            Repita nueva contraseña:
                        </div>
                        <div class="col-lg-3">
                            <input type="password" class="form-control" :id="'input_repeat_new_password'" v-model="repeat_new_password" required>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" :id="'type_repeat_new_password'" @change="changeTypeInput('repeat_new_password')">
                                <label class="form-check-label" for="defaultCheck1">
                                    Ver texto
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-success" data-dismiss="modal">
                                Cambiar contraseña
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

            dni: '',
            now_password: '',
            new_password: '',
            repeat_new_password: '',
        };
    },

    methods: {

        async guardar()
        {
            if(this.new_password == this.repeat_new_password)
            {
                swal({

                    title: "Confirmar el cambio?",
                    text: "Se cambiará su contraseña!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete)
                    {
                        let url = './api/user/cambiar-password';

                        axios.post(url, { 
                            
                            'dni': this.dni,
                            'now_password': this.now_password,
                            'new_password': this.new_password,
                            'repeat_new_password': this.repeat_new_password,
                            'email': usuario,
                         })
                        .then(response => {

                            if(response.data.estado_accion == true)
                            {
                                swal('Correcto!', 'Contraseña cambiada correctamente', 'success');
                            }
                            else if(response.data.estado_accion == 'dniInvalido')
                            {
                                swal('Correcto!', 'El DNI es incorrecto', 'warning');
                            }
                            else
                            {
                                swal('Alerta!', 'Su Contraseña actual no coincide', 'warning');
                            }
                        })
                        .catch(error => {

                        });

                        
                    }
                });
            }
            else
            {
                swal("Alerta!", "Su Nueva contraseña y Repita nueva contraseña deben ser iguales", "warning");
            }
        },

        changeTypeInput(input)
        {
            if($('#type_'+ input).prop('checked'))
            {
                $('#input_'+ input).attr('type', 'text');
            }
            else
            {
                $('#input_'+ input).attr('type', 'password');
            }
        },
    },

    created() 
    {

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