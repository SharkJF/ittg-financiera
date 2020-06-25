<template>  
    <v-dialog v-model="open" persistent max-width="600px">
      
      <v-card>
        <v-card-title>
          <span class="headline"><strong>Editar Usuario</strong></span>
        </v-card-title>
        <v-card-text>
          <v-container>
              <v-col cols="12" sm="6" md="12">
                <v-text-field
                 v-model="value.name"
                 label="Nombre" 
                 type="text" 
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field 
                 v-model="value.phone"
                 label="Telefono" 
                 type="number" 
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                 v-model="value.address" 
                 label="Direccion" 
                 type="text" 
                 required>
                </v-text-field>
              </v-col>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="cerrarForm">Close</v-btn>
          <v-btn color="blue darken-1" text v-on:click="updateClient">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script>
    export default {
       name: 'EditClientForm',
       data: () => ({
          dialog: false,
           cliente:{
              name:'',
              phone:'',
              address:''
           },
           update: false,
       }),
       props:{
         value:{
           type: Object,
           default: function(){
             return {
               name:'',
               address:'',
               phone:'',
             }
           }
         },
         open:{
           type: Boolean,
           default: false,
         }
       },
       watch:{
         open(){
           this.dialog = this.open
         }
       },
       methods: {
            updateClient(){
              axios.put('api/clients/edit/'+this.value.id,this.value)
                .then(response=>{
                  this.actualizarTable()
                  this.cerrarForm()
                })
                .catch (error=>{
                  console.log(error)
                })
            },
            actualizarTable(){
              this.update = true
              this.$emit('updTable',this.update)
            },
            cerrarForm(){
              this.dialog = false
              this.$emit('disable',this.dialog)
            }
        },
    }
</script>