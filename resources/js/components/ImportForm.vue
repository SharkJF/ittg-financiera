<template>  
    <v-dialog v-model="dialog" persistent max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          v-bind="attrs"
          v-on="on"
          class="ma-2"
          outlined color="indigo">
          <v-icon dark>mdi-arrow-up-bold-box</v-icon>
          Importar
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline"><strong>Seleccionar archivo</strong></span>
        </v-card-title>
        <v-container>
          <v-text-field
                 placeholder="Después de subir el archivo, presione cerrar"
                 outlined
                 disabled
                 prepend-inner-icon="mdi-arrow-up-bold-circle"
                 required>
                </v-text-field>
            <template>
              <div class="col-sm-10">
                <input type="file" id="file" ref="file" v-on:change="handleFileUpload()" accept=".XLSX, .CSV" class="form-control">
              </div>
            </template>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn outlined color="indigo" text @click="actualizarTable">Cerrar</v-btn>
          <v-btn class="ma-2" outlined color="indigo" text v-on:click="EventSubir">
          <v-icon dark left>mdi-content-save-settings</v-icon>Subir</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script>
    export default {
       name: 'ImportForm',
        data: () => ({
          file: '',
          dialog: false,
          update: false,
      }),
       methods: {
        actualizarTable(){
              this.dialog=false
              this.update = true
              this.$emit('updTable',this.update)
              
            },
         EventSubir(){
            let formData = new FormData();
            formData.append('file', this.file);
            axios
                .post( '/api/import-excel-personas',
                    formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(){
                   console.log("Importado")
                })
                .catch(function(){
                    console.log("Error en importar")
                });
        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        }
        
       }
    }
</script>