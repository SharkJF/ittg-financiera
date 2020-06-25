<template>
 <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-dialog v-model="dialog" persistent max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          v-bind="attrs"
          v-on="on"
          class="ma-2"
          outlined color="indigo"
          >
        <v-icon dark left>mdi-account-plus</v-icon>
          Nuevo Cliente
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline"><strong>Crear Usuario</strong></span>
        </v-card-title>
        <v-card-text>
          <v-container>
              <v-col cols="10">
                <v-text-field
                 v-model="cliente.name"
                 outlined
                 label="Nombre" 
                 placeholder="Name"
                 type="text" 
                 :rules="nameRules"
                 prepend-icon="mdi-format-text"
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="10">
                <v-text-field 
                 v-model="cliente.phone"
                 label="Telefono" 
                 type="number"
                 placeholder="Phone" 
                 prepend-icon="mdi-phone"
                 outlined
                 :rules="phoneRules"
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="10">
                <v-text-field
                 v-model="cliente.address" 
                 label="Direccion" 
                 type="text" 
                 placeholder="Address" 
                 prepend-icon="mdi-map-marker"
                 outlined
                 :rules="addressRules"
                 required>
                </v-text-field>
              </v-col>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outlined color="indigo" text @click="dialog=false">Cancelar</v-btn>
          <v-btn
            :disabled="!valid"
            class="ma-2"
            tile 
            @click="guardar"
            outlined color="indigo"
          >
          <v-icon dark left>mdi-content-save-settings</v-icon>
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-form>
</template>
<script>
    export default {
       name: 'UserCreateForm',
       data: () => ({
         valid:true,
           dialog: false,
           cliente:{
              name:'',
              phone:'',
              address:''
           },
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
           update: false,
       }),
       methods: {
            guardar(){
              axios.post('api/clients',this.cliente)
                .then(response=>{
                  this.cliente.name =0
                  this.cliente.phone = ' '
                  this.cliente.address=0
                  this.actualizarTable()
                  this.dialog = false
                  console.log(guardado)
                  
                })
                .catch (error=>{
                  console.log(error)
                })
            },
            actualizarTable(){
              this.update = true
              this.$emit('updTable',this.update)
            },
            cerrar(){
                this.cliente.name =' '
                this.cliente.phone = ' '
                this.cliente.address=' '
                this.dialog = false
            }
        },
    }
</script>