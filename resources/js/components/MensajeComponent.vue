<template>
    <div class="row col-12 ml-1">
        <b>{{ mensaje.usuario }}: </b>&nbsp;<p>{{ mensaje.mensaje }}</p>
    </div>
</template>

<script>
    export default {
        props: ['mensaje'],
        data() {
            return {

            };
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
