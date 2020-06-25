<template>
<v-form>
  <v-row justify="end">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          v-bind="attrs"
          v-on="on"
          class="ma-2"
          outlined color="indigo">
          <v-icon dark left>mdi-cloud-upload</v-icon>
          Nuevo Prestamo
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline"><strong>Crear Prestamo</strong></span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-select
                  v-model="prestamo.client_id"
                  :items="names"
                  item-text="name"
                  item-value="id"
                  outlined
                  label="Nombre"
              ></v-select>
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                 v-model="prestamo.amount"
                 label="Monto" 
                 type="number" 
                 required>
                </v-text-field>
                
              </v-col>
              <v-col cols="12" md="6">
                <v-text-field
                 v-model="prestamo.payments_number" 
                 label="No. Pagos" 
                 type="number" 
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                 v-model="prestamo.fee" 
                 label="Cuota" 
                 type="number" 
                 required>
                </v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                 v-model="prestamo.ministry_date" 
                 label="Fecha de ministración" 
                 type="date" 
                 required>
                </v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" text v-on:click="guardar">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
  </v-form>
</template>
<script>
    export default {
       name: 'LoanCreateForm',
       mounted: function(){
         this.getNames()
       },
       data: () => ({
           dialog: false,
           prestamo:{
              client_id:'',
              amount:'',
              payments_number:'',
              fee:'',
              ministry_date:'',
              due_date:''
           },
           update: false,
           names:[],
           select: { state: 'Nombre', abbr: 'id' },
       }),
       methods: {
            guardar(){
              axios.post('api/loans',this.prestamo)
                .then(response=>{
                  this.actualizarTable()
                  this.dialog = false
                  console.log('guardado')
                })
                .catch (error=>{
                  console.log(error)
                })
            },
            actualizarTable(){
              this.update = true
              this.$emit('updTable',this.update)
            },
            getNames(){
              axios.get('api/loans/names')
                .then(response=>{
                  this.names=response.data
                })
                .catch (error=>{
                  console.log(error)
                })
            },
        }
    }
</script>