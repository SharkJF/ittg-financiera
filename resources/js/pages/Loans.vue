<template>
    <v-card>
        <v-data-table
            :headers="headers"
            :items="loans"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title><strong>Prestamos</strong></v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                   <LoanCreateForm
                       v-on:updTable="actualizarTable($event)">
                   </LoanCreateForm>
                </v-toolbar>
            </template>
            <template v-slot:item.name="{ item }">
            {{ item.client.name }}
          </template>
          <template v-slot:item.actions="{ item }">
                <v-btn color="red" x-small dark
                @click="borrarPrestamo(item)"> 
                    Borrar
                </v-btn>
            </template>
        </v-data-table>
        
    </v-card>
</template>
<script>
import LoanCreateForm from '@/js/components/LoanCreateForm';
    export default {
        name: 'Loans',
         components: {
            LoanCreateForm,
        },
        mounted: function(){
            this.getLoans()
        },
        data: () => {
            return {
                headers:[
                    { text: '#', value: 'id' },
                    { text: 'Cliente', value: 'name' },
                    { text: 'Cantidad', value: 'amount' },
                    { text: 'No Pagos', value: 'payments_number' },
                    { text: 'Cuota', value: 'fee' },
                    { text: 'Fecha Ministracion', value: 'ministry_date' },
                    { text: 'Fecha Vencimiento', value: 'due_date' },
                    { text: 'Acciones',value: 'actions'},
                ],
                loans: []
            }  
        },
        methods: {
            getLoans(){
                axios.get('api/loans').then(response=>{
                    this.loans = response.data
                    console.log(response)
                })
                .catch(error=>{
                    console.log(error)
                })
            },
            actualizarTable(event){
                console.log(event)
                if(event)
                {
                    this.getLoans()
                }
            },
            borrarPrestamo(item){
                const index = this.loans.indexOf(item)
                const id = this.loans[index].id;
                axios.post('api/loans/'+id)
                    .then(response=>{
                        this.eliminado=true
                        this.actualizarTable(this.eliminado)
                        alert('Borrado')
                    })
                    .catch(error=>{
                        console.log(error)
                    })
            }
        },
    }
</script>
