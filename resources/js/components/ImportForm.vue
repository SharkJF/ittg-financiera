<template>  
    <v-dialog v-model="dialog" persistent max-width="500px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          dark
          v-bind="attrs"
          v-on="on"
          class="ma-2"
          outlined color="indigo">
          <v-icon dark left>mdi-arrow-up-bold-box</v-icon>
          Importar
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline"><strong>Seleccionar archivo</strong></span>
        </v-card-title>
        <v-container>
            <template>
            <v-file-input
                v-model="files"
                placeholder="Upload your documents"
                label="File input"
                multiple
                prepend-icon="mdi-paperclip"
                outlined
            >
                <template v-slot:selection="{ text }">
                <v-chip
                    small
                    label
                    color="indigo"
                >
                    {{ text }}
                </v-chip>
                </template>
            </v-file-input>
        </template>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="cerrar">Close</v-btn>
          <v-btn color="blue darken-1" text v-on:click="importar">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script>
    export default {
       name: 'ImportForm',
       data: () => ({
      files: [],
      dialog: false,
    }),
       methods: {
           importar(){
                axios.post('api/clients/import')
                    .then(response=>{
                        alert('Añadidos')
                    })
                    .catch(error=>{
                        console.log(error)
                    })
            },
            cerrar(){
                this.dialog = false
            }
       }
    }
</script>