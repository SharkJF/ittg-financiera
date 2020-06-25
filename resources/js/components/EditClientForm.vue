<template> 
<v-form
    ref="form"
    v-model="valid"
    lazy-validation
  > 
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
                 outlined
                 :rules="nameRules"
                 prepend-icon="mdi-format-text"
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field 
                 v-model="value.phone"
                 label="Telefono" 
                 type="number" 
                 outlined
                 :rules="nameRules"
                 prepend-icon="mdi-phone"
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                 v-model="value.address" 
                 label="Direccion" 
                 type="text" 
                 outlined
                 :rules="nameRules"
                 prepend-icon="mdi-map-marker"
                 required>
                </v-text-field>
              </v-col>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outlined color="indigo" text @click="cerrarForm">Close</v-btn>
          <v-btn :disabled="!valid"
            class="ma-2"
            color="indigo"
            tile  text v-on:click="updateClient">
            <v-icon dark left>mdi-content-save-settings</v-icon>
            Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</v-form>
</template>
<script>
    export default {
       name: 'EditClientForm',
       data: () => ({
          dialog: false,
          valid:true,
           cliente:{
              name:'',
              phone:'',
              address:''
           },
           update: false,
           nameRules:[
              v => !!v || 'Name is required',
           ],
           phoneRules:[
              v => !!v || 'Phone is required',
              v => (v && v.length >= 10) || 'Phone must be more than 10 characters',
           ],
           addressRules:[
              v => !!v || 'Address is required',
           ],
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