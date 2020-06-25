<template>

  <v-card
    class="mx-auto"
    max-width="344"
  >
    <v-card-text>
      <p class="display-1 text--primary">
        No. de clientes:
      </p>
      <p>adjective</p>
    </v-card-text>
    <v-card-actions>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
    name:'Home',
    mounted: function(){
        this.getNumberClients()
    },
    data: () => ({
        noCliente:''
    }),
    methos:{
        getNumberClients(){
            axios.get('api/clients/noclientes')
                .then(response=>{
                    this.nocliente= response.data
                    console.log(response.data)
                })
                .catch(error=>{
                    console.log(error)
                })
        }
    }
}
</script>

