<template>
    <v-card>
        <v-data-table
            :headers="headers"
            :items="payments"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                    <v-toolbar-title><strong>Pagos</strong></v-toolbar-title>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    ></v-divider>
                    <v-spacer></v-spacer>
                    <v-btn @click="exportExcel"
                    class="ma-2"
                    outlined color="indigo">
                    <v-icon dark left>mdi-cloud-download</v-icon>
                    Descargar
                    </v-btn>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-btn color="black" x-small dark
                :to="{ name:'abonoView', params:{id:item.id}}"
                >
                    abrir
                </v-btn>
            </template>
            <template>
               <PaymetsForm
                v-on:updTable="actualizarTable($event)">
               </PaymetsForm>
            </template>
            <template v-slot:item.name="{ item }">
            {{ item.client.name }}
          </template>
        </v-data-table>
    </v-card>
</template>
<script>
import abonoView from '@/js/components/abonoView';
import XLSX from "xlsx";
    export default {
        name: 'Payments',
        components: {
            abonoView,
        },
        created: function(){
            this.getpayments()
        },
        data: () => {
            return {
                headers:[
                    { text: '#', value: 'id' },
                    { text: 'Cliente', value: 'name' },
                    { text: 'Cantidad', value: 'amount' },
                    { text: 'Cuotas', value: 'payments_number' },
                    { text: 'Pagos completados', value: 'pagos_completados' },
                    { text: 'Saldo abonado', value: 'saldo_abonado' },
                    { text: 'Saldo pendiente', value: 'saldo_pendiente' },
                    { text: 'Finalizado', value: 'finalizado'},
                    { text: 'Acciones', value: 'actions'},
                ],
                payments: [],
                table:[]
            }  
        },
        methods: {
            getpayments(){
                axios.get('api/payments')
                    .then(response=>(
                        this.payments = response.data
                    ))
            },
            exportExcel: function () {
                axios.get('/api/payments/table')
                    .then(response=>{
                        this.table = response.data
                        console.log(this.table)
                        this.exportar()
                    })
                    
            },
            exportar: function()
            {
                const workbook = XLSX.utils.book_new()
                const filename = 'pagos'
                let data = XLSX.utils.json_to_sheet(this.table)
                XLSX.utils.book_append_sheet(workbook, data, filename)
                XLSX.writeFile(workbook, `${filename}.xlsx`)
            }
        },
    }
</script>|