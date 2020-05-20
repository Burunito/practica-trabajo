<template>
    <div class="card">
        <div class="card-header">Yoda bot</div>
        <div class="mensajes">
            <mensaje-component 
            v-for="mensaje in mensajes" 
            :key="mensaje.id"
            :mensaje="mensaje"
            @new="agregarMensaje"
            ></mensaje-component>
            <span class="mascara" id="mask-escribiendo">Escribiendo...</span>
        </div>
        <div class="form">
            <form action="" v-on:submit.prevent="enviarMensaje()">
                <div class="row">
                    <div class="col-10">
                        <input class="form-control " type="text" name="mensaje" id="mensaje" aria-describedby="mensaje" v-model="mensaje">
                     </div>
                     <div class="col-2">   
                        <button class="btn btn-primary">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                id: 1,
                chars: 'Anakin, Yoda, Rey, Palpatine, Kenobi, Luke Skywalker, Leia, Kylo Ren, Padme Amidala',
                films: 'Star Wars: Episodio I - La amenaza fantasma, Star Wars: Episodio II - El ataque de los clone, Star Wars: Episodio III - La venganza de los Sith, Star Wars: Episodio IV - Una nueva esperanza, Star Wars: Episodio V - El Imperio contraataca, Star Wars: Episodio VII - El despertar de la Fuerza, Star Wars: Episodio VIII - Los últimos Jedi, Star Wars: Episodio IX - El ascenso de Skywalker',
                secret: "eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJwcm9qZWN0IjoieW9kYV9jaGF0Ym90X2VuIn0.anf_eerFhoNq6J8b36_qbD4VqngX79-yyBKWih_eA1-HyaMe2skiJXkRNpyWxpjmpySYWzPGncwvlwz5ZRE7eg",
                mensaje: '',
                mensajes: []
            }
        },
        mounted() {
            $('#mask-escribiendo').hide();
            axios.get('all')
                .then((response) => {
                   //this.mensajes = response.data.data;
                   //this.id = response.data.data[response.data.data.length].id + 1;
                }
                ); 
            let intentos = 0;
            let data = {secret: this.secret};
            
            axios.defaults.headers.post["x-inbenta-key"] = 'nyUl7wzXoKtgoHnd2fB0uRrAv0dDyLC+b4Y6xngpJDY=';
            axios.defaults.headers.post["Content-Type"] = 'application/json';
            axios.defaults.headers.post["Access-Control-Allow-Origin"] = '*';
             
            axios.post('https://api.inbenta.io/v1/auth', {secret: this.secret}, 
                {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );
            
            //axios.post(, data, this.config)
            /*    
                .then(
                    (response) => {
                    this.api.header.Authorization = 'Bearer '+response.accessToken;
                    }
                );
            */
            console.log(this.api);
        },
        methods: {
            enviarMensaje(){
                if(!this.mensaje)
                    alert('Debe de escribir un mensaje');

                this.agregarMensaje('Yo', this.mensaje);
                if(this.mensaje.includes('force')){
                    $('#mask-escribiendo').show();
                    setTimeout(function() {
                        $('#mask-escribiendo').hide();
                        this.agregarMensaje('YodaBot', this.films);
                    }.bind(this), 2000);
                }
                else {
                    $('#mask-escribiendo').show();
                    /*
                    axios.post('https://api.inbenta.io/v1/auth', {secret: this.secret}, 
                        {
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        }
                    );
                    */
                    $('#mask-escribiendo').hide();
                }

                this.mensaje='';
                //this.enviarMensaje(mensaje);
            },
            agregarMensaje(usuario, mensaje){
                let mensajeBot = {
                    id: this.id,
                    mensaje: mensaje,
                    usuario: usuario
                };

                this.id++;
                //this.mensaje = '';
                this.mensajes.push(mensajeBot);
                //this.agregarMensaje('YodaBot', this.mensaje);
                axios.post('/', {conversacion: JSON.stringify(this.mensajes)});
            },
            apiMensaje(mensaje){
                $('#mask-escribiendo').show();
                //axios.post('')
               //this.mensajes.push(mensaje);

               if(!response){
                    intentos++;
                    $('#mask-escribiendo').hide();
                    this.agregarMensaje('YodaBot', this.mensaje);
               }
               else {
                    intentos = 0;
                    $('#mask-escribiendo').hide();
                    this.agregarMensaje('YodaBot', this.mensaje);
               }

               if(intentos == 2){
                    intentos = 0;
                    $('#mask-escribiendo').hide();
                    this.agregarMensaje('YodaBot', this.chars);
               }
            },

        }
    }
</script>


<style>
.mensajes {
  max-height: 60vH;
  min-height: 60vH;
  overflow-x: hidden;
  overflow-y: auto;
}

.mascara{
    position: absolute;
    bottom: 40px;
}
</style>